<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

$environment = App::environment();

class AccountsController extends Controller
{
    public function index()
    {
        // Lấy tất cả các bản ghi
        $accounts = Accounts::all();
//        return view('accounts.index', compact('roles'));
        return response()->json($accounts);
    }

    public function create(Request $request)
    {
        try {
            if (request()->input('username') === "" || request()->input('password') === ""){
                return response()->json('Username or Password must not be null', 400);
            } else {
                $existsUsername = Accounts::where('username', request()->input('username'))->first();
                if ($existsUsername) {
                    return response()->json('Username already exists', 500);
                } else {
                    $password_hash = password_hash(request()->input('password'), PASSWORD_BCRYPT, ['cost' => env('COST_FACTOR')]);
//                    Accounts::insert()
                }
            }
        } catch (\Throwable $th) {

        }
    }
}
