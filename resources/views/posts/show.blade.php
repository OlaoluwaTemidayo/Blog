@extends('layout')

@section('title', $post->title)

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        <p><small>Published on {{ $post->created_at->format('M d, Y') }}</small></p>
        <div>{{ $post->content }}</div>
    </article>

    <section>
        <h3>Comments</h3>

        <!-- Display Validation Errors (if any) -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @auth
            <!-- Comment Submission Form -->
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <textarea name="content" rows="3" placeholder="Write a comment..." required></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <button type="submit">Post Comment</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Log in</a> to comment.</p>
        @endauth

        <!-- Display Existing Comments -->
        <ul>
            @foreach($post->comments as $comment)
                <li>
                    <strong>{{ $comment->user->name }}:</strong>
                    <p>{{ $comment->content }}</p>
                    <small>Posted on {{ $comment->created_at->format('M d, Y') }}</small>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
