@extends('layouts.app')

@section('content')
    <div class="container-fluid col-11 d-block">
        <div>
            <h1><b>{{ $post->title }}</b></h1>

            <span style="color:gray; font-size:18px">
                By <span class="font-italic font-weight-bold" style="color: #6c757d">{{ $post->user->name}}</span>, last update on {{ date('jS M Y',strtotime($post->updated_at)) }}
            </span>

            <p class="lead" style="font-size: 22px; margin: 20px 0px 20px 0px">
                {{ $post->description }}
            </p>

            <div>
                <img src=" {{ url('images/'.$post->img_path) }}" alt="" style="width:100%">
            </div>
        </div>
    </div>
@endsection