@extends('layouts.app')

@section('title', $anns->id)

@section('content')

    @php
        $image = DB::table('announcements')->where('id', $anns->id)->first();
        $images = explode('|', $image->image);
    @endphp

    <div class="ann-container p-3 d-flex justify-content-between" style="background-color: #F2F2F2">
        <div class="content w-74 p-5 rounded" style="background-color: white; box-shadow: 0px 0px 10px -8px rgba(66, 68, 90, 1);">
            <h1>{{$anns->name}}</h1>
            <h5>{{$anns->city}}, {{$anns->province}}, {{$anns->country}}</h5>
            <div class="ann-stats d-flex flex-row">
                @if ($anns->rating >= 1)
                    <p>{{$anns->rating}}</p>
                @endif
            </div>
            <div class="ann-gallery rounded d-flex flex-wrap">
                @foreach($images as $img)
                    <img src="{{URL::to($img)}}" class="w-50 p-1" alt="Zdjecie">
                @endforeach
            </div>
            <h3 >{{$anns->desc}}</h3>
        </div>
        <div class="reservation w-25 rounded ml-2 d-flex flex-column text-center" style="background-color: white; box-shadow: 0px 0px 10px -8px rgba(66, 68, 90, 1);">
            <h4 class="p-3">Cena: {{$anns->price}} zł / doba</h4>
            @guest
                <p>Rejestracja dostępna po zalogowaniu</p>
            @else
                <form action="/pages/selAnn" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group w-70 mb-2">
                        <input type="datetime-local" name="date-start" class="form-control">
                    </div>
                    <div class="from-group w-70">
                        <input type="datetime-local" name="date_end" class="form-control">
                    </div><br>
                    <button class="btn btn-primary w-70">Zarezerwuj</button>
                </form>
            @endguest
        </div>
    </div>

@endsection