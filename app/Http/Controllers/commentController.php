<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    public function index(){
        $comments = Comment::all();
    }

    public function store(Request $request){
        if($request->body && $request->user_id && $request->post_id){
            Comment::create([
                'body'=> $request->body,
                'user_id'=> Auth::id(),
                'post_id' =>$request->post_id
            ]);
            return redirect()->back();
        }
    }
    public function edit(){}
    public function update(Request $request){}
    public function delete(){}
}
