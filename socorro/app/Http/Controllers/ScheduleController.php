<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $events = [];
        $appointments = Schedule::all();
    
        foreach($appointments as $appointment) {
            $events[] = [
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
    
        return view('module.schedule.index', compact('events'));
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

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
