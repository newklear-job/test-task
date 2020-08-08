@extends('layouts.app')

@section('title', 'Перевірити погоду')

@section('content')
    <div class="title m-b-md">
        Перевірити погоду в місті
    </div>

    <form action="{{route('weather.show')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="city">Вкажіть місто</label>
            <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control">
            @error('city')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
            <button type="submit">Перевірити погоду</button>
        </div>
    </form>
@endsection
