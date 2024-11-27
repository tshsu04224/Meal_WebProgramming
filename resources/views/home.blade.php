@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">正在進行的飯局</h1>
        @if ($postRunnings != [])
            @foreach ($postRunnings as $post)
                <div class="post">
                    <a class="link" href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a>
                    <div class="avatarShow-container">
                        <div class="avatarShow-time">
                            <span>{{ $post->date }} {{ $post->time }}</span>
                        </div>
                        <div class="user-list">
                            <div class="avatar-relative">
                                <a href="{{ route('profiles.postUsers', ['post' => $post]) }}">
                                    @foreach ($avatars[$post->id] as $index => $avatar)
                                        @if ($index < 3)
                                            <div class="avatarShow"
                                                style="transform: translate({{ -($index * 20) }}px); z-index: {{ $index + 1 }}; right: 0;">
                                                @if ($avatar->image)
                                                    <img class="user-avatar" src="{{ asset('storage/' . $avatar->image) }}">
                                                @else
                                                    <img class="user-avatar"
                                                        src="http://localhost:8080/Meal/public/images/user/user.png">
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="post">
                <a class="link" href="{{ route('posts.create') }}">{{ __('沒有正在進行的飯局') }}</a>
            </div>
        @endif

        <h1 class="page-title">創建的飯局</h1>
        @if ($userCreates != [])
            @foreach ($userCreates as $post)
                <div class="post">
                    <a class="link" href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a>
                    <div class="avatarShow-container">
                        <div class="avatarShow-time">
                            <span>{{ $post->date }} {{ $post->time }}</span>
                        </div>
                        <div class="user-list">
                            <div class="avatar-relative">
                                <a href="{{ route('profiles.postUsers', ['post' => $post]) }}">
                                    @foreach ($avatars[$post->id] as $index => $avatar)
                                        @if ($index < 3)
                                            <div class="avatarShow"
                                                style="transform: translate({{ -($index * 20) }}px); z-index: {{ $index + 1 }}; right: 0;">
                                                @if ($avatar->image)
                                                    <img class="user-avatar"
                                                        src="{{ asset('storage/' . $avatar->image) }}">
                                                @else
                                                    <img class="user-avatar"
                                                        src="http://localhost:8080/Meal/public/images/user/user.png">
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="post">
                <a class="link" href="{{ route('posts.create') }}">{{ __('點我創建飯局吧!') }}</a>
            </div>
        @endif

        <h1 class="page-title">參加的飯局</h1>
        @if ($postJoins != [])
            @foreach ($postJoins as $post)
                <div class="post">
                    <a class="link" href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                    <div class="avatarShow-container">
                        <div class="avatarShow-time">
                            <span>{{ $post->date }} {{ $post->time }}</span>
                        </div>
                        <div class="user-list">
                            <div class="avatar-relative">
                                <a href="{{ route('profiles.postUsers', ['post' => $post]) }}">
                                    @foreach ($avatars[$post->id] as $index => $avatar)
                                        @if ($index < 3)
                                            <div class="avatarShow"
                                                style="transform: translate({{ -($index * 20) }}px); z-index: {{ $index + 1 }}; right: 0;">
                                                @if ($avatar->image)
                                                    <img class="user-avatar"
                                                        src="{{ asset('storage/' . $avatar->image) }}">
                                                @else
                                                    <img class="user-avatar"
                                                        src="http://localhost:8080/Meal/public/images/user/user.png">
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="post">
                <a class="link" href="{{ route('posts.index') }}">{{ __('點我參加飯局吧!') }}</a>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        window.onload = function() {

            var homeSVG = document.getElementById('homeSVG');

            if (homeSVG) {
                homeSVG.innerHTML = `
                <svg aria-label="首頁" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24">
                    <title>首頁</title>
                    <path d="M22 23h-6.001a1 1 0 0 1-1-1v-5.455a2.997 2.997 0 1 0-5.993 0V22a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V11.543a1.002 1.002 0 0 1 .31-.724l10-9.543a1.001 1.001 0 0 1 1.38 0l10 9.543a1.002 1.002 0 0 1 .31.724V22a1 1 0 0 1-1 1Z"></path>
                    </svg>`;
            }
        };

        var navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                homeSVG.innerHTML = `
                <svg aria-label="首頁" id="homeSVG" fill="currentColor" height="24" role="img"
                    viewBox="0 0 24 24" width="24">
                    <title>首頁</title>
                    <path
                        d="M9.005 16.545a2.997 2.997 0 0 1 2.997-2.997A2.997 2.997 0 0 1 15 16.545V22h7V11.543L12 2 2 11.543V22h7.005Z"
                        fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2">
                    </path>
                </svg>`;
            });
        });
    </script>
@endpush
