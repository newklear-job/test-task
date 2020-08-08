<?php

namespace App\Services;


use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeatherInfo($city): Response
    {
        $apiKey = config('weather.openWeatherAPI');
        return Http::get("api.openweathermap.org/data/2.5/weather?units=metric&lang=ua&appid=$apiKey&q=$city");
    }

    public function formatWeatherResponse(Response $weatherResponse)
    {
        $sunriseWithTZ = Carbon::createFromTimestamp($weatherResponse['sys']['sunrise'] + $weatherResponse['timezone']);
        $sunsetWithTZ = Carbon::createFromTimestamp($weatherResponse['sys']['sunset'] + $weatherResponse['timezone']);
        return [
            'Місто' => $weatherResponse['name'],
            'Код країни' => $weatherResponse['sys']['country'],
            'Температура' => $weatherResponse['main']['temp'] . "°C",
            'Опис погоди' => $weatherResponse['weather'][0]['description'],
            'Тиск' => $weatherResponse['main']['pressure'] . " hPa",
            'Схід сонця' => $sunriseWithTZ->format('d.m.Y, Hгод, iхв'),
            'Захід сонця' => $sunsetWithTZ->format('d.m.Y, Hгод, iхв'),
            'Тривалість дня' => $sunsetWithTZ->diff($sunriseWithTZ)->format('%Hгод %iхв %sсек')
        ];
    }
}