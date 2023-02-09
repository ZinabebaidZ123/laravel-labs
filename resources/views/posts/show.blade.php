@extends('layouts.app')
@section('content')
<div class="container">
<div class="card container">
  <div class="card-header">
    Post Info
  </div>
  <div class="card-body">
    <h5 class="card-title"> <h3>Title:</h3> {{$post->title}}</h5>
    <p class="card-text"> <h3>Description:</h3> {{$post->description}}</p>
    <p class="card-text">  <h3>Created_at:</h3> {{$post->time}}</p>
  </div>
</div>
<br>
<hr class="container">
<br>
<div class="card container">
  <div class="card-header">
    Post Creator Info
  </div>
  <div class="card-body">
    <h5 class="card-title"> <h3>Creator:</h3>{{$post->user->name}} </h5>
    <p class="card-text"> <h3>  Email:</h3>{{$post->user->email}}</p>
  </div>
</div>
<br>
<hr class="container">
<br>
<div class="card container">
    <div class="card-header">
     Comments
    </div>
    @foreach ($comments as $comment)
    <hr>
    <div class="card-body">
        <h5 class="card-title"> <h3>Creator:</h3>{{$comment->user->name}} </h5>
        <p class="card-text"> <h3>Comment:</h3>{{$comment->body}}</p>
      </div>
    @endforeach
  </div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
   Add Comment
  </button>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Comment</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('comments.store') }}">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Comment</label>
                  <textarea class="form-control" name="body"></textarea>
                  <select name="user_id" id="">
                    @foreach ($users as $user)
                    <option value="{{ $user->id; }}">{{ $user->name; }}</option>
                    @endforeach
                  </select>
                  <input type="hidden" class="form-control" name="post_id" value="{{ $post->id; }}">
                </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Share</button>
        </div>

    </form>
      </div>
    </div>
  </div>
{{-- Modal --}}


</div>
@endsection
