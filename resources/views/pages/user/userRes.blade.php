@extends('layouts.app')

@section('title', 'Moje rezerwacje')

@section('content')

    <div class="">
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Lista rezerwacji</h2>
          </div>
        </div>
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
              @foreach($result as $ann)
              <tr>
                <th scope="row">{{$ann->id}}</th>
                <td>{{$ann->user_id}}</td>
                <td>{{$ann->name}}</td>
                <td>{{$ann->name}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>

@endsection