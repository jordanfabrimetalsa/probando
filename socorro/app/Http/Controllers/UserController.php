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
use App\Models\SystemRole;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Support\DelegationAccess;

class UserController extends Controller
{
    public function login_new()
    {
        return view('layout.login');
    }

    public function index()
    {
        $voluntarios = DelegationAccess::scope(Voluntary::query())->get();
        $roles = SystemRole::where('active', true)->orderBy('name')->get();
        return view('module.usuario.index', compact('voluntarios', 'roles'));
    }

    public function data(){
        $query = User::with('voluntary.delegation');
        if (!DelegationAccess::isNational()) {
            $query->whereHas('voluntary', fn ($q) => $q->where('delegation_id', DelegationAccess::id()));
        }
        return response()->json($query->get());
    }

    public function store(Request $request){
        $request->validate([
            'voluntary_id' => ['nullable', 'exists:voluntaries,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:system_roles,slug'],
            'status' => ['required', 'in:A,I'],
        ]);
        try{
            DB::beginTransaction();

            if ($request->voluntary_id) {
                DelegationAccess::authorize((int) Voluntary::findOrFail($request->voluntary_id)->delegation_id);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->voluntary_id = $request->voluntary_id;
            $user->save();
            $id_user = $user->id;

            // Actualizar busy del voluntario si existe
            if ($request->voluntary_id) {
                $voluntary = Voluntary::find($request->voluntary_id);
                if ($voluntary) {
                    $voluntary->update(['busy' => true]);
                }
            }

            DB::commit();
            return response()->json(['success' => 'Usuario creado correctamente'], 201);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el usuario: ' . $e->getMessage()], 500);
        }
    }

    public function edit($id){
        try{
            $user = User::with('voluntary')->findOrFail($id);
            abort_unless($user->voluntary, 403);
            DelegationAccess::authorize((int) $user->voluntary->delegation_id);
            return response()->json($user);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'role' => ['required', 'exists:system_roles,slug'],
            'status' => ['required', 'in:A,I'],
        ]);
        try{
            $user = User::with('voluntary')->findOrFail($id);
            abort_unless($user->voluntary, 403);
            DelegationAccess::authorize((int) $user->voluntary->delegation_id);
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
            $user = User::with('voluntary')->findOrFail($id);
            abort_unless($user->voluntary, 403);
            DelegationAccess::authorize((int) $user->voluntary->delegation_id);
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

            $regions = new Regions();
            $regions->name = 'Magallanes';
            $regions->save();

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
            $voluntary->busy = true;
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
                $voluntary = Voluntary::find($user->voluntary_id);
                if(Hash::check($request->password, $user->password)){
                    Auth::login($user);
                    $request->session()->regenerate();
                    $request->session()->put('voluntary', $voluntary);
                    return redirect()->route('dashboard');
                }else{
                    return redirect()->route('login')->with('error', 'Contraseña incorrecta');
                }
            }else{
                return redirect()->route('login')->with('error', 'Usuario no encontrado');
            }

        }catch(Exception $e){
            Log::error('Error durante el inicio de sesión.', ['exception' => $e]);
            return redirect()->route('login')->with('error', 'No fue posible iniciar sesión. Inténtalo nuevamente.');
        }
    }
}
