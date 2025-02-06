@extends('layout')
@section('content')
    <div class="col-md-9">
        <h1 class="text-center py-3">Vendegkönyv</h1>
        <form action="/vendegkonyv" method="POST">
            @csrf
            <div class="py-2">
                <label for="nev" class="form-label">Név:<span class="text-danger">*</span></label>
                <input type="text" name="nev" id="nev" class="form-control" value="{{old('nev')}}">
                @error('nev')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="email" class="form-label">E-mail:<span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="message" class="form-label">Üzenet:<span class="text-danger">*</span></label>
                <textarea name="message" id="message" cols="30" rows="6" class="form-control" value="{{old('message')}}"></textarea>
                @error('message')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="py-2">
                <span class="text-danger">* kötelező megadni</span>
            </div>
            <button class="btn btn-outline-info">Beküld</button>
            <hr>
        </form>
            @foreach ($req as $row)
                <div class="py-2">
                    <h5>{{$row->nev}} - <a href="mailto:{{$row->email}}">{{$row->email}}</a></h5>
                    <p>{{date_format(date_create($row->date), 'Y. m. d.')}}</p>
                </div>
                <p>{{$row->message}}</p>
            @endforeach
    </div>
@endsection

