@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{route('albums.index')}}"
                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">All Albums</a>
            </div>
        </div>
    </div>
</div>
@endsection
