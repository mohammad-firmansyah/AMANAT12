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

        if ($request->session()->get("token")){
            return redirect("dashboard");
        }

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

            // $a = '$2y$10$h8QEktHn/L444v4gqG.nXeVFuuODoxh6KKhMehMgrB2CeTmEtNRxq';
            // dd($validated["password"],Hash::check("123456", $a));
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

    public function logout(){
        session()->forget('token');
        return redirect("/");
    }
    
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'pass_old' => 'required',
            'pass_new' => 'required|min:6',
            'pass_new_con' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect('dashboard')
            ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        try {
            $decrypted = Crypt::decryptString($request->session()->get("token"));
        } catch (DecryptException $e) {
            dd($e);
        }
        $user = DB::table("users")->where("user_id", $decrypted)->first();

        if ($user->user_id) {

            if ($validated["pass_new_con"] == $validated["pass_new"]) {
                $pass_hashed = Hash::make($validated["pass_new"]);
                $affected =  DB::table("users")->where("user_id",$decrypted)->update(["user_pass" => $pass_hashed]);
                if ($affected) {
                    // dd($affected);
                    session()->forget("token");
                    session()->flash("message","Password has been reset");
                    return redirect("/");
                }
            }
        } 

        return redirect("/")->withErrors("Token is Expired");

    }
}
