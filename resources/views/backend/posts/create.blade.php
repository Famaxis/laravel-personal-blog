@extends('layouts.backend')

@section('content')
        <h1>Create post</h1>
        <form method="POST" enctype="multipart/form-data" data-persist="garlic" action="{{ route('posts.store') }}"
              class="col-8">
            @csrf
            @include('backend.posts._form')

            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="Create post"/>
            </div>
        </form>
@endsection