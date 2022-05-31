<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $clients = Client::orderBy('id', 'DESC')->paginate(15);
            return response()->view('client.index', ['clients' => $clients]);
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
            Client::create($request->validated());
            return redirect(route('client.index'))->with('success', 'New client have been created');
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
            $client->update([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'country' => $request->get('country'),
                'priority' => $request->get('priority'),
            ]);
            return redirect('client')->with('success', 'Client have been successfully updated');

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
            Client::where('id', $request->get('id'))->delete();
            return redirect('client')->with('success', 'Client have been successfully deleted');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function softDeletedClients()
    {
        try {
            $soft_deleted_clients = Client::withTrashed()->where('id', 1)->get();
            return output($soft_deleted_clients);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function forceDeleteSoftDeletedClients()
    {
        try {
            $force_deleted_clients = Client::withTrashed()->where('id', 1)->forceDelete();
            return output($force_deleted_clients);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function bestClients(){
        try {
            $clients = Client::has('project', '>=', 3)->orderBy('id', 'DESC')->paginate(15);
            return view('client.best')->with(['clients' => $clients]);
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }
}
