<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\DocumentCar;
use App\Models\Maintenance;
use App\Models\Delegation;
use Exception;

class VehiculoController extends Controller
{
    public function index()
    {
        $brands = CarBrand::all();
        $models = CarModel::all();
        $delegations = Delegation::all();
        return view('module.vehiculo.index', compact('brands', 'models', 'delegations'));
    }

    public function data(){
        try{
            $vehiculos = Car::with('brand')
                        ->with('model')
                        ->get();
            return response()->json($vehiculos);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function show($id){
        try{
            $car = Car::with('brand')
                        ->with('model')
                        ->with('delegation')
                        ->with('documentCar')
                        ->with('maintenance')
                        ->find($id);
            return response()->json($car);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function brandData(){
        try{
            $brands = CarBrand::all();
            return response()->json($brands);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function modelData(){
        try{
            $models = CarModel::with('brand')->get();
            return response()->json($models);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function Store(Request $request){
        $request->validate([
            'brand_id' => 'required',
            'model_id' => 'required',
            'plate' => 'required|string|max:255',
            'chassis' => 'required|string|max:255',
            'colour' => 'required|string|max:255',
            'year' => 'required|numeric',
            'motor' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'kilometer' => 'required|numeric'
        ]);

        try{
            $car = new Car();
            $car->brand_id = $request->brand_id;
            $car->model_id = $request->model_id;
            $car->plate = $request->plate;
            $car->chassis = $request->chassis;
            $car->colour = $request->colour;
            $car->year = $request->year;
            $car->motor = $request->motor;
            $car->type = $request->type;
            $car->kilometer = $request->kilometer;
            $car->id_delegations = $request->id_delegations;
            $car->status = $request->status;

            if($car->save()){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Vehículo registrado'
                ], 201);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error al registrar vehículo'
                ], 500);
            }
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function destroy($id){
        try{
            $car = Car::find($id);
            if($car->delete()){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Vehículo eliminado'
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error al eliminar vehículo'
                ], 500);
            }
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function brandStore(Request $request){
        try{
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $brand = new CarBrand();
            $brand->name = $request->name;
            $brand->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Marca registrado'
            ], 201);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function modelStore(Request $request){
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'brand_id' => 'required|exists:brand_cars,id',
            ]);

            $model = new CarModel();
            $model->name = $request->name;
            $model->brand_id = $request->brand_id;
            $model->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Modelo registrado'
            ], 201);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function documentStore(Request $request){
        $request->validate([
                'car_id_document' => 'required|exists:cars,id',
                'circulation_permit' => 'required',
                'gases' => 'required',
                'technical_inspection' => 'required',
                'insurance' => 'required',
        ]);

        try{
            $document = new DocumentCar();
            $document->car_id = $request->car_id_document;
            $document->circulation_permit = $request->circulation_permit;
            $document->gases = $request->gases;
            $document->technical_inspection = $request->technical_inspection;
            $document->insurance = $request->insurance;
            $document->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Documentación del vehículo actualizada correctamente'
            ], 201);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function MaintenanceStore(Request $request){
        $request->validate([
                'car_id_maintenance' => 'required|exists:cars,id',
                'kilometer' => 'required',
                'place' => 'required',
                'cost' => 'required',
                'date' => 'required',
        ]);

        try{
            $maintenance = new Maintenance();
            $maintenance->car_id = $request->car_id_maintenance;
            $maintenance->kilometer = $request->kilometer;
            $maintenance->place = $request->place;
            $maintenance->cost = $request->cost;
            $maintenance->date = $request->date;
            $maintenance->save();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Mantenimiento del vehículo realizado correctamente'
            ], 201);
        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
