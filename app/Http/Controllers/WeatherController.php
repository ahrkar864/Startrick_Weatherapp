<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather.index');
    }

    public function fetchWeather(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
        ]);

        $city = $request->input('city');
        $apiKey = env('OPENWEATHER_API_KEY');
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

        try {
            $response = Http::get($url);
            if ($response->successful()) {
                $data = $response->json();

                return view('weather.result', [
                    'city' => $data['name'],
                    'temperature' => $data['main']['temp'],
                    'weather' => ucfirst($data['weather'][0]['description']),
                    'datetime' => now()->toDayDateTimeString(),
                ]);
            }
            if ($response->status() === 404) {
                return redirect()->route('home')->withErrors(['city' => 'City not found. Please check the city name and try again.']);
            }

            return redirect()->route('home')->withErrors(['city' => 'API request failed. Please try again later.']);
            
        } catch (\Exception $e) {

            return redirect()->route('home')->withErrors(['city' => 'Something went wrong. Please try again later.']);
        }
    }
}
