@extends ("layout")

@section("content")
<section class="createPost">
    <form method="POST" action="/posts">
        @csrf
        <h2>
            Create Post
        </h2>
        <div class="field">
            <label for="title">Title</label>
            <input type="text" class="text-black placeholder-opacity-100" name="title" value={{ old('title') }}>
            @error("title")
            <p class="errorMsg">{{$message}}</p>
            @enderror
        </div>

        <div class="field">
            <label for="url">URL</label>
            <input type="text" class="text-black placeholder-opacity-100" name="url" value={{ old('url') }}>

            @error("url")
            <p class="errorMsg">{{$message}}</p>
            @enderror

        </div>

        <div class="field">
            <label for="body">Body</label>
            <textarea name="body" class="text-black placeholder-opacity-100" id="body" cols="30" rows="10">{{ old('body') }}</textarea>

            @error("body")
            <p class="errorMsg">{{$message}}</p>
            @enderror
        </div>

        <div class="submit">
            <button type="submit commentBtn">Create Post</button>
        </div>

    </form>
</section>
@endsection
