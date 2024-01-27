@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->created_at->format('F j, Y') }}</p>
                <p>{!! $post->content !!}</p>
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <h2>Blog Post Titles</h2>
                    <ul class="list-group">
                        @foreach($posts as $p)
                            <li class="list-group-item">
                                <a href="{{ route('blog.show', $p) }}">{{ $p->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
