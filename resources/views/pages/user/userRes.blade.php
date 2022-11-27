@extends('layouts.app')

@section('title', 'Moje rezerwacje')

@section('content')

  @php
    $counter = 1;
  @endphp

    <div class="">
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Lista rezerwacji</h2>
          </div>
        </div>
        @if ()
            
        @else
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Od</th>
                <th scope="col">Do</th>
              </tr>
            </thead>
            <tbody>
              @foreach($result as $item)
              <tr>
                <th scope="row">{{$counter++}}</th>
                <td>{{$item->user_id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->desc}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
    </div>

@endsection