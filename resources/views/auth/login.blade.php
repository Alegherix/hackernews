@extends('layout')

@section('content')
<main class="auth">
    <h2>Login</h2>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="formGroup">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="formGroup">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="formGroup">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="commentBtn">
                        Login
                    </button>

                </div>
            </div>
        </form>
    </div>
</main>
@endsection