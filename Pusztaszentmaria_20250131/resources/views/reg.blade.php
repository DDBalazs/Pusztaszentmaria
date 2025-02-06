@extends('layout')
@section('content')
    <div class="col-md-9">
        <h1 class="text-center py-3">Regisztráció</h1>
        <form action="/reg" method="POST">
            @csrf
            <div class="py-2">
                <label for="nev" class="form-label">Név:</label>
                <input type="text" name="nev" id="nev" class="form-control" value="{{old('nev')}}">
                @error('nev')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="email" class="form-label">E-Mail</label>
                <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="password" class="form-label">Jelszó:</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="password_confirmation" class="form-label">Jelszó ismét:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                @error('password_confirmation')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
                <button type="submit" class="btn btn-success">Regisztráció</button>
        </form>
    </div>
@endsection

