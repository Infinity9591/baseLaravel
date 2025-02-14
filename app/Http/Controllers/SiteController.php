<?php

namespace App\Http\Controllers;

use App\Helpers\JWTHelper;
use App\Models\Accounts;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    function login(Request $request){
        try {
            $account = Accounts::where('username', request('username'))->first();
            if (!$account){
                return response()->json("Username or Password is not correct (Username)", 401);
            }
            else if ($account->is_active == 0){
                return response()->json("Your account is not active", 403);
            }
            else {
                if (password_verify(request('password'),  $account->password_hash)){
                    $payload = ['id' => $account->id, 'username' => $account->username];
                    $token = JwtHelper::createToken($payload, 3600);
//                    return response()->json(['token' => $token], 200);
                    return response()->json(['message' => 'Success', 'token'=>$token, 'user' => ['id'=>$account->id, 'username' => $account->username]], 200);
                }
            }
        } catch (\Throwable $th) {
            return response()->json("error", 500);

        }
    }
}
