<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voluntary;
use App\Models\StockMovement;
use App\Models\SendOut;
use App\Models\Rescue;
use App\Models\FinanceTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Support\DelegationAccess;

class DashboardController extends Controller
{
    public function index(){

        $cant_voluntaries = DelegationAccess::scope(Voluntary::query())->count();

        $cant_voluntaries_no_payment = DelegationAccess::scope(Voluntary::query())->where('payment', false)->count();

        $data = Voluntary::join('delegations', 'voluntaries.delegation_id', '=', 'delegations.id')
        ->selectRaw('voluntaries.delegation_id, COUNT(*) as aggregate, delegations.name as delegation_name')
        ->groupBy('voluntaries.delegation_id', 'delegations.name')
        ->when(!DelegationAccess::isNational(), fn ($query) => $query->where('voluntaries.delegation_id', DelegationAccess::id()))
        ->get();

        $add = StockMovement::selectRaw('SUM(quantity * unit_cost) as total')
                              ->when(!DelegationAccess::isNational(), fn ($query) => $query->where('delegation_id', DelegationAccess::id()))
                              ->where('type', 'add')
                              ->first();

        $reduce = StockMovement::selectRaw('SUM(quantity * unit_cost) as total')
                              ->when(!DelegationAccess::isNational(), fn ($query) => $query->where('delegation_id', DelegationAccess::id()))
                              ->where('type',  'reduce')
                              ->get();

        $today = Carbon::today();

        // Cumpleaños de hoy
        $birthdaysToday = Voluntary::whereMonth('birthday', $today->month)
            ->when(!DelegationAccess::isNational(), fn ($query) => $query->where('delegation_id', DelegationAccess::id()))
            ->whereDay('birthday', $today->day)
            ->get();

        // Lista ordenada por mes y día
        $allBirthdays = Voluntary::orderByRaw('MONTH(birthday), DAY(birthday)')
            ->when(!DelegationAccess::isNational(), fn ($query) => $query->where('delegation_id', DelegationAccess::id()))
            ->get();

        $months = collect(range(5, 0))->map(fn ($offset) => now()->subMonths($offset)->startOfMonth());
        $monthLabels = $months->map(fn ($month) => $month->locale('es')->translatedFormat('M y'));
        $departureSeries = $months->map(fn ($month) => SendOut::whereBetween('departure_date', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count());
        $incomeSeries = $months->map(fn ($month) => DelegationAccess::scope(FinanceTransaction::query())->whereBetween('transaction_date', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->whereHas('category', fn ($query) => $query->where('type', 'income'))->sum('amount'));
        $expenseSeries = $months->map(fn ($month) => DelegationAccess::scope(FinanceTransaction::query())->whereBetween('transaction_date', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->whereHas('category', fn ($query) => $query->where('type', 'expense'))->sum('amount'));
        $activeDepartures = SendOut::where('active', true)->count();
        $rescuesThisYear = DelegationAccess::scope(Rescue::query(), 'id_delegation')->whereYear('date_finish_rescue', now()->year)->count();
        $financeBalance = DelegationAccess::scope(FinanceTransaction::with('category'))->get()->sum(fn ($transaction) => $transaction->category?->type === 'income' ? (float) $transaction->amount : -(float) $transaction->amount);
        $upcomingBirthdays = $allBirthdays->sortBy(function ($voluntary) use ($today) {
            $date = Carbon::parse($voluntary->birthday)->year($today->year);
            return $date->lt($today) ? $date->addYear() : $date;
        })->take(5);

        return view('module.dashboard.dashboard', compact('data', 'cant_voluntaries', 'cant_voluntaries_no_payment', 'birthdaysToday', 'upcomingBirthdays', 'monthLabels', 'departureSeries', 'incomeSeries', 'expenseSeries', 'activeDepartures', 'rescuesThisYear', 'financeBalance'));
    }
}
