@extends('layouts.app')

@section('content')
    <style>
        .post-shoe-container {
            widows: 100%;
            display: flex;
            flex-direction: column;
            margin-top: 50px;
        }

        .title {
            display: flex;
            align-items: center;
            justify-content: start;
            height: 50px;
            width: 100%;
        }

        .title-item {
            display: flex;
            align-items: center;
        }

        .title-item img {
            height: 100%;
            width: auto;
        }

        .page-title {
            margin-left: 20px;
        }

        .all-posts {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            padding: 10px;
            gap: 20px;
        }

        .post-container {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            height: 100%;
            width: 100%;
            overflow: hidden;
            display: flex;
            text-align: center;
            flex-direction: column;
        }

        .post-container:hover {
            background-color: #ffd5bb55;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            height: 100%;
            width: 100%;
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .post-link {
            display: block;
            width: 30%;
            height: 200px;
            text-decoration: none;
            font-size: 23px;
            font-weight: 600;
            margin: 10px 10px;
        }

        .post-container .post {
            display: flex;
            flex-direction: column;
            padding: 30px;
        }

        .post-title {
            display: flex;
            flex-direction: column;
            background-color: #8c4c1fba;
            color: #fff;
            font-size: 25px;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 20px;
        }

        .post-title div {
            text-align: start;
        }

        #post-time {
            font-size: 15px;
            font-weight: 500;
        }

        .post-content {
            display: flex;
            justify-content: start;
            text-decoration: none;
            color: #69412d;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            margin-left: 15px;
        }
    </style>


    <body>
        <div class="container">
            <div class="post-shoe-container">
                <div class="title">
                    <div class="title-item">
                        <svg width="28" height="33" viewBox="0 0 20 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.11011 8H6.11011V1H4.11011V8H2.11011V1H0.110107V10H4.11011V14H2.11011V25C2.11011 25.7956 2.42618 26.5587 2.98879 27.1213C3.5514 27.6839 4.31446 28 5.11011 28C5.90576 28 6.66882 27.6839 7.23143 27.1213C7.79404 26.5587 8.11011 25.7956 8.11011 25V14H6.11011V10H10.1101V1H8.11011V8ZM6.11011 25C6.11011 25.2652 6.00475 25.5196 5.81721 25.7071C5.62968 25.8946 5.37532 26 5.11011 26C4.84489 26 4.59054 25.8946 4.403 25.7071C4.21546 25.5196 4.11011 25.2652 4.11011 25V16H6.11011V25Z"
                                fill="#4B2E20" />
                            <path
                                d="M22.1101 7V4C22.1101 2.93913 21.6887 1.92172 20.9385 1.17157C20.1884 0.421427 19.171 0 18.1101 0C17.0492 0 16.0318 0.421427 15.2817 1.17157C14.5315 1.92172 14.1101 2.93913 14.1101 4V7C14.113 7.88456 14.409 8.74321 14.9518 9.44164C15.4946 10.1401 16.2536 10.6389 17.1101 10.86V14H15.1101V25C15.1101 25.7956 15.4262 26.5587 15.9888 27.1213C16.5514 27.6839 17.3145 28 18.1101 28C18.9058 28 19.6688 27.6839 20.2314 27.1213C20.794 26.5587 21.1101 25.7956 21.1101 25V14H19.1101V10.86C19.9666 10.6389 20.7256 10.1401 21.2684 9.44164C21.8112 8.74321 22.1072 7.88456 22.1101 7ZM19.1101 25C19.1101 25.2652 19.0048 25.5196 18.8172 25.7071C18.6297 25.8946 18.3753 26 18.1101 26C17.8449 26 17.5905 25.8946 17.403 25.7071C17.2155 25.5196 17.1101 25.2652 17.1101 25V16H19.1101V25ZM16.1101 7V4C16.1101 3.46957 16.3208 2.96086 16.6959 2.58579C17.071 2.21071 17.5797 2 18.1101 2C18.6405 2 19.1492 2.21071 19.5243 2.58579C19.8994 2.96086 20.1101 3.46957 20.1101 4V7C20.1101 7.53043 19.8994 8.03914 19.5243 8.41421C19.1492 8.78929 18.6405 9 18.1101 9C17.5797 9 17.071 8.78929 16.6959 8.41421C16.3208 8.03914 16.1101 7.53043 16.1101 7Z"
                                fill="#4B2E20" />
                        </svg>
                    </div>
                    <div class="title-item">
                        <h1 class="page-title">我要假奔</h1>
                    </div>
                </div>
                <div class="all-posts">
                    @foreach ($postLists as $post)
                            <a class="post-link" href="{{ route('posts.show', ['post' => $post]) }}">
                                <div class="post-container">
                                    <div class="post-title">
                                        <div id="post-time">
                                            {{ $timeCreateds[$post->id] }}
                                        </div>
                                        <div>
                                            {{ $post->title }}
                                        </div>
                                    </div>
                                    <div class="post-content">
                                        餐廳 : {{ $post->restaurant }}
                                    </div>
                                    <div class="post-content">
                                        {{ $post->date }}
                                    </div>
                                </div>
                            </a>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
@endsection

@push('scripts')
    <script>
        window.onload = function() {
            var joinSVG = document.getElementById('joinSVG');
            if (joinSVG) {
                // Clear existing content
                joinSVG.innerHTML = '';

                // Add new SVG content
                joinSVG.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.45 20.9C16.6691 20.9 20.9 16.6691 20.9 11.45C20.9 6.23091 16.6691 2 11.45 2C6.23091 2 2 6.23091 2 11.45C2 16.6691 6.23091 20.9 11.45 20.9ZM11.45 5.05004C10.6095 5.05004 9.77731 5.21558 9.00083 5.53721C8.22435 5.85884 7.51882 6.33026 6.92452 6.92455C6.33023 7.51885 5.85881 8.22438 5.53718 9.00086C5.21555 9.77735 5.05 10.6096 5.05 11.45C5.05 12.0023 5.49772 12.45 6.05 12.45C6.60229 12.45 7.05 12.0023 7.05 11.45C7.05 10.8722 7.16381 10.3001 7.38493 9.76623C7.60606 9.2324 7.93016 8.74734 8.33873 8.33877C8.74731 7.93019 9.23236 7.60609 9.7662 7.38497C10.3 7.16385 10.8722 7.05004 11.45 7.05004C12.0023 7.05004 12.45 6.60232 12.45 6.05004C12.45 5.49775 12.0023 5.05004 11.45 5.05004Z"
                        fill="currentColor" />
                    <path d="M23 23L20 20" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" />
                </svg>`;

                var navLinks = document.querySelectorAll('.nav-link');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        joinSVG.innerHTML = `
                        <svg id="joinSVG" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="10.5" r="8.5" stroke="currentColor"
                                stroke-width="2" />
                            <path
                                d="M11 6C10.4747 6 9.95457 6.10346 9.46927 6.30448C8.98396 6.5055 8.54301 6.80014 8.17157 7.17157C7.80014 7.54301 7.5055 7.98396 7.30448 8.46927C7.10346 8.95457 7 9.47471 7 10"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M23 22L18 17" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>`;
                    });
                });
            }
        };
    </script>
@endpush
