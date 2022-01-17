@extends('layouts.app')

@section('content')

<div class="container-fluid col-11">
        <h1 class="text-left" style="font-size: 60px">
            <b>Edit post</b>
        </h1>
</div>

@if($errors->any())
    <ul class="rounded container-fluid col-10 border" style="background-color:rgba(255, 0, 0, 0.2); font-size:20px">
        @foreach ($errors->all() as $error)
            <div>
                {{ $error }}
            </div>                
        @endforeach
    </ul>
@endif

<div class="container-fluid col-11">
    <form 
        action="/blog/{{ $post->slug }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="input-group mt-5">
        <input
            name="title" 
            type="text" 
            class="form-control" 
            value="{{ $post->title }}"
            style="font-size: 40px">
        </div>

        <div class="input-group mt-4">
            <textarea 
                name="description"
                class="form-control"
                rows="10"
                style="font-size: 20px">{{ $post->description }}</textarea>
        </div>

        <div class="input-group mt-4">
            <input
                name="image"
                type="file"
                style="font-size:18px">
        </div>
        
        <button 
            type="submit"
            class="mt-5 btn text-center font-weight-bold btn-primary text-uppercase"
            style="font-size: 20px">

            <span class="m-auto">
                Submit Post
            </span>  

        </button>

    </form>
</div>

@endsection