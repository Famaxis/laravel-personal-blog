@extends('layouts.plain')

@section('meta')
<meta name="description" content="{!! $resource->description !!}">
@endsection

@section('title'){{ $resource->title }} | @endsection

@section('styles')
<link href="{{ asset('css/templates/' . $resource->template->css) }}" rel="stylesheet">
    @if($resource->css)
        <link href="{{ asset('css/resources/' . $resource->css) }}" rel="stylesheet">
    @endif
@endsection

@section('content')
    @include('templates/' . $resource->template->file, compact('resource', 'next', 'prev'))
@endsection

@section('scripts')
    @if($resource->template->js)
        <script src="{{asset('js/templates/' . $resource->template->js) }}" type="text/javascript" charset="utf-8"></script>
    @endif
    @if($resource->js)
        <script src="{{asset('js/resources/' . $resource->js) }}" type="text/javascript" charset="utf-8"></script>
    @endif
@endsection