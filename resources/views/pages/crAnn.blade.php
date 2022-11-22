@extends('layouts.app')

@section('title', 'Dodaj ogłoszenie')

@section('content')

<form action="/pages/crAnn" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Prześlij zdjęcia</label>
        <div class="files">
            <input type="file" name="image[]" class="form-control" multiple>
        </div>
    </div>
    <input type="hidden" name="userID" class="form-control" value="{{$user}}">
    <div class="form-group">
        <label for="">Nazwa</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Opis</label>
        <input type="text" name="desc" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Cena</label>
        <textarea type="text" name="price" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Kraj</label>
        <textarea type="text" name="country" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Miejscowość/Miasto</label>
        <textarea type="text" name="city" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Województwo</label>
        <textarea type="text" name="province" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Ulica</label>
        <textarea type="text" name="street" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Numer Domu</label>
        <textarea type="text" name="hNum" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Kod Pocztowy</label>
        <textarea type="text" name="postalCode" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">Dodaj</button>
</form>

@endsection