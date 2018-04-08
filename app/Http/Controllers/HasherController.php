<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HasherController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }
}
