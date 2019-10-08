<?php

/**
 * Created by PhpStorm.
 * User: lysyi
 * Date: 30.06.16
 * Time: 14:29
 */
class TrackingSites {

    public $jsonFileName = 'report.json';

    public $sites;

    private $_reportArray = [];

    private $_reportErrorArray = [];

    private $_reportEmails = [
        #'lysyi.alex@gmail.com',
        #'leonstr.leon@gmail.com',
        #'neuomateo@gmail.com'
        'vitaliy.kostyukov@gmail.com'
    ];

    private $_consoleLog;

    /**
     * @return mixed
     */
    public function getConsoleLog() {
        return $this->_consoleLog;
    }

    /**
     * @param mixed $consoleLog
     */
    public function setConsoleLog($consoleLog) {
        $this->_consoleLog = $consoleLog;
    }



    public function __construct($fileName = null, $sites = null, $consoleLog = false) {
        echo date('H:i:s d/m/Y') . "\n";
        if (is_null($sites)) {
            die ('sites is empty');
        } else {
            $this->setSites($sites);
        }

        if (!is_null($fileName)) {
            $this->jsonFileName = $fileName;
        }

        $this->setConsoleLog($consoleLog);

        $this->trekking();
    }

    /**
     * @return mixed
     */
    public function getSites() {
        return $this->sites;
    }

    /**
     * @param mixed $sites
     */
    public function setSites($sites) {
        $this->sites = $sites;
    }

    public function trekking() {
        foreach($this->getSites() as $key => $group) {

            foreach($group as $site) {
                $headers  = $this->_curlRequest($site);
                $httpCode = $this->_getHttpCode($headers);
                $siteIp   = $this->_getSiteIp($headers);

                $this->_reportArray[$key][] = [
                    'httpCode' => $httpCode,
                    'time'     => $this->getTime(),
                    'site'     => $site,
                    'ip'       => $siteIp

                ];

                $this->_curlConsoleLog($site, $httpCode, $siteIp);
                if ($httpCode !== 200 && $httpCode !== 0) {
                    $this->_reportErrorArray[] = $site . ' - ' . $httpCode;
                }
            }
        }
        $this->_writeReportInFile($this->_reportArray, $this->jsonFileName);
        if (!empty($this->_reportErrorArray)) {
            $this->_sendErrorReport($this->_reportErrorArray);
        }
    }

    public function _curlConsoleLog($site, $httpCode, $siteIp) {
        if ($this->getConsoleLog()) {
            echo $httpCode . ' - ' . $site . "\n";
        }
    }

    public function getTime() {
        return date('H:i:s d/m/Y');
    }

    private function _curlRequest($site) {
        $ch = curl_init();
        $options = [
            CURLOPT_URL            => $site,
            CURLOPT_HEADER         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 30
        ];

        curl_setopt_array($ch, $options);
        curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);
        return $headers;
    }

    private function _getHttpCode(array $headers) {
        return $headers['http_code'];
    }

    private function _getSiteIp(array $headers) {
        return $headers['primary_ip'];
    }


    private function _sendErrorReport($arr) {
        $subject = 'Sparta Report';

        $message = '';
        foreach($arr as $site) {
            $message .= $site . "\n";
        }

        $headers = 'From: report@sparta.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        foreach($this->_reportEmails as $email){
            if(!mail($email, $subject, $message, $headers)) {
                echo 'error to send mail' . "\n";
            } else {
                echo 'mail send!' . "\n";
            }
        }
    }

    private function _writeReportInFile($sites, $fileName) {

        if(!file_put_contents(__DIR__ . '/' . $fileName, json_encode($sites))) {
            die ('error write json file');
        } else {
            echo "\n File write! \n";
        }

        echo "\n\n\n";

        return true;
    }
}
