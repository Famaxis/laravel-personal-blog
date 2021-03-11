@extends('layouts.backend')

@section('content')
    <h1>Tags</h1>
    <div class="col-8">
        @foreach($tags as $tag)
            <a class="paper-btn btn-small"
               href="{{ route('posts.fetch', $tag->slug) }}">{!! $tag->name !!}</a>
        @endforeach
    </div>
@endsection