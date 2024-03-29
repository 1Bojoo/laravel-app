@extends('layouts.app')

@section('title', 'Kontakt')

@section('content')

    {{-- <div class="d-flex flex-row mt-3 p-3">
        <div class="w-75 d-flex flex-row">
            <div class="w-50"> 
                <p class="fs-2">Kontakt: </p>
                <p class="fs-5">
                    <span class="fs-3">Administracja: </span><br>
                    Tadeusz Kowalski - tad.kow@akademik.pl <br>
                    Ilona Warszawska - ilo.war@akademik.pl <br><br>
                    <span class="fs-3">Telefon: </span><br>
                    111 222 333<br>
                </p>
            </div>
            <div class="w-50">
                <p class="fs-2">Adres: </p>
                <p class="fs-5">
                    Akademik "Testowy" nr 1 <br>
                    42-218 Częstochowa <br>
                    ul. Sowińskiego 40/48
                </p>
            </div>
        </div>
        <div class="w-25 text-center">
            <p class="fs-2">Formularz kontaktowy</p>
            <button class="btn btn-success mt-3 w-50" data-bs-toggle="modal" data-bs-target="#conModal"> Kontakt</button>
        </div>
    </div> --}}

    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-xl-4 p-2 d-flex justify-content-center">
                <div class="card border-0" style="width: 25rem; min-height: 18rem; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                    <div class="card-body">
                      <h5 class="card-title text-center p-2 fs-2">Kontakt: </h5>
                      <p class="card-text text-center fs-5">
                        <span class="fs-3">Administracja: </span><br>
                        Tadeusz Kowalski - tad.kow@akademik.pl <br>
                        Ilona Warszawska - ilo.war@akademik.pl <br><br>
                        <span class="fs-3">Telefon: </span><br>
                        111 222 333<br>
                      </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 p-2 d-flex justify-content-center">
                <div class="card border-0" style="width: 25rem; min-height: 18rem; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                    <div class="card-body">
                      <h5 class="card-title text-center p-2 fs-2">Adres: </h5>
                      <p class="card-text text-center fs-5">
                        Akademik "Testowy" nr 1 <br>
                        42-218 Częstochowa <br>
                        ul. Sowińskiego 40/48
                      </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 p-2 d-flex justify-content-center">
                <div class="card border-0" style="width: 25rem; height: 18rem; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);">
                    <div class="card-body text-center align-items-center">
                      <h5 class="card-title text-center p-2 fs-2">Formularz kontaktowy</h5>
                      <button class="btn btn-success mt-3 w-50" data-bs-toggle="modal" data-bs-target="#conModal"> Kontakt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="conModal" tabindex="-1" aria-labelledby="conModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="conModalLabel">Kontakt</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('contactForm')}}" method="post" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
                    @csrf
                    <div class="w-70">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="name" class="">Imię</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="email" class="">Email</label>
                                    <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Błędny adres email</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
        
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="">Temat</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
        
                            <div class="col-md-12">
        
                                <div class="md-form">
                                    <label for="message">Wiadomość</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>
        
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning mt-3 w-70" id="sendMail">Wyślij</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Wiadomość została wysłana",
                icon: "success",
                confirmButtonText: 'Ok',
            })
        </script>
    @elseif (session('status'))
        <script>
            Swal.fire({
                title: "Coś poszło nie tak",
                icon: "error",
                confirmButtonText: 'Ok',
            })
        </script>
    @endif
    
@endsection