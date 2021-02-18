@extends('layouts.frontend')

@section('meta')
<meta name="description" content="{!! $resource->description !!}">
@endsection

@section('styles')
<link href="{{ asset('css/colors/' . $resource->template . '.css') }}" rel="stylesheet">
@endsection

@section('title')
{!! $resource->title !!} |
@endsection

@section('content')
    <div class="container">
        <article class="article">
            {!! $resource->contents !!}
        </article>

        <p>
            <a href="{{ route('front.posts') }}">On main page</a>
        </p>

        <hr class="margin-large">

    </div>
@endsection