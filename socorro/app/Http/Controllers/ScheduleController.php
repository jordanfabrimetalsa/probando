<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Guard;
use App\Models\Voluntary;
use App\Models\BossEvent;
use App\Models\FileSchedule;
use Carbon\Carbon;
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

    public function dataFile($id)
    {
        try {

            $files = FileSchedule::with('event')->where('event_id', $id)->get()->map(function($file) {
                if ($file->path) {
                    $file->download_url = route('calendario.download', $file->id);
                }
                return $file;
            });


            return response()->json($files);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function downloadFile($id)
    {
        $file = FileSchedule::findOrFail($id);
        return response()->download(storage_path('app/public/' . $file->path), $file->name);
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

        $start = Carbon::parse($validated['start'])->startOfDay();
        $end = Carbon::parse($validated['end'])->addDay()->startOfDay(); // end exclusivo

        $schedule = Schedule::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'start' => $start->toDateString(),
            'end' => $end->toDateString()
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

    public function storeGuard(Request $request)
    {
        try {
            $request->validate([
                'id_event' => 'required|integer|exists:events,id',
                'id_user' => 'required|integer|exists:users,id',
                'assign' => 'required|string'
            ]);
    
            $guard = new Guard;
            $guard->id_event = $request->id_event;
            $guard->id_user = $request->id_user;
            $guard->type = $request->assign;
            
            if ($guard->save()) {
                return response()->json([
                    'success' => true,
                    'guard' => $guard,
                    'message' => 'Guardia asignada correctamente'
                ]);
            }
    
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el guardia'
            ], 500);
    
        } catch (\Exception $e) {
            \Log::error('Error en storeGuard: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar la solicitud',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function storeFile(Request $request){
        try {

            $path = $request->file('file')->store('files', 'public');
            $file = new FileSchedule;
            $file->event_id = $request->id_event;
            $file->name = $request->file('file')->getClientOriginalName();
            $file->path = $path;
            $file->type = $request->file('file')->getMimeType();
            
            if ($file->save()) {
                return response()->json([
                    'success' => true,
                    'file' => $file,
                    'message' => 'Archivo guardado correctamente'                
                ]);
            }
    
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el archivo',
                'error' => $file
            ], 500);
    
        } catch (\Exception $e) {
            \Log::error('Error en storeFile: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar la solicitud',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
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
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function destroyGuard($id){
        try{
            $guard = Guard::find($id);
            $guard->delete();

            return response()->json([
                'success' => true,
                'guard' => $guard
            ]);
        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
