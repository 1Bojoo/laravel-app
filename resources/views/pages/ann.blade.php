@extends('layouts.app')

@section('title', 'Ogłoszenia')

@section('content')

@foreach ($anns as $item)

    @php
        $image = DB::table('announcements')->where('id', $item->id)->first();
        $images = explode('|', $image->image);
        $url = route('selAnn', ['id' => $item->id]);
    @endphp

      <a href="{{$url}}" class="text-decoration-none">

      <div class="card--container d-flex flex-column p-3" style="width: 400px;" href="">
              
          <img src="{{URL::to($images[0])}}" alt="" class="w-100 mb-2 rounded">
              
              {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="{{URL::to($images[0])}}" alt="First slide">
                    </div>
                      @foreach ($images as $img)
                          @if ($loop->iteration > 1)
                              <div class="carousel-item">
                                  <img class="d-block w-100" src="{{URL::to($img)}}" alt="Second slide">
                              </div>
                          @endif
                      @endforeach
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div> --}}     

          <div class="card--info d-flex justify-content-between">
              <h4>{{$item->city}}, {{$item->province}}, {{$item->country}}</h4>
              @if($item->rating >= 1)
                <p>{{$item->rating}}</p>
              @endif
          </div>
          <p>Cena: {{$item->price}} zł / doba</p>

      </div>

  </a>
   
@endforeach

@endsection