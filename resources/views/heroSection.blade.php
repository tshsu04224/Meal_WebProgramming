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
    <div class="heroSection">
        <div class="section-container">
            <header class="header">
                <div class="header-item">
                    <a class="nav-link-brand" href="#">
                        <img src="http://localhost:8080/Meal/public/images/logo.svg" alt="logo" height="40px"
                            width="100px" />
                    </a>
                </div>
                <div class="header-item">
                    <h1 class="home-title">覓得你的專屬飯友</h1>
                </div>
                <div class="user-actions">
                    <a href="{{ route('login') }}" class="header-login"><span>Log in</span></a>
                    <a href="{{ route('register') }}" class="header-signup"><span>Sign up</span></a>
                    <div class="placeholder"></div>
                </div>
            </header>

            <div class="rectangle1">
                <div class="rectangle-container">
                    <div class="rect-item">
                        <img src="{{ asset('images\home-create.jpg') }}" class="section-img" />
                    </div>
                    <div class="rect-item content">
                        <div class="small-title" style="width: 504.4px; height: 75.06px; left: 500px; top: 35px;">
                            <h3 class="section-title">好餓喔， 揪人一起吃！</h2>
                        </div>
                        <div class="home-context" style="width: 565px; height: 141px; left: 500px; top: 120px">
                            交友圈逐漸固定，生活變得枯燥乏味？<br>
                            創建專屬飯局，一起改變現狀吧！<br>
                            無論是想認識新朋友，還是尋找口味相同的夥伴，<br>
                            交給『Meal 覓友』，幫你打破生活的沉悶。<br>
                        </div>
                    </div>
                    <div class="rect-item">
                        <button onclick="location.href='{{ route('posts.create') }}'" class="home-btn"
                            style="left: 1025px; top: 100px">
                            創<br>建<br>飯<br>局
                        </button>
                    </div>
                </div>
            </div>

            <div class="rectangle2">
                <div class="rectangle-container">
                    <div class="rect-item">
                        <button onclick="location.href='{{ route('surprise') }}'" class="home-btn"
                            style="left: 70px; top: 100px">
                            驚<br>喜<br>包
                        </button>
                    </div>

                    <div class="rect-item content">
                        <div class="small-title" style="width: 504.4px; height: 75.06px; left: 500px; top: 35px;">
                            <h3 class="section-title">好無聊，來點驚喜吧！</h3>
                        </div>
                        <div class="home-context" style="width: 565px; height: 141px; left: 180px; top: 120px">
                            厭倦了制式化的交友方式嗎？<br>
                            『Meal 覓友』提供全新的驚喜包體驗，<br>
                            每次見面都是未知的探索，為生活增添無限趣味，<br>
                            現在就開始享受全新的交友世界吧！
                        </div>
                    </div>

                    <div class="rect-item">
                        <img src="{{ asset('images\home-surprise.jpg') }}" class="section-img" />
                    </div>
                </div>
            </div>

            <div class="rectangle3">
                <div class="rectangle-container">
                    <div class="rect-item">
                        <img src="{{ asset('images\home-join.jpg') }}" class="section-img" />
                    </div>
                    <div class="rect-item content">
                        <div class="small-title" style="width: 504.4px; height: 75.06px; left: 500px; top: 35px;">
                            <span class="section-title">隨便啦，我就想吃飯！</span>
                        </div>
                        <div class="home-context" style="width: 565px; height: 141px; left: 500px; top: 120px">
                            時間彈性，不挑餐廳，還是找不到飯友？<br>
                            現在就加入已有的飯局吧！<br>
                            『Meal 覓友』帶你走入他人的世界，<br>
                            無論何人何時何地，都可以開啟一場交友盛宴！
                        </div>
                    </div>
                    <div class="rect-item">
                        <button onclick="location.href='{{ route('posts.index') }}'" class="home-btn"
                            style="left: 1025px; top: 100px">
                            加<br>入<br>飯<br>局
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
