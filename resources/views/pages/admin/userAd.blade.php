@extends('layouts.app')

@section('title', 'Użytkownicy')

@section('content')

    <div class="">
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Lista użytkowników</h2>
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
                <th scope="col">Nazwa</th>
                <th scope="col">Email</th>
                <th scope="col">Rola</th>
                <th scope="col">Akcje</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
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
@section('script')
  <script type="text/javascript">
    $(function() {
      $('.delete').click(function() {
        $.ajax({
          method: "DELETE",
          url: "/pages/admin/userAd/" + $(this).data('id'),
          data: {_token: '{{csrf_token()}}'}
        })
        .done(function(response) {
          window.location.reload();
        })
        .fail(function(response) {
          alert("ERROR");
        })
      });
    });
  </script>
@endsection