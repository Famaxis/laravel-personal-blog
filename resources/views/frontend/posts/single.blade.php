@extends('layouts.frontend')

@section('content')
    <div class="container">
        <article class="article">
            <h1 class="article-title">{!! $post->title !!}</h1>

            {!! $post->content !!}

            @foreach($post->tags as $tag)
                <a class="paper-btn btn-small"
                   href="{{ route('posts.fetch', $tag->slug) }}">{!! $tag->name !!}</a>
            @endforeach

        </article>
    </div>
@endsection