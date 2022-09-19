@extends('layouts.app')

@section('content')
    <a style="width: 200px; margin-left: 600px" href="{{route('albums.index')}}"
       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">All Albums</a>
    <div class="form-group">
        <label>Album pictures </label>
        <div style="margin-top: 50px">

            <table style="background-color: whitesmoke">
                <tr>
                    @isset($my_album->photos)
                        @foreach($my_album->photos as $image)
                            <td style="height: 100px;margin: auto">
                                <img style="margin-right: 15px " height="150px" width="150px" src="{{$image->photo}}"><br>
                                <a style="margin-right: 30px;margin-top: 9px;border-radius: 5px" href="{{route('DeleteImages',$image -> id)}}"
                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">delete</a>
                                <a style="margin-right: 30px;margin-top: 9px;border-radius: 5px" href="{{route('moveImages',$image -> id)}}"
                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">move</a>
                            </td>
                        @endforeach
                    @endisset
                </tr>
            </table>
        </div>
    </div>
    <form class="form" action="{{route('move.Album')}}"
          method="POST"
    >
        @csrf
        <div class="mb-3" >
            <label for="exampleInputEmail1" class="form-label">Add Album</label>
            <select  style="width: 60%" type="text"
                     class="select2 form-control"
                     name="album_id" >
                <optgroup label="please choise the service">
                    @if($albums && $albums->count()>0)
                        @foreach($albums as $album)
                            <option value="{{$album->id }}" @if($album->id==$my_album->album_id) selected @endif style="font-size: large">{{$album->name }}
                                </li></option>



                        @endforeach
                    @endif


                </optgroup>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
