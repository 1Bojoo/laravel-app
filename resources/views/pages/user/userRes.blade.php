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
                <th scope="col">Email</th>
                <th scope="col">Rola</th>
                <th scope="col">Akcje</th>
              </tr>
            </thead>
            <tbody>
              @foreach($anns as $ann)
              <tr>
                <th scope="row">{{$ann->id}}</th>
                <td>{{$ann->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>
                  <a href="{{route('editUser', $user->id)}}">
                    <button type="button" class="edit btn btn-warning">Edytuj</button>
                  </a>
                  <button type="button" class="delete btn btn-danger" data-id="{{$user->id}}">Usuń</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>

@endsection