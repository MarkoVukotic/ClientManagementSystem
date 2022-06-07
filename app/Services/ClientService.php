<?php

namespace App\Services;


use App\Models\Client;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class ClientService
{

    public static function orderClients()
    {
        try {
            $clients = Client::orderBy('id', 'DESC')->paginate(15);
            return response()->view('client.index', ['clients' => $clients]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public static function createClient($request)
    {
        try {
            Client::create($request->validated());
            return redirect(route('client.index'))->with('success', 'New client have been created');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public static function clientUpdate($client, Request $request)
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

    public static function clientDestroy(Request $request)
    {
        try {
            Client::where('id', $request->get('id'))->delete();
            return redirect('client')->with('success', 'Client have been successfully deleted');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public static function getSoftDeletedClients()
    {
        try {
            $soft_deleted_clients = Client::withTrashed()->get();
            return view('client.softDeletedClients')->with(['deleted_clients' => $soft_deleted_clients]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public static function forceDeleteSoftDeletedClients()
    {
        try {
            $force_deleted_clients = Client::withTrashed()->where('id', 1)->forceDelete();
            return output($force_deleted_clients);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public static function restoreSoftDeletedClients($id)
    {
        try {
            Client::select('*')->withTrashed()->where('id', $id)->restore();
            return redirect('client')->with('success', 'Client have been successfully restored');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function bestClients()
    {
        try {
            $clients = Client::has('project', '>=', 3)->orderBy('id', 'DESC')->paginate(15);
            return view('client.best')->with(['clients' => $clients]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
