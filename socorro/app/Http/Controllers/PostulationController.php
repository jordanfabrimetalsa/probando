<?php

namespace App\Http\Controllers;

use App\Models\Delegation;
use App\Models\Postulation;
use App\Models\Voluntary;
use App\Support\DelegationAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PostulationController extends Controller
{
    public function index()
    {
        $query = Delegation::withCount([
            'postulations as open_postulations_count' => fn ($query) => $query->where('status', 'A'),
        ])->orderBy('name');
        $delegations = DelegationAccess::isNational()
            ? $query->where('is_national', false)->get()
            : $query->whereKey(DelegationAccess::id())->get();
        $hasAvailableDelegation = $delegations->contains(
            fn ($delegation) => $delegation->open_postulations_count === 0
        );

        return view('module.postulation.index', compact('delegations', 'hasAvailableDelegation'));
    }

    public function adminData()
    {
        $query = Postulation::with('delegation')->withCount('people')->latest('start_date');
        DelegationAccess::scope($query, 'delegation_id');

        return response()->json($query->get());
    }

    public function data($id)
    {
        return response()->json(
            Postulation::where('delegation_id', $id)
                ->where('status', 'A')
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->orderBy('start_date')
                ->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string', 'min:20', 'max:5000'],
            'cant_people_selected' => ['required', 'integer', 'min:1', 'max:1000'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'delegation_id' => ['required_without:delegation_id_postulation', 'exists:delegations,id'],
            'delegation_id_postulation' => ['required_without:delegation_id', 'exists:delegations,id'],
        ]);
        $delegationId = (int) ($validated['delegation_id'] ?? $validated['delegation_id_postulation']);
        DelegationAccess::authorize($delegationId);

        $postulation = DB::transaction(function () use ($validated, $delegationId) {
            $delegation = Delegation::whereKey($delegationId)->lockForUpdate()->firstOrFail();
            $alreadyOpen = Postulation::where('delegation_id', $delegationId)
                ->where('status', 'A')->lockForUpdate()->exists();
            if ($alreadyOpen) {
                throw ValidationException::withMessages([
                    'delegation_id' => 'Esta delegación ya tiene una postulación abierta. Debes cerrar la anterior antes de crear una nueva.',
                ]);
            }

            $postulation = Postulation::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'cant_people_selected' => $validated['cant_people_selected'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'delegation_id' => $delegationId,
                'status' => 'A',
            ]);
            $delegation->update(['postulation_status' => 'A']);

            return $postulation;
        });

        return response()->json([
            'message' => 'Postulación creada correctamente.',
            'postulation' => $postulation,
        ], 201);
    }

    public function details($id)
    {
        $postulation = Postulation::with(['delegation', 'people'])->findOrFail($id);
        DelegationAccess::authorize((int) $postulation->delegation_id);

        return response()->json($postulation);
    }

    public function voluntariesData($id)
    {
        DelegationAccess::authorize((int) $id);
        return response()->json(Voluntary::where('delegation_id', $id)->get());
    }

    public function updateStatus(Request $request, Postulation $postulation)
    {
        DelegationAccess::authorize((int) $postulation->delegation_id);
        $validated = $request->validate(['status' => ['required', Rule::in(['A', 'C'])]]);

        DB::transaction(function () use ($postulation, $validated) {
            Delegation::whereKey($postulation->delegation_id)->lockForUpdate()->firstOrFail();
            if ($validated['status'] === 'A') {
                $anotherOpen = Postulation::where('delegation_id', $postulation->delegation_id)
                    ->whereKeyNot($postulation->id)->where('status', 'A')->lockForUpdate()->exists();
                if ($anotherOpen) {
                    throw ValidationException::withMessages([
                        'status' => 'No se puede abrir esta convocatoria porque la delegación ya tiene otra postulación abierta.',
                    ]);
                }
            }
            $postulation->update($validated);
            $this->syncDelegationStatus((int) $postulation->delegation_id);
        });

        return response()->json(['message' => 'Estado de la convocatoria actualizado.']);
    }

    public function destroy(Postulation $postulation)
    {
        DelegationAccess::authorize((int) $postulation->delegation_id);
        $delegationId = (int) $postulation->delegation_id;
        $postulation->delete();
        $this->syncDelegationStatus($delegationId);

        return response()->json(['message' => 'Convocatoria eliminada correctamente.']);
    }

    private function syncDelegationStatus(int $delegationId): void
    {
        $hasOpen = Postulation::where('delegation_id', $delegationId)
            ->where('status', 'A')->exists();
        Delegation::whereKey($delegationId)->update(['postulation_status' => $hasOpen ? 'A' : 'C']);
    }
}
