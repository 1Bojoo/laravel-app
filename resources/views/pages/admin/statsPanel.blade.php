@extends('layouts.panel')

@section('title', 'Moje ogłoszenia')

@section('content')

                <div class="row">
                        <div class="col-12 mt-5 mb-2">
                                <h2>Statystyki</h2>
                        </div>
                </div>
                
                <div class="row mt-4">
                        <div class="col mb-3">
                                <div class="card align-items-center text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Liczba pokoi: {{$rooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>
                        <div class="col mb-3">
                                <div class="card align-items-center text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Dostępne pokoje: {{$freeRooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>
                        <div class="col mb-3">
                                <div class="card align-items-center text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Zajęte pokoje: {{$occRooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>
                </div>

                <div class="row">
                        <div class="col mb-3">
                                <div class="card text-center" style="width: 19rem; border: none; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                                        <div class="card-body">
                                                <h5 class="card-title pt-2">Pokoje wykluczone z użytku: {{$offRooms->count()}}</h5>
                                        </div>
                                </div>
                        </div>
                </div>

@endsection