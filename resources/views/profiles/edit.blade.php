@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">編輯個人檔案</h1>
        <div class="edit-form">
            <div class="profile-edit">
                <div class="profile-container">
                    <div class="profile-avatar-edit">
                        <div class="avatar">
                            @if ($profile->avatar->image)
                                <img id="avatar" src="{{ asset('storage/' . $profile->avatar->image) }}">
                            @else
                                <img id="defaultAvatar" src="http://localhost:8080/Meal/public/images/user/user.png">
                            @endif
                        </div>
                    </div>
                    <div class="profile-item-edit">
                        <div class="profile-name">
                            <span class="profile-title username">{{ $profile->username }}</span>
                            <span class="profile-title name">{{ $user->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="profile-container">
                    <div class="profile-item-edit">
                        <div class="profile-img-edit">
                            @if ($profile->avatar->image != null)
                                <div id="change-photo" role="button" tablindex="0">變更相片</div>
                            @else
                                <label id="change-photo-default" for="avatar">變更相片</label>
                            @endif
                            <!-- Overlay -->
                            <div id="overlay" class="hidden"></div>

                            <!-- Popup Menu -->
                            <div id="avatar-container" class="avatar-container hidden">
                                <div class="avatar-menu">
                                    <div class="avatar-menu-title">變更大頭貼</div>
                                    <div class="avatar-button-container">
                                        <label id="upload-photo" class="avatar-title" for="avatar"
                                            style="color:#0095f6;">上傳相片</label>
                                        <form action="{{ route('profiles.removeAvatar') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button id="remove" class="avatar-title"
                                                style="color: #ed4956;">移除目前的大頭貼照</button>
                                        </form>
                                        <button id="cancel" class="avatar-title">取消</button>
                                    </div>

                                    <form id="profile-form" action="{{ route('profiles.avatar') }}" method="POST"
                                        enctype="multipart/form-data" hidden>
                                        @method('PUT')
                                        @csrf
                                        <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png" />
                                        <button type="submit">test</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('profiles.update', ['profile' => $profile]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-item">
                    <label for="username" class="form-field-name" >使用者名稱 </label>
                    <input type="text" class="form-control" name="username" id="username"
                        value="{{ $profile->username }}" placeholder="請輸入使用者名稱"/>
                </div>

                <div class="form-item">
                    <label for="gender" class="form-field-name">性別 </label>
                    <select name="gender" class="form-control" id="gender">
                        <option value="null" disabled selected>請選擇</option>
                        <option value="男">男</option>
                        <option value="女">女</option>
                        <option value="其他">其他</option>
                    </select>
                </div>

                <div class="form-item">
                    <label for="birthday" class="form-field-name">生日</label>
                    <input type="date" class="form-control" name="birthday" id=""
                        placeholder="{{ $profile->birthday }}"/>
                </div>

                <div class="form-item-textarea">
                    <label class="form-name-textarea">個人簡介</label>
                    <textarea name="bio" class="form-control-textarea" style="resize: none;"></textarea>
                </div>

                <div class="form-item-btn">
                    <input class="btn-primary" type="submit" value="提交" />
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var changePhoto = document.getElementById("change-photo");
            var removePhotoButton = document.getElementById("remove");
            var cancelButton = document.getElementById("cancel");
            var uploadPhoto = document.getElementById("upload-photo");
            var photoMenu = document.getElementById("avatar-container");
            var overlay = document.getElementById("overlay");

            changePhoto.addEventListener("click", function(event) {
                photoMenu.classList.remove("hidden");
                overlay.classList.remove("hidden");
            });

            removePhotoButton.addEventListener("click", function() {
                photoMenu.classList.add("hidden");
                overlay.classList.add("hidden");
            });

            cancelButton.addEventListener("click", function() {
                photoMenu.classList.add("hidden");
                overlay.classList.add("hidden");
            });

            // Hide the menu and overlay when clicking outside of the menu
            document.addEventListener("click", function(event) {
                if (!photoMenu.contains(event.target) && !changePhoto.contains(event.target)) {
                    photoMenu.classList.add("hidden");
                    overlay.classList.add("hidden");
                }
            });


        });


        document.addEventListener("DOMContentLoaded", function() {
            var avatarInput = document.getElementById("avatar");

            avatarInput.addEventListener("change", function() {
                var profileForm = document.getElementById("profile-form");
                profileForm.submit();
            });
        });
    </script>
@endsection
