<?php

namespace App\Http\Controllers;

use PHPUnit\Exception;

class HomeController extends Controller
{
    public function index()
    {
        try {
            return view('home.index');
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
