<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\SendOut;
use App\Mail\SendOutMailable;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendOutController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[\pL\s\'’-]+$/u'],
            'lastname' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[\pL\s\'’-]+$/u'],
            'document_type' => ['required', 'in:0,1'],
            'document_number' => ['required', 'string', 'min:5', 'max:20', 'regex:/^[A-Za-z0-9.-]+$/'],
            'email' => ['required', 'email:rfc', 'max:100'],
            'phone' => ['required', 'digits_between:8,12'],
            'region' => ['required', 'integer', 'between:0,15'],
            'destination' => ['required', 'string', 'min:3', 'max:80'],
            'route' => ['required', 'string', 'min:3', 'max:150'],
            'activity' => ['required', 'integer', 'in:0,1,3,4,5,6,7'],
            'number_participants' => ['required', 'integer', 'between:1,100'],
            'departure_date' => ['required', 'date'],
            'return_date' => ['required', 'date', 'after:departure_date', function ($attribute, $value, $fail) use ($request) {
                if ($request->departure_date && strtotime($value) < strtotime($request->departure_date) + 3600) {
                    $fail('La fecha de regreso debe ser al menos una hora posterior a la salida.');
                }
            }],
            'name_emergency_family' => ['required', 'string', 'min:3', 'max:60'],
            'parentesco_family_emergency' => ['required', 'in:Padre,Madre,Hermano,Hermana,Amigo,Otro'],
            'number_family_emergency' => ['required', 'digits_between:8,12'],
            'name_emergency_family_2' => ['required', 'string', 'min:3', 'max:60'],
            'parentesco_family_emergency_2' => ['required', 'in:Padre,Madre,Hermano,Hermana,Amigo,Otro'],
            'number_family_emergency_2' => ['required', 'digits_between:8,12', 'different:number_family_emergency'],
            'file_path' => ['nullable', 'file', 'extensions:gpx,kmz', 'max:10240'],
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'Ingresa un correo electrónico válido.',
            'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
            'return_date.after' => 'La fecha de regreso debe ser posterior a la fecha de salida.',
            'different' => 'Los dos contactos de emergencia deben ser diferentes.',
            'file_path.extensions' => 'El archivo de ruta debe ser GPX o KMZ.',
            'file_path.max' => 'El archivo de ruta no puede superar los 10 MB.',
        ], [
            'name' => 'nombres', 'lastname' => 'apellidos', 'document_type' => 'tipo de documento',
            'document_number' => 'RUT o pasaporte', 'phone' => 'teléfono', 'region' => 'región',
            'destination' => 'destino', 'route' => 'ruta', 'activity' => 'actividad',
            'number_participants' => 'número de participantes', 'departure_date' => 'fecha de salida',
            'return_date' => 'fecha de regreso', 'name_emergency_family' => 'primer contacto',
            'parentesco_family_emergency' => 'parentesco del primer contacto',
            'number_family_emergency' => 'teléfono del primer contacto',
            'name_emergency_family_2' => 'segundo contacto',
            'parentesco_family_emergency_2' => 'parentesco del segundo contacto',
            'number_family_emergency_2' => 'teléfono del segundo contacto', 'file_path' => 'archivo de ruta',
        ]);

        $request->merge([
            'document_number' => strtoupper(str_replace(['.', '-'], '', trim($validated['document_number']))),
            'email' => strtolower(trim($validated['email'])),
        ]);

        try {
            $sendout_search = SendOut::where('document_number', $request->document_number)
                ->where('active', 1)
                ->first();

            if ($sendout_search) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al guardar la salida',
                    'error' => 'Aun tienes un aviso activo.'
                ], 409);
            } else {
                $sendout = new SendOut;
            }

            $sendout->name = $request->name;
            $sendout->lastname = $request->lastname;
            $sendout->document_type = $request->document_type;
            $sendout->document_number = $request->document_number;
            $sendout->email = $request->email;
            $sendout->phone = $request->phone;
            $sendout->region = $request->region;
            $sendout->destination = $request->destination;
            $sendout->route = $request->route;
            $sendout->activity = $request->activity;
            $sendout->number_participants = $request->number_participants;
            $sendout->departure_date = $request->departure_date;
            $sendout->return_date = $request->return_date;
            $sendout->active = 1;
            $sendout->file_path = null;
            $sendout->name_emergency_family = $request->name_emergency_family;
            $sendout->parentesco_family_emergency = $request->parentesco_family_emergency;
            $sendout->number_family_emergency = $request->number_family_emergency;
            $sendout->name_emergency_family_2 = $request->name_emergency_family_2;
            $sendout->parentesco_family_emergency_2 = $request->parentesco_family_emergency_2;
            $sendout->number_family_emergency_2 = $request->number_family_emergency_2;

            // Guardar el archivo ANTES de guardar el modelo
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');

                // Verificar que el archivo sea válido
                if ($file->isValid()) {
                    // Validar que sea GPX o KMZ
                    $allowedExtensions = ['gpx', 'kmz'];
                    $extension = strtolower($file->getClientOriginalExtension());

                    if (!in_array($extension, $allowedExtensions)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Solo se permiten archivos GPX o KMZ',
                            'error' => 'Extensión no válida: ' . $extension
                        ], 400);
                    }

                    // Generar nombre de archivo manteniendo la extensión original
                    $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    $path = $file->storeAs('sendouts', $fileName, 'public');

                    $sendout->file_path = $path;
                } else {
                    Log::error('Archivo no válido: ' . $file->getErrorMessage());
                    return response()->json([
                        'success' => false,
                        'message' => 'Archivo no válido',
                        'error' => $file->getErrorMessage()
                    ], 400);
                }
            }

           if ($sendout->save()) {
                $mailSent = true;
                $mailError = null;

                try {
                    switch ($sendout->region) {
                        case 0:
                        case 1:
                        case 11:
                        case 14:
                            Mail::to([$request->email, "socorroandino@socorroandinochile.cl"])->send(new SendOutMailable($sendout));
                            break;
                        case 2:
                            Mail::to([$request->email, "antofagasta@socorroandinochile.cl"])->send(new SendOutMailable($sendout));
                            break;
                        case 3:
                            Mail::to([$request->email, "atacama@socorroandinochile.cl"])->send(new SendOutMailable($sendout));
                            break;
                        case 4:
                            Mail::to([$request->email, "coquimbo@socorroandinochile.cl"])->send(new SendOutMailable($sendout));
                            break;
                        case 5:
                        case 6:
                            Mail::to([$request->email, "avisos.metropolitana@gmail.com"])->send(new SendOutMailable($sendout));
                            break;
                        case 7:
                        case 8:
                            Mail::to([$request->email, "ohiggins@socorroandinochile.cl"])->send(new SendOutMailable($sendout));
                            break;
                        case 9:
                        case 10:
                            Mail::to([$request->email, "nuble@socorroandinochile.cl"])->send(new SendOutMailable($sendout));
                            break;
                        case 12:
                        case 13:
                            Mail::to([$request->email, "loslagos@socorroandinochile.cl"])->send(new SendOutMailable($sendout));
                            break;
                        case 15:
                            Mail::to([$request->email, "magallanes@socorroandinochile.cl"])->send(new SendOutMailable($sendout));
                            break;
                        default:
                            Mail::to([$request->email])->cc('socorroandino@socorroandinochile.cl')->send(new SendOutMailable($sendout));
                            break;
                    }
                } catch (Exception $e) {
                    $mailSent = false;
                    $mailError = $e->getMessage();
                    Log::error('Error al enviar correo de salida (SendOut ID: ' . $sendout->id . '): ' . $mailError);
                }

                return response()->json([
                    'success' => true,
                    'data' => $sendout,
                    'mail_sent' => $mailSent,
                    'mail_error' => $mailError,
                    'message' => $mailSent ? 'Salida guardada correctamente' : 'Salida guardada correctamente, pero no se pudo enviar el correo'
                ]);
            } else {
                Log::error('Error al guardar la salida: ' . $sendout->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error al guardar la salida'
                ], 500);
            }
        } catch (Exception $e) {
            Log::error('Error al guardar la salida: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la salida',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'tipo_documento' => ['required', 'in:1,2'],
            'rut' => ['required', 'string', 'min:5', 'max:20', 'regex:/^[A-Za-z0-9.-]+$/'],
        ], [
            'tipo_documento.required' => 'Selecciona el tipo de documento.',
            'rut.required' => 'Ingresa el RUT o pasaporte.',
            'rut.regex' => 'El documento contiene caracteres no válidos.',
        ]);

        try {
            $documentType = $validated['tipo_documento'] === '1' ? '1' : '0';
            $documentNumber = strtoupper(str_replace(['.', '-'], '', trim($validated['rut'])));
            $sendout = SendOut::where('document_type', $documentType)
                ->whereRaw("REPLACE(REPLACE(UPPER(document_number), '.', ''), '-', '') = ?", [$documentNumber])
                ->get();

            if ($sendout) {
                return response()->json([
                    'success' => true,
                    'data' => $sendout,
                    'message' => 'Salida encontrada correctamente'
                ]);
            } else {
                Log::error('Error al buscar la salida: ' . $sendout->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error al buscar la salida'
                ], 500);
            }
        } catch (Exception $e) {
            Log::error('Error al buscar la salida: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar la salida',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function finish(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:notice_departure,id'],
        ], [
            'id.required' => 'No se recibió el aviso que deseas finalizar.',
            'id.exists' => 'El aviso indicado ya no existe.',
        ]);

        try {
            $sendout = SendOut::find($validated['id']);

            if ($sendout) {
                $sendout->active = false;
                $sendout->return_date = now();
                if ($sendout->save()) {
                    return response()->json([
                        'success' => true,
                        'data' => $sendout,
                        'message' => 'Salida terminada correctamente'
                    ]);
                } else {
                    Log::error('Error al terminar la salida: ' . $sendout->getMessage());
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al terminar la salida'
                    ], 500);
                }
            } else {
                Log::error('Error al terminar la salida: ' . $sendout->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error al terminar la salida'
                ], 500);
            }
        } catch (Exception $e) {
            Log::error('Error al terminar la salida: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al terminar la salida',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function list()
    {
        return view('module.aviso.index');
    }

    public function data()
    {
        try {
            $sendouts = SendOut::all()->map(function ($sendout) {
                if ($sendout->file_path) {
                    $sendout->download_url = route('aviso.download', $sendout->id);
                    $sendout->has_gpx = strtolower(pathinfo($sendout->file_path, PATHINFO_EXTENSION)) === 'gpx';
                    if ($sendout->has_gpx) $sendout->track_url = route('aviso.track', $sendout->id);
                }
                return $sendout;
            });

            if ($sendouts) {
                return response()->json($sendouts);
            } else {
                Log::error('Error al listar las salidas');
                return response()->json([
                    'success' => false,
                    'message' => 'Error al listar las salidas'
                ], 500);
            }
        } catch (Exception $e) {
            Log::error('Error al listar las salidas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al listar las salidas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        $sendout = SendOut::findOrFail($id);

        if (!$sendout->file_path) {
            abort(404, 'Archivo no encontrado');
        }

        $filePath = storage_path('app/public/' . $sendout->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'El archivo no existe en el servidor');
        }

        return response()->download($filePath);
    }

    public function track($id)
    {
        $sendout = SendOut::findOrFail($id);
        abort_unless($sendout->file_path && strtolower(pathinfo($sendout->file_path, PATHINFO_EXTENSION)) === 'gpx', 404, 'Este aviso no contiene una ruta GPX.');
        $storageRoot = realpath(storage_path('app/public'));
        $filePath = realpath(storage_path('app/public/'.$sendout->file_path));
        abort_unless($storageRoot && $filePath && str_starts_with($filePath, $storageRoot.DIRECTORY_SEPARATOR), 404, 'Archivo GPX no encontrado.');
        return response()->file($filePath, ['Content-Type' => 'application/gpx+xml; charset=UTF-8']);
    }

    public function changeState($id)
    {
        $active = 0;
        $change = SendOut::findOrFail($id);
        $change->active = $active;
        $change->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado cambiado correctamente'
        ]);
    }

    public function showInfo($id)
    {
        $sendout = SendOut::findOrFail($id);
        return response()->json($sendout);
    }
}
