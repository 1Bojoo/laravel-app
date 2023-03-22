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
            <div class="w-100 mt-1 mb-3 d-flex justify-content-center align-items-center">
                <input class="form-control w-25" id="myInput" type="text" placeholder="Szukaj..">
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imie</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">Email</th>
                    <th scope="col">Numer telefonu</th>
                    <th scope="col">Pokój</th>
                    <th scope="col">Od</th>
                    <th scope="col">Do</th>
                    <th scope="col">Akcje</th>
                </tr>
                </thead>
                <tbody id="myTable">
                @foreach($res as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->user->firstname}}</td>
                    <td>{{$item->user->lastname}}</td>
                    <td>{{$item->user->email}}</td>
                    <td>{{$item->user->phone}}</td>
                    <td>{{$item->room->roomNum}}</td>
                    <td>{{$item->arrDate}}</td>
                    <td>{{$item->depDate}}</td>
                    <td>
                        <a href="{{route('deleteRes', $item->id)}}" class="btn btn-danger" onclick="confirmation(event)">Usuń</a>
                        {{-- <a href="{{route('editRes', $item->id)}}" class="btn btn-warning">Edytuj</a> --}}
                        <button class="editRes btn btn-warning w-50" data-bs-toggle="modal" data-bs-target="#staticBackdropEditRes">Edytuj</button>


                        <div class="modal fade" id="staticBackdropEditRes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Edytuj rezerwacje</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="formRes" action="{{route('editRes', $item->id)}}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="roomNum" class="col-md-4 col-form-label text-md-end">{{ __('Numer pokoju') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="roomNum" type="text" class="form-control @error('roomNum') is-invalid @enderror" name="roomNum" value="{{$item->room->roomNum}}" required autocomplete="roomNum" autofocus>
                
                                                @error('roomNum')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button class="btn btn-primary mt-2">Edytuj</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection

@section('script')

    <script type="text/javascript">
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            console.log(value);
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        function confirmation(e){
            e.preventDefault();

            var url = e.currentTarget.getAttribute('href');

            Swal.fire({
                title: "Czy na pewno chcesz usunąć rekord?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Tak',
                cancelButtonText: 'Nie'
            }).then((result) => {
                if(result.value){
                    window.location.href = url;
                }
            })
        }
    </script>

@endsection