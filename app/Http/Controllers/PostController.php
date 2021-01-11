<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
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
            "user_id" => $user_id,
            "title" => request("title"),
            "url" => request("url"),
            "body" => request("body")
        ]);

        return redirect("/posts/{$post->id}");
    }

    public function show(Post $post)
    {

        // Hämtar alla relevanta kommentarer till posten
        $allComments = Comment::all();
        $comments = $allComments->where("post_id", $post->id);
        $comments = $comments->map(function ($author) {
            $username = User::find($author->user_id)->name;
            $author["author"] = $username;
            return $author;
        });

        // Skapar ett nytt fält i post baserat på
        // name för authorn av posten
        $posterName = User::find($post->user_id)->name;
        $post["author"] = $posterName;
        $post["comment_amount"] = $comments->count();

        return view("posts.show", ["post" => $post, "comments" => $comments]);
    }


    public function edit(Post $post)
    {
        return view("posts.edit", compact("post"));
    }

    public function update(Post $post)
    {
        // Om user_id =/ user_id så returnera att dem ej kan uppdatera andras poster
        $user_id = Auth::user()->id;
        $author_id = (int)$post->user_id;


        if ($user_id !== $author_id) {
            return ("You can only edit your own posts");
            return redirect()->back()->withErrors([""]);
        }

        // Det är samma använare, och användaren är inloggad
        $post->update($this->validatePost());

        // return redirect("/posts/" . $post->id);
        return redirect(route("posts.show", $post));
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ((int)$post->user_id !== Auth::user()->id) {
            return ("Nice try, you can only delete your own Posts");
        };
        $post->delete();
        return redirect(route('home'));
    }

    public function upvote($id)
    {
        PostLike::create([
            "user_id" => Auth::user()->id,
            "post_id" => $id
        ]);

        $post = Post::find($id);

        return redirect(route("posts.show", $post));
    }

    public function test()
    {
    }

    public function getLike()
    {
        return ["a", "b", "c"];
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
