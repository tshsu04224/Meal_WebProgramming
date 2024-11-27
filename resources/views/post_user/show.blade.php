@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">{{ $user->name }} 的飯局</h1>
    <ul>
        @foreach($posts as $post)
            <li>{{ $post->restaurant }}</li>
        @endforeach
    </ul>
</div>
@endsection