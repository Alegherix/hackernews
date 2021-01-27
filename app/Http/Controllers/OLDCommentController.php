<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        // Validera input före vi insertar i databasen
        request()->validate([
            "body" => "required|min:3"
        ]);

        $post_id = $post->id;
        $user_id = Auth::user()->id;

        Comment::create([
            "post_id" => $post_id,
            "user_id" => $user_id,
            "body" => request()->body
        ]);

        return redirect(route("posts.show", $post));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $this->destroy($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        request()->validate([
            "body" => "required|min:3"
        ]);

        $comment = Comment::find($id);
        $comment->update([
            "body" => request()->body
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $post = Post::findOrFail($comment->post_id);

        if ((int)$comment->user_id !== Auth::user()->id) {
            return ("Nice try, you can only delete your own comments");
        };

        $comment->delete();

        return redirect(route("posts.show", $post));
    }
}
