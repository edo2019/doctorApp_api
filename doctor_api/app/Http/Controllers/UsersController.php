<?php

namespace App\Http\Controllers;

use App\Models\User;
//use Dotenv\Exception\ValidationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        //handle incoming request
        $request->validate(
            [
                'email'=>'required|email',
                'password'=>'required',
            ]
            );
        $user = User::where('email', $request->email)->first();

        if(!$user || ! Hash::check($request->password, $user->password)){
            throw validationException::withMessages([
               'email'=>['The provided credetials are incorrect'],
            ]);
        }
        return $user->createToken($request->email)->plainTextToken;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
