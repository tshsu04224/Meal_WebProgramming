@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">創建飯局</h1>

        <div class="form">
            <div class="form-container">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <div class="form-item">
                        <label for="title" class="form-field-name">標題 :</label>
                        <input type="text" class="form-control" name="title" id="title" required />
                    </div>

                    <div class="form-item">
                        <label for="restaurant" class="form-field-name">餐廳 :</label>
                        <input type="text" class="form-control" name="restaurant" id="restaurant" required />
                    </div>


                    <div class="form-item">
                        <label for="date" class="form-field-name">日期 :</label>
                        <input type="date" class="time-form-control" name="date" value="<?= date('Y-m-d') ?>" />

                        <label for="time" class="form-field-name">時間 :</label>
                        <input type="time" class="time-form-control" id="time" name="time"
                            value="<?= date('H:00', strtotime('+1 hour')) ?>" step="3600">
                    </div>

                    <div class="form-item-textarea">
                        <label class="form-name-textarea">備註 :</label>
                        <textarea name="content" class="form-control-textarea" style="resize: none;"></textarea>
                    </div>
                    @if ($errors->any())
                        <div class="error-msg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="error">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-item-btn">
                        <input class="btn-primary" type="submit" value="送出" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.onload = function() {
            var createSVG = document.getElementById('createSVG');
            if (createSVG) {
                // Clear existing content
                createSVG.innerHTML = '';

                // Add new SVG content
                createSVG.innerHTML = `
                    <svg aria-label="新貼文" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor"
                        height="24" role="img" viewBox="0 0 24 24" width="24">
                        <title>新貼文</title>
                        <path
                            d="M2 12v3.45c0 2.849.698 4.005 1.606 4.944.94.909 2.098 1.608 4.946 1.608h6.896c2.848 0 4.006-.7 4.946-1.608C21.302 19.455 22 18.3 22 15.45V8.552c0-2.849-.698-4.006-1.606-4.945C19.454 2.7 18.296 2 15.448 2H8.552c-2.848 0-4.006.699-4.946 1.607C2.698 4.547 2 5.703 2 8.552Z"
                            fill="currentColor" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"></path>
                        <line fill="none" stroke="#fef8f2" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" x1="6.545" x2="17.455"
                            y1="12.001" y2="12.001"></line>
                        <line fill="none" stroke="#fef8f2" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" x1="12.003" x2="12.003"
                            y1="6.545" y2="17.455"></line>
                    </svg>`;

                var navLinks = document.querySelectorAll('.nav-link');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        createSVG.innerHTML = `
                        <svg aria-label="新貼文" id="createSVG" fill="currentColor" height="24" role="img"
                            viewBox="0 0 24 24" width="24">
                            <title>新貼文</title>
                            <path
                                d="M2 12v3.45c0 2.849.698 4.005 1.606 4.944.94.909 2.098 1.608 4.946 1.608h6.896c2.848 0 4.006-.7 4.946-1.608C21.302 19.455 22 18.3 22 15.45V8.552c0-2.849-.698-4.006-1.606-4.945C19.454 2.7 18.296 2 15.448 2H8.552c-2.848 0-4.006.699-4.946 1.607C2.698 4.547 2 5.703 2 8.552Z"
                                fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"></path>
                            <line fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" x1="6.545" x2="17.455"
                                y1="12.001" y2="12.001"></line>
                            <line fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" x1="12.003" x2="12.003"
                                y1="6.545" y2="17.455"></line>
                        </svg>`;
                    });
                });
            }
        };
    </script>
@endpush
