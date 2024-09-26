<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalClients = Client::count();

        return response()->json([
            'total_users' => $totalUsers,
            'total_products' => $totalProducts,
            'total_clients' => $totalClients
        ]);
    }
}
