@extends('layouts.frontend')

@section('meta')
    <meta name="description" content="{{ $resource->first_sentence }}">
@endsection

@section('styles')
    <link href="{{ asset('css/colors/' . $resource->default_template . '.css') }}" rel="stylesheet">
    @if($resource->css)
        <link href="{{ asset('css/resources/' . $resource->css) }}" rel="stylesheet">
    @endif
@endsection

@section('title'){{ $resource->first_sentence }} | @endsection

@section('content')
    <div class="container">
        <article class="article">
            {!! $resource->contents !!}
        </article>
        <p>
            @if($next)

                <a href="{{ $next->slug }}">
                    <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                        <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round'
                              stroke-width='48' d='M328 112L184 256l144 144'/>
                    </svg>
                    next</a>
            @endif

            @if($prev)
                <a href="{{ $prev->slug }}">prev
                    <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                        <path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round'
                              stroke-width='48' d='M184 112l144 144-144 144'/>
                    </svg>
                </a>
            @endif
        </p>
        <p>
            <a href="{{ route('front.posts') }}">On main page</a>
        </p>

        @foreach($resource->tagged as $tagged)
            <a class="paper-btn btn-small"
               href="{{ route('front.posts.fetch', $tagged->tag_slug) }}">{{ $tagged->tag_name }}</a>
        @endforeach
        <hr class="margin-large">

        {{--        Comments --}}
        @if($settings->comments_allowed)
            @include('frontend.comments._form')
        @endif
        @include('frontend.comments._list')

    </div>
@endsection

@section('scripts')
    @if($resource->has_image)
        <script src="{{asset('js/lightbox.js') }}" type="text/javascript" charset="utf-8"></script>
    @endif

    @if($resource->js)
        <script src="{{asset('js/resources/' . $resource->js) }}" type="text/javascript" charset="utf-8"></script>
    @endif
@endsection
