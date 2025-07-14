<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function login_new()
    {
        return view('layout.login');
    }

    public function index()
    {
        $users = User::all();
        return view('module.usuario.index', compact('users'));
    }

    public function store(Request $request){
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);

            if($user->save()){
                return redirect()->route('usuarios')->with('success', 'Usuario creado correctamente');
            }else{
                return back()->with('error', 'Error al crear el usuario');
            }
        }catch(Exception $e){
            return back()->with('error', $e);
        }
    }

    public function logout(Request $request){
        try{
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('success', 'Sesion cerrada correctamente');
        }catch(Exception $e){
            return back()->with('error', $e);
        }
    }

    public function create_user(){
        try{
            $user = new User();
            $user->name = 'admin';
            $user->email = 'admin@admin.com';
            $user->role = 'admin';
            $user->status = 'A';
            $user->password = Hash::make('admin');

            if($user->save()){
                return back()->with('success', 'Usuario creado correctamente');
            }else{
                return back()->with('error', 'Error al crear el usuario');
            }
        }catch(Exception $e){
            return back()->with('error', $e);
        }
    }

    public function login(Request $request){
        try{
            $user = User::where('email', $request->email)->first();

            if($user){
                if(Hash::check($request->password, $user->password)){
                    Auth::login($user);
                    $request->session()->regenerate();
                    return redirect()->route('dashboard')->with('success', 'Inicio de sesión exitoso');
                }else{
                    return back()->with('error', 'Contraseña incorrecta');
                }
            }else{
                return back()->with('error', 'Usuario no encontrado');
            }

        }catch(Exception $e){
            return back()->with('error', $e);
        }
    }
}
