<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="auth">
        <div class="auth-container">
            <img class="form-title" src="http://localhost:8080/Meal/public/images/logo.svg" alt="logo"
                height="55px" width="137.5px" />

            <div class="auth-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="auth-form-item">
                        <label for="email" class="auth-form-field-name">{{ __('Email') }}</label>

                        <div class="form-textbox">
                            <input id="email" type="email"
                                class="auth-form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Type your email" autocomplete="email"
                                autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="auth-form-item">
                        <label for="password" class="auth-form-field-name">{{ __('Password') }}</label>

                        <div class="form-textbox">
                            <input id="password" type="password"
                                class="auth-form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Type your password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="auth-form-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="auth-form-item">
                        <div class="form-submit">
                            <button type="submit" class="auth-btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="auth-btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <p>Don't have an account?
                                    <a class="signup" href="{{ route('register') }}">
                                        {{ __('Sign up') }}
                                    </a>
                                </p>    
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
