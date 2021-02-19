@extends('layouts.plain')

@section('meta')
<meta name="description" content="{!! $resource->description !!}">
@endsection

@section('title'){{ $resource->title }} | @endsection

@section('styles')
<link href="{{ asset('css/templates/' . $resource->template->css) }}" rel="stylesheet">
<link href="{{ asset('css/resources/' . $resource->css) }}" rel="stylesheet">
@endsection

@section('content')
    @include('templates/' . $resource->template->file, compact('resource'))
@endsection

@section('scripts')
    <script src="{{asset('js/templates/' . $resource->template->js) }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('js/resources/' . $resource->js) }}" type="text/javascript" charset="utf-8"></script>
@endsection