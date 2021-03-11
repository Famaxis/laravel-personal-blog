@extends('layouts.frontend')

@section('meta')
    <meta name="description" content="{!! $resource->description !!}">
@endsection

@section('styles')
    <link href="{{ asset('css/colors/' . $resource->default_template . '.css') }}" rel="stylesheet">
    @if($resource->css)
        <link href="{{ asset('css/resources/' . $resource->css) }}" rel="stylesheet">
    @endif
@endsection

@if($resource->title)
    @section('title'){!! $resource->title !!} |@endsection
@endif

@section('content')
        <article class="article">
            {!! $resource->contents !!}
        </article>

        <p>
            <a href="{{ route('front.posts') }}">On main page</a>
        </p>

        <hr class="margin-large">
@endsection

@if($resource->js)
    @section('scripts')
        <script src="{{asset('js/resources/' . $resource->js) }}" type="text/javascript" charset="utf-8"></script>
    @endsection
@endif