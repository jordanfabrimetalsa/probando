<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactFormController extends Controller
{
    function index(){
        return view('module.contacto.index');
    }

    public function data(){
        return response()->json(ContactForm::all());
    }
}
