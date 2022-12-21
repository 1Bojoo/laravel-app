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
                <form action="/pages/selAnn/{{$anns->id}}" method="post" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
                    @csrf
                    <div class="w-70">
                        <div class="input-group date mb-2">
                            <input type="hidden" name="annId" value={{$anns->id}}>
                            <input type="text" name="date_start" id="startDate" class="form-control">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <div class="from-group mb-2">
                            <input type="date" name="date_end" id="endDate" class="form-control">
                        </div><br>
                    </div>
                    <button class="btn btn-primary w-70">Zarezerwuj</button>
                </form>
            @endguest
        </div>
    </div>

@endsection
@section('script')

    <script type="text/javascript">

        var dates = @json($dates);

        $('#startDate').datepicker({
            format: 'yyyy/mm/dd',
            startDate: new Date(),
            autoclose: true,
            clearBtn: true,
            todayBtn: true,
            datesDisabled: dates
        });

    </script>

@endsection