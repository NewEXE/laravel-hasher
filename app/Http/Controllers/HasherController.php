<?php

namespace App\Http\Controllers;

use App\Models\HashAlgorithm;
use App\Models\Vocabulary;
use Illuminate\Http\Request;

class HasherController extends Controller
{
    public function index(Request $request)
    {
        $words = Vocabulary::all();
        $algorithms = HashAlgorithm::all();

        return view('welcome', compact('words', 'algorithms'));
    }
}
