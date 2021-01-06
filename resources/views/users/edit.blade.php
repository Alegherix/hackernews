@extends("layout")

@section("content")
<main class="settings">

    <h2>Update account settings</h2>
    <div class="separator"></div>

    <div class="profileContainer">
        <p>Profile Avatar</p>
        <div class="avatar">
            <img class="avatarImg" src="{{ asset($user->avatar) }}">
        </div>
    </div>


    <form method="POST" action="/users/settings" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="avatarInputContainer">
            <input id="avatar" type="file" class="avatarInput" name="avatar">
            @error("avatar")
            <p class="errorMsg">{{$message}}</p>
            @enderror
        </div>

        <div class="field">
            <label for="title">Email</label>
            <input type="text" name="email" value="{{ $user->email}}">
            @error("email")
            <p class="errorMsg">{{$message}}</p>
            @enderror
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" value="{{ $user->password}}">
            @error("password")
            <p class="errorMsg">The password has to have a min length of 7</p>
            @enderror

        </div>

        <div class="field">
            <label for="biography">Biography</label>
            <textarea name="biography" id="biography" cols="30" rows="10">{{ $user->biography }}</textarea>

            @error("biography")
            <p class="errorMsg">{{$message}}</p>
            @enderror
        </div>

        <div class="submit">
            <button type="submit">Update Profile</button>
        </div>

    </form>

</main>

@endsection