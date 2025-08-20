<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMailable;
use Exception;

class MainDrawController extends Controller
{
    public function index()
    {
        return view('maindraw.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required|string',
            'message' => 'required|string',
        ]);

        $contact = $request->only(['name', 'email', 'type', 'message']);

        try{
            Mail::to('aguilerajordan2@gmail.com')->send(new ContactMailable($contact));
            return redirect()->back()->with('success', '¡Mensaje enviado correctamente!');
        }catch(Exception $e){
            return redirect()->back()->with('error', '¡Error al enviar el mensaje!');
        }

    }
}
