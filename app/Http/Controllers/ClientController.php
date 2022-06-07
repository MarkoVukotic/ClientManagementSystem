<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientService $clientService)
    {
        try {
            return $clientService->orderClients();
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
    public function store(StoreClientRequest $request, ClientService $clientService)
    {
        try {
            return $clientService->createClient($request);
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
    public function update(Request $request, Client $client, ClientService $clientService)
    {
        try {
            return $clientService->clientUpdate($client, $request);
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
    public function destroy(Request $request, ClientService $clientService)
    {
        try {
            return $clientService->clientDestroy($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function softDeletedClients(ClientService $clientService)
    {
        try {
            return $clientService->getSoftDeletedClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function forceDeleteSoftDeletedClients(ClientService $clientService)
    {
        try {
            return $clientService->forceDeleteSoftDeletedClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function restoreSoftDeletedClients(ClientService $clientService, $id)
    {
        try {
            return $clientService->restoreSoftDeletedClients($id);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function bestClients(ClientService $clientService)
    {
        try {
            return $clientService->bestClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
