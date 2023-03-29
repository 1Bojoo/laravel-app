<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts/Styles -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
    " rel="stylesheet">

    <!-- Scripts -->
    <script
        src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
        integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c="
        crossorigin="anonymous">
    </script>
    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" 
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer">
    </script>
    <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
    "></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand ps-3" href="{{ url('/') }}">
                    <strong>Akademik <i class="bi bi-node-plus-fill"></i></strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto pd-3">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dorm') }}">Zarezerwuj</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rules') }}">Regulamin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}">Aktualności</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link" href="{{ route('contact') }}">Kontakt</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item fw-bold">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item fw-bold">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right me-5" aria-labelledby="navbarDropdown">
                                    @can('isAdmin')
                                        <a class="dropdown-item" href="{{route('manStats')}}">Panel Zarządzania</a>
                                        <a class="dropdown-item" href="{{route('crann')}}">Dodaj ogłoszenie</a>
                                    @endcan
                                    <a class="dropdown-item" href="{{route('myres')}}">Moje rezerwacje</a>
                                    <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Wygeneruj kod QR</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj się') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Wygeneruj kod QR</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Podaj swoje hasło w celu wygenerowania kodu QR: </span>

                    <div class="form-outline form-white input-group mb-2">
                        <input id="pass" type="password" class="form-control form-control-md @error('password') is-invalid @enderror" name="pass" required>
                    </div>
                        
                    <button type="button" class="btn btn-primary genQR">Generuj</button><br><br>
                    <span>Po wygenerowaniu kod QR zostanie wysłany na maila</span>

                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cofnij</button>
                </div>
              </div>
            </div>
          </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <main class="container">
            @yield('content')
        </main>
    </div>
    @yield('script')
        <script type="text/javascript">          

            $('.genQR').click(function() {

                var pass = $('#pass').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{ route('generateQR') }}",
                    data: {
                        pass: pass, 
                    },
                    success: function(c){
                        if(c == 'fail'){
                            Swal.fire({
                                title: "Błędne hasło",
                                icon: "error",
                                confirmButtonText: 'Ok',
                                }).then((result) => {
                                    if(result.value){
                                        $('#exampleModal').modal('hide');
                                    }
                                })
                        }else{
                            Swal.fire({
                                title: "Kod QR został wysłany na maila",
                                icon: "success",
                                confirmButtonText: 'Ok',
                                }).then((result) => {
                                    if(result.value){
                                        $('#exampleModal').modal('hide');
                                    }
                                })
                        }
                    },
                    error: function(ee){
                        console.log("Coś poszło nie tak");
                    }
                })
            });
        </script>
</body>
</html>
