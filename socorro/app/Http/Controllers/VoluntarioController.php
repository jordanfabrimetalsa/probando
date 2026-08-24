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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\FinanceTransaction;
use App\Support\DelegationAccess;

class VoluntarioController extends Controller
{

    public function index()
    {
        $cargos = Cargo::all();
        $delegations = DelegationAccess::isNational() ? Delegation::all() : Delegation::whereKey(DelegationAccess::id())->get();
        return view('module.voluntario.index', compact('delegations', 'cargos'));
    }

    public function data()
    {
        $voluntarios = DelegationAccess::scope(Voluntary::with('delegation', 'cargo'))->get();
        return response()->json($voluntarios);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'delegation_id' => ['required', 'exists:delegations,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'document' => ['required', 'string', 'min:7', 'max:10', 'unique:voluntaries,document'],
            'name' => ['required', 'string', 'min:2', 'max:80'],
            'lastname' => ['required', 'string', 'min:2', 'max:80'],
            'phone' => ['required', 'digits_between:8,12'],
            'birthday' => ['required', 'date', 'before:today'],
            'address' => ['required', 'string', 'min:3', 'max:180'],
            'profession' => ['required', 'string', 'min:2', 'max:100'],
            'gender' => ['required', 'in:M,F'],
            'allergic' => ['required', 'boolean'], 'disease' => ['required', 'boolean'],
            'medicine' => ['required', 'boolean'], 'vehicle' => ['required', 'boolean'],
            'license' => ['required', 'boolean'], 'payment' => ['required', 'boolean'],
            'blood_type' => ['required', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-,N'],
            'type' => ['required', 'in:V,A,H,C'], 'status' => ['required', 'in:A,I,S,R'],
            'init_voluntary' => ['required', 'date', 'before_or_equal:today'],
        ], [], ['delegation_id'=>'delegación','document'=>'número de documento','birthday'=>'fecha de nacimiento','init_voluntary'=>'fecha de inicio']);
        DelegationAccess::authorize((int) $request->delegation_id);
        try{
            DB::beginTransaction();
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

            if($voluntary->save() && $request->hasFile('image')){
                $image_voluntary = new Image_Voluntary();
                $image_voluntary->voluntary_id = $voluntary->id;
                $image_voluntary->name = $request->file('image')->getClientOriginalName();
                $image_voluntary->path = $request->file('image')->store('imagenes', 'public');
                $image_voluntary->save();
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Voluntario registrado'
            ], 201);
        }catch(Exception $e){
            DB::rollBack();
            Log::error('Error al crear voluntario.', ['user_id'=>Auth::id(), 'exception'=>$e]);
            return response()->json([
                'status' => 'error',
                'message' => 'No fue posible crear el voluntario. Inténtalo nuevamente.'
            ], 500);
        }
    }

    public function show(string $id)
    {
        try{
            $voluntary = DelegationAccess::scope(Voluntary::with(['delegation', 'images', 'cargo']))->find($id);
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
            $voluntary = DelegationAccess::scope(Voluntary::query())->findOrFail($id);
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
            $voluntary = DelegationAccess::scope(Voluntary::query())->findOrFail($id);
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
            $voluntary = DelegationAccess::scope(Voluntary::query())->findOrFail($id);
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
        $target = Voluntary::findOrFail($request->id_user_emergency);
        DelegationAccess::authorize((int) $target->delegation_id);
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
        $validated = $request->validate([
            'id_user_remark' => ['required', 'exists:voluntaries,id'],
            'remark' => ['required', 'string', 'min:3', 'max:255'],
            'gravity' => ['required', 'in:0,1,2,3,4,5'],
        ], [], ['id_user_remark'=>'voluntario','remark'=>'anotación','gravity'=>'gravedad']);
        $target = Voluntary::findOrFail($validated['id_user_remark']);
        DelegationAccess::authorize((int) $target->delegation_id);
        try{
            $remark = new Remark();
            $remark->voluntary_id = $validated['id_user_remark'];
            $remark->remark = $validated['remark'];
            $remark->gravity = $validated['gravity'];
            $remark->responsable_id = Auth::user()->id;
            $remark->save();

            return response()->json(['success' => 'Voluntario actualizado correctamente']);
        }catch(Exception $e){
            Log::error('Error al registrar anotación.', ['user_id'=>Auth::id(), 'voluntary_id'=>$validated['id_user_remark'], 'exception'=>$e]);
            return response()->json([
                'status' => 'error',
                'message' => 'No fue posible registrar la anotación.'
            ], 500);
        }
    }

    public function storeCargo(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100', 'unique:cargos,nombre'],
        ], [], ['name' => 'nombre']);

        try{
            Cargo::create(['nombre' => $validated['name']]);

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
            $relations = ['delegation', 'images'];
            if (Schema::hasTable('cargos')) {
                $relations[] = 'cargo';
            }
            $voluntary = Voluntary::with($relations)->find($voluntaryId);
            if (!$voluntary) {
                return redirect()->route('login')->with('error', 'Voluntario no encontrado');
            }
            if (!Schema::hasTable('cargos')) {
                $voluntary->setRelation('cargo', null);
            }

            $rescuesQuery = DB::table('rescue')
                ->where('rescue.voluntario_id', $voluntaryId);

            if (Schema::hasTable('rescate_voluntarios')) {
                $rescuesQuery->orWhereIn('rescue.id', function ($query) use ($voluntaryId) {
                    $query->select('rescate_id')
                        ->from('rescate_voluntarios')
                        ->where('voluntario_id', $voluntaryId);
                });
            }

            $rescues = $rescuesQuery
                ->select([
                    'rescue.*',
                    DB::raw('rescue.type as tipo_emergencia'),
                    DB::raw('rescue.date_finish_rescue as fecha_operativo'),
                    DB::raw('rescue.place as lugar'),
                    DB::raw("'-' as sexo"),
                ])
                ->orderByDesc('rescue.date_finish_rescue')
                ->get();

            $remark = Remark::with('user')->where('voluntary_id', $voluntaryId)->get();
            $emergency = Emergency::where('voluntary_id', $voluntaryId)->get();
            $dues = FinanceTransaction::with('category')
                ->where('voluntary_id', $voluntaryId)
                ->whereHas('category', fn ($query) => $query->where('system_key', 'membership_dues'))
                ->latest('transaction_date')
                ->get();

            return view('module.voluntario.profile', compact('voluntary', 'remark', 'emergency', 'rescues', 'dues'));
        }catch(Exception $e){
            Log::error('No fue posible cargar el perfil del voluntario.', [
                'user_id' => Auth::id(),
                'voluntary_id' => Auth::user()?->voluntary_id,
                'exception' => $e,
            ]);

            return redirect()->route('dashboard')->with('error', 'No fue posible cargar tu perfil. Inténtalo nuevamente.');
        }
    }
}
