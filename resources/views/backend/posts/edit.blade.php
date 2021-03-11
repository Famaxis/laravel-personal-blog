@extends('layouts.backend')

@section('content')
    <h1>Update post</h1>
    <form method="POST" enctype="multipart/form-data" data-persist="garlic"
          action="{{ route('posts.update', $post->slug) }}" class="col-8">
        @csrf
        @include('backend.posts._form')

        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Update post"/>
        </div>
    </form>
@endsection