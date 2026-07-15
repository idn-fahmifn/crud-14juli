<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Category, Item};

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'totalItems' => Item::count(),
            'totalCategory' => Category::count(),
            'goodCondition' => Item::where('condition', 'good')->count(),
            'needAttention' => Item::whereIn('condition', ['bad', 'maintenance'])->count()
        ]);
    }
}
