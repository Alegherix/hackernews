@extends("layout")

@section("content")
<main>
    <section class="info">
        <button class="commentBtn"><a href="{{route('posts.create')}}">Create Post</a></button>
        <h3>Newest Posts</h3>
        <div class="likedContainer">

        </div>
    </section>
    @foreach ($posts as $post)
    <section class="welcomeSection">
        <div class="likesContainer">
            <form method="POST" action="/posts/{{$post->id}}/upvote">
                @csrf
                <button class="submitBtn" type="submit"><i class="fas fa-chevron-up upvoteIcon"></i></button>
            </form>
            <p>{{$post->likes->count()}}</p>
        </div>
        <div class="postInfoContainer">
            <div class="titleContainer">
                <a href="posts/{{$post->id}}">
                    <p>{{$post->title}}</p>
                </a>
            </div>
            <div class="postDescContainer">
                <p>Posted by {{$post->author_id}}</p>
                <p>{{$post->created_at}}</p>
            </div>
        </div>
    </section>
    @endforeach
</main>
@endsection