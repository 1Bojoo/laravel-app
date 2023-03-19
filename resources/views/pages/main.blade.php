@extends('layouts.main')

@section('content')

  <div class="main">
    <div class="vh-100" style="background-image: url('/img/roomBg.png'); background-size: cover;">
      <div class="container text-white">
        <div class="row row-cols-3 vh-100 align-items-center">
          <div class="col-6 animate__animated animate__backInLeft animate__delay-1s text-start" style="font-family: 'Kaushan Script', cursive;">
            <p class="fs-1">
              <a href="" class="linkTrans text-decoration-none text-white">
                Miejsce na coś
              </a>
            </p>
          </div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-6 animate__animated animate__pulse animate__infinite animate__slow text-center" style="font-family: 'Roboto Slab', serif;">
            <h1 style="font-size: 80px;">
              <b>AKADEMIK</b>
            </h1><br>
            <p style="margin-top: -38px; font-size: 25px;">nr 1 "Testowy"</p><br>
            <a href="#cards" class="scrollDown text-decoration-none text-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16" style="margin-top: -55px">
                <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
              </svg>
            </a>
          </div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-6 animate__animated animate__backInRight animate__delay-2s text-end" style="font-family: 'Kaushan Script', cursive;">
            <p class="fs-1">
              <a href="{{route('dorm')}}" class="linkTrans text-decoration-none text-white">
                Zarezerwuj miejsce dla siebie
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container text-center my-3">
      <div class="row mx-auto my-auto justify-content-center">
        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-img">
                    <img src="https://via.placeholder.com/700x500.png/CB997E/333333?text=1" class="img-fluid">
                  </div>
                  <div class="card-img-overlay">Slide 1</div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-img">
                    <img src="https://via.placeholder.com/700x500.png/DDBEA9/333333?text=2" class="img-fluid">
                  </div>
                  <div class="card-img-overlay">Slide 2</div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-img">
                    <img src="https://via.placeholder.com/700x500.png/FFE8D6/333333?text=3" class="img-fluid">
                  </div>
                  <div class="card-img-overlay">Slide 3</div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-img">
                    <img src="https://via.placeholder.com/700x500.png/B7B7A4/333333?text=4" class="img-fluid">
                  </div>
                  <div class="card-img-overlay">Slide 4</div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-img">
                    <img src="https://via.placeholder.com/700x500.png/A5A58D/333333?text=5" class="img-fluid">
                  </div>
                  <div class="card-img-overlay">Slide 5</div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-img">
                    <img src="https://via.placeholder.com/700x500.png/6B705C/eeeeee?text=6" class="img-fluid">
                  </div>
                  <div class="card-img-overlay">Slide 6</div>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </a>
          <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
        </div>
      </div>		
    </div>

    <div class="vh-100 d-flex align-items-center" id="cards">
      <div class="container" style="font-family: 'Kaushan Script', cursive;">
        <div class="row align-items-center">
          <div class="col-4 d-flex justify-content-center">
              <div class="card align-items-center text-center" style="width: 19rem; border: none;">
                <div class="card-body">
                  <h2 class="card-title pt-5">REGULAMIN</h2>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="300" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                  <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                  <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                  <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                </svg>
                <a href="" class="text-decoration-none text-black stretched-link"></a>
              </div>
          </div>
          <div class="col-4 d-flex justify-content-center">
              <div class="card align-items-center text-center" style="width: 19rem; border: none;">
                <div class="card-body">
                  <h3 class="card-title pt-5">AKTUALNOŚCI</h3>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="300" fill="currentColor" class="bi bi-stickies" viewBox="0 0 16 16">
                  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z"/>
                  <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z"/>
                </svg>
                <a href="" class="text-decoration-none text-black stretched-link"></a>
              </div>
          </div>
          <div class="col-4 d-flex justify-content-center">
              <div class="card align-items-center text-center" style="width: 19rem; border: none;">
                <div class="card-body">
                  <h3 class="card-title pt-5">KONTAKT</h3>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="300" fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 16 16">
                  <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882l-6-3.2ZM15 7.383l-4.778 2.867L15 13.117V7.383Zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2Z"/>
                </svg>
                <a href="{{route('contact')}}" class="text-decoration-none text-black stretched-link"></a>
              </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="text-center text-white h-50" style="background-color: #202020 !important;">
    <div class="container p-4 pb-0">
      <h3 class="pb-3" style="font-family: 'Kaushan Script', cursive;">Znajdziesz nas tutaj</h3>
      <section class="pb-3">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10081.538851810197!2d19.1096335!3d50.8240376!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4710b680726ea9c5%3A0x7597e2e83862fcfb!2sDom%20Studencki%20nr%207%20%22Herkules%22!5e0!3m2!1spl!2spl!4v1678965721896!5m2!1spl!2spl" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </section>
    </div>
    <div class="text-center p-3" style="background-color: #181818;">
      © 2023 Copyright:
      <a class="text-white" href="{{route('main')}}" style="text-decoration: none; font-weight: bold;">Akademik</a>
    </div>
  </footer>    
  <!-- FOOTER END-->  

@endsection

@section('script')

  <script type="text/javascript">

  let items = document.querySelectorAll('.carousel .carousel-item')

  items.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i=1; i<minPerSlide; i++) {
      if (!next) {
          // wrap carousel by using first child
          next = items[0]
      }
      let cloneChild = next.cloneNode(true)
      el.appendChild(cloneChild.children[0])
      next = next.nextElementSibling
    }
  })

  </script>

@endsection