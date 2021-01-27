<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	public function transform(User $user)
	{
		return [
			'username' => $user->name,
			'avatar' => $user->avatar,
		];
	}
}
