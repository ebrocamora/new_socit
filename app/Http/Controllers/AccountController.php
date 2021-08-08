<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();

        $roles = auth()->user()->roles();

        return view('account.profile', compact('user'));
    }
}
