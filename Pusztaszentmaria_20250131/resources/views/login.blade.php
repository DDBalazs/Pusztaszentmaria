@extends('layout')
@section('content')
    <div class="col-md-9">
        <h1 class="text-center py-3">Bejelentkezés</h1>
        <form action="/login" method="post">
            @csrf
            @if(session('errors'))
                <div class="alert alert-danger">
                    {{ session('errors')->first('sv') }}
                </div>
            @endif
            <div class="py-2">
                <label for="credentials" class="form-label">Név vagy email:</label>
                <input type="text" name="credentials" id="credentials" class="form-control">
            </div>

            <div class="py-2">
                <label for="password" class="form-label">Jelszó:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="py-2">
                <button type="submit" class="btn btn-dark">Belépés</button>
            </div>
        </form>
    </div>
@endsection

