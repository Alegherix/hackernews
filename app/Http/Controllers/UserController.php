<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user)
    {
        return view("users.show", compact("user"));
    }

    public function edit()
    {
        $user = Auth::user();

        return view("users.edit", compact("user"));
    }

    public function update(User $user)
    {
        // Validera inputs
        $validatedUser = $this->validateUser();

        // Fetcha den inloggade användaren och uppdatera dennes fält
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if (request()->has("avatar")) {
            $image = request()->file("avatar");
            // Make a image name based on user name and current timestamp
            $name = Str::slug(request()->input('email')) . '_' . time();

            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->avatar = $filePath;
        }



        $user->email = request("email");
        $user->password = Hash::make(request("password"));
        $user->biography = request("biography");
        $user->save();

        // Skicka tillbaka användaren till samma sida, så den kan verifiera sina uppdateringar
        return view("users.edit", compact("user"));
    }

    public function updateAvatar()
    {
        die(var_dump(request()->all()));
    }

    public function validateUser()
    {
        return request()->validate([
            "email" => "required|min:5|email:rfc,dns", //|unique:users
            "password" => "required|min:7",
            "avatar" => 'image|mimes:jpeg,png,jpg,gif'
        ]);
    }
}
