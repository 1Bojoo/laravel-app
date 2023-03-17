@extends('layouts.app')

@section('title', $dorm->id)

@section('content')

    @php
        $image = DB::table('dormitory')->where('id', 1)->first();
        $images = explode('|', $image->image);
        $countImg = count($images);
    @endphp

    <div class="ann-container p-3 d-flex justify-content-between" style="background-color: #F2F2F2">
        <div class="content w-74 p-5 rounded" style="background-color: white; box-shadow: 0px 0px 10px -8px rgba(66, 68, 90, 1);">
            <h1>{{$dorm->name}}</h1>
            <h5> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg> 
                {{$dorm->postalCode}} {{$dorm->city}}, ul. {{$dorm->street}} {{$dorm->hNum}}
            </h5>
            <div class="ann-stats d-flex flex-row">
                @if ($dorm->rating >= 1)
                    <p>{{$dorm->rating}}</p>
                @endif
            </div>
            <div class="ann-gallery rounded d-flex flex-wrap mt-3">

                @if($countImg < 4)

                    @foreach(array_slice($images, 0, $countImg-1) as $img)
                    <img src="{{URL::to($img)}}"
                    class="w-50 p-1 rounded" 
                    alt="Zdjecie">
                    @endforeach

                    <button type="button" class="btn w-50 border border-0 p-0 position-relative" data-bs-toggle="modal" data-bs-target="#staticBackdropGallery">

                        <img src="{{URL::to($images[$countImg-1])}}"
                        class="w-100 p-1 rounded" 
                        alt="Zdjecie">

                        <p class="position-absolute top-50 start-50 translate-middle fs-3 text-white">Galeria zdjęć</p>

                    </button>

                @else

                    @foreach(array_slice($images, 0, 3) as $img)
                    <img src="{{URL::to($img)}}"
                    class="w-50 p-1 rounded" 
                    alt="Zdjecie">
                    @endforeach

                    <button type="button" class="btn w-50 border border-0 p-0 position-relative" data-bs-toggle="modal" data-bs-target="#staticBackdropGallery">

                        <img src="{{URL::to($images[3])}}"
                        class="w-100 p-1 rounded" 
                        alt="Zdjecie">

                        <p class="position-absolute top-50 start-50 translate-middle fs-3 text-white">Galeria zdjęć</p>

                    </button>

                @endif

            </div>
            <p class="fs-5 mt-3 p-1">{{$dorm->desc}}</p>
        </div>
        <div class="reservation w-25 rounded ml-2 d-flex flex-column text-center" style="background-color: white; box-shadow: 0px 0px 10px -8px rgba(66, 68, 90, 1);">
            <h4 class="p-3">Cennik: </h4>
            <span class="fs-5">Student - 390 zł / miesiąc</span>
            <span class="fs-5">Gość - 40 zł / doba</span>
            @guest
                <p class="mt-2">Rejestracja dostępna po zalogowaniu</p>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center pt-4">
                    <button class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Zarezerwuj</button>
                    {{-- <h4 class="mt-5">Sprawdź dostępność pokoi:</h4>
                    <button class="btn btn-primary w-50 m-0 d-block mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdropRoomAv">Pokoje</button> --}}
                </div>
            @endguest
        </div>
    </div>

    <div class="modal fade" id="staticBackdropRoomAv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Dostępność pokoi</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Rezerwacja</h1>
            </div>
            <div class="modal-body">
                <div>
                    <select id="selRes" class="form-select form-select-md mb-3 mx-auto w-50" aria-label=".form-select-lg example">
                        <option value="cDate">Wybierz okres rezerwacji</option>
                        @canany(['isAdmin', 'isStudent'])
                            <option value="acadYear">Rok akademicki</option>
                            <option value="acadSem">Semestr akademicki</option>
                        @endcanany
                        @can('isGuest')
                            <option value="selBooking">Wybrany okres</option>
                        @endcan
                    </select>

                    <select id="selAcadYear" class="form-select form-select-md mb-3 mx-auto w-50" hidden>
                        <option value="cYear">Wybierz rok akademicki</option>
                        <option value="acadYear">2022/2023</option>
                    </select>

                    <select id="selRoomAcadYear" class="form-select form-select-md mb-3 mx-auto w-50" aria-label=".form-select-ld example" hidden>
                        <option value="cRoom">Wybierz pokój</option>
                        @foreach ($allRooms as $item)

                            @if($item->floor > 0)

                                @if ($item->reservation->isEmpty())
                                    <option value="{{$item->id}}">{{$item->roomNum}}</option>
                                @elseif((\Carbon\Carbon::parse($item->reservation->first()->arrDate) < \Carbon\Carbon::parse("2022-10-01")) && (\Carbon\Carbon::parse($item->reservation->first()->depDate) > \Carbon\Carbon::parse("2023-06-30")))
                                    <option value="{{$item->id}}">{{$item->roomNum}}</option>
                                @endif

                            @endif

                        @endforeach
                    </select>

                    <select id="selAcadSem" class="form-select form-select-md mb-3 mx-auto w-50" hidden>
                        <option value="cSem">Wybierz semestr</option>
                        <option value="firstSem">2022/2023 (październik/luty)</option>
                        <option value="secondSem">2022/2023 (luty/czerwiec)</option>
                    </select>

                    <select id="selRoomFirstSem" class="form-select form-select-md mb-3 mx-auto w-50" aria-label=".form-select-ld example" hidden>
                        <option value="cRoom">Wybierz pokój</option>
                        @foreach ($allRooms as $item)

                            @if($item->floor > 0)
                                @if ($item->reservation->isEmpty())
                                    <option value="{{$item->id}}">{{$item->roomNum}}</option>
                                @elseif((\Carbon\Carbon::parse($item->reservation->first()->arrDate) < \Carbon\Carbon::parse("2022-10-01")) && (\Carbon\Carbon::parse($item->reservation->first()->depDate) > \Carbon\Carbon::parse("2022-02-28")))
                                    <option value="{{$item->id}}">{{$item->roomNum}}</option>
                                @endif
                            @endif

                        @endforeach
                    </select>

                    <select id="selRoomSecondSem" class="form-select form-select-md mb-3 mx-auto w-50" aria-label=".form-select-ld example" hidden>
                        <option value="cRoom">Wybierz pokój</option>
                        @foreach ($allRooms as $item)

                            @if($item->floor > 0)
                                @if ($item->reservation->isEmpty())
                                    <option value="{{$item->id}}">{{$item->roomNum}}</option>
                                @elseif((\Carbon\Carbon::parse($item->reservation->first()->arrDate) < \Carbon\Carbon::parse("2023-03-01")) && (\Carbon\Carbon::parse($item->reservation->first()->depDate) > \Carbon\Carbon::parse("2023-06-30")))
                                    <option value="{{$item->id}}">{{$item->roomNum}}</option>
                                @endif
                            @endif

                        @endforeach
                    </select>

                    <select id="selRoomGuest" class="form-select form-select-md mb-3 mx-auto w-50" aria-label=".form-select-ld example" hidden>
                        <option value="cRoom">Wybierz pokój</option>
                        @foreach ($allRooms as $item)

                            @if($item->floor == 0)
                                <option value="{{$item->id}}">{{$item->roomNum}}</option>
                            @endif

                        @endforeach
                    </select>
                </div>

                <form action="{{route("guestRes", $dorm->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="guestRoomId" id="guest_room_id" value="">

                    <div class="d-flex flex-column align-items-center">
                        <div class="w-50 ">
                            <div class="resForm" hidden>
                                {{-- <div class="input-group input-daterange">
                                    <input type="text" placeholder="Od" name="date_start" id="startDate" class="form-control">
                                    <div class="input-group-addon">to</div>
                                    <input type="text" placeholder="Do" name="date_end" id="endDate" class="form-control">
                                </div> --}}
                                <div class="form-group date mb-2 d-flex flex-row">
                                    <input type="text" placeholder="Od" name="date_start" id="startDate" class="form-control">
                                    <div class="input-group text-center align-items-center fs-4 ms-2" style="width: 10%">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                                <div class="from-group date d-flex flex-row">
                                    <input type="text" placeholder="Do" name="date_end" id="endDate" class="form-control">
                                    <div class="input-group text-center align-items-center fs-4 ms-2" style="width: 10%">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary w-25 guestRoomRes" hidden>
                            Zarezerwuj
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary resButton" data-bs-toggle="modal" data-bs-target="#staticBackdropSendForm" hidden>Dalej</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cofnij</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="staticBackdropSendForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Uzupełnij swoje dane</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route("res", $dorm->id) }}">
                    @csrf

                    <input type="hidden" name="dormId" value={{$dorm->id}}>
                    <input type="hidden" name="roomId" id="room_id" value="">
                    <input type="hidden" placeholder="Od" name="date_start_form" id="startDateForm" class="form-control">
                    <input type="hidden" placeholder="Do" name="date_end_form" id="endDateForm" class="form-control">
  
                    <div class="form-outline form-white input-group mb-2">
                      <span class="input-group-text" id="basic-addon1">Imię: </span>
                      <input id="firstname" type="text" class="form-control form-control-lg @error('firstname') is-invalid @enderror" name="firstname" value="{{ Auth::user()->firstname ?? '' }}" required autocomplete="firstname" autofocus>
  
                      @error('firstname')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
  
                    <div class="form-outline form-white input-group mb-2">
                      <span class="input-group-text" id="basic-addon1">Nazwisko: </span>
                      <input id="lastname" type="text" class="form-control form-control-lg @error('lastname') is-invalid @enderror" name="lastname" value="{{ Auth::user()->lastname ?? ''}}" required autocomplete="lastname" autofocus>
  
                      @error('lastname')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
  
                    <div class="form-outline form-white input-group mb-2">
                      <span class="input-group-text" id="basic-addon1">Email: </span>
                      <input id="email" type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email ?? ''}}" required autocomplete="email" autofocus>
  
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="form-outline form-white input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">Numer telefonu: </span>
                        <input id="phone" type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::user()->phone ?? ''}}" required autocomplete="phone" autofocus>
    
                        @error('phone')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>

                    <div class="form-outline form-white input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">Kod pocztowy: </span>
                        <input id="postalCode" type="text" class="form-control form-control-lg @error('postalCode') is-invalid @enderror" name="postalCode" value="{{ old('postalCode') }}" required autocomplete="postalCode" autofocus>
    
                        @error('postalCode')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline form-white input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">Miasto: </span>
                        <input id="city" type="text" class="form-control form-control-lg @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
    
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline form-white input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">Ulica: </span>
                        <input id="street" type="text" class="form-control form-control-lg @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="street" autofocus>
    
                        @error('street')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline form-white input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">Numer domu / mieszkania: </span>
                        <input id="hNum" type="text" class="form-control form-control-lg @error('hNum') is-invalid @enderror" name="hNum" value="{{ old('hNum') }}" required autocomplete="hNum" autofocus>
    
                        @error('hNum')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
  
                    <button class="btn btn-primary">Zarezerwuj</button>
                    </form>      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

      <div class="modal fade" id="staticBackdropGallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Galeria</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="d-flex flex-wrap">
                    @foreach ($images as $img)
                        <div class="position-relative w-50">
                            <img src="{{URL::to($img)}}"
                            id="id_{{$loop->index}}"
                            class="w-100 p-1 rounded" 
                            alt="Zdjecie">

                            @can('isAdmin')

                                <a href="{{route('delImg', $loop->index)}}" class="deleteImg btn btn-secondary text-decoration-none text-white bg-dark position-absolute" style="top: 5%; right: 3%" data-annid="{{$dorm->id}}" data-imageid="{{$loop->index}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                      </svg>
                                </a>

                            @endcan

                            {{-- <button type="button" class="deleteImg position-absolute top-0 start-100 translate-middle" data-annid="{{$dorm->id}}" data-imageid="{{$loop->index}}">X</button> --}}
                        </div>
                    @endforeach
                </div>

                <div class="w-100 mt-3 text-center">
                    @can('isAdmin')
                        <button class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#staticBackdropAddImage">Dodaj zdjęcia</button>
                    @endcan
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="staticBackdropAddImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Dodaj zdjęcia</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('addImage')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Prześlij zdjęcia</label>
                        <div class="files">
                            <input type="file" name="image[]" class="form-control" multiple>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-2">Dodaj</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('script')

    <script type="text/javascript">

        var dates = @json($dates); 

        var array = [];

        var currDate = new Date();
        mm = currDate.getMonth()+1;

        var selRes = $('#selRes option:selected').val();

        if(selRes == "cDate"){
                $('#selAcadYear').attr('hidden', true);
                $('#selAcadSem').attr('hidden', true);
                $('#selRoomAcadYear').attr('hidden', true);
                $('.resForm').attr('hidden', true);
                $('.resButton').attr('hidden', true);
            }

        $.ajaxSetup({

        headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });

        $("#selRes").change(function(){
            selRes = $('#selRes option:selected').val();
            console.log(selRes);
            selAcadYear = $('#selAcadYear option:selected').val();
            console.log(selAcadYear);

            if(selRes == "cDate"){
                $('#selAcadYear').attr('hidden', true);
                $('#selAcadSem').attr('hidden', true);
                $('#selRoomAcadYear').attr('hidden', true);
                $('#selRoomGuest').attr('hidden', true);
                $('#selRoomFirstSem').attr('hidden', true);
                $('#selRoomSecondSem').attr('hidden', true);
                $('.resForm').attr('hidden', true);
                $('.resButton').attr('hidden', true);
                $('#selAcadSem').val("cSem");
                $('#selAcadYear').val("cYear");
                $('#selRoomAcadYear').val("cRoom");
            }
            else if(selRes == "acadYear"){
                $('#selAcadSem').attr('hidden', true);
                $('#selRoomAcadYear').attr('hidden', true);
                $('#selAcadYear').removeAttr('hidden');
                $('#selRoomGuest').attr('hidden', true);
                $('#selRoomFirstSem').attr('hidden', true);
                $('#selRoomSecondSem').attr('hidden', true);

                $("#selAcadYear").change(function(){

                    selAcadYear = $('#selAcadYear option:selected').val();
                    console.log(selAcadYear);

                    if(selAcadYear != "cYear"){
                            if(mm < 10 && mm > 6){
                                $('#startDate').val("2022-10-01");
                                $('#startDateForm').val("2022-10-01");
                                $('#endDate').val("2023-06-30");
                                $('#endDateForm').val("2023-06-30");
                            }
                            else{
                                mm = mm = currDate.getMonth()+2;
                                var Date = currDate.getFullYear() + "-" + mm + "-01";
                                $('#startDate').val(Date);
                                $('#startDateForm').val(Date);
                                $('#endDate').val("2023-06-30");
                                $('#endDateForm').val("2023-06-30");
                            }

                            $('#selRoomAcadYear').removeAttr('hidden');
                                $("#selRoomAcadYear").change(function(){
                                    selRoom = $('#selRoomAcadYear option:selected').val();
                                    console.log(selRoom);

                                    if(selRoom != "cRoom"){
                                        $('#room_id').val(selRoom);
                                        console.log($('#room_id').val());
                                        $('.resButton').removeAttr('hidden');
                                    }
                                    else{
                                        $('.resButton').attr('hidden', true);
                                        $('#room_id').val("cRoom");
                                    }
                            });
                    }
                    else{
                        $('.resButton').attr('hidden', true);
                        $('#selRoomAcadYear').attr('hidden', true);
                        $('#room_id').val("cRoom");
                    }

                });
                
            }else if(selRes == "acadSem"){
                $('#selAcadYear').attr('hidden', true);
                $('.resForm').attr('hidden', true);
                $('#selRoomAcadYear').attr('hidden', true);
                $('#selAcadSem').removeAttr('hidden');
                $('#selRoomGuest').attr('hidden', true);
                $('#selAcadSem option:selected').val("cSem");

                if(mm > 2 && mm < 10){
                    $('#selAcadSem option[value="firstSem"]').attr('hidden', true);
                }else{
                    $('#selAcadSem option[value="secondSem"]').attr('hidden', true);
                }

                $("#selAcadSem").change(function(){
                    selAcadSem = $('#selAcadSem option:selected').val();
                    if(selAcadSem == "firstSem"){
                        if(mm >= 10 || mm <= 2){
                            mm = currDate.getMonth()+2;
                        }
                        else{
                            mm = "10";
                        }
                        endDate = "2023-02-28";
                        $('#selRoomFirstSem').removeAttr('hidden');
                        $("#selRoomFirstSem").change(function(){
                            selRoom = $('#selRoomFirstSem option:selected').val();

                            if(selRoom != "cRoom"){
                                $('#room_id').val(selRoom);
                                $('.resButton').removeAttr('hidden');
                            }
                            else{
                                $('.resButton').attr('hidden', true);
                                $('#room_id').val("cRoom");
                            }
                        });
                    }
                    else if(selAcadSem == "secondSem"){
                        if(mm <= 2 && mm >= 6){
                            mm = "02";
                        }
                        else{
                            mm = currDate.getMonth()+2
                            if(mm < 10){
                                mm = "0"+mm;
                            }
                        }
                        endDate = "2023-06-30"
                        $('#selRoomSecondSem').removeAttr('hidden');
                        $("#selRoomSecondSem").change(function(){
                            selRoom = $('#selRoomSecondSem option:selected').val();

                            if(selRoom != "cRoom"){
                                $('#room_id').val(selRoom);
                                $('.resButton').removeAttr('hidden');
                            }
                            else{
                                $('.resButton').attr('hidden', true);
                                $('#room_id').val("cRoom");
                            }
                        });
                    }
                    else{
                        $('#selRoomFirstSem').attr('hidden', true);
                        $('#selRoomSecondSem').attr('hidden', true);
                        $('#room_id').val("cRoom");
                        $('#selAcadSem').val("cSem");
                        $('.resButton').attr('hidden', true);
                    }
                    var Date = currDate.getFullYear() + "-" + mm + "-01";
                    $('#startDate').val(Date);
                    $('#startDateForm').val(Date);
                    $('#endDate').val(endDate);
                    $('#endDateForm').val(endDate);

                })
            }else if(selRes == "selBooking"){
                $('#startDate').val("");
                $('#startDateForm').val("");
                $('#endDate').val("");
                $('#endDateForm').val("");
                $('#selAcadSem').attr('hidden', true);
                $('#selAcadYear').attr('hidden', true);
                $('#selAcadSem').val("cSem");
                $('#selAcadYear').val("cYear");

                $('#selRoomGuest').removeAttr('hidden');
                    $("#selRoomGuest").change(function(){
                        selRoom = $('#selRoomGuest option:selected').val();

                        if(selRoom != "cRoom"){
                            $('#guest_room_id').val(selRoom);

                            console.log($('#guest_room_id').val());

                            array = dates[selRoom];

                            console.log(array);

                            $('.resForm').removeAttr('hidden');

                            $('.guestRoomRes').removeAttr('hidden');
                        }
                        else{
                            $('.resForm').attr('hidden', true);
                            $('.guestRoomRes').attr('hidden', true);
                        }
                });
            }
        })

        $('#startDate').datepicker({
            format: 'yyyy-mm-dd',
            startDate: new Date(),
            autoclose: true,
            clearBtn: true,
            todayBtn: true,
            updateViewDate: false,
            }).on('show', function(e){
                    $('#startDate').datepicker('setDatesDisabled',array);
            });

        $('#endDate').datepicker({
            format: 'yyyy-mm-dd',
            startDate: new Date(),
            autoclose: true,
            clearBtn: true,
            todayBtn: true,
            }).on('show', function(e){
                $('#endDate').datepicker('setDatesDisabled',array);
            });

    </script>

@endsection