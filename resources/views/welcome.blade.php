@extends("layout")

@section("content")
<main>
    
    <p>Hey vue, you alive?</p>
    <div id="app">
        <hello-world> </hello-world> 
    </div>

    <h1 class="banner">{{$banner}}</h1>
    <section class="info">
        <a class="routeBtn" href="{{route('posts.create')}}"><button class="commentBtn">Create Post</button></a>
    </section>
    @foreach ($posts as $post)
    <article class="welcomeSection">
        <div class="likesContainer">
            <form method="POST" action="/posts/{{$post->id}}/upvote">
                @csrf
                <button class="submitBtn" type="submit"><i class="fas fa-chevron-up upvoteIcon"></i></button>
            </form>
            <p>{{$post->upvotes}}</p>
        </div>
        <div class="imageContainer">
            <img class="avatarImg" src="{{ asset($post->user->avatar) }}">
        </div>
        <div class=" postInfoContainer">
            <div class="titleContainer">
                <a href="posts/{{$post->id}}">
                    <p>{{$post->title}}</p>
                </a>
            </div>
            <div class="postDescContainer">
                <p>Posted by {{$post->user->name}}</p>
                <p>{{$post->created_at}}</p>
            </div>
        </div>
    </article>
    @endforeach
</main>
@endsection