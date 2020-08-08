@extends('layouts.app')
@section('style')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        a{
            float:right;
        }
    </style>
@endsection
@section('title', "Погода в місті $city")

@section('content')
    <div class="title m-b-md">
        Погода для запиту "{{$city}}"
    </div>
    <table>
        <tr>
            <th>Параметр</th>
            <th>Значення</th>
        </tr>
        @foreach($formattedWeather as $parameterName => $parameterValue)
            <tr>
                <td>{{$parameterName}}</td>
                <td>{{$parameterValue}}</td>
            </tr>
        @endforeach
    </table>

    <a href="{{route('weather.index')}}">Назад</a>

@endsection
