@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                    <th>Title</th>
                    <th>Post</th>
                    <th>Tags</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{!! $post->title !!}</td>
                            <td>{!! $post->content !!}</td>
                            <td>

                                @foreach($post->tags as $tag)
                                    <a href="{{ route('posts.fetch', $tag->slug) }}">{!! $tag->name !!}</a>
                                @endforeach

                            </td>
                            <td>
                                <a href="/" class="btn btn-sm btn-outline-primary py-0">Read Post</a>
                                <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-sm btn-outline-success py-0">Edit Post</a>
                                <form action="{{route('post.destroy', $post->slug)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger py-0">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection