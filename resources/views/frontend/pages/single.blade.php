@extends('layouts.frontend')

@section('meta')
<meta name="description" content="{!! $page->description !!}">
@endsection

@section('styles')
<link href="{{ asset('css/colors/' . $page->template . '.css') }}" rel="stylesheet">
@endsection

@section('title')
{!! $page->title !!} |
@endsection

@section('content')
    <div class="container">
        <article class="article">
            {!! $page->contents !!}
        </article>

        <p>
            <a href="{{ route('front.posts') }}">On main page</a>
        </p>

        <hr class="margin-large">

    </div>
@endsection