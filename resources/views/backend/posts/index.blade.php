@extends('layouts.backend')

@section('content')

    @if(Route::current()->getName() === 'posts.fetch')
       <h1>Posts tagged with {!! $tag->name !!}</h1>
    @endif

    <table class="table-alternating">
        <thead>
        <th>Description</th>
        <th>Post</th>
        <th style="min-width: 10rem;">Tags</th>
        <th>First Sentence</th>
        <th>Template</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr @if(!$post->is_published)
                    class="unpublished"
                @endif
            >
                <td>{!! $post->description!!}</td>
                <td>{!! $post->content !!}</td>
                <td>
                    @foreach($post->tags as $tag)
                        <a class="paper-btn btn-small"
                           href="{{ route('posts.fetch', $tag->slug) }}">{!! $tag->name !!}</a>
                    @endforeach
                </td>
                <td>{!! $post->first_sentence !!}</td>
                <td>{!! $post->template !!}</td>
                <td>
                    <a href="{{ route('front.posts.show',$post->slug) }}" class="paper-btn btn-secondary-outline">Read</a>
                    <a href="{{ route('posts.edit', $post->slug) }}" class="paper-btn btn-success-outline">Edit</a>
                    <form action="{{route('posts.destroy', $post->slug)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="paper-btn btn-danger-outline">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $posts->links() !!}
@endsection