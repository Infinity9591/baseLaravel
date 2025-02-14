<?php

namespace App\Http\Controllers;

use App\Models\RolePermissions;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    function index(){
        $rolePermissions = RolePermissions::all();
        return response()->json($rolePermissions);
    }

    function addPermissions(Request $request){
        try {
            $permissions = ($request->all());
            if (!is_array($permissions)) {
                return response()->json('Input must be an array', 400);
            }
            $result = [];
            foreach ($permissions as $permission) {
                $role_id = $permission['role_id'];
                $permission_id = $permission['permission_id'];
                $table_name = $permission['table_name'];

                $exists = RolePermissions::where('role_id', $role_id)->where('permission_id', $permission_id)->where('table_name', $table_name)->first();

                if ($exists) {
                    $exists['status'] = 'Exists';
                    array_push($result, $exists);
                } else {
                    RolePermissions::insert(['role_id' => $role_id,'permission_id' => $permission_id,'table_name' => $table_name]);
                    $exists['status'] = 'Created';
                    array_push($result, $exists);
                }
            }
            return response()->json($result, 200);


        } catch (\Throwable $th) {
            return response()->json("error", 500);

        }
    }

    function deletePermissions(Request $request){
        try {
            $permissions = ($request->all());
            if (!is_array($permissions)) {
                return response()->json('Input must be an array', 400);
            }
            $result = [];
            foreach ($permissions as $permission) {
                $role_id = $permission['role_id'];
                $permission_id = $permission['permission_id'];
                $table_name = $permission['table_name'];

                $exists = RolePermissions::where('role_id', $role_id)->where('permission_id', $permission_id)->where('table_name', $table_name)->first();

                if ($exists) {
                    $exists->delete();
                    $exists['status'] = 'Deleted';
                    array_push($result, $exists);
                } else {
                    $exists['status'] = 'Not Found';
                    array_push($result, $exists);
                }
            }
            return response()->json($result, 200);


        } catch (\Throwable $th) {
            return response()->json("error", 500);

        }
    }
}
