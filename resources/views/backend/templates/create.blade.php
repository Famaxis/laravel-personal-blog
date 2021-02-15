@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Create Page</h1>

        <form method="post" enctype="multipart/form-data" data-persist="garlic" action="{{ route('templates.store') }}">
            @csrf
            @include('backend.templates._form')

            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="Create template"/>
            </div>
        </form>
    </div>
@endsection