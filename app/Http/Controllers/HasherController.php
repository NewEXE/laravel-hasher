<?php

namespace App\Http\Controllers;

use App\Facades\HMACHasher;
use App\Services\GeoData;
use Illuminate\Http\Request;

class HasherController extends Controller
{
    public function index(Request $request)
    {
//        $geoData = GeoData::get();
//
//        $country = $geoData->country;
//        $ip = $geoData->query;
//        $ua = $request->server('HTTP_USER_AGENT');
//        dd($ua);
        
        return view('welcome');
    }
}
