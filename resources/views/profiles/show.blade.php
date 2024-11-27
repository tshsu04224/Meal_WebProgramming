@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-avatar">
                <div class="avatar">
                    @if ($profile->avatar->image)
                        <img src="{{ asset('storage/' . $profile->avatar->image) }}">
                    @else
                        <img src="http://localhost:8080/Meal/public/images/user/user.png">
                    @endif
                </div>
            </div>
            <div class="profile-item-container">
                <div class="profile-item">
                    <div class="profile-name">
                        @if ($profile->username)
                            <span class="profile-title username">{{ $profile->username }}</span>
                        @else
                            <span class="profile-title">尚未填寫使用者名稱</span>
                        @endif
                        <span class="profile-title name">{{ $profile->user->name }}</span>
                    </div>
                </div>

                <div class="profile-item">
                    @if ($profile->gender)
                        <span class="profile-title">性別 : </span>
                        <span class="profile-title">{{ $profile->gender }}</span>
                    @else
                        <span class="profile-title">尚未填寫性別</span>
                    @endif
                </div>
                <div class="profile-item">
                    @if ($profile->birthday)
                        <span class="profile-title">生日 : </span>
                        <span class="profile-title">{{ $profile->birthday }}</span>
                    @else
                        <span class="profile-title">尚未填寫生日</span>
                    @endif
                </div>

                <div class="profile-item">
                    @if ($profile->bio)
                        <span class="profile-title">個人簡介 : </span>
                        <span class="profile-title">{{ $profile->bio }}</span>
                    @else
                        <span class="profile-title">尚未填寫個人簡介</span>
                    @endif
                </div>

                <div class="profile-item">
                    <span class="profile-title">加入日期 ：{{ $user->created_at->format('M d, Y') }}</span>
                </div>

                @if ($profile->user == Auth::user())
                    <div class="profile-item">
                        <a class="profile-link" href="{{ route('profiles.edit', ['profile' => Auth::user()]) }}">編輯個人檔案</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.onload = function() {
            var profileSVG = document.getElementById('profileSVG');
            if (profileSVG) {
                // Clear existing content
                profileSVG.innerHTML = '';

                // Add new SVG content
                profileSVG.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 1C5.92487 1 1 5.92487 1 12C1 15.8854 3.01448 19.3004 6.05596 21.2573C6.03492 21.2071 6.03047 21.1503 6.04624 21.0954C6.41914 19.7982 7.17876 18.6542 8.21858 17.8284C9.30341 16.967 10.6326 16.5 12 16.5C13.3674 16.5 14.6966 16.967 15.7814 17.8284C16.8212 18.6542 17.5809 19.7982 17.9538 21.0954C17.9695 21.1503 17.9651 21.2071 17.944 21.2573C20.9855 19.3004 23 15.8854 23 12C23 5.92487 18.0751 1 12 1ZM12 6C9.79086 6 8 7.79086 8 10C8 12.2091 9.79086 14 12 14C14.2091 14 16 12.2091 16 10C16 7.79086 14.2091 6 12 6Z"
                        fill="currentColor" />
                </svg>
                `;

                var navLinks = document.querySelectorAll('.nav-link');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        profileSVG.innerHTML = `
                        <svg id="profileSVG" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="10" r="3" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" />
                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="2" />
                            <path
                                d="M17.8566 19.8659C17.9429 19.805 17.9829 19.6969 17.9538 19.5954C17.5809 18.2982 16.8212 17.1542 15.7814 16.3284C14.6966 15.467 13.3674 15 12 15C10.6326 15 9.30341 15.467 8.21858 16.3284C7.17876 17.1542 6.41914 18.2982 6.04624 19.5954C6.01707 19.6969 6.05708 19.805 6.14335 19.8659V19.8659C9.65447 22.3443 14.3455 22.3443 17.8566 19.8659V19.8659Z"
                                fill="currentColor" />
                        </svg>`;
                    });
                });
            }
        };
    </script>
@endpush
