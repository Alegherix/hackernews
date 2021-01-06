<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    public function index()
    {
        return view("posts.index");
    }

    public function create()
    {
        return view("posts.create");
    }


    public function store()
    {
        $this->validatePost();
        // Since we know we're signed in, fetch users id for foreign key
        $user_id = Auth::user()->id;

        $post = Post::create([
            "author_id" => $user_id,
            "title" => request("title"),
            "url" => request("url"),
            "body" => request("body")
        ]);

        return redirect("/posts/{$post->id}");
    }

    public function show(Post $post)
    {
        return view("posts.show", compact("post"));
    }


    public function edit(Post $post)
    {
        return view("posts.edit", compact("post"));
    }

    public function update(Post $post)
    {
        // Om user_id =/ author_id så returnera att dem ej kan uppdatera andras poster
        $user_id = Auth::user()->id;
        $author_id = (int)$post->author_id;

        if ($user_id !== $author_id) {
            return ("You can only edit your own posts");
        }

        // Det är samma använare, och användaren är inloggad
        $post->update($this->validatePost());

        // return redirect("/posts/" . $post->id);
        return redirect(route("posts.show", $post));
    }


    public function destroy(Post $post)
    {
        //
    }

    public function validatePost()
    {
        return request()->validate([
            "title" => ["required", "min:3"],
            "url" => "required",
            "body" => "required"
        ]);
    }
}
