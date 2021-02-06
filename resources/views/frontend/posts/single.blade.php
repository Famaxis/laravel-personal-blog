@extends('layouts.frontend')

@section('content')
    <div class="container">
        <article class="article">
            {!! $post->content !!}
        </article>
            <p>
                @if($next)

                    <a href="{{ $next->slug }}">
                        <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'><path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='48' d='M328 112L184 256l144 144'/></svg>
                        next</a>
                @endif

                @if($prev)
                    <a href="{{ $prev->slug }}">prev
                        <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'><path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='48' d='M184 112l144 144-144 144'/></svg>
                    </a>
                @endif
            </p>
        <p>
            <a href="{{ route('front.posts') }}">On main page</a>
        </p>

            @foreach($post->tags as $tag)
                <a class="paper-btn btn-small"
                   href="{{ route('front.posts.fetch', $tag->slug) }}">{{ $tag->name }}</a>
            @endforeach
        <hr class="margin-large">

{{--        Comments --}}
@include('frontend.comments._form')
@include('frontend.comments._list')

    </div>
@endsection