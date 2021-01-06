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

    public function edit()
    {
        // Hitta inloggad användare
        // Prepopulatea fieldsen som finns
        // Gör en PUT req till update metoden

        $user = Auth::user();
        if (!$user) {
            return redirect(route("home"));
        }

        return view("users.edit", compact("user"));
    }

    public function update(User $user)
    {
        // Validera inputs 
        $validatedUser = $this->validateUser();

        // Fetcha den inloggade användaren och uppdatera dennes fält
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $user->email = request("email");
        $user->password = request("password");
        $user->biography = request("biography");
        $user->save();

        // Skicka tillbaka användaren till samma sida, så den kan verifiera sina uppdateringar
        return view("users.edit", compact("user"));
    }

    public function validateUser()
    {
        return request()->validate([
            "email" => "required|min:5|email:rfc,dns", //|unique:users
            "password" => ["required", "min:7"]
        ]);
    }
}
