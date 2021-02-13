@extends('layouts.backend')

@section('content')
<div class="container">
<h1>Tags</h1>
    @foreach($tags as $tag)
        <a class="paper-btn btn-small"
           href="{{ route('posts.fetch', $tag->slug) }}">{!! $tag->name !!}</a>
    @endforeach
</div>
@endsection