@extends('layout')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Blog Post</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Update Post</button>
    </form>
@endsection
