@extends("layout")

<!-- https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css -->

@section("content")
<section>
    <div class="specificPostContainer">
        <div class="postContainer">
            <div class="likesContainer">
                <i class="fas fa-chevron-up"></i>
                <p>100</p>
            </div>
            <div class="postInfoContainer">
                <h2 class="postTitle"><a href="{{$post->url}}">Title of the post whatever it is</a></h2>
                <div class="infoContainer">
                    <p>Posted by: {{$post->author}}</p>
                    <p>{{$post->created_at}}</p>
                    @if(Auth::user()->id === (int)$post->author_id)
                    <a href="{{ route('posts.edit', $post) }}"><i class="fas fa-edit"></i></a>
                    <form method="POST" class="deleteCommentForm" action="/posts/{{$post->id}}">
                        @method("DELETE")
                        @csrf
                        <i class="fas fa-trash deleteCommentIcon"></i>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque qui, aperiam architecto saepe, fugiat eum suscipit dicta facilis, reiciendis assumenda quibusdam! Inventore unde fuga blanditiis molestiae laborum obcaecati eligendi fugiat, maiores a nostrum porro animi iste? Magnam laudantium commodi aspernatur!
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
                <textarea class="commentArea" name="body" id="body" placeholder="What are your thought?"></textarea>

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
                <i class="fas fa-chevron-up"></i>
                <p>100</p>
            </div>
            <div class="comment">
                <div class="commentInfoContainer">
                    <p>{{$comment->author}}</p>
                    <p>{{$comment->updated_at}}</p>
                    @auth
                    @if(Auth::user()->id == $comment->author_id)
                    <i class="fas fa-edit"></i>
                    <form method="POST" class="deleteCommentForm" action="/comments/{{$comment->id}}">
                        @method("DELETE")
                        @csrf
                        <i class="fas fa-trash deleteCommentIcon"></i>
                    </form>
                    @endauth
                    @endif
                </div>
                <div class="commentBodySection">
                    <p>{{$comment->body}}</p>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <script src="/js/app.js"></script>
</section>

@endsection