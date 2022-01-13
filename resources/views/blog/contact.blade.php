@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function(){
        if ($("#msg").is(":visible")) {
            setTimeout(function(){
                $("#msg").fadeOut(5000);
            }, 3000);
        }
    });
</script>

@if (session()->has('message'))
    <div id="msg" class="mx-1 rounded container-fluid col-5 border text-align-center" style="background-color:rgba(0,128,0,0.2); font-size:20px">
        <span>
            {{ session()->get('message')}}
        </span>
    </div>
@endif

@if($errors->any())
    <ul class="rounded container-fluid col-5 border mx-1" style="background-color:rgba(255, 0, 0, 0.2); font-size:20px">
        @foreach ($errors->all() as $error)
            <div>
                {{ $error }}
            </div>                
        @endforeach
    </ul>
@endif

<div class="container col-5 mx-1">
    <form
        action="contact"
        method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name" style="font-size: 20px">Full Name</label>
            <input 
                name="name" 
                type="text" 
                style="font-size: 20px"
                class="form-control"
                placeholder="Enter your name">
        </div>

        <div class="form-group">
            <label for="email" style="font-size: 20px">Email address</label>
            <input 
                name="email" 
                type="email" 
                style="font-size: 20px"
                class="form-control"
                aria-describedby="emailHelp"
                placeholder="Enter email">
            <small 
                id="emailHelp"
                class="form-text text-muted">We'll never share your email with anyone else.
            </small>
        </div>
        
        <div class="form-group">
            <label for="subject" style="font-size: 20px">Subject</label>
            <input 
                name="subject" 
                type="text" 
                class="form-control"
                style="font-size: 20px"
                placeholder="Enter subject">
        </div>

        <div class="form-group">
            <label for="message" style="font-size: 20px">Message</label>
            <textarea 
                name="message"
                placeholder="Message..."
                class="form-control"
                rows="5"
                style="font-size: 20px"></textarea>
        </div>

        <button 
            type="submit"
            class="mt-2 btn text-center font-weight-bold btn-primary text-uppercase"
            style="font-size: 20px">

            <span class="m-auto">
                Submit
            </span>  

        </button>
    </form>
</div>
@endsection