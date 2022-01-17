@extends('layouts.app')

@section('content')

<div class="container-fluid col-11 justify-content-center border-bottom">
    <h1 class="text-center" style="font-size: 60px">
        <b>Blog Posts</b>
    </h1>
</div>
    <script>
        $(document).ready(function(){
            if ($("#msg").is(":visible")) {
                setTimeout(function(){
                    $("#msg").fadeOut(2000);
                }, 3000);
            }
        });
    </script>

    @if (session()->has('message'))
        <div id="msg" class="mx-5 my-3 rounded container-fluid col-3 border text-align-center" style="background-color:rgba(0,128,0,0.2); font-size:20px">
            <span>
                {{ session()->get('message')}}
            </span>
        </div>
    @endif

    @if (Auth::check())
        <div class="container-fluid col-11 d-block">
            <a href="/blog/create" class="mt-3 btn text-center font-weight-bold btn-secondary text-uppercase justify-content-center">Create a Post</a>
        </div>
    @endif

    @foreach ($posts as $post)
        <div class="container-fluid col-11 d-block border-bottom">
            <div class="row py-5">
                <div class="col-6">
                    <img src="{{ url($post->img_path) }}" alt="" style="width:100%">
                </div>

                <div class="col-5">
                    <h1><b>{{ $post->title }}</b></h1>

                    <span style="color:gray; font-size:18px">
                        By <span class="font-italic font-weight-bold" style="color: #6c757d">{{ $post->user->name}}</span>, last update on {{ date('jS M Y',strtotime($post->updated_at)) }}
                    </span>

                    <p class="lead" style="font-size: 22px; margin: 20px 0px 20px 0px">
                        {{ $post->description }}
                    </p>

                    <a href="/blog/{{ $post->slug }}" class="text-uppercase text-center font-weight-bold btn btn-lg btn-primary">Read more</a>
                </div>

                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                    <div class="col-1 dropdown show">
                        <a class="btn btn-secondary" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-caret-down"></i>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/blog/{{ $post->slug }}/edit">
                                Edit
                            </a>
                            <form 
                                action="/blog/{{ $post->slug}}"
                                method="POST">
                                @csrf
                                @method('delete')

                                <button 
                                class="dropdown-item"
                                type="submit"
                                style="font-size:18px">
                                    Delete post
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

@endsection