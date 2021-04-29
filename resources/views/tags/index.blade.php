@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-end">
    <div>
    <a href="{{route ('tags.create') }}" class="btn btn-success my-2 " >Add tag</a>
    </div>
</div>
<div class="card card-default">
    <div class="card-header">
    Tags
    </div>
    <div class="card-body">
      @if($tags->count() > 0)
      <table class="table">
            <thead>
                <th>Post count</th>
                <th>Name</th>
                <th></th>
            </thead>
       
            <tbody>
            @foreach($tags as $tag)
            
            <tr >
            <td> 
       {{$tag->posts->count()}}
                </td>

                <td class="list-group-item">
                {{$tag->name}}
              
                <button class="btn btn-danger btn-sm mx-2" style="float:right" onclick="handleDelete({{ $tag->id }})">Delete</button>
                <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm" style="float:right">Edit</a>

                </td>
            </tr>
            
        
            @endforeach
            </tbody>
        </table>
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deletleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="" method="POST" id="deletetagform">
          @csrf
          @method('Delete')
         
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletleModalLabel">Delete tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this tag ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
            </div>
          </form>
         </div>
        </div>
    </div>
      @else
      <h3 class="text-center">No post yet</h3>
      @endif

</div>


@endsection
@section('scripts')
<script>
    function handleDelete(id){
       
        var form = document.getElementById('deletetagform')
        form.action = '/tags/' + id
         console.log('Deleting',form)
        $('#deleteModal').modal('show')
        

    }
   
</script>
@endsection