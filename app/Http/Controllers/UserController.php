<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserInfo()
    {
        $info = User::findOrFail(1);

        return response()->json($info);
    }
}
