<?php

namespace App\Http\Controllers;

use App\Models\TableLogs;
use Illuminate\Http\Request;

class TableLogController extends Controller
{
    function index(){
        try {
            return response()->json(TableLogs::all(), 200);
        } catch (\Throwable $th) {
            return response()->json("error", 500);
        }
    }
}
