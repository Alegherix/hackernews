@extends("layout")
@section("content")
<section>
    <div class="specificPostContainer">
        <div class="postContainer">
            <div class="likesContainer">
                <form method="POST" action="/posts/{{$post->id}}/upvote">
                    @csrf
                    <button class="submitBtn" type="submit"><i class="fas fa-chevron-up upvoteIcon"></i></button>
                </form>
                <p class="nLikes">{{$post->upvotes}}</p>
            </div>
            <div class="avatarContainer">
                <img class="avatar" src="{{ asset($post->user->avatar) }}">
            </div>
            <div class="postInfoContainer">
                <h2 class="postTitle"><a href="{{$post->url}}">{{$post->title}}</a></h2>
                <div class="infoContainer">
                    <p>Posted by: {{$post->author}}</p>
                    <p>{{$post->created_at}}</p>
                    @auth
                    @if(Auth::user()->id === (int)$post->user_id)
                    <a href="{{ route('posts.edit', $post) }}"><i class="fas fa-edit"></i></a>
                    <form method="POST" class="deletePostForm" action="/posts/{{$post->id}}">
                        @method("DELETE")
                        @csrf
                        <button class="submitBtn" type="submit">
                            <i class="fas fa-trash deletePostIcon"></i>
                        </button>
                    </form>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
        <p>
            {{$post->body}}
        </p>
        <div class="separator"></div>

        <div id="app">
            {{-- post id should be passed in here for the loops --}}
            <post-comments post-id="{{ $post->id }}"></post-comments>
        </div>
    </div>
</section>
@endsection
