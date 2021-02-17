@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Create post</h1>

        <form method="POST" enctype="multipart/form-data" data-persist="garlic" action="{{ route('posts.store') }}">
            @csrf
            @include('backend.posts._form')

            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="Create post"/>
            </div>
        </form>
    </div>
@endsection