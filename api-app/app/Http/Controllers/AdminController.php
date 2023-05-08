<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminRole($id)
    {
        $user = User::find($id);
        $user->role_id = 1;
        $user->save();
        return response([
            'message' => 'Congrat, You are Admin Now.',
            'user' => $user
        ]);
    }
    public function UserRole($id)
    {
        $user = User::find($id);
        $user->role_id = 2;
        $user->save();
        return response([
            'message' => 'Congrat, You are A Normal User Now.',
            'user' => $user
        ]);
    }

    public function VerifiedEmail()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->markEmailAsVerified();
        return response([
            'message' => 'Email is Verified.',
            'user' => $user
        ]);
    }
}
