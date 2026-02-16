<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Voluntary;
use App\Models\Delegation;
use App\Models\Image_Voluntary;
use App\Models\Emergency;
use App\Models\Remark;
use Illuminate\Support\Facades\Hash;

class VoluntarioController extends Controller
{

    public function index()
    {
        $delegations = Delegation::all();
        return view('module.voluntario.index', compact('delegations'));
    }

    public function data()
    {
        $voluntarios = Voluntary::with('delegation')->get();
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
            $voluntary = Voluntary::with(['delegation', 'images'])->find($id);
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

            $voluntary->emergency = Emergency::where('voluntary_id', $id)->get();
            $voluntary->remark = Remark::where('voluntary_id', $id)->get();
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
            $remark->save();

            return response()->json(['success' => 'Voluntario actualizado correctamente']);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el voluntario'
            ], 500);
        }
    }
}
