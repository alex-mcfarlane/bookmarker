<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        $users = $users->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name
            ];
        });

        return $users;
    }
}
