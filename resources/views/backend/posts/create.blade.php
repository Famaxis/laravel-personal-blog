@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Create Post</h1>
        @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form enctype="multipart/form-data" method="post" action="{{ route('posts.store') }}">
            @csrf
            @include('backend.posts._form')

            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="Create post"/>
            </div>
        </form>
    </div>
@endsection