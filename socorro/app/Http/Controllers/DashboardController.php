<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voluntary;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $cant_voluntaries = Voluntary::count();

        $cant_voluntaries_no_payment = Voluntary::where('payment', false)->count();

        $data = Voluntary::join('delegations', 'voluntaries.delegation_id', '=', 'delegations.id')
        ->selectRaw('voluntaries.delegation_id, COUNT(*) as aggregate, delegations.name as delegation_name')
        ->groupBy('voluntaries.delegation_id', 'delegations.name')
        ->get();

        $add = StockMovement::selectRaw('SUM(quantity * unit_cost) as total')
                              ->where('type', 'add')
                              ->first();

        $reduce = StockMovement::selectRaw('SUM(quantity * unit_cost) as total')
                              ->where('type',  'reduce') 
                              ->get();

        return view('module.dashboard.dashboard', compact('data', 'cant_voluntaries', 'add', 'reduce', 'cant_voluntaries_no_payment'));
    }
}
