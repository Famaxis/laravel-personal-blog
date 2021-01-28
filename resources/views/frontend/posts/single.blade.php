@extends('layouts.frontend')

@section('content')
    <div class="container">
        <article class="article">
            <h1 class="article-title">{!! $post->title !!}</h1>

            {!! $post->content !!}

        </article>
    </div>
@endsection