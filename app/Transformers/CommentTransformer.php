<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Comment;
use League\Fractal\TransformerAbstract;

// In fractals we use transformers to define how to output data
// Transformers can be either callbacks or classes, classes are recommended for reusability
class CommentTransformer extends TransformerAbstract
{
	protected $availableIncludes = [
		'user', 'replies'
	];

	public function transform(Comment $comment)
	{
		return [
			'id' => $comment->id,
			'user_id' => $comment->user_id,
			'body' => $comment->body,
			'created_at' => $comment->created_at->toDateTimeString(),
			'created_at_human' => $comment->created_at->diffForHumans(),
		];
	}

	// Connect to UserTransformer
	public function includeUser(Comment $comment)
	{
		return $this->item($comment->user, new UserTransformer);
	}

	// Connect to replies function in Comment model
	public function includeReplies(Comment $comment)
	{
		return $this->collection($comment->replies, new CommentTransformer);
	}
}
