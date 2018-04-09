<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserHash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserHashesController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user->saveIfNotExists();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user->hashes()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //todo exclude
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param UserHash $hash
     * @return UserHash
     */
    public function show(UserHash $hash)
    {
        return $hash;
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
     * @param UserHash $hash
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(UserHash $hash)
    {
        $hash->delete();

        return response()->json(null, 204);
    }
}
