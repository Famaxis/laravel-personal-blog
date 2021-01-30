@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Update Post</h1>

        <form method="post" enctype="multipart/form-data" data-persist="garlic" action="{{ route('posts.update', $post->slug) }} ">
            @csrf
            @include('backend.posts._form')

            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="Update post"/>
            </div>
        </form>
    </div>
@endsection