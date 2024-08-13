<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();

        return view('dashboard.user.user', [
            'users' => $data,
        ]
        );
    }
}
