<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Imagen;
use Exception;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login_new()
    {
        return view('layout.login');
    }

    public function index()
    {
        return view('module.usuario.index');
    }

    public function data(){
        return response()->json(User::all());
    }

    public function store(Request $request){
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->save();
            $id_user = $user->id;

            if($this->up_image($request, $id_user)){
                return response()->json(['success' => 'Usuario creado correctamente']);
            }else{
                return response()->json(['error' => 'Error al crear el usuario']);
            }
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function edit($id){
        try{
            $user = User::find($id);
            return response()->json($user);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function update(Request $request, $id){
        try{
            $user = User::find($id);
            $user->role = $request->role;
            $user->status = $request->status;
            $user->save();
            return response()->json(['success' => 'Usuario actualizado correctamente']);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function destroy($id){
        try{
            $user = User::find($id);
            $user->delete();
            return response()->json(['success' => 'Usuario eliminado correctamente']);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function up_image($request, $id_user){
        try{
            $path = $request->file('image')->store('images', 'public');
            $name = basename($path);

            $image = new Imagen();
            $image->name = $name;
            $image->path = $path;
            $image->user_id = $id_user;
            $image->save();
            return response()->json(['success' => 'Imagen actualizada correctamente']);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function logout(Request $request){
        try{
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json(['success' => 'Sesion cerrada correctamente']);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
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
                return response()->json(['success' => 'Usuario creado correctamente']);
            }else{
                return response()->json(['error' => 'Error al crear el usuario']);
            }
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function login(Request $request){
        try{
            $user = User::where('email', $request->email)->first();

            if($user){
                if(Hash::check($request->password, $user->password)){
                    Auth::login($user);
                    $request->session()->regenerate();
                    return redirect()->route('dashboard');
                }else{
                    return redirect()->route('login')->with('error', 'Contraseña incorrecta');
                }
            }else{
                return redirect()->route('login')->with('error', 'Usuario no encontrado');
            }

        }catch(Exception $e){
            return redirect()->route('login')->with('error', $e);
        }   
    }
}
