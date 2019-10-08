<?php

namespace App\Http\Controllers\Status;

use App\Http\Requests\StatusDomainStoreRequest;
use App\Http\Requests\StatusDomainUpdateRequest;
use App\Models\Domain;
use Illuminate\Support\Facades\Cache;
use \Storage;
use App\Repositories\StatusDomainRepository;

class DomainController extends BaseController
{
    private $statusDomainRepository;

    public function __construct()
    {
        $this->middleware('auth');
//        $this->statusDomainRepository = new StatusDomainRepository();
        $this->statusDomainRepository = app(StatusDomainRepository::class);
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
        $domain = $this->statusDomainRepository->storeDomain($request);
        Domain::create($domain);
        Storage::disk('logs')->makeDirectory($domain['namefolder']);
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
