<?php

namespace App\Console\Commands;

use App\Models\Domain;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RunScannerExpiryDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Determining the end of the domain registration date';

    private $domain;

    private $TLDs;

    private $subDomain;

    private $servers = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->servers = json_decode(Storage::get('whois.servers.json'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $domainsexpiry = Domain::pluck('name', 'id')->all();
        $finish = [];
        foreach ($domainsexpiry as $id => $dm) {
            $whois_string = $this->parser($dm);
            if ($whois_string == "Domain name isn't valid!") {
//                $finish[$dm] = 'ручками';
                $finish[$id] = 0;
                continue;
            }
            $not_found_string = '';
            $tld = $this->TLDs;
            if (isset($this->servers->$tld[2])) {
                $not_found_string = $this->servers->$tld[2];
            }
            if (preg_match($not_found_string, $whois_string, $matches)) {
                $matches[1] = (strpos($matches[1], '.') == true) ? str_replace('.', '-', $matches[1]) : $matches[1];
                $time = strtotime(trim($matches[1]));
//                $finish[$dm] = date('d-m-Y', $time);
                $finish[$id] = $time;
            }

        }
//        dd($finish);
        $this->updateExpire($finish);
    }

    private function parser($domain)
    {
        if (strpos($domain, '/')) $domain = strstr($domain, '/', true);
        $this->domain = (substr_count($domain, '.') > 1) ? $this->domainNamePreparation($domain) : $domain;
        // check $domain syntax and split full domain name on subdomain and TLDs
        if (
            preg_match('/^([\p{L}\d\-]+)\.((?:[\p{L}\-]+\.?)+)$/ui', $this->domain, $matches)
            || preg_match('/^(xn\-\-[\p{L}\d\-]+)\.(xn\-\-(?:[a-z\d-]+\.?1?)+)$/ui', $this->domain, $matches)
        ) {
            $this->subDomain = $matches[1];
            $this->TLDs = $matches[2];
        } else
            throw new \InvalidArgumentException("Invalid $domain syntax");

        if ($this->isValid($this->TLDs) == true) {
            $isTld = $this->TLDs;
            $whois_server = $this->servers->$isTld[0];

            // If TLDs have been found
            if ($whois_server != '') {

                // if whois server serve replay over HTTP protocol instead of WHOIS protocol
                if (preg_match("/^https?:\/\//i", $whois_server)) {

                    // curl session to get whois reposnse
                    $ch = curl_init();
                    $url = $whois_server . $this->subDomain . '.' . $this->TLDs;
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                    $data = curl_exec($ch);

                    if (curl_error($ch)) {
                        return "Connection error!";
                    } else {
                        $string = strip_tags($data);
                    }
                    curl_close($ch);

                } else {

                    // Getting whois information
                    $fp = fsockopen($whois_server, 43);
                    if (!$fp) {
                        return "Connection error!";
                    }

                    $dom = $this->subDomain . '.' . $this->TLDs;
                    fputs($fp, "$dom\r\n");

                    // Getting string
                    $string = '';

                    // Checking whois server for .com and .net
                    if ($this->TLDs == 'com' || $this->TLDs == 'net') {
                        while (!feof($fp)) {
                            $line = trim(fgets($fp, 128));

                            $string .= $line;

                            $lineArr = explode(":", $line);

                            if (strtolower($lineArr[0]) == 'whois server') {
                                $whois_server = trim($lineArr[1]);
                            }
                        }
                        // Getting whois information
                        $fp = fsockopen($whois_server, 43);
                        if (!$fp) {
                            return "Connection error!";
                        }

                        $dom = $this->subDomain . '.' . $this->TLDs;
                        fputs($fp, "$dom\r\n");

                        // Getting string
                        $string = '';

                        while (!feof($fp)) {
                            $string .= fgets($fp, 128);
                        }

                        // Checking for other tld's
                    } else {
                        while (!feof($fp)) {
                            $string .= fgets($fp, 128);
                        }
                    }
                    fclose($fp);
                }

                $string_encoding = mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true);
                $string_utf8 = mb_convert_encoding($string, "UTF-8", $string_encoding);

                return htmlspecialchars($string_utf8, ENT_COMPAT, "UTF-8", true);
            } else {
                return "No whois server for this tld in list!";
            }
        } else {
            return "Domain name isn't valid!";
        }
    }

    private function isValid($tld)
    {
        if (
            isset($this->servers->$tld[0]) && strlen($this->servers->$tld[0]) > 6 && $tld != 'my' && $tld != 'gr' && $tld != 'eu'
        ) {
            $tmp_domain = strtolower($this->subDomain);
            if (
                preg_match("/^[a-z0-9\-]{3,}$/", $tmp_domain)
                && !preg_match("/^-|-$/", $tmp_domain) //&& !preg_match("/--/", $tmp_domain)
            ) {
                return true;
            }
        }

        return false;
    }

    private function domainNamePreparation($dmn)
    {
        $countPoins = substr_count($dmn, '.');

        $newDmn = ($countPoins > 2) ? implode('.', array_slice(explode('.', $dmn), -3)) : $dmn;

        if ((strpos($newDmn, 'com.ua') == true) || (strpos($newDmn, 'in.ua') == true) || (strpos($newDmn, 'org.ua') == true)) {
            return $newDmn;
        } else {
            $newDmn = ltrim(strstr($newDmn, '.'), '.');
            return $newDmn;
        }
    }

    private function updateExpire($finish)
    {
//        dd($finish);
        if ($finish) {
            foreach ($finish as $key => $var) {
                $domains = Domain::find($key);
                if ($var != 0){
                    $domains->expiry = $var;
                    $domains->save();
                }
            }
        }
    }

}
