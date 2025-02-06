@extends('layout')
@section('content')
    <div class="col-md-9">
        <h1 class="text-center py-3">Profilod</h1>

        <p><b>Neved:</b> {{Auth::user()->nev}}</p>
        <p><b>E-Mail címed:</b> {{Auth::user()->email}}</p>
        <p><b>Regisztrációd ideje:</b> {{date_format(date_create(Auth::user()->created_at), 'Y. m. d.')}}</p>
        <hr>
        <p>
            <a class="btn btn-success" href="/newpass">Jelszó módosítás</a>
            <a class="btn btn-danger" href="/del">Profil törlése</a>
        </p>

    </div>
@endsection
