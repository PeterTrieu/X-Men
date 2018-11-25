<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['create','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = DB::select('SELECT * FROM posts');
        // $posts = Post::orderBy('email','asc')->take(1)->get();
        // $posts = Post::orderBy('email','asc')->get();

        $posts = Post::orderBy('email','asc')->paginate(4);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'description' => 'required',
            'before_image' => 'image|required|max:1999',
            'after_image' => 'image|required|max:1999'
            ]);

            //Handle File Upload
            if($request->hasFile('before_image')){
                //Get filename with the extension
                $filenamewithExt = $request->file('before_image')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('before_image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore1=$filename.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('before_image')->storeAs('public/before_images',$fileNameToStore1);
            }
            else{
                $fileNameToStore = 'noimage.jpg';
            }

            if($request->hasFile('after_image')){
                //Get filename with the extension
                $filenamewithExt = $request->file('after_image')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('after_image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore2=$filename.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('after_image')->storeAs('public/after_images',$fileNameToStore2);
            }   
            else{
                $fileNameToStore = 'noimage.jpg';
            }

        // Create Post
        $post = new Post;
        $post->email=$request->input('email');
        $post->description=$request->input('description');
        $post->before_image= $fileNameToStore1;
        $post->after_image= $fileNameToStore2;
        $post->save();

        return redirect('/')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);
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
        $this->validate($request,[
            'email' => 'required',
            'description' => 'required'
            ]);

            //Handle File Upload
            if($request->hasFile('before_image')){
                //Get filename with the extension
                $filenamewithExt = $request->file('before_image')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('before_image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore1=$filename.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('before_image')->storeAs('public/before_images',$fileNameToStore1);
            }

            if($request->hasFile('after_image')){
                //Get filename with the extension
                $filenamewithExt = $request->file('after_image')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('after_image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore2=$filename.'_'.time().'.'.$extension;
                //Upload Image
                $path=$request->file('after_image')->storeAs('public/after_images',$fileNameToStore2);
            }   

        // Create Post
        $post = Post::find($id);
        $post->email=$request->input('email');
        $post->description=$request->input('description');
        if($request->hasFile('before_image')){
            $post->before_image = $fileNameToStore1;
        }
        if($request->hasFile('after_image')){
            $post->after_image = $fileNameToStore2;
        }
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if($post->before_image != 'noimage.jpg'){
            //Delete before image
            Storage::delete('public/before_images/'.$post->before_image);
        }

        if($post->after_image != 'noimage.jpg'){
            //Delete before image
            Storage::delete('public/after_images/'.$post->after_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
