<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainDrawController extends Controller
{
    public function index()
    {
        return view('maindraw.index');
    }
}
