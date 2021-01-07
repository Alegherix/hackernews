@extends("layout")

@section("content")
<main>
    @foreach ($posts as $post)
    <section class="welcomeSection">
        <div class="likesContainer">
            <i class="fas fa-chevron-up"></i>
            <p>100</p>
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