<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest\CreatePost;
use App\Http\Requests\PostRequest\DeletePost;
use App\Http\Requests\PostRequest\ReadPost;
use App\Http\Requests\PostRequest\UpdatePost;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(CreatePost $request)
    {

        $post = Post::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'user_id' => $request['user_id']
        ]);

        return response()->json(["data" => $post, "message" => "created_with_success"]);

    }

    public function read(ReadPost $request)
    {

        $id = (int)$request->id;
        $posts = ($id) ? Post::with('user')->find($id) : Post::with('user')->get();

        return response()->json(['data' => $posts]);
    }

    public function update(UpdatePost $request)
    {
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'user_id' => $request['user_id']
        ];

        $post = Post::find($request->id);
        $post->update($data);

        return response()->json(["data" => $post, "message" => "updated_with_success"]);

    }

    public function delete(DeletePost $request)
    {

        $post = Post::find($request->id);
        $post->delete();

        return response()->json(["data" => null, "message" => "deleted_with_success"]);

    }
}
