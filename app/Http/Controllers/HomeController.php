<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $posts = Post::all()->sortByDesc("created_at");
        return view("welcome", ["posts" => $posts]);
    }

    public function popular()
    {
        $posts = Post::all()->sortByDesc("upvotes");
        return view("welcome", ["posts" => $posts]);
    }
}
