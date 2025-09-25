<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use Exception;

class VehiculoController extends Controller
{
    public function index()
    {
        $brands = CarBrand::all();
        $models = CarModel::all();
        return view('module.vehiculo.index', compact('brands', 'models'));
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
        try{
            $request->validate([
                'brand_id' => 'required',
                'model_id' => 'required',
                'plate' => 'required|string|max:255',
                'chassis' => 'required|string|max:255',
                'colour' => 'required|string|max:255',
                'year' => 'required|numeric',
                'motor' => 'required|string|max:255',
                'type' => 'required|string|max:255'
            ]);

            $car = new Car();
            $car->brand_id = $request->brand_id;
            $car->model_id = $request->model_id;
            $car->plate = $request->plate;
            $car->chassis = $request->chassis;
            $car->colour = $request->colour;
            $car->year = $request->year;
            $car->motor = $request->motor;
            $car->type = $request->type;
            $car->status = $request->status;
            $car->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Vehículo registrado'
            ], 201);
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
}
