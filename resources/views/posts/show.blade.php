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
                <p class="nLikes">{{$post->likes->count()}}</p>
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
        <!-- Gör de enbart tillgängligt att posta för inloggade users -->
        @auth
        <div class="commentInfoContainer">

            <p>Comment as: {{Auth::user()->name}}</p>

            <p>{{$post->comment_amount}} comments</p>
        </div>
        <form method="POST" action="/comments/{{$post->id}}">
            @csrf
            <div class="field">
                <label for="body"></label>
                <textarea class="commentArea" name="body" id="body" placeholder="What are your thoughts?"></textarea>

                @error("body")
                <p class="errorMsg">{{$message}}</p>
                @enderror

                <button class="commentBtn" type="submit">Post Comment</button>
            </div>
        </form>
        @endauth
        <div class="separator"></div>
        <!-- Här behöver vi en Collection Loop baserat på Alla kommentarer för posten -->
        @foreach ($comments as $comment)
        <div class="commentContainer">
            <div class="likesContainer">
                <img class="avatar" src="{{ asset($post->user->avatar) }}">
            </div>
            <div class="comment">
                <div class="commentInfoContainer">
                    <p>{{$comment->author}}</p>
                    <p>{{$comment->updated_at}}</p>
                    @auth
                    @if(Auth::user()->id == $comment->user_id)
                    <i class="editComment fas fa-edit"></i>
                    <form method="POST" class="deleteCommentForm" action="/comments/{{$comment->id}}">
                        @method("DELETE")
                        @csrf
                        <button class="submitBtn" type="submit">
                            <i class="fas fa-trash deleteCommentIcon"></i>
                        </button>
                    </form>
                    @endif
                    @endauth
                </div>
                <div class="commentBodySection">
                    <p class="commentParagraph">{{$comment->body}}</p>
                    <form method="POST" class="updateCommentForm hide" action="/comments/{{$comment->id}}">
                        @method("PUT")
                        @csrf
                        <textarea class="commentArea" name="body" id="body">{{$comment->body}}</textarea>
                        <button class="commentBtn" type="submit">
                            Update post
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <script src="/js/app.js"></script>
</section>

@endsection