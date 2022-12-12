@extends('layouts.app')

@section('title', 'Dodaj ogłoszenie')

@section('content')

<form action="{{route('updateAnn', $ann->id)}}" enctype="multipart/form-data" method="POST">
    @csrf
    {{-- <div class="form-group">
        <label for="">Prześlij zdjęcia</label>
        <div class="files">
            <input type="file" name="image[]" class="form-control" multiple>
        </div>
    </div> --}}
    <div class="form-group">
        <label for="">Nazwa</label>
        <input type="text" name="name" class="form-control" value="{{$ann->name}}" required autocomplete="name">
    </div>
    <div class="form-group">
        <label for="">Opis</label>
        <textarea type="text" name="desc" class="form-control" required autocomplete="desc">{{$ann->desc}}</textarea>
    </div>
    <div class="form-group">
        <label for="">Cena</label>
        <input type="text" name="price" class="form-control" value="{{$ann->price}}" required autocomplete="price">
    </div>
    <div class="form-group">
        <label for="">Kraj</label>
        <input type="text" name="country" class="form-control" value="{{$ann->country}}" required autocomplete="country">
    </div>
    <div class="form-group">
        <label for="">Miejscowość/Miasto</label>
        <input type="text" name="city" class="form-control" value="{{$ann->city}}" required autocomplete="city">
    </div>
    <div class="form-group">
        <label for="">Województwo</label>
        <input type="text" name="province" class="form-control" value="{{$ann->province}}" required autocomplete="province">
    </div>
    <div class="form-group">
        <label for="">Ulica</label>
        <input type="text" name="street" class="form-control" value="{{$ann->street}}" required autocomplete="street">
    </div>
    <div class="form-group">
        <label for="">Numer Domu</label>
        <input type="text" name="hNum" class="form-control" value="{{$ann->hNum}}" required autocomplete="hNum">
    </div>
    <div class="form-group">
        <label for="">Kod Pocztowy</label>
        <input type="text" name="postalCode" class="form-control" value="{{$ann->postalCode}}" required autocomplete="postalCode">
    </div>
    <button class="btn btn-primary">Edytuj</button>
</form>

@endsection