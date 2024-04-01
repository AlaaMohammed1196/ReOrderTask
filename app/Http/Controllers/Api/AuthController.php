<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class AuthController extends Controller
{


    public function getUsers()
    {
           $users = DB::table('users')
               ->get();
           return response(['users' =>$users],200);
    }
}
