<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $request;

        $user = DB::table("users")->where("username",$validated["username"])->get();
        if (count($user)) {
            if (Hash::check($validated["password"],$user[0]->user_pass)) {
                $request->session()->put("token",Crypt::encryptString($user[0]->user_id));
                return redirect("dashboard");
            }
            else {
                return redirect("/")->withErrors("Username or Password Incorrect");
            }
        } else {
            $user = DB::table("users")->where("user_nip",$validated["username"])->get();
            if (count($user)) {
                $hashedPassword = Hash::make($validated["password"]);
                if (Hash::check($user[0]->user_pass , $hashedPassword)) {
                    $request->session("token",Crypt::encryptString($user[0]->user_id));
                    return redirect("dashboard");
                }
            }
            return redirect("/")->withErrors("Username or Password Incorrect");
        }

    }
}
