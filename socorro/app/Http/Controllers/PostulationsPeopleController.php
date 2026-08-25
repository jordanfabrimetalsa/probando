<?php

namespace App\Http\Controllers;

use App\Models\Postulation;
use App\Models\PostulationsPeople;
use App\Support\DelegationAccess;
use Illuminate\Http\Request;

class PostulationsPeopleController extends Controller
{
    public function data($id)
    {
        $postulation = Postulation::findOrFail($id);
        DelegationAccess::authorize((int) $postulation->delegation_id);

        return response()->json(
            PostulationsPeople::where('postulation_id', $id)->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'rut' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
            'presentation' => ['required', 'string', 'min:20', 'max:5000'],
            'postulation_id' => ['required', 'exists:postulations,id'],
        ]);

        $postulation = Postulation::findOrFail($validated['postulation_id']);
        abort_unless(
            $postulation->status === 'A'
                && $postulation->start_date <= now()
                && $postulation->end_date >= now(),
            422,
            'Esta convocatoria no se encuentra abierta.'
        );

        $exists = PostulationsPeople::where('postulation_id', $postulation->id)
            ->where(function ($query) use ($validated) {
                $query->where('rut', $validated['rut'])
                    ->orWhere('email', $validated['email']);
            })->exists();
        abort_if($exists, 422, 'Ya existe una postulación asociada a este RUT o correo.');

        $person = PostulationsPeople::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Postulación enviada correctamente.',
            'data' => $person,
        ], 201);
    }
}
