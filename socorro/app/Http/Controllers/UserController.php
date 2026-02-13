<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Imagen;
use App\Models\Voluntary;
use App\Models\Delegation;
use App\Models\Regions;
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
        $voluntarios = Voluntary::all();
        return view('module.usuario.index', compact('voluntarios'));
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
            $user->voluntary_id = $request->voluntary_id;
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

    public function logout(Request $request){
        try{
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        }catch(Exception $e){
            return redirect()->route('login');
        }
    }

    public function create_user(){
        try{
            $region = new Regions();
            $region->name = 'Metropolitana';
            $region->save();

            $delegation = new Delegation();
            $delegation->name = 'Metropolitana';
            $delegation->region_id = $region->id;
            $delegation->image = 'delegations/w84ToCpCx3M9i00EC58jpukKR5yRkeA95UUhdWKK.png';
            $delegation->postulation_status = 'C';
            $delegation->save();

            $voluntary = new Voluntary();
            $voluntary->delegation_id = $delegation->id;
            $voluntary->document = '12345678';
            $voluntary->name = 'admin';
            $voluntary->lastname = 'admin';
            $voluntary->phone = '12345678';
            $voluntary->birthday = '2000-01-01';
            $voluntary->address = 'admin';
            $voluntary->profession = 'admin';
            $voluntary->gender = 'M';
            $voluntary->allergic = false;
            $voluntary->disease = false;
            $voluntary->medicine = false;
            $voluntary->vehicle = false;
            $voluntary->license = false;
            $voluntary->payment = false;
            $voluntary->blood_type = 'N';
            $voluntary->type = 'A';
            $voluntary->status = true;
            $voluntary->save();

            $user = new User();
            $user->name = 'admin';
            $user->email = 'admin@admin.com';
            $user->role = 'admin';
            $user->status = 'A';
            $user->voluntary_id = $voluntary->id;
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
