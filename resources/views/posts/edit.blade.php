@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">更新飯局</h1>

        <div class="form">
            <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-item">
                    <label for="name" class="form-field-name">標題:</label>
                    <input type="text" class="form-control" name="restaurant" id="restaurant" value="{{ $post->title }}"
                        required /><br>
                </div>

                <div class="form-item">
                    <label for="name" class="form-field-name">餐廳:</label>
                    <input type="text" class="form-control" name="restaurant" id="restaurant"
                        value="{{ $post->restaurant }}" required /><br>
                </div>

                <div class="form-item">
                    <label for="time" class="form-field-name">時間:</label>
                    <input type="text" class="form-control" name="time" id="time"
                        value="{{ $post->time }}" /><br>
                </div>
                <div class="form-item-textarea">
                    <label class="form-field-name">備註:</label>
                    <textarea name="content" class="form-control-textarea" style="resize: none;">{{ $post->content }}</textarea><br>
                </div>

                <div class="form-item-btn">
                    <input class="btn-primary" type="submit" value="確認" />
                    <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input class="btn-primary" type="button" value="刪除" onclick="showDeleteModal()">
                    </form>
                </div>
            </form>
        </div>
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <div class="delete-item">
                    <span>確定刪除飯局？</sapn>
                </div>
                <div class="delete-item">
                    <form id="delete-form" action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="delete-item-form">
                            <div class="delete-btn">
                                <div type="button" onclick="closeDeleteModal()">取消</div>
                            </div>
                            <div class="delete-btn" id="danger">
                                <div type="submit">確認刪除</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showDeleteModal() {
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            var avatarInput = document.getElementById("danger");

            avatarInput.addEventListener("click", function() {
                var deleteForm = document.getElementById("delete-form");
                deleteForm.submit();
            });
        });

        window.onclick = function(event) {
            var modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
