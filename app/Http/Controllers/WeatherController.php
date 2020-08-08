<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather.index');
    }

    public function show(WeatherRequest $weatherRequest, WeatherService $weatherService)
    {
        $city = $weatherRequest['city'];
        $weatherResponse = $weatherService->getWeatherInfo($city);

        if (!$weatherResponse->ok())
        {
            return redirect()->back()->withErrors(['city' => $weatherResponse['message'] ?? 'Неочікувана помилка!']);
        }

        $formattedWeather = $weatherService->formatWeatherResponse($weatherResponse);
        return view('weather.show', compact('formattedWeather', 'city'));
    }
}
