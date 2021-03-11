@extends('layouts.backend')

@section('content')
    <h1>Create template</h1>
    <form method="POST" enctype="multipart/form-data" data-persist="garlic" action="{{ route('templates.store') }}"
          class="col-8">
        @csrf
        @include('backend.templates._form')

        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Create template"/>
        </div>
    </form>
@endsection