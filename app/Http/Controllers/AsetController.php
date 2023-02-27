<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function dashboard(){
        $user = DB::table("users")->where("user_id",session("token"))->first();

        $nama = $user->username;
        $jabatan = $user->
        return view("page.home",compact(["nama","title","jabatan"]));
    }
}
