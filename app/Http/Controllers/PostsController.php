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
        $newImageID = uniqid().'-'.$request->title;
        
        $imageURL= $request->image->storeOnCloudinaryAs('myblog', $newImageID)->getSecurePath();

        // $request->image->move(public_path('images'),$newImageName);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'img_path' => $imageURL,
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
            $newImageID = uniqid().'-'.$request->title;

            $image = Post::where('slug', $id)->first()->img_path;

            $imageID = explode("/", $image);

            $imageID = explode(".", last($imageID));

            $imageID = $imageID[0];

            $imageURL= $request->image->storeOnCloudinaryAs('myblog', $newImageID)->getSecurePath();
            // $request->image->move(public_path('images'),$newImageName);
            
            cloudinary()->uploadApi()->destroy('myblog/'.$imageID);
        } else {
            $image = Post::where('slug', $id)->first()->img_path;

            $imageID = explode("/", $image);

            $imageID = explode(".", last($imageID));

            $imageID = $imageID[0];
     
            $newImageID = uniqid().'-'.$request->title;

            $imageURL = cloudinary()->uploadFile($image,['public_id' => $newImageID, 'folder' => 'myblog'])->getSecurePath();
            
            cloudinary()->uploadApi()->destroy('myblog/'.$imageID);
        }

        Post::where('slug', $id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'img_path' => $imageURL,
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
        $image = $post->first()->img_path;

        $imageID = explode("/", $image);

        $imageID = explode(".", last($imageID));

        $imageID = $imageID[0];
        
        cloudinary()->uploadApi()->destroy('myblog/'.$imageID);

        $post->delete();

        return redirect('/blog')
            ->with('message','Your post has been deleted.');           
    }
}
