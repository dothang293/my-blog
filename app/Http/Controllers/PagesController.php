<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PagesController extends Controller
{
    public function index()
    {   
        $three_post = array_slice(Post::orderBy('updated_at', 'DESC')->get()->all(), 0, 3);
        
        return view('index')
            ->with('posts', $three_post);
    }
}
