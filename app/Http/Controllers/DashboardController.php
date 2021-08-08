<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $rewards = Reward::all();

        return view('dashboard.dashboard', compact('rewards'));
    }

    public function validateCode(Request $request)
    {
        if($request->code === '3v3nt') {
            return http_response_code(200);
        } else {
            abort('404', 'Event code is not valid.');
        }
    }
}
