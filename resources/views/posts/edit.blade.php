<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <section class="createPost">
        <form method="POST" action="/posts/{{$post->id}}">
            @csrf
            @method("PUT")

            <h2>
                Update Post
            </h2>
            <div class="field">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{$post->title}}">
            </div>

            <div class="field">
                <label for="url">URL</label>
                <input type="text" name="url" value="{{$post->url}}">
            </div>

            <div class="field">
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10">{{$post->body}}</textarea>
            </div>

            <div class="submit">
                <button type="submit">Update post</button>
            </div>

        </form>
    </section>
</body>

</html>