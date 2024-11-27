@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">我的飯局</h1>
        <hr>
        @foreach ($posts as $post)
            <a class="link" href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->restaurant }}</a>
            <hr>
        @endforeach

    </div>
@endsection
