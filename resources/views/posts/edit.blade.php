@extends('layouts.app')
@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(!empty(Session::get('msg')))
<div class="alert alert-primary w-75" role="alert">
{{Session::get('msg')}}
</div>
@endif
<form action="{{route('posts.update')}}" method="POST">
@csrf
<div class="mb-3">
    <input type="hidden" class="form-control" name="id" value="{{$post->id}}">
</div>
        <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{$post->title}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" name="description">{{$post->description}}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Posted By</label>
        <select class="form-control" rows="3" name="user_id" value="{{$post->user_id}}">
            <option value="{{$post->user_id}}">{{$post->user->name}}</option>
        </select>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Edit">
    </div>
</form>
</div>

@endsection
