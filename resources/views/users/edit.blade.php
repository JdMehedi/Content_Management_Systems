@extends('layouts.app')

@section('content')



<div class="card">
                <div class="card-header">My Profle</div>

                <div class="card-body">
                
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{$error}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                            
                   <form action="{{route('users.update-profile')}}" method="POST">
                   @csrf 
                   @method('PUT')

                   <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name}}">
                   </div>

                   <div class="form-group">
                    <label for="about">About</label>
                        <textarea name="about" id="about" cols="5" rows="5" class="form-control"> {{$user->about}} </textarea>
                   </div>
                   <button type="submit" class="btn btn-success btn-sm">Update Profle</button>
                   </form>
                </div>
            </div>


@endsection
