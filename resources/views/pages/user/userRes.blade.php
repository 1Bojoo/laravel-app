@extends('layouts.app')

@section('title', 'Moje rezerwacje')

@section('content')

  @php
    $counter = 1;
  @endphp

    <div class="">
      @if($res->isEmpty())
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Brak rezerwacji</h2>
          </div>
        </div>
      @else
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Lista rezerwacji</h2>
          </div>
        </div>
        <table class="table w-75">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Ogłoszenie</th>
                <th scope="col">Od</th>
                <th scope="col">Do</th>
                <th scope="col">Akcje</th>
              </tr>
            </thead>
            <tbody>
              @foreach($res as $item)
              <tr>
                <th scope="row">{{$counter++}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->arrDate}}</td>
                <td>{{$item->depDate}}</td>
                <td><a href="{{route('delRes', $item->id)}}" class="btn btn-danger">Usuń</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
      @endif
    </div>

@endsection