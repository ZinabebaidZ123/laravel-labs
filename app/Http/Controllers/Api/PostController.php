<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();
        return PostResource::collection($posts);
    }
    public function store(StorePostRequest $request){
        if (User::where('id', '=', $request->user_id)->exists()) {
            Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id()
            ])->replicate();
            return ['msg'=>'success'];
        }
    }
    public function update(UpdatePostRequest $request)
    {
        $post = Post::where("title",$request->title)->get();
        if(count($post) > 1 ){
            return ['msg'=>'Invalid Data'];
        }
        elseif(count($post) == 1 && $post[0]->id != $request->id){
            return ['msg'=>'Data Duplicated'];
        }else{
            Post::find($request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' =>Auth::id()
            ]);
            return ['msg'=>'success'];
        }
    }
}
