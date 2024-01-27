@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Blog Post</h2>
        <form method="post" action="{{ route('blog.update', $post) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="8" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
