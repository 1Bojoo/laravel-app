@extends('layouts.panel')

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
          <div class="w-100 mt-1 mb-3 d-flex justify-content-center align-items-center">
            <input class="form-control w-25" id="myInput" type="text" placeholder="Szukaj..">
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
              <tbody id="myTable">
                @foreach($users as $user)
                <tr>
                  <th scope="row">{{$user->id}}</th>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                    @if($user->role == 'guest')
                      Gość
                    @elseif($user->role == 'student')
                      Student
                    @else
                      Admin
                    @endif
                  </td>
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
        Swal.fire({
          title: "Czy na pewno chcesz usunąć rekord?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: 'Tak',
          cancelButtonText: 'Nie'
        }).then((result) => {
          if(result.value){
            $.ajax({
              method: "DELETE",
              url: "{{route('users')}}/" + $(this).data('id'),
              data: {_token: '{{csrf_token()}}'}
            })
            .done(function(response) {
              window.location.reload();
            })
            .fail(function(response) {
              alert("ERROR");
            })
          }
        })
      });
    });

    $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            console.log(value);
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
  </script>
@endsection