<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <div class="createPostContainer">
        <section class="createPost">
            <form method="POST" action="/posts">
                @csrf

                <h2>
                    Create Post
                </h2>
                <div class="field">
                    <label for="title">Title</label>
                    <input type="text" name="title">
                </div>

                <div class="field">
                    <label for="url">URL</label>
                    <input type="text" name="URL">
                </div>

                <div class="field">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" cols="30" rows="10"></textarea>
                </div>

                <div class="submit">
                    <button type="submit">Create Post</button>
                </div>

            </form>
        </section>
    </div>
</body>

</html>