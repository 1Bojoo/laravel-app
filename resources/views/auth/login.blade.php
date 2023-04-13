@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Logowanie') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Zapamiętaj mnie') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                    <button class="qrLogin btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Kod QR</button>
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zaloguj się') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link " href="{{ route('password.request') }}">
                                        {{ __('Zapomniałeś hasła?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0 mt-3">
                            <div class="col-md-8 offset-md-4">
                                Nie masz konta?
                                <a href="{{ route('register') }}">
                                    {{ __('Zarejestruj się') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <input type="hidden" id="result" name="result">
            <div id="reader" width="600px"></div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            $('#result').val(decodedText);
            let id = decodedText;              
            html5QrcodeScanner.clear().then(_ => {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('validateQR') }}",
                    type: 'POST',            
                    data: {
                        _methode : "POST",
                        _token: CSRF_TOKEN, 
                        qr_code : id
                    },
                    success: function(response) {
                        console.log(response);
                        if(response == 'fail'){
                            Swal.fire({
                                title: "Nieprawidłowy kod QR",
                                icon: "error",
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if(result.value){
                                    window.location.href = "/login";
                                }
                            })
                        }else{
                            Swal.fire({
                                title: "Kod QR zweryfikowany pomyślnie",
                                icon: "success",
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if(result.value){
                                    window.location.href = "/";
                                }
                            })
                        }
                    },
                    error: function(ee){
                        window.location.href = "/login";
                        alert('Coś poszło nie tak');
                    }           
                });   
            }).catch(error => {
                alert('Błąd');
            });
        }

        function onScanFailure(error) {}

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} }, false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
