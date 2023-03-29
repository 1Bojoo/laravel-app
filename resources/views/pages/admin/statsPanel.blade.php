@extends('layouts.panel')

@section('title', 'Moje ogłoszenia')

@section('content')

                <div class="row">
                        <div class="col-12 mt-5 mb-4">
                                <h1>Statystyki</h1>
                        </div>
                </div>

                <div class="row">
                        <div class="col-12 mt-5 mb-4">
                                <h2>Pokoje</h2>
                        </div>
                </div>

                <table class="table">
                        <thead>
                                <tr>
                                        <th class="col">Liczba pokoi</th>
                                        <th class="col">Dostępne pokoje</th>
                                        <th class="col">Zajęte pokoje</th>
                                        <th class="col">Pokoje wykluczone z użytku</th>
                                </tr>
                        </thead>
                        <tbody>
                                <tr>
                                        <td>{{$rooms->count()}}</td>
                                        <td>{{$freeRooms->count()}}</td>
                                        <td>{{$occRooms->count()}}</td>
                                        <td>{{$offRooms->count()}}</td>
                                </tr>
                        </tbody>
                </table>

                {{-- <div class="row">
                        <div class="col mb-3 d-flex justify-content-center">
                                <div class="card align-items-center text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Liczba pokoi: {{$rooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>
                </div>
                
                <div class="row mt-4">
                        <div class="col mb-3 d-flex justify-content-center">
                                <div class="card align-items-center text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Dostępne pokoje: {{$freeRooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>
                        <div class="col mb-3 d-flex justify-content-center">
                                <div class="card align-items-center text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Zajęte pokoje: {{$occRooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>
                        <div class="col mb-3 d-flex justify-content-center">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Pokoje wykluczone z użytku: {{$offRooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>
                </div> --}}

                <div class="row">
                        <div class="col-12 mt-5 mb-4">
                                <h2>Magazyn</h2>
                        </div>
                </div>

                <table class="table">
                        <thead>
                                <tr>
                                        <th class="col">Liczba kompletów pościeli</th>
                                        <th class="col">Dostępne poduszki</th>
                                        <th class="col">Dostępne kołdry</th>
                                        <th class="col">Dostępne prześcieradła</th>
                                        <th class="col">Dostępne poszewki</th>
                                </tr>
                        </thead>
                        <tbody>
                                <tr>
                                        <td>{{$storage->quantity}}</td>
                                        <td>{{$storage->pillow}}</td>
                                        <td>{{$storage->duvet}}</td>
                                        <td>{{$storage->bedsheet}}</td>
                                        <td>{{$storage->bedclothes}}</td>
                                </tr>
                        </tbody>
                </table>

                {{-- <div class="row">
                        <div class="col-12 mb-3 d-flex justify-content-center">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Liczba kompletów: {{$storage->quantity}}</h5>
                                        </div>
                                </div>
                        </div>
                </div>

                <div class="row mt-4">

                        <div class="col mb-3 d-flex justify-content-center">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Dostępne poduszki: {{$storage->pillow}}</h5>
                                        </div>
                                </div>
                        </div>

                        <div class="col mb-3 d-flex justify-content-center">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Dostępne kołdry: {{$storage->duvet}}</h5>
                                        </div>
                                </div>
                        </div>

                        <div class="col mb-3 d-flex justify-content-center">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Dostępne prześcieradła: {{$storage->bedsheet}}</h5>
                                        </div>
                                </div>
                        </div>

                        <div class="col mb-3 d-flex justify-content-center">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Dostępne poszewki: {{$storage->bedclothes}}</h5>
                                        </div>
                                </div>
                        </div>

                </div> --}}

                {{-- <div class="row">

                        <div class="col mb-3">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Zajete poduszki: {{($storage->quantity) - $storage->pillow}}</h5>
                                        </div>
                                </div>
                        </div>

                        <div class="col mb-3">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Zajęte kołdry: {{$offRooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>

                        <div class="col mb-3">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Zajęte prześcieradła: {{$offRooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>

                </div> --}}

@endsection