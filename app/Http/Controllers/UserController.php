<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show(User $user)
    {
        return view("users.show", compact("user"));
    }

    public function edit(User $user)
    {
        return view("users.edit", compact("user"));
    }

    public function update(User $user)
    {
    }
}
