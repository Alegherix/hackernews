# Hacker News

## Specs

-   As a user I should be able to create an account.

-   As a user I should be able to login.

-   As a user I should be able to logout.

-   As a user I should be able to edit my account email, password and biography.

-   As a user I should be able to upload a profile avatar image.

-   As a user I should be able to create new posts with title, link and description.

-   As a user I should be able to edit my posts.

-   As a user I should be able to delete my posts.

-   As a user I'm able to view most upvoted posts.

-   As a user I'm able to view new posts.

-   As a user I should be able to upvote posts.

-   As a user I should be able to remove upvote from posts.

-   As a user I'm able to comment on a post.

-   As a user I'm able to edit my comments.

-   As a user I'm able to delete my comments.

## To Run This Code On Your Machine

You need:

-   [PHP](https://www.php.net/docs.php)
-   [Laravel 8x](https://laravel.com/docs/8.x)
-   [Composer](https://getcomposer.org/)
-   [SQLite](https://sqlite.org/index.html)

When you're ready you can:

1. Clone this repo

```bash
git clone https://github.com/Alegherix/hackernews.git
```

2. Change directory to hackernews

3. Install dependencies

```bash
composer install
```

4. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Start the server

```bash
php artisan serve
```

## Code Review - Daniel Borgström

1. I would suggest using Policies(https://laravel.com/docs/8.x/authorization#generating-policies)
2. updateAvatar in UserController.php returns die dump.
3. PostController and CommentController both uses CRUD. I would suggest Route::resource
4. show in CommentController can be manipulated so a user can delete someone else's comment.
5. When updating database. Instead or writing every single field you can write \$request->al()
6. Many views uses the same output. Components will make it look better. (https://laravel.com/docs/8.x/blade#rendering-components)
7. Some comments in the code are in swedish and some in english.
8. I would suggest using Paginate for the posts. (https://laravel.com/docs/8.x/pagination)
9. And eager loading (https://laravel.com/docs/8.x/eloquent-relationships#eager-loading)
10. Overall nicely clean code!

## Testing Done By

Daniel Borgström
Evelyn Fredin

## License

[MIT](LICENSE) © Martin Hansson
