<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permissions::all();
        return response()->json($permissions);
    }

    function create(Request $request){
        try {
            Permissions::insert([
                'id' => $request->input('id'),
                'action_name' => $request->input('action_name'),
            ]);
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            return response()->json('error', 500);
        }
    }
}
