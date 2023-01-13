@extends('layouts.start')

@section('content')

  <div class="main">
    <div class="searchBooking d-flex align-items-center justify-content-center p-3">
      <div class="input-group">
        <input type="text" placeholder="Miasto">
      </div>
      <div class="pp">
        <select>
          <option value="0">Obiekt zakwaterowania</option>
          <option value="dormitory">Akademik</option>
          <option value="apartment">Mieszkanie</option>
        </select>
      </div>
    </div>
  </div>

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