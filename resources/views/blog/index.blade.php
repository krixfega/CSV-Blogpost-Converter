<!-- resources/views/blog/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h1>Blog Posts</h1>
        @foreach ($posts as $post)
            <div>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
            </div>
        @endforeach
    </div>
@endsection
