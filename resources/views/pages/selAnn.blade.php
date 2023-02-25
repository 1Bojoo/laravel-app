@extends('layouts.app')

@section('title', $anns->id)

@section('content')

    @php
        $image = DB::table('announcements')->where('id', $anns->id)->first();
        $images = explode('|', $image->image);
        $countImg = count($images);
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

            {{-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded">
                  <div class="carousel-item active">
                    <img src="{{URL::to($images[0])}}" id="id_0" class="d-block w-100" alt="cos tam">
                  </div>
                  @foreach(array_slice($images, 1) as $img)
                    <div class="carousel-item">
                        <img src="{{URL::to($img)}}" id="id_{{$loop->index+1}}" class="d-block w-100" alt="...">
                    </div>
                  @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div> --}}

            <h3 >{{$anns->desc}}</h3>
        </div>
        <div class="reservation w-25 rounded ml-2 d-flex flex-column text-center" style="background-color: white; box-shadow: 0px 0px 10px -8px rgba(66, 68, 90, 1);">
            <h4 class="p-3">Cena: {{$anns->price}} zł / doba</h4>
            @guest
                <p>Rejestracja dostępna po zalogowaniu</p>
            @else
                <div class="d-flex flex-column text-center items-align-center justify-content-center">
                    <button class="btn btn-primary w-70" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Zarezerwuj</button>
                    <h4 class="mt-4">Sprawdź dostępność pokoi:</h4>
                    <button class="btn btn-primary w-70 m-0 d-block mt-4" data-bs-toggle="modal" data-bs-target="#staticBackdropRoomAv">Pokoje</button>
                </div>
            @endguest
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
                        <option value="acadYear">Rok akademicki</option>
                        <option value="acadSem">Semestr akademicki</option>
                        <option value="selBooking">Wybrany okres</option>
                    </select>

                    <select id="selAcadYear" class="form-select form-select-md mb-3 mx-auto w-50">
                        <option value="cYear">Wybierz rok akademicki</option>
                        <option value="acadYear">2023/2024</option>
                    </select>

                    <select id="selAcadSem" class="form-select form-select-md mb-3 mx-auto w-50" hidden>
                        <option value="cSem">Wybierz semestr</option>
                        <option value="firstSem">2022/2023 (październik/luty)</option>
                        <option value="secondSem">2022/2023 (luty/czerwiec)</option>
                    </select>
                </div>

                <form action="/pages/selAnn/{{$anns->id}}" method="post" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
                    @csrf

                    <div class="w-50">
                        <div class="resForm" hidden>
                            <div class="form-group date mb-2 d-flex flex-row">
                                <input type="hidden" name="annId" value={{$anns->id}}>
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

                    <button class="btn btn-primary w-50 resButton" hidden>Zarezerwuj</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cofnij</button>
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

                            <a href="{{route('delImg', ['annID'=>$anns->id, 'imageID'=>$loop->index])}}" class="deleteImg position-absolute top-0 start-100 translate-middle" data-annid="{{$anns->id}}" data-imageid="{{$loop->index}}">X</a>

                            @endcan

                            {{-- <button type="button" class="deleteImg position-absolute top-0 start-100 translate-middle" data-annid="{{$anns->id}}" data-imageid="{{$loop->index}}">X</button> --}}
                        </div>
                    @endforeach

                        <div class="w-50">
                            <button class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#staticBackdropAddImage">Dodaj zdjęcia</button>
                        </div>

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
                <form action="{{route('addImage', $anns->id)}}" enctype="multipart/form-data" method="POST">
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

@endsection
@section('script')

    <script type="text/javascript">

        var dates = @json($dates);

        var currDate = new Date();
        mm = currDate.getMonth()+1;

        var selRes = $('#selRes option:selected').val();

        if(selRes == "cDate"){
                $('#selAcadYear').attr('hidden', true);
                $('#selAcadSem').attr('hidden', true);
                $('.resForm').attr('hidden', true);
                $('.resButton').attr('hidden', true);
            }

        console.log(selRes);
        var selAcadSem = $('#selAcadSem option:selected').val();
        console.log(selAcadSem);

        $.ajaxSetup({

        headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });

        $("#selRes").change(function(){
            selRes = $('#selRes option:selected').val();
            console.log(selRes);
            if(selRes == "cDate"){
                $('#selAcadYear').attr('hidden', true);
                $('#selAcadSem').attr('hidden', true);
                $('.resForm').attr('hidden', true);
                $('.resButton').attr('hidden', true);
                $('#selAcadSem').val("cSem");
                $('#selAcadYear').val("cYear");
            }
            else if(selRes == "acadYear"){
                $('#selAcadSem').attr('hidden', true);
                $('.resForm').attr('hidden', true);
                $('#selAcadYear').removeAttr('hidden');
                $('.resButton').removeAttr('hidden');
                $('#selAcadYear').val("cYear");
                if(mm < 10 && mm > 6){
                    $('#startDate').val("2023-10-01");
                    $('#endDate').val("2024-06-30");
                }
                else{
                    mm = mm = currDate.getMonth()+2;
                    var Date = currDate.getFullYear() + "-" + mm + "-01"; 
                    $('#startDate').val(Date);
                    $('#endDate').val("2024-06-30");
                }
            }
            else if(selRes == "acadSem"){
                $('#selAcadYear').attr('hidden', true);
                $('.resForm').attr('hidden', true);
                $('#selAcadSem').removeAttr('hidden');
                $('.resButton').removeAttr('hidden');
                if(mm < 2){
                        $('#selAcadSem option[value="firstSem"]').attr('hidden', true);
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
                    }
                    else{
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
                    }
                    var Date = currDate.getFullYear() + "-" + mm + "-01";
                    $('#startDate').val(Date);
                    $('#endDate').val(endDate);

                })

            }
            else if(selRes == "selBooking"){
                $('#startDate').val("");
                $('#endDate').val("");
                $('#selAcadSem').attr('hidden', true);
                $('#selAcadYear').attr('hidden', true);
                $('#selAcadSem').val("cSem");
                $('.resForm').removeAttr('hidden');
                $('#selAcadYear').val("cYear");
            }
        })

        $('#startDate').datepicker({
            format: 'yyyy/mm/dd',
            startDate: new Date(),
            autoclose: true,
            clearBtn: true,
            todayBtn: true,
            datesDisabled: dates
        });

        $('#endDate').datepicker({
            format: 'yyyy/mm/dd',
            startDate: new Date(),
            autoclose: true,
            clearBtn: true,
            todayBtn: true,
            datesDisabled: dates
        });

    </script>

@endsection