@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
    <div>
    <a href="{{route ('post.create') }}" class="btn btn-success my-2 " >Add Post</a>
    </div>
</div>
<div class="card card-default ">
    <div class="card-header">
    Post
    </div>
    <div class="card-body">
   @if($posts->count() > 0)
   <table class="table">
    <thead>
        <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Tag</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
        
            <td>  
             <img src="{{asset('storage/'.$post->image)}}" width="150px" height="150px" alt=""> <br><br>
             <h3>Details: </h3>
             {{$post->description}}
            </td>
            <td>
            {{$post->title}}
            </td>
            <td>
            <a href="{{route('categories.edit', $post->category->id)}}">  {{$post->category->name}}</a>
          
            </td>
            <td><a href="#">tag</a></td>
           

           @if(!$post->trashed())
           <td>

            <a href="{{route('post.edit',$post->id)}}" class="btn btn-success btn-sm">Edit</a>
            
            </td>
            @else
              <td>

              <form action="{{route('restore.posts',$post->id)}}" method="POST">

              @csrf

              @method("PUT")

                    <button type="submit" class="btn btn-info btn-sm">Restore</button>
              </form>
            
            </td>

           @endif
            <td >

            <form  action="{{route('post.destroy',$post->id)}}" method="POST">
            @csrf

            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm " >
            {{$post->trashed()? 'Delete':'Trash'}}
            </button>
            </form>
            </td>
            
        </tr>
        @endforeach
     </tbody>
    </table>

   @else
   <h3 class="text-center">No post yet</h3>
   @endif
    </div>
</div>
@endsection