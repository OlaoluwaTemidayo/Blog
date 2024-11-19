@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blog Posts</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

    @if ($posts->count())
        <ul class="list-group">
            @foreach ($posts as $post)
                <li class="list-group-item">
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </li>
            @endforeach
        </ul>

        {{ $posts->links() }}
    @else
        <p>No posts available.</p>
    @endif
</div>
@endsection
