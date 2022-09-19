@extends('layouts.app')

@section('content')
    <a style="width: 200px; margin-left: 600px" href="{{route('albums.index')}}"
       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">All Albums</a>




    <img style="margin-right: 15px " height="150px" width="150px" src="{{$photo->photo}}"><br>
    <form class="form" action="{{route('move.photo')}}"
          method="POST"
    >
        @csrf
        <input type="hidden" value="{{$photo->id}}" name="photo_id">
        <div class="mb-3" >
            <label for="exampleInputEmail1" class="form-label">Add Album</label>
            <select  style="width: 60%" type="text"
                     class="select2 form-control"
                     name="album_id" >
                <optgroup label="please choise the service">
                    @if($albums && $albums->count()>0)
                        @foreach($albums as $album)
                            <option value="{{$album->id }}" @if($album->id==$photo->album_id) selected @endif style="font-size: large">{{$album->name }}
                                </li></option>



                        @endforeach
                    @endif


                </optgroup>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
