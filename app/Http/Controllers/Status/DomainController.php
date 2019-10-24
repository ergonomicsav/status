<?php

namespace App\Http\Controllers\Status;

use App\Http\Requests\StatusDomainStoreRequest;
use App\Http\Requests\StatusDomainUpdateRequest;
use App\Models\Domain;
use App\Repositories\ExpiryScannerProcessing;
use App\Repositories\ModelProcessing;
use Illuminate\Support\Facades\Cache;
use \Storage;
use App\Repositories\StatusDomainRepository;
use App\Repositories\SslScannerProcessing;

class DomainController extends BaseController
{
    private $statusDomainRepository;
    private $sslScannerProcessing;
    private $expiryScannerProcessing;
    private $modelProcessing;

    public function __construct()
    {
        $this->middleware('auth');
//        $this->statusDomainRepository = new StatusDomainRepository();
        $this->statusDomainRepository = app(StatusDomainRepository::class);
        $this->sslScannerProcessing = app(SslScannerProcessing::class);
        $this->expiryScannerProcessing = app(ExpiryScannerProcessing::class);
        $this->modelProcessing = app(ModelProcessing::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param StatusDomainRepository $domainRepository
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timemonitoring = explode(' ', Cache::get('new_time'));
        $domains = $this->statusDomainRepository->getDomains();
        if (empty($domains)) abort(404);

        return view('Admin.index', compact('domains', 'timemonitoring'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusDomainStoreRequest $request)
    {
        $valueArr = $this->statusDomainRepository->storeDomain($request);
        $domain = Domain::create($valueArr);
        $this->sslScannerProcessing->processing($domain);
        $this->expiryScannerProcessing->processing($domain);
        $this->modelProcessing->processing($domain);
        Storage::disk('logs')->makeDirectory($valueArr['namefolder']);
        return redirect()->route('domains.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Domain $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        $domain = $this->statusDomainRepository->preparationDataEditing($domain);

        return view('Admin.edit', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Domain $domain
     * @return \Illuminate\Http\Response
     */
    public function update(StatusDomainUpdateRequest $request, Domain $domain)
    {
        $updateDomain = $this->statusDomainRepository->updateDomain($request);
//        dd($updateDomain, $domain);
        if ($updateDomain['namefolder'] != $domain->namefolder){
            Storage::disk('logs')->makeDirectory($updateDomain['namefolder']);
            Storage::disk('logs')->deleteDirectory($domain->namefolder);
        }
        $domain->update($updateDomain);
        return redirect()->route('domains.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Domain $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
//        $dmName = $domain->getAttribute('name');
        Storage::disk('logs')->deleteDirectory($domain->namefolder);
        $domain->delete();
        return redirect()->route('domains.index');
    }
}
