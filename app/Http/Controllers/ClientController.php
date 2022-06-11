<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

/**
 *
 */
class ClientController extends Controller
{
    /**
     * @var ClientService
     */
    protected $clientService;

    /**
     * @param ClientService $clientService
     */
    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('client.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return RedirectResponse
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
     * @param Client $client
     * @return void
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return Application|Factory|View
     */
    public function edit(Client $client)
    {
        return view('client.edit')->with(['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return Application|Redirector|RedirectResponse
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
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Request $request)
    {
        try {
            return $this->clientService->clientDestroy($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @return Application|Factory|View|void
     */
    public function softDeletedClients()
    {
        try {
            return $this->clientService->getSoftDeletedClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector|void
     */
    public function forceDeleteSoftDeletedClients($id)
    {
        try {
            return $this->clientService->forceDeleteSoftDeletedClients($id);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector|void
     */
    public function restoreSoftDeletedClients($id)
    {
        try {
            return $this->clientService->restoreSoftDeletedClients($id);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @return Application|Factory|View|void
     */
    public function bestClients()
    {
        try {
            return $this->clientService->bestClients();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function displayClient($id){
        return $this->clientService->displayClient($id);
    }
}
