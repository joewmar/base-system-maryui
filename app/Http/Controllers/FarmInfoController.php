<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmInfoController extends Controller
{
    //
    public function index()
    {
        return view('farm-information.home');
    }
}
