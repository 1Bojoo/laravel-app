@extends('layouts.main')

@section('content')

  <div class="main">
    <div class="vh-100" style="background-image: url('/img/roomBg.png'); background-size: cover;">
      <div class="container text-white">
        <div class="row row-cols-3 vh-100 align-items-center">
          <div class="col-6 animate__animated animate__backInLeft animate__delay-1s text-start" style="font-family: 'Edu NSW ACT Foundation', cursive;">
            <p class="fs-1">
              <a href="" class="linkTrans text-decoration-none text-white">
                Jakies tam pokoje
              </a>
            </p>
          </div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-6 animate__animated animate__pulse animate__infinite animate__slow text-center">
            <h1 style="font-size: 80px;">
              <b>AKADEMIK</b>
            </h1><br>
            <p style="margin-top: -38px; font-size: 25px;">nr 1 "Testowy"</p><br>
            <a href="" class="scrollDown text-decoration-none text-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16" style="margin-top: -55px">
                <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
              </svg>
            </a>
          </div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-6 animate__animated animate__backInRight animate__delay-2s text-end" style="font-family: 'Edu NSW ACT Foundation', cursive;">
            <p class="fs-1">
              <a href="{{route('dorm')}}" class="linkTrans text-decoration-none text-white">
                Zarezerwuj miejsce dla siebie
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="text-center text-white h-50" style="background-color: #202020 !important;">
    <div class="container p-4 pb-0">
      <section>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10081.538851810197!2d19.1096335!3d50.8240376!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4710b680726ea9c5%3A0x7597e2e83862fcfb!2sDom%20Studencki%20nr%207%20%22Herkules%22!5e0!3m2!1spl!2spl!4v1678965721896!5m2!1spl!2spl" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <a class="btn btn-outline-light btn-floating m-1 rounded-5" href="#!" role="button"><i class="bi bi-facebook"></i></a>
        <a class="btn btn-outline-light btn-floating m-1 rounded-5" href="#!" role="button"><i class="bi bi-twitter"></i></a>
        <a class="btn btn-outline-light btn-floating m-1 rounded-5" href="#!" role="button"><i class="bi bi-instagram"></i></a>
      </section>
    </div>
    <div class="text-center p-3" style="background-color: #181818;">
      © 2023 Copyright:
      <a class="text-white" href="{{route('main')}}" style="text-decoration: none; font-weight: bold;">Akademik</a>
    </div>
  </footer>    
  <!-- FOOTER END-->  

@endsection