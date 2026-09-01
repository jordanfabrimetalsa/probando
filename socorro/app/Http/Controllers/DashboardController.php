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
        $activityLabels = [0=>'Trekking',1=>'Hiking',2=>'Mountain Bike',3=>'Escalada',4=>'Escalada en hielo',5=>'Randonnée',6=>'Kayak',7=>'Kitesurf'];
        $regionLabels = [0=>'Arica y Parinacota',1=>'Tarapacá',2=>'Antofagasta',3=>'Atacama',4=>'Coquimbo',5=>'Valparaíso',6=>'Metropolitana',7=>"O'Higgins",8=>'Maule',9=>'Ñuble',10=>'Biobío',11=>'La Araucanía',12=>'Los Ríos',13=>'Los Lagos',14=>'Aysén',15=>'Magallanes'];
        $yearDepartures = SendOut::whereYear('departure_date', now()->year)->get();
        $activeRecords = SendOut::where('active', true)->orderBy('return_date')->get();
        $completed = $yearDepartures->where('active', false);
        $durations = $completed->map(fn ($item) => Carbon::parse($item->departure_date)->diffInHours(Carbon::parse($item->return_date)));

        $metrics = [
            'year_total'=>$yearDepartures->count(),
            'active'=>$activeRecords->count(),
            'overdue'=>$activeRecords->filter(fn ($item) => Carbon::parse($item->return_date)->isPast())->count(),
            'people_active'=>$activeRecords->sum('number_participants'),
            'participants'=>$yearDepartures->sum('number_participants'),
            'avg_duration'=>$durations->isNotEmpty() ? round($durations->avg(),1) : null,
            'completion_rate'=>$yearDepartures->count() ? round($completed->count()*100/$yearDepartures->count()) : 0,
        ];

        $months = collect(range(7, 0))->map(fn ($offset) => now()->subMonths($offset)->startOfMonth());
        $monthLabels = $months->map(fn ($month) => $month->locale('es')->translatedFormat('M y'));
        $departureSeries = $months->map(fn ($month) => SendOut::whereBetween('departure_date', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count());
        $activities = $yearDepartures->groupBy('activity')->map->count()->sortDesc()->mapWithKeys(fn ($count,$key)=>[$activityLabels[(int)$key] ?? 'Sin informar'=>$count]);
        $regions = $yearDepartures->groupBy('region')->map->count()->sortDesc()->mapWithKeys(fn ($count,$key)=>[$regionLabels[(int)$key] ?? 'Sin informar'=>$count]);
        $topDestinations = $yearDepartures->groupBy('destination')->map->count()->sortDesc()->take(5);
        $recent = SendOut::latest('departure_date')->take(8)->get();

        return view('module.dashboard.dashboard', compact('metrics','monthLabels','departureSeries','activities','regions','topDestinations','activeRecords','recent','activityLabels','regionLabels'));
    }
}
