@extends('layouts.app')

@section('content')
    <a style="width: 200px; margin-left: 600px" href="{{route('albums.index')}}"
       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">All Albums</a>


    <form class="form" action="{{route('albums.store')}}"
    method="POST"
    >
    @csrf
        <div class="mb-3" >
            <label for="exampleInputEmail1" class="form-label">Add Album</label>
            <input style="width: 300px;" type="text" class="form-control"  name="name" aria-describedby="emailHelp">
            @error("name")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
