@extends('layouts.panel')

@section('title', 'Moje ogłoszenia')

@section('content')
    
        <div class="">
            <div class="row">
            <div class="col-12 mt-5 mb-2">
                <h2>Rezerwacje</h2>
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
                    <th scope="col">Imie</th>
                    <th scope="col">Email</th>
                    <th scope="col">Pokój</th>
                    <th scope="col">Od</th>
                    <th scope="col">Do</th>
                    <th scope="col">Akcje</th>
                </tr>
                </thead>
                <tbody>
                @foreach($res as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->user->email}}</td>
                    <td></td>
                    <td>{{$item->arrDate}}</td>
                    <td>{{$item->depDate}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

@endsection