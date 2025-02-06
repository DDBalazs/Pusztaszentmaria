@extends('layout')
@section('content')
    <div class="col-md-9">
        <h1 class="text-center py-3">Jelszó módosítás</h1>
        <form action="/newpass" method="POST"> 
            @csrf
            <div class="py-2">
                <label for="oldpassword" class="form-label">Régi jelszó:</label>
                <input type="password" name="oldpassword" id="oldpassword" class="form-control">
                @error('oldpassword')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="newpassword" class="form-label">Új jelszó</label>
                <input type="password" name="newpassword" id="newpassword" class="form-control">
                @error('newpassword')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="newpassword_confirmation" class="form-label">Új jelszó megint:</label>
                <input type="password" name="newpassword_confirmation" id="password" class="form-control">
                @error('newpassword_confirmation')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
                <button type="submit" class="btn btn-success">Jelszó módosítása</button>
        </form>
    </div>
@endsection
