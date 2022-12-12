@extends('layouts.app')

@section('title', 'Moje ogłoszenia')

@section('content')
    
    <div class="">
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Moje ogłoszenia</h2>
          </div>
        </div>
        <div class="d-flex flex-row">
            @if($anns->isEmpty())
                <form action="{{route('crann')}}">
                    <button type="submit" class="btn btn-success">Dodaj ogłoszenie</button>
                </form>
            @else
                @foreach($anns as $ann)
                    @php
                        $image = DB::table('announcements')->where('id', $ann->id)->first();
                        $images = explode('|', $image->image);
                    @endphp

                    <a href="{{route('selAnn', ['id' => $ann->id])}}">
                        <img src="{{URL::to($images[0])}}" alt="" class="rounded" style="width: 300px; height: 200px;">
                    </a>
                @endforeach
                <table class="table" style="margin-left: 50px">
                    <thead>
                    <tr>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($anns as $ann)
                    <tr>
                        <td>{{$ann->name}}</td>
                        <td>{{$ann->price}} zł</td>
                        <td>
                            <a href="{{route('editAnn', $ann->id)}}" class="btn btn-warning">Edytuj</a>
                            <a href="{{route('delAnn', $ann->id)}}" class="btn btn-danger">Usuń</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection