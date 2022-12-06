@extends('layouts.start')

@section('content')

<div class="p-5 text-center bg-image" style="background-image: url(img/hero-bg.png); height: 820px;">
    <div class="mask">
        <div class="d-flex justify-content-center align-items-center h-100 tekst-custom">
            <div class="text-white" id="heroText">
                <img src="img/logoJBMS.png" height="300px" width="230px" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1500" class="mb-3" >
                <h1 data-aos="zoom-in" data-aos-delay="600" data-aos-duration="1500" class="mb-3">ZAREZERWUJ</h1>
                <h4 data-aos="zoom-in" data-aos-delay="900" data-aos-duration="1500" class="mb-3">JUŻ DZIŚ</h4>
                <a href="#category" data-aos="zoom-in" data-aos-delay="1500" data-aos-duration="1500" class="btn btn-light btn-lg rounded-5  animate__animated animate__pulse animate__delay-2s animate__infinite" role="button"><i class="bi bi-caret-down-fill"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- HERO END -->

<!-- CATEGORY -->
<nav id="category" class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="">Fryzjer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Masaż</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Barber shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Boisko</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Hala sportowa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Salon kosmetyczny</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Sala gimnastyczna</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Studia tatuażu</a>
      </li>   
    </ul>
  </div>
</nav>

  <!-- CATEGORY END -->

  <!-- RECOMMENDED -->
  <div class="recommended" id="recommended">
    <h2 class="recommended-header" data-aos="zoom-in">Polecane</h2>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-4 shake-slow" data-aos="flip-left" data-aos-delay="300">
        <div class="gallery-box">
          <div class="img-mini">
            <img class="responsivemini" src="img/1.png" alt="jd">
            <p>ul. Kościuszki 1, Częstochowa</p>
          </div>
      </div>   
    </div>
    <div class="col-sm-6 col-md-6 col-lg-4 shake-slow" data-aos="flip-left" data-aos-delay="500">
      <div class="gallery-box">
        <div class="img-mini">
          <img class="responsivemini" src="img/2.png" alt="jd">
          <p>ul. Nowowiejskiego 10, Częstochowa</p>

        </div>
    </div>   
    </div>
    <div class="col-sm-6 col-md-6 col-lg-4 shake-slow" data-aos="flip-left" data-aos-delay="700">
      <div class="gallery-box">
        <div class="img-mini">
          <img class="responsivemini" src="img/3.png" alt="jd">
          <p>ul. Targowa 3/5, Częstochowa</p>
        </div>
    </div>   
    </div>
    </div>
    </div>
    <!-- RECOMMENDED END -->

    <!-- PICTURE -->
    <div class="p-5 text-center bg-image" style="background-image: url(img/boisko.png); height: 350px;">
      <div class="mask">
          <div class="d-flex justify-content-center align-items-center h-100 tekst-custom-2">
              <div class="text-white">
                  <h1 class="mb-3" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1500">Potrzebujesz boiska, aby zagrać z przyjaciółmi?</h1>
                  <hr style="width: 50%; margin: auto; margin-bottom: 20px;" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="1500">
                  <p data-aos="zoom-in" data-aos-delay="900" data-aos-duration="1500">Złóż rezerwację</p>
                  <button type="button" class="btn btn-primary rounded-4 animate__animated animate__pulse animate__delay-2s animate__infinite" style="padding: 10px 20px 10px 20px !important;"data-aos="zoom-in" data-aos-delay="1500" data-aos-duration="1500">KLIKNIJ</button>
              </div>
          </div>
      </div>
  </div>
  <!-- PICTURE END -->

  <!-- FOOTER -->
  <footer class="text-center text-white" style="background-color: #202020 !important;">
    <div class="container p-4 pb-0">
      <section class="mb-4">
        <a class="btn btn-outline-light btn-floating m-1 rounded-5" href="#!" role="button"><i class="bi bi-facebook"></i></a>
        <a class="btn btn-outline-light btn-floating m-1 rounded-5" href="#!" role="button"><i class="bi bi-twitter"></i></a>
        <a class="btn btn-outline-light btn-floating m-1 rounded-5" href="#!" role="button"><i class="bi bi-instagram"></i></a>
      </section>
    </div>
    <div class="text-center p-3" style="background-color: #181818;">
      © 2022 Copyright:
      <a class="text-white" href="https://jbms.pl/" style="text-decoration: none; font-weight: bold;">JBMS.pl</a>
    </div>
  </footer>      
  <!-- FOOTER END-->  

@endsection