<?php

namespace App\Http\Controllers;

use App\Facades\HMACHasher;
use Illuminate\Http\Request;

class HasherController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
