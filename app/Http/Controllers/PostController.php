<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;


class PostController extends Controller
{
    public function __construct(){
        $this->middleware('test')->only(['create','store']);
       
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {  
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
    

        try {
            $image = $request->image->store('chobi');
            
            $post = Post::create([
    
                'title'=>$request->title,
                'description'=>$request->description,
                'content'=>$request->content,
                'image'=>$image,
                'published_at'=>$request->published_at,
                'category_id'=>$request->category,
                'user_id' =>auth()->user()->id
            ]);
            
            if($request->tags){
                $post->tags()->attach($request->tags);
            }
    
            // session()->flash('success','Post created successfully');
            return redirect()->route('post.index')->with('success','Post created successfully');
            
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   

        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //check if new image
        if($request->hasFile('image'))
        {   
            $data = $request->only(['title','description','content','published_at']); 
            //upload image
            $image = $request->image->store('posts');
            //delete old on
            $post->deleteImage();
            $data['image'] = $image;

                if($request->tags){
                    $post->tags()->sync($request->tags);
                }


            $post->update($data);

        }
        
        
        //update attribute
         
        //flash
         session()->flash('success','Post updated successfully');
        //redirect
         return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {  
         $post = Post::withTrashed()->where('id',$id)->first();
        //  $post->delete();

        if($post->trashed())
        {
            Storage::delete($post->image);
            $post->forceDelete();
        }
        else{
            $post->delete();
        }


        session()->flash('success','Post delete successfully');
        return redirect(route('post.index'));
    }

/**
     * RemoDisplay a list of all trashed post.
     *
    
     * @return \Illuminate\Http\Response
     */

    public function trashed()
    {   $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }

    /**
     * Put a list of all restore post.
     *
    
     * @return \Illuminate\Http\Response
     */
    public function restore( $id)
    {   
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        session()->flash('success','Post restore successfully');
        return redirect()->back();

    }


}
