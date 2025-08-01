<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voluntary;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $cant_voluntaries = Voluntary::count();

        $data = User::selectRaw("date_format(created_at, '%Y-%m-%d') as date, count(*) as aggregate")
        ->whereDate('created_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->get();

        return view('module.dashboard.dashboard', compact('data', 'cant_voluntaries'));
    }
}
