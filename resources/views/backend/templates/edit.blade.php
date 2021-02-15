@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Update Page</h1>

        <form method="post" enctype="multipart/form-data" data-persist="garlic" action="{{ route('templates.update', $template->id) }} ">
            @csrf
            @include('backend.templates._form')

            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="Update template"/>
            </div>
        </form>
    </div>
@endsection