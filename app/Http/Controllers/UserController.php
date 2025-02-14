<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        return response()->json(Users::all(), 200);
    }

    function create(Request $request){
        try {
            $account_id = $request->input('account_id');
            Users::insert([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'account_id' => $account_id
            ]);
            return response()->json("success", 200);

        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    function update(Request $request){
        try {
            $user = Users::find($request->input('id'));
            $user->update([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'account_id' => $request->input('account_id'),
            ]);
            return response()->json("success", 200);

        } catch (\Throwable $th) {
            return response()->json($th, 400);

        }
    }
}
