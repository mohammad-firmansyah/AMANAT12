<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class User
{
    public static function get_user_from_token()
    {
        // dd(session("token"));
        if(session("token")) {

            try {
                $decrypted = Crypt::decryptString(session("token"));
            } catch (DecryptException $e) {
                print_r($e);
            }

            $user = DB::table('users')->where('user_id', $decrypted)->first();

            // dd($user);
            if ($user->user_id) {
                return $user;
            }
        }

    }
}
