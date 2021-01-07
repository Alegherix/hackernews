@extends("layout")

<!-- https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css -->

@section("content")
<section>
    <div class="specificPostContainer">
        <div class="postContainer">
            <div class="likesContainer">
                <p>/\</p>
                <p>100</p>
            </div>
            <div class="postInfoContainer">
                <h2>Title of the post whatever it is</h2>
                <div class="infoContainer">
                    <p>Posted by: {{$post->author}}</p>
                    <p>{{$post->created_at}}</p>
                    <p>x</p>
                    <p>x</p>
                </div>
            </div>
        </div>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque qui, aperiam architecto saepe, fugiat eum suscipit dicta facilis, reiciendis assumenda quibusdam! Inventore unde fuga blanditiis molestiae laborum obcaecati eligendi fugiat, maiores a nostrum porro animi iste? Magnam laudantium commodi aspernatur!
        </p>
        <!-- Gör de enbart tillgängligt att posta för inloggade users -->
        @if (Auth::user()!==null)
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
        @endif
        <div class="separator"></div>
        <!-- Här behöver vi en Collection Loop baserat på Alla kommentarer för posten -->
        @foreach ($comments as $comment)
        <div class="commentContainer">
            <div class="likesContainer">
                <p>/\</p>
                <p>100</p>
            </div>
            <div class="comment">
                <div class="commentInfoContainer">
                    <p>{{$comment->author}}</p>
                    <p>{{$comment->updated_at}}</p>
                </div>
                <div class="commentBodySection">
                    <p>{{$comment->body}}</p>
                </div>
            </div>
        </div>

        @endforeach
    </div>


</section>

@endsection