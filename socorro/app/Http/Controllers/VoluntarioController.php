<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Voluntary;
use App\Models\Delegation;
use App\Models\Image_Voluntary;
use App\Models\Emergency;
use App\Models\Remark;
use App\Models\Cargo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class VoluntarioController extends Controller
{

    public function index()
    {
        $cargos = Cargo::all();
        $delegations = Delegation::all();
        return view('module.voluntario.index', compact('delegations', 'cargos'));
    }

    public function data()
    {
        $voluntarios = Voluntary::with('delegation', 'cargo')->get();
        return response()->json($voluntarios);
    }

    public function store(Request $request)
    {
        try{
            $voluntary = new Voluntary();
            $voluntary->delegation_id = $request->delegation_id;
            $voluntary->document = $request->document;
            $voluntary->name = $request->name;
            $voluntary->lastname = $request->lastname;
            $voluntary->phone = $request->phone;
            $voluntary->birthday = $request->birthday;
            $voluntary->address = $request->address;
            $voluntary->profession = $request->profession;
            $voluntary->gender = $request->gender;
            $voluntary->allergic = $request->allergic;
            $voluntary->disease = $request->disease;
            $voluntary->medicine = $request->medicine;
            $voluntary->vehicle = $request->vehicle;
            $voluntary->license = $request->license;
            $voluntary->payment = $request->payment;
            $voluntary->blood_type = $request->blood_type;
            $voluntary->type = $request->type;
            $voluntary->status = $request->status;
            $voluntary->init_voluntary = $request->init_voluntary;
            $voluntary->busy = false;

            if($voluntary->save()){
                $image_voluntary = new Image_Voluntary();
                $image_voluntary->voluntary_id = $voluntary->id;
                $image_voluntary->name = $request->file('image')->getClientOriginalName();
                $image_voluntary->path = $request->file('image')->store('imagenes', 'public');
                $image_voluntary->save();
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error al crear el voluntario'
                ], 500);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Voluntario registrado'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el voluntario'
            ], 500);
        }
    }

    public function show(string $id)
    {
        try{
            $voluntary = Voluntary::with(['delegation', 'images', 'cargo'])->find($id);
            if (!$voluntary) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Voluntario no encontrado'
                ], 404);
            }

            // Verificar si el archivo existe
            if ($voluntary->image && $voluntary->image !== '/assets/img/default-avatar.png') {
                $imagePath = str_replace('/storage/', '', $voluntary->image);
                $fullPath = storage_path('app/public/' . $imagePath);
                $voluntary->image = env('APP_URL') . '/storage/' . $imagePath;
            }
            $voluntary->remark = Remark::with('user')->where('voluntary_id', $id)->get();
            $voluntary->emergency = Emergency::where('voluntary_id', $id)->get();
            return response()->json($voluntary);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al mostrar voluntario: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(string $id)
    {
        try{
            $voluntary = Voluntary::find($id);
            return response()->json($voluntary);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al editar voluntario'
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        try{
            $voluntary = Voluntary::find($id);
            $voluntary->cargo_id = $request->cargo_edit;
            $voluntary->blood_type = $request->blood_type;
            $voluntary->vehicle = $request->vehicle;
            $voluntary->license = $request->license;
            $voluntary->type = $request->type;
            $voluntary->status = $request->status;
            $voluntary->save();

            return response()->json(['success' => 'Voluntario actualizado correctamente']);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el voluntario'
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try{
            $voluntary = Voluntary::find($id);
            $voluntary->delete();

            /*$image_voluntary = Image_Voluntary::where('id', $id)->first();
            $image_voluntary->delete();*/

            return response()->json([
                'status' => 'success',
                'message' => 'Voluntario eliminado'
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el voluntario'
            ]);
        }
    }

    public function emergencyStore(Request $request)
    {
        try{
            $emergency = new Emergency();
            $emergency->voluntary_id = $request->id_user_emergency;
            $emergency->emergency_name = $request->emergency_name;
            $emergency->emergency_phone = $request->emergency_phone;
            $emergency->relationship = $request->relationship;
            $emergency->save();

            return response()->json(['success' => 'Voluntario actualizado correctamente']);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el voluntario'
            ], 500);
        }
    }

    public function remarkStore(Request $request)
    {
        try{
            $remark = new Remark();
            $remark->voluntary_id = $request->id_user_remark;
            $remark->remark = $request->remark;
            $remark->gravity = $request->gravity;
            $remark->responsable_id = Auth::user()->id;
            $remark->save();

            return response()->json(['success' => 'Voluntario actualizado correctamente']);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el voluntario'
            ], 500);
        }
    }

    public function storeCargo(Request $request){
        try{
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
            ]);

            $cargo = new Cargo();
            $cargo->nombre = $request->name;
            $cargo->save();

            return response()->json(['success' => 'Cargo creado correctamente']);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el cargo: ' . $e->getMessage()
            ], 500);
        }
    }

    public function profile(){
        try{
            $voluntaryId = Auth::user()->voluntary_id;
            $voluntary = Voluntary::with(['delegation', 'cargo', 'images'])->find($voluntaryId);
            if (!$voluntary) {
                return redirect()->route('login')->with('error', 'Voluntario no encontrado');
            }

            $rescues = DB::table('rescate_voluntarios')
                        ->join('rescates', 'rescate_voluntarios.rescate_id', '=', 'rescates.id')
                        ->where('rescate_voluntarios.voluntario_id', $voluntaryId)
                        ->select('rescates.*')
                        ->orderByDesc('rescates.fecha_operativo')
                        ->get();

            $remark = Remark::with('user')->where('voluntary_id', $voluntaryId)->get();
            $emergency = Emergency::where('voluntary_id', $voluntaryId)->get();

            $cargos = Cargo::all();
            $delegations = Delegation::all();
            return view('module.voluntario.profile', compact('voluntary','cargos', 'delegations', 'remark', 'emergency', 'rescues'));
        }catch(Exception $e){
            return redirect()->route('login')->with('error', $e);
        }
    }
}
