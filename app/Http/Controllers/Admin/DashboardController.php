<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $new_orders = 200;
        $bounce_rate = 70;
        $user_registrations = 50;
        $unique_visitors = 70;

        // Cara 1
        // return view('pages.dashboard.index', ["new_orders" => $new_orders, "bounce_rate" => $bounce_rate]);

        // Cara 2
        return view('pages.dashboard.index', compact('new_orders', 'bounce_rate', 'user_registrations', 'unique_visitors'));
    }
}
