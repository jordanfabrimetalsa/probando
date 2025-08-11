<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ApiServices
{
    protected $apiKey;
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5';

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
    }

    public function consumeApiWeatherSanJosé()
    {
        try {
            $response = Http::get("{$this->baseUrl}/weather", [
                'lat' => -33.63494,
                'lon' => -70.36144,
                'appid' => $this->apiKey,
                'units' => 'metric', 
                'lang' => 'es'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                // Agregar la URL completa del ícono
                if (isset($data['weather'][0]['icon'])) {
                    $data['weather'][0]['iconUrl'] = "https://openweathermap.org/img/wn/{$data['weather'][0]['icon']}@2x.png";
                }
                return $data;
            }

            Log::error('Error en la respuesta de la API del clima', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return ['error' => 'Error en la respuesta del servicio del clima'];
            
        } catch (\Exception $e) {
            Log::error('Excepción al consumir API del clima: ' . $e->getMessage());
            return ['error' => 'No se pudo conectar al servicio del clima'];
        }
    }

    public function consumeAPiWeatherLaParva(){
        try{
            $response = Http::get("{$this->baseUrl}/weather",[
                'lat' => -33.3355943,
                'lon' => -70.2899972,
                'appid' => $this->apiKey,
                'units' => 'metric', 
                'lang' => 'es'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['weather'][0]['icon'])) {
                    $data['weather'][0]['iconUrl'] = "https://openweathermap.org/img/wn/{$data['weather'][0]['icon']}@2x.png";
                }
                return $data;
            }

            Log::error('Error en la respuesta de la API del clima', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return ['error' => 'Error en la respuesta del servicio del clima'];
            
        } catch (\Exception $e) {
            Log::error('Excepción al consumir API del clima: ' . $e->getMessage());
            return ['error' => 'No se pudo conectar al servicio del clima'];
        }
    }
}
