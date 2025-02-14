<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Accounts::all();
        return response()->json($accounts);
    }

    public function create(Request $request)
    {
//        return response()->json($request->input('username'));
        try {
            if (request()->input('username') == "" || request()->input('password') == ""){
                return response()->json('Username or Password must not be null', 400);
            } else {
                $existsUsername = Accounts::where('username', request()->input('username'))->first();
                if ($existsUsername) {
                    return response()->json('Username already exists', 500);
                } else {
                    $password_hash = password_hash(request()->input('password'), PASSWORD_BCRYPT, ['cost' => (int)env('COST_FACTOR')]);
//                    return response()->json($password_hash, 200);
                    if ($request->input('role_id') !== null){
                        $role_id = $request->input('role_id');
                    }
                    else $role_id = null;
//                    return response()->json($role_id, 200);

                    Accounts::insert([
                        'username' => $request->input('username'),
                        'password_hash' => $password_hash,
                        "role_id" => $role_id,
                        'is_active' => 1
                    ]);
                    return response()->json("success", 200);
                }
            }
        } catch (\Throwable $th) {

            return response()->json('error', 500);
        }
    }

    function deactive(Request $request){
        try {
            $account = Accounts::where('id', $request->input('id'))->first();
            $account->update(['is_active' => 0]);
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            return response()->json("error", 500);
        }
    }

    function active(Request $request){
        try {
            $account = Accounts::where('id', $request->input('id'))->first();
            $account->update(['is_active' => 1]);
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            return response()->json("error", 500);
        }
    }

    function editRole(Request $request){
        try {
            $account = Accounts::where('id', $request->input('id'))->first();
            $account->update(['role_id' => $request->input('role_id')]);
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            return response()->json("error", 500);
        }
    }
}
