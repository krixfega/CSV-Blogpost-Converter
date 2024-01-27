@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>All Blog Posts</h2>
                @foreach($posts as $post)
                    <h3><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
                    <p>{{ $post->created_at->format('F j, Y') }}</p>

                    <!-- Add Edit link here -->
                    <p><a href="{{ route('posts.edit', $post->id) }}">Edit</a></p>

                    <hr>
                @endforeach
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <h2>Blog Post Titles</h2>
                    <ul class="list-group">
                        @foreach($posts as $post)
                            <li class="list-group-item">
                                <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
