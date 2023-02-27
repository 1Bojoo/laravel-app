@extends('layouts.panel')

@section('title', 'Moje ogłoszenia')

@section('content')
    
        <div class="">
            <div class="row">
            <div class="col-12 mt-5 mb-2">
                <h2>Pokoje</h2>
                <button class="float-end me-4 mb-3 btn btn-primary">Dodaj</button>
            </div>
            {{-- <div class="col-6">
                <a class="float-right" href="{{route('createUser')}}">
                <button type="button" class="btn btn-primary">Dodaj</button>
                </a>
            </div> --}}
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numer pokoju</th>
                    <th scope="col">Piętro</th>
                    <th scope="col">Najemca</th>
                    <th scope="col">Status</th>
                    <th scope="col">Akcje</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->roomNum}}</td>
                    <td>{{$item->floor}}</td>
                    <td>{{$item->reservation?->user->firstname}} {{$item->reservation?->user->lastname}}</td>
                    <td>
                        @if($item->isOwned == false)
                            Wolny
                        @else
                            Zajęty
                        @endif
                    </td>
                    <td>
                        <a href="{{route('editRoom', $item->roomNum)}}" class="btn btn-primary">Edytuj status</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

@endsection