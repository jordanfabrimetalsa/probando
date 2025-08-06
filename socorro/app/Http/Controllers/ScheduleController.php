<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Guard;
use App\Models\Voluntary;
use Exception;

class ScheduleController extends Controller
{
    public function index()
    {
        $voluntaries = Voluntary::all();

        $events = [];
        $appointments = Schedule::all();
    
        foreach($appointments as $appointment) {
            $events[] = [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'description' => $appointment->description,
                'start' => $appointment->start,
                'end' => $appointment->end,
                'extendedProps' => [
                    'type' => $appointment->type
                ],
                'backgroundColor' => $this->getEventColor($appointment->type),
                'borderColor' => $this->getEventColor($appointment->type)
            ];
        }
    
        return view('module.schedule.index', compact('events', 'voluntaries'));
    }

    public function dataGuard($id){
        try{
            $guard = Guard::with(['events', 'voluntaries'])->where('id_event', $id)->get();

            return response()->json($guard);   
        }catch(Exception $e){
            return response()->json($e);
        }
    }
    
    private function getEventColor($type)
    {
        switch($type) {
            case 'Class': return '#4f646b';
            case 'Guard': return '#D8433C';
            default: return '#CFA5B4';
        }
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:Class,Guard,Event',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ]);

        $schedule = Schedule::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'start' => $validated['start'],
            'end' => $validated['end']
        ]);

        return response()->json([
            'success' => true,
            'event' => [
                'id' => $schedule->id,
                'title' => $schedule->title,
                'start' => $schedule->start,
                'end' => $schedule->end,
                'extendedProps' => [
                    'type' => $schedule->type,
                    'description' => $schedule->description
                ]
            ]
        ]);
    }

    public function storeGuard(Request $request){
        try{
            $guard = new Guard;
            $guard->id_event = $request->id_event;
            $guard->id_user = $request->id_user;
            $guard->save();

            return response()->json([
                'success' => true,
                'guard' => $guard
            ]);
        }catch(Excepcion $e){

        }
    }

    public function show(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        try{
            $schedule = Schedule::find($id);
            $schedule->delete();

            return response()->json([
                'success' => true,
                'schedule' => $schedule
            ]);
        }catch(Excepcion $e){
            return response()->json($e);
        }
    }
}
