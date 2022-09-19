@extends('layouts.app')

@section('content')
    <a href="{{route('albums.create')}}"
       class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Add Album</a>


    @include('includes.alerts.success')
    @include('includes.alerts.errors')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">options</th>

        </tr>
        </thead>
        <tbody>
        @foreach($albums as $album)

        <tr>
            <!-- this alert for move album or delete -->
            <div   style="z-index:4;width: 400px;margin: auto;display:none" class="alert alert-danger quickview-modal{{$album->id}}" role="alert">
                <a href="{{route('move_album',$album->id)}}"
                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> move to other album</a>

                <form style="display: inline" method="POST" action="{{route('albums.destroy',$album->id)}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                <button type="submit"
                   class="quick-view btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 ">Delete</button>
                </form>
            </div>
            <!-- end elert -->
            <th scope="row">#</th>
            <td>{{$album->name}}</td>
                <td>
                    <div class="btn-group" role="group"
                         aria-label="Basic example">
                        <a href="{{route('albums.show',$album->id)}}"
                           class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> photos</a>
                        <a href="{{route('albums.edit',$album->id)}}"
                           class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>
                        <a album-id="{{$album->id}}"
                           class="@if($album->photos->count()>0)quick-view  @endif btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 ">Delete</a>
                        <!-- if the count of photo of album < 0 the alert not work -->
                    </div>

                </td>

        </tr>
        @endforeach

        </tbody>
    </table>
@endsection
@section('script')



        <script>

            $(document).on('click', '.quick-view', function () {
                $('.quickview-modal' + $(this).attr('album-id')).css("display", "block");
            });
    </script>




@stop
