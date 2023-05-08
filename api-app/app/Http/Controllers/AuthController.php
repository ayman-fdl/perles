<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register (Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('perlesToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return Response($response, 201);
    }
    public function login (Request $request){
        $fileds = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fileds['email'])->first();

        if (!$user || !Hash::check($fileds['password'], $user->password)) {
            return response([
                'message' => 'Email ou Mot de passe sont incorrecte.'
            ], 401);
        }
        $token = $user->createToken('perlesToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        // return response()->json(['message' => 'Logged Out.'], 201);
        return response([
            'message' => 'You\'re Logged out'
        ],200);
    }

    public function user(){
        return response([
            'user' => auth()->user(),
            'user id' => Auth::user()['name']
        ], 200);
    }


    public function update(Request $request){
        $adminRole = 1;
        $userRole = 2;

        $id = Auth::user()->id;
        $user = User::find($id); // search of a user with his id
        $user->update($request->all());
        return response([
            'user' => $user
        ]);
    }





    public function alluser(){
        return User::all();
    }
}
