@extends('layouts.app')

@section('title', 'Moje ogłoszenia')

@section('content')
  
    <div class="">
        <div class="row">
          <div class="col-12 mt-5 mb-2">
            <h2>Ogłoszenia użytkowników</h2>
          </div>
        </div>
        <div class="d-flex">
            @if($anns->isEmpty())
                <p>Brak ogłoszeń</p>
            @else
                <div class="d-flex flex-column mt-3">
                    @foreach($anns as $ann)
                        @php
                            $image = DB::table('announcements')->where('id', $ann->id)->first();
                            $images = explode('|', $image->image);
                        @endphp

                        <a href="{{route('selAnn', ['id' => $ann->id])}}">
                            <img src="{{URL::to($images[0])}}" alt="" class="p-1 rounded" style="width: 200px; height: 125px;">
                        </a>
                    @endforeach
                </div>
                <table class="table" style="margin-left: 50px">
                    <thead>
                    <tr>
                        <th scope="col">Id ogłoszenia</th>
                        <th scope="col">Id użytkownika</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($anns as $ann)
                    <tr>
                        <td>{{$ann->id}}</td>
                        <td>{{$ann->userID}}</td>
                        <td>{{$ann->name}}</td>
                        <td>
                            {{-- <a href="{{route('editUser', $ann->id)}}">
                              <button type="button" class="edit btn btn-warning">Edytuj</button>
                            </a> --}}
                            <button type="button" class="delete btn btn-danger" data-id="{{$ann->id}}">Usuń</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection

@section('script')
  <script type="text/javascript">
    $(function() {
      $('.delete').click(function() {
        $.ajax({
          method: "DELETE",
          url: "{{route('announcements')}}/" + $(this).data('id'),
          data: {_token: '{{csrf_token()}}'}
        })
        .done(function(response) {
          window.location.reload();
        })
        .fail(function(response) {
          alert("ERROR");
        })
      });
    });
  </script>
@endsection