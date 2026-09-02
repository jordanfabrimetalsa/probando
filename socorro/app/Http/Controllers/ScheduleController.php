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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

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
                    'type' => $appointment->type,
                    'description' => $appointment->description,
                    'guard_enabled' => $appointment->guard_enabled,
                    'guard_capacity' => $appointment->guard_capacity,
                    'guard_leader_id' => $appointment->guard_leader_id,
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
        Gate::authorize('manage-guards');

        $validated = $request->validate([
            'description' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'guard_enabled' => 'nullable|boolean',
            'guard_capacity' => 'required|integer|min:1|max:200',
            'guard_leader_id' => 'nullable|integer|exists:voluntaries,id',
        ]);

        $start = Carbon::parse($validated['start'])->startOfDay();
        $end = Carbon::parse($validated['end'])->addDay()->startOfDay(); // end exclusivo

        $schedule = DB::transaction(function () use ($validated, $request, $start, $end) {
            $guardNumber = Schedule::where('type', 'Guard')
                ->whereYear('start', $start->year)
                ->whereMonth('start', $start->month)
                ->lockForUpdate()
                ->pluck('title')
                ->map(fn ($title) => preg_match('/Guardia N°\s*(\d+)/u', $title, $match) ? (int) $match[1] : 0)
                ->max() + 1;
            $schedule = Schedule::create([
                'title' => 'Guardia N° '.$guardNumber,
                'description' => $validated['description'],
                'type' => 'Guard',
                'start' => $start->toDateString(),
                'end' => $end->toDateString(),
                'guard_enabled' => $request->boolean('guard_enabled'),
                'guard_capacity' => $validated['guard_capacity'],
                'guard_leader_id' => $validated['guard_leader_id'] ?? null,
            ]);

            if ($schedule->guard_leader_id) {
                Guard::create(['id_event' => $schedule->id, 'id_voluntary' => $schedule->guard_leader_id, 'type' => 'leader']);
            }

            return $schedule;
        });

        return response()->json([
            'success' => true,
            'event' => [
                'id' => $schedule->id,
                'title' => $schedule->title,
                'start' => $schedule->start,
                'end' => $schedule->end,
                'extendedProps' => [
                    'type' => $schedule->type,
                    'description' => $schedule->description,
                    'guard_enabled' => $schedule->guard_enabled,
                    'guard_capacity' => $schedule->guard_capacity,
                    'guard_leader_id' => $schedule->guard_leader_id,
                ]
            ]
        ]);
    }

    public function configureGuard(Request $request, Schedule $schedule)
    {
        Gate::authorize('manage-guards');
        abort_unless($schedule->type === 'Guard', 422, 'El evento seleccionado no es una guardia.');
        $validated = $request->validate([
            'guard_enabled' => ['nullable', 'boolean'],
            'guard_capacity' => ['required', 'integer', 'min:1', 'max:200'],
            'guard_leader_id' => ['nullable', 'integer', 'exists:voluntaries,id'],
        ]);

        DB::transaction(function () use ($schedule, $validated, $request) {
            $event = Schedule::lockForUpdate()->findOrFail($schedule->id);
            $currentCount = Guard::where('id_event', $event->id)->count();
            $newLeaderId = $validated['guard_leader_id'] ?? null;
            $newLeaderExists = $newLeaderId && Guard::where('id_event', $event->id)->where('id_voluntary', $newLeaderId)->exists();
            $resultingCount = $currentCount + ($newLeaderId && !$newLeaderExists ? 1 : 0);
            if ($validated['guard_capacity'] < $resultingCount) {
                throw ValidationException::withMessages(['guard_capacity' => "El cupo no puede ser menor a los {$resultingCount} participantes actuales."]);
            }

            Guard::where('id_event', $event->id)->where('type', 'leader')->update(['type' => 'assistant']);
            if ($newLeaderId) {
                Guard::updateOrCreate(['id_event' => $event->id, 'id_voluntary' => $newLeaderId], ['type' => 'leader']);
            }
            $event->update([
                'guard_enabled' => $request->boolean('guard_enabled'),
                'guard_capacity' => $validated['guard_capacity'],
                'guard_leader_id' => $newLeaderId,
            ]);
        });

        return response()->json(['success' => true, 'message' => 'Configuración de guardia actualizada.']);
    }

    public function storeGuard(Request $request){
        try{
            Gate::authorize('manage-guards');
            $request->validate([
                'id_event' => 'required|integer|exists:events,id',
                'id_voluntary' => 'required|integer|exists:voluntaries,id',
                'type' => 'required|string'
            ]);

            $guard = DB::transaction(function () use ($request) {
                $event = Schedule::lockForUpdate()->findOrFail($request->id_event);
                if (Guard::where('id_event', $event->id)->where('id_voluntary', $request->id_voluntary)->exists()) {
                    throw ValidationException::withMessages(['id_voluntary' => 'Este voluntario ya pertenece a la actividad.']);
                }
                if ($event->type === 'Guard' && Guard::where('id_event', $event->id)->count() >= $event->guard_capacity) {
                    throw ValidationException::withMessages(['id_voluntary' => 'La guardia ya alcanzó su cupo máximo.']);
                }
                return Guard::create($request->only('id_event', 'id_voluntary', 'type'));
            });

            if ($guard) {
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
            Gate::authorize('manage-guards');
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
            Gate::authorize('manage-guards');
            $guard = Guard::find($id);
            if ($guard?->type === 'leader') {
                return response()->json(['success' => false, 'message' => 'El jefe de guardia no se puede eliminar.'], 422);
            }
            $guard->delete();

            return response()->json([
                'success' => true,
                'guard' => $guard
            ]);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function availableGuards(Request $request)
    {
        abort_unless($request->user()->voluntary_id, 403, 'Su usuario no está vinculado a una ficha de voluntario.');

        $guards = Schedule::query()
            ->with('guardLeader')
            ->withCount('guards')
            ->where('type', 'Guard')
            ->where('guard_enabled', true)
            ->whereDate('end', '>=', now()->toDateString())
            ->orderBy('start')
            ->get();
        $registrations = Guard::where('id_voluntary', $request->user()->voluntary_id)->pluck('id', 'id_event');

        return view('module.schedule.available', compact('guards', 'registrations'));
    }

    public function joinGuard(Request $request, Schedule $schedule)
    {
        $voluntaryId = $request->user()->voluntary_id;
        abort_unless($voluntaryId, 403, 'Su usuario no está vinculado a una ficha de voluntario.');

        DB::transaction(function () use ($schedule, $voluntaryId) {
            $guard = Schedule::lockForUpdate()->findOrFail($schedule->id);
            abort_unless($guard->type === 'Guard' && $guard->guard_enabled, 422, 'Esta guardia no está habilitada para inscripciones.');
            if (Guard::where('id_event', $guard->id)->where('id_voluntary', $voluntaryId)->exists()) {
                throw ValidationException::withMessages(['guard' => 'Ya se encuentra inscrito en esta guardia.']);
            }
            if (Guard::where('id_event', $guard->id)->count() >= $guard->guard_capacity) {
                throw ValidationException::withMessages(['guard' => 'La guardia ya alcanzó su cupo máximo.']);
            }
            Guard::create(['id_event' => $guard->id, 'id_voluntary' => $voluntaryId, 'type' => 'assistant']);
        });

        return back()->with('success', 'Su inscripción en la guardia fue registrada.');
    }

    public function leaveGuard(Request $request, Schedule $schedule)
    {
        $voluntaryId = $request->user()->voluntary_id;
        abort_unless($voluntaryId, 403);
        abort_if((int) $schedule->guard_leader_id === (int) $voluntaryId, 422, 'El jefe de guardia no puede retirar su asignación.');
        Guard::where('id_event', $schedule->id)->where('id_voluntary', $voluntaryId)->delete();

        return back()->with('success', 'Su inscripción fue retirada.');
    }
}
