@extends('layouts.app')

@section('content')
    <a style="width: 200px; margin-left: 600px" href="{{route('albums.index')}}"
       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">All Albums</a>
<div class="container">
    <form class="form" action="{{route('albums.update',$album->id)}}"
          method="Post"
    >

        @csrf
        @method('PUT')
        <div class="mb-3" >
            <label for="exampleInputEmail1" class="form-label">Add Album</label>
            <input value="{{$album->name}}" style="width: 300px;" type="text" class="form-control"  name="name" aria-describedby="emailHelp">
            @error("name")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
