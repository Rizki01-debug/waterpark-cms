<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class UserDashboardController extends Controller
{
    public function index()
{
    $banner = Banner::where('status', true)->latest()->first();

    return view('frontend.dashboard', compact('banner'));
}

}