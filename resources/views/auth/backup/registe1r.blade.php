@extends('layouts.reg')

@section('content')
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <div class="mb-md-3 mt-md-4 pb-4 text-center">

                <img id="boyImg" src="img/boy.png" class="mb-3" width="75" height="75">
      
                <h5 class="fw-bold mb-2 text-uppercase text-center">Rejestracja</h5>
                <p class="text-dark-50 mb-4 text-center">Proszę podać login, email oraz hasło.</p>
                <form method="POST" action="{{ route('register') }}">
                  @csrf

                  <div class="form-outline form-white input-group mb-2">
                    <span class="input-group-text" id="basic-addon1">Nickname </span>
                    <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-outline form-white input-group mb-2">
                    <span class="input-group-text" id="basic-addon1">Firstname </span>
                    <input id="firstname" type="text" class="form-control form-control-lg @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                    @error('firstname')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-outline form-white input-group mb-2">
                    <span class="input-group-text" id="basic-addon1">Lastname </span>
                    <input id="lastname" type="text" class="form-control form-control-lg @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                    @error('lastname')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-outline form-white input-group mb-2">
                    <span class="input-group-text" id="basic-addon1">Phone number </span>
                    <input id="phone" type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                    @error('phone')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-outline form-white input-group mb-2">
                    <span class="input-group-text" id="basic-addon1">Email </span>
                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-outline form-white input-group mb-2">
                    <span class="input-group-text" id="basic-addon1">Hasło</span>
                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-outline form-white input-group mb-2">
                    <span class="input-group-text" id="basic-addon1">Powtórz hasło</span>
                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                  </div>

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required/>
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!" style="color: hsl(106, 34%, 52%) !important; text-decoration: none">Terms of service</a>
                    </label>
                  </div>
                  <button class="btn btn-outline-warning btn-md px-5 mt-3" type="submit">Zarejestruj</button>
                  <br />
                  <button class="btn btn-outline-secondary btn-md px-5 mt-2" type="submit" onclick="location.href='{{ route('main') }}'">Anuluj</button>
                  </form>             
              </div>
            </div>
  
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
