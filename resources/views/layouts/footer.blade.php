<footer class="container-fluid bg-dark bg-gradient text-white p-4">
    <section class="d-block justify-content-center border-bottom mb-5 text-center">
        <div class="mb-2 d-none d-lg-block text-white">
            <span class="text-reset">
                Get connected with us on social networks:
            </span>
        </div>

        <!-- Social network icons -->
        <div>
            <a href="https://www.facebook.com/boy.293" target="_blank" class="btn rounded-circle btn-outline-light btn-floating mb-2 m-1" role="button">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/_do.quang.thang_/" target="_blank" class="btn rounded-circle btn-outline-light btn-floating mb-2 m-1" role="button">
                <i class="fab fa-instagram"></i>
            </a>         
            <a class="btn rounded-circle btn-outline-light btn-floating m-1" href="#!" role="button">
                <i class="fab fa-github"></i>
            </a>   
        </div>
    </section>

    <section class="d-block mb-4">
        <div class="row">
            <div class="col-sm-4">
                <h1 style="font-size:20px">Pages</h1>
                <hr style="height:1px;border-width:0;color:white;background-color:gray">
                <p>
                    <a href="/">Home</a>
                    <br><a href="/blog">Blog</a>
                    <br><a href="{{ route('login') }}">Login</a>
                    <br><a href="{{ route('register') }}">Register</a>
                </p>
            </div>

            <div class="col-sm-4">
                <h1 style="font-size:20px">Latest Posts</h1>
                    <hr style="height:1px;border-width:0;color:white;background-color:gray">

                @foreach ($posts as $post)
                    <p style="overflow: hidden;text-overflow: ellipsis; white-space: nowrap">
                        <a href="/blog/{{ $post->slug }}">
                            {{ $post->title }}
                        </a>
                        <br>
                    </p>
                @endforeach
            </div>            
            <div id="ContactInfo" class="col-sm-4">
                <h1 style="font-size:20px">Find Us</h1>
                <hr style="height:1px;border-width:0;color:white;background-color:gray">
                <p>
                    <a href="https://www.google.com/maps/place/To%C3%A0+A7+-+Chung+c%C6%B0+An+B%C3%ACnh+City/@21.0507564,105.7750958,17z/data=!3m1!4b1!4m5!3m4!1s0x313455adb96d252f:0x5a0706c963136969!8m2!3d21.0507564!4d105.7772845" target="_blank"><b>A7 building, An Binh city</b></a>
                    <br><a>232 Pham Van Dong St.</a>
                    <br><a>Hanoi, Vietnam (10000)</a>
                    <br><a>(+84) 344275834</a>
                </p>
            </div>

        </div>
    </section>
    <p class="text-center">Mr. Mo &copy; 2021</p> 
</footer>