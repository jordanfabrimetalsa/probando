<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMailable;
use Exception;
use App\Models\ContactForm;
use App\Models\Delegation;

class MainDrawController extends Controller
{
    public function index()
    {
        $delegations = Delegation::all();
        return view('maindraw.index', compact('delegations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required|string',
            'message' => 'required|string',
        ]);

        try{
            $datos = $request->all();
            ContactForm::create($datos);
            Mail::to($request->email)->send(new ContactMailable($datos));
            return response()->json([
                'success' => true,
                'message' => 'Correo Enviado Exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
