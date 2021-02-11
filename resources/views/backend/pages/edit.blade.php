@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Update Page</h1>

        <form method="post" enctype="multipart/form-data" data-persist="garlic" action="{{ route('pages.update', $page->slug) }} ">
            @csrf
            @include('backend.pages._form')

            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="Update page"/>
            </div>
        </form>
    </div>
@endsection