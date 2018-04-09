<?php

namespace App\Http\Controllers;

use App\Facades\HMACHasher;
use App\Models\HashAlgorithm;
use App\Models\User;
use App\Models\UserHash;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserHashesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Vocabulary::all();
        $algorithms = HashAlgorithm::all();

        return view('welcome', compact('words', 'algorithms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return void
     */
    public function store(Request $request, User $user)
    {
        $user = $user->saveIfNotExists();

        /** @var Collection $algorithms */
        $algorithms = HashAlgorithm::whereIn('id', $request->inputAlgorithms)->get(['id', 'name'])->keyBy('id');

        $words = Vocabulary::whereIn('id', $request->inputWords)->get(['id', 'word']);

        HMACHasher::encodeMany($user, $words, $algorithms);

        $hashes = HMACHasher::getEncoded();

        dump($hashes);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
