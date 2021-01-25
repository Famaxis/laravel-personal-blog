@extends('layouts.backend')

@section('content')
    <table class="table-alternating">
        <thead>
        <th>Title</th>
        <th>Post</th>
        <th style="min-width: 10rem;">Tags</th>
        <th>Template</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{!! $post->title !!}</td>
                <td>{!! $post->content !!}</td>
                <td>
                    @foreach($post->tags as $tag)
                        <a class="paper-btn btn-small"
                           href="{{ route('posts.fetch', $tag->slug) }}">{!! $tag->name !!}</a>
                    @endforeach

                </td>
                <td>{!! $post->template !!}</td>
                <td>
                    <a href="/" class="paper-btn btn-secondary-outline">Read Post</a>
                    <a href="{{ route('posts.edit', $post->slug) }}" class="paper-btn btn-success-outline">Edit Post</a>
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