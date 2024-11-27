@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <style>
            .show-container {
                position: relative;
                width: 100%;
                height: 100vh;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;

            }

            .background {
                position: absolute;
                background-image: url('https://i.pinimg.com/originals/95/db/dd/95dbdd16dcf11d3fd60c4e19b963b8c0.jpg');
                background-size: cover;
                background-position: center;
                opacity: 0.3;
                width: 100%;
                height: 100vh;
                z-index: 0;
            }

            .overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background-color: rgba(0, 0, 0, 0.2);
                z-index: 0;
            }

            .title {
                color: #8B5E34;
                font-size: 30px;
                font-weight: 700;
                text-align: center;
            }

            .post-data-container {
                position: relative;
                background: #fef8f2;
                border: 1px solid #dddddd00;
                padding: 30px 60px;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 1;
            }

            .post-edit {
                position: absolute;
                top: 0;
                right: 0;
                padding: 20px 30px;
            }

            .edit-btn {
                text-decoration: none;
                color: #8B5E34;
                font-size: 18px;
            }

            .edit-btn:hover {
                font-weight: 600;
            }

            .show-item-container {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: start;
                border-radius: 10px;
                margin: 15px;
                color: #8B5E34;
            }

            .show-item {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 10px;
                font-size: 25px;
                font-weight: 700;
            }

            .show-item span {
                font-weight: 500;
            }

            .data {
                margin: 0 10px;
            }

            input {
                display: block;
                width: 100%;
                line-height: 40px;
                border-radius: 25px;
                background-color: #A67B5B;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                border: none;
                font-size: 20px;
                font-weight: 700;
                color: white;
                letter-spacing: 1px;
            }

            input:hover {
                background-color: #7A5230;
                cursor: pointer;
            }

            input:active {
                box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
                transform: translate(2px 4px);
            }

            .button {
                padding: 10px;
                border-radius: 8px;
            }

            .already-join {
                display: flex;
                justify-content: center;
            }

            .eat {
                text-align: center;
                border-radius: 15px;
                background-color: #7A5230;
                color: #fff;
                width: 100px;
                padding: 2px;
                font-size: 13px;
            }
        </style>
    </head>

    <body>
        <div class="show-container">
            <div class="background"></div>
            <div class="overlay"></div>
            <div class="post-data-container">
                @if ($postOwner)
                    <div class="post-edit">
                        <a href="{{ route('posts.edit', ['post' => $post]) }}" class="edit-btn">
                            <span>編輯</span>
                        </a>
                    </div>
                @endif


                @if ($exist)
                    <div class="already-join">
                        <div class="eat"><span>已參加此飯局!</span></div>
                    </div>
                @endif
                <div class="title">{{ $post->title }}</div>

                <div class="show-item-container">
                    <div class="show-item">
                        <span>餐廳 : </span>
                        <span class="data">{{ $post->restaurant }}</span>
                    </div>
                    <div class="show-item">
                        <span>日期 : </span>
                        <span class="data">{{ $post->date }}</span>
                    </div>
                    <div class="show-item">
                        <span>時間 : </span>
                        <span class="data">{{ $post->time }}</span>
                    </div>
                    <div class="show-item">
                        <span>備註 : </span>
                        <span class="data">{{ $post->content }}</span>
                    </div>
                    <div class="show-item">
                        <span>
                            <div class="avatarShow-container">
                                <div class="user-list">
                                    <div class="avatar-relative">
                                        <a href="{{ route('profiles.postUsers', ['post' => $post]) }}" class="user-list">
                                            @foreach ($avatars as $index => $avatar)
                                                @if ($index < 3)
                                                    <div class="avatarShow show"
                                                        style="transform: translate({{ $index * 20 }}px); z-index: {{ $index + 1 }}; left: 0;">
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
                        </span>
                    </div>
                </div>
                @if ($postOwner && $post->status == 1)
                    <form action="{{ route('posts.endPost') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                        <div class=button>
                            <input type="submit" value="結束飯局">
                        </div>
                    </form>
                @endif

                @if (!$exist)
                    <form action="{{ route('post_user.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                        <div class=button>
                            <input type="submit" value="加入飯局">
                        </div>
                    </form>
                @endif


                <!-- error msg -->
                @if ($errors->any())
                    <div class="error-msg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="error">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>

    </body>

    </html>
@endsection
