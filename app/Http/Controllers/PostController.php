<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::latest()->paginate(2);
        $posts = Post::with('user')->paginate(2);
        foreach ($posts as $post) {
            $post->time = \Carbon\Carbon::parse($post->created_at)->format('d/m/Y');
        }
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }
    public function show($id)
    {
        $post = Post::find($id);
        $createdAtVar =  $post->created_at;
        $x = explode(" ", $createdAtVar->toDateTimeString());
        $post->created_at = $x[0];
        $post->time = $x[0];
        $users = User::all();
        $comments = $post->comments;
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
            'users' => $users
        ]);
    }
    public function create()
    {
        $users = User::all();
        return View(
            "posts.create",
            ['users' => $users,]
        );
    }
    public function store(StorePostRequest $request)
    {
        if (User::where('id', '=', $request->user_id)->exists()) {
            Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id()
            ])->replicate();
            return redirect()->route('posts.index');
        } else {
            return redirect()->route('posts.create');
        }
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return View("posts.edit", ['post' => $post]);
    }
    public function update(UpdatePostRequest $request)
    {
        $post = Post::where("title", $request->title)->get();
        if (count($post) > 1) {
            return redirect()->back()->with('msg', "Data Invalid");
        } elseif (count($post) == 1 && $post[0]->id != $request->id) {
            return redirect()->back()->with('msg', "Data Invalid");
        } else {
            Post::find($request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id()
            ]);
            return redirect()->route('posts.index');
        }
    }
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
}
