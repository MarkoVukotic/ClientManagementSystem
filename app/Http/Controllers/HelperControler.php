<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;

class HelperControler extends Controller
{

    public static function getUserNamesWithIds()
    {
        return User::select('name', 'id')->get()->toArray();
    }

    public static function getClientNamesWithIds()
    {
        return Client::select('first_name', 'id')->get()->toArray();
    }

}
