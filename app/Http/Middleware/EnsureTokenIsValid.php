<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Crypt;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $decrypted = Crypt::decryptString($request->session()->get("token"));
        } catch (DecryptException $e) {
            dd($e);
        }
        $user = DB::table("users")->where("user_id",$decrypted)->get();
        if (count($user)) {
            return $next($request);
        } else {
            return redirect("/")->withErrors("Token is Expired");
        }
    }
}
