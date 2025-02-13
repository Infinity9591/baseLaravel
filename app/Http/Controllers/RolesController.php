<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function index()
    {
        try {
            $roles = Roles::all();
            return response()->json($roles, 200);

//            return response()->json(DB::select('SHOW TABLES'));
        } catch (\Throwable $th) {
            return response()->json("error", 400);
        }
    }

    public function create(Request $request)
    {
        try {
            Roles::insert([
                'id' => $request->input('id'),
                'name' => $request->input('name')
              ]);
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function update(Request $request){
        try {
            $role = Roles::find($request->input('id'));
            $role->update([
                'name' => $request->input('name')
            ]);
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }
}
