@extends('layouts.app')

@section('title', 'Moje rezerwacje')

@section('content')

  @php
    $counter = 1;
  @endphp

    <div class="">
      @if($res->isEmpty())
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Brak rezerwacji</h2>
          </div>
        </div>
      @else
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Lista rezerwacji</h2>
          </div>
        </div>
        <table class="table w-75">
            <thead>
              <tr>
                <th scope="col">Pokój</th>
                <th scope="col">Od</th>
                <th scope="col">Do</th>
                <th scope="col">Pościel</th>
                <th scope="col">Akcje</th>
              </tr>
            </thead>
            <tbody>
              @foreach($res as $item)
              <tr>
                <td>{{$item->room->roomNum}}</td>
                <td>{{$item->arrDate}}</td>
                <td>{{$item->depDate}}</td>
                <td>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropBedClothes{{$item->id}}">Zobacz</button>

                  <div class="modal fade" id="staticBackdropBedClothes{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Rezerwacja pościeli</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="col">Poduszka</th>
                                        <th class="col">Kołdra</th>
                                        <th class="col">Prześcieradło</th>
                                        <th class="col">Poszewki</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if($item->bedclothes->pillow == 0)
                                            <td>Nie</td>
                                        @else
                                            <td>Tak</td>
                                        @endif
                            
                                        @if($item->bedclothes->duvet == 0)
                                            <td>Nie</td>
                                        @else
                                            <td>Tak</td>
                                        @endif
                            
                                        @if($item->bedclothes->bedsheet == 0)
                                            <td>Nie</td>
                                        @else
                                            <td>Tak</td>
                                        @endif
                            
                                        @if($item->bedclothes->bedclothes == 0)
                                            <td>Nie</td>
                                        @else
                                            <td>Tak</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </td>
                <td><a href="{{route('delRes', $item->id)}}" class="btn btn-danger">Usuń</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
      @endif
    </div>

@endsection