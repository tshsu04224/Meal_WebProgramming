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
            <img class="form-title" src="http://localhost:8080/Meal/public/images/logo.svg" alt="標題"
            height="55px" width="137.5px" />

            <div class="auth-form">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="auth-form-item">
                        <label for="name" class="auth-form-field-name">{{ __('Name') }}</label>

                        <div class="form-textbox">
                            <input id="name" type="text"
                                class="auth-form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" placeholder="Type your name" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="auth-form-item">
                        <label for="email"
                            class="auth-form-field-name">{{ __('Email Address') }}</label>

                        <div class="form-textbox">
                            <input id="email" type="email"
                                class="auth-form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Type your email" required autocomplete="email">

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
                                class="auth-form-control @error('password') is-invalid @enderror" name="password" placeholder="Type your password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="auth-form-item">
                        <label for="password-confirm"
                            class="auth-form-field-name">{{ __('Confirm Password') }}</label>

                        <div class="form-textbox">
                            <input id="password-confirm" type="password" class="auth-form-control"
                                name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="auth-form-item">
                        <div class="form-submit">
                            <button type="submit" class="auth-btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
