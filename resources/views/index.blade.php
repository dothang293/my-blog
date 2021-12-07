@extends('layouts.indexapp')

@section('content')

    <div class="container-fluid p-2">
        <h1>Rencent Posts</h1>
    </div>

    <div class="card-deck">
        @foreach($posts as $post)
            <div class="card">
                <div class="wrapper-image">
                    <img class = "card-img-top" src="{{ url('images/'.$post->img_path) }}" alt="Cap" style="width:100% position:absolute">
                </div>

                <div class="card-body">
                    <h3 style="font-size:17px"><b>{{ $post->title}}</b></h3>
                    <p>{{$post->description}}</p>
                    <a href="/blog/{{ $post->slug }}" class="btn btn-sm btn-dark">Read more</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection