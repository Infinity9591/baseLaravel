<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        // Lấy tất cả các bản ghi
        $accounts = Accounts::all();
//        return view('accounts.index', compact('roles'));
        return response()->json($accounts);
    }
}
