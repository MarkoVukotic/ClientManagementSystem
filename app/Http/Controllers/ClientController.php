<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    protected $clientService;

    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->clientService->orderClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreClientRequest $request)
    {
        try {
            return $this->clientService->createClient($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit')->with(['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Client $client)
    {
        try {
            return $this->clientService->clientUpdate($client, $request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        try {
            return $this->clientService->clientDestroy($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function softDeletedClients()
    {
        try {
            return $this->clientService->getSoftDeletedClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function forceDeleteSoftDeletedClients()
    {
        try {
            return $this->clientService->forceDeleteSoftDeletedClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function restoreSoftDeletedClients($id)
    {
        try {
            return $this->clientService->restoreSoftDeletedClients($id);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function bestClients()
    {
        try {
            return $this->clientService->bestClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
