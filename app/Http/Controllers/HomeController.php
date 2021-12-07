<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $three_post = array_slice(Post::orderBy('updated_at', 'DESC')->get()->all(), 0, 3);
        
        return view('index')
            ->with('posts', $three_post);        ;
    }
}
