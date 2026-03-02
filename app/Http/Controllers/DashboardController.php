<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user    = $request->user();
        $prompts = $user->prompts()->latest()->take(10)->get();

        return view('dashboard', compact('user', 'prompts'));
    }
}
