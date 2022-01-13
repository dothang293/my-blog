<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use Cviebrock\EloquentSluggable\Services\SlugService;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index')
            ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,bmp,png,jpeg|max:5048'
        ]);
        $newImageName = uniqid().'-'.$request->title.'.'.$request->image->extension();

        $request->image->move(public_path('images'),$newImageName);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'img_path' => $newImageName,
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'user_id' => auth()->user()->id 
        ]);

        return redirect('/blog')
            ->with('message','Your post has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blog.show')
            ->with('post', Post::where('slug',$id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('blog.edit')
            ->with('post', Post::where('slug',$id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,bmp,png,jpeg|max:5048'
        ]);

        if (isset($request->image) && $request->image) {
            $newImageName = uniqid().'-'.$request->title.'.'.$request->image->extension();

            $request->image->move(public_path('images'),$newImageName);

            unlink(public_path('images/'.Post::where('slug', $id)->first()->img_path));
        } else {
            $image = public_path('images/'.Post::where('slug', $id)->first()->img_path);

            $ext = pathinfo($image, PATHINFO_EXTENSION);

            $newImageName = uniqid().'-'.$request->title.'.'.$ext;

            rename($image,public_path('images/'.$newImageName));
        }

        Post::where('slug', $id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'img_path' => $newImageName,
                'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
                'user_id' => auth()->user()->id                 
            ]);

        return redirect('/blog')
            ->with('message','Your post has been edited.');            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('slug', $id);

        // unlink(public_path('images/'.$post->first()->img_path));

        $post->delete();

        return redirect('/blog')
            ->with('message','Your post has been deleted.');           
    }
}
