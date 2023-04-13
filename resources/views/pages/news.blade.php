@extends('layouts.app')

@section('title', 'Kontakt')

@section('content')

<div class="mt-3 mb-5 p-3">
    <div class="text-center">
        <h1>Aktualności</h1>
    </div>
    @can('isAdmin')
        <div class="text-center pt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticAddNews">Dodaj ogłoszenie</button>
        </div>
    @endcan
    <div class="container mt-5">
        <div class="row row-cols-3 align-items-center">
            @foreach($news as $item)
                <div class="col-12 col-md-6 col-xl-4 d-flex justify-content-center mb-4">
                    <div class="card border-0" style="width: 20rem; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                        <div class="card-body">
                        <h4 class="card-title text-center p-3">{{$item->title}}</h4>
                        <p class="card-text">{{$item->content}}</p>
                        <h5 class="card-title text-end p-2">{{$item->date}}</h5>
                        </div>

                        @can('isAdmin')
                            <a href="{{route('delNews', $item->id)}}" onclick="confirmation(event)" class="text-decoration-none text-primary position-absolute stretched-link" style="top: 5%; right: 5%">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </a>
                        @endcan

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="modal fade" id="staticAddNews" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Dodaj ogłoszenie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('addNews')}}" id="newsForm" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Tytuł</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Wiadomość</label>
                    <textarea type="text" name="content" class="form-control" use="newsForm"></textarea>
                </div>
                <input type="date" value="{{now()->format('Y-m-d')}}" name="date" hidden>
                <button class="btn btn-primary mt-2">Dodaj</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
    <script type="text/javascript">
        function confirmation(e){
            e.preventDefault();

            var url = e.currentTarget.getAttribute('href');

            Swal.fire({
                title: "Czy na pewno chcesz usunąć ogłoszenie?",
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