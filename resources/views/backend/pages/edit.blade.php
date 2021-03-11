@extends('layouts.backend')

@section('content')
    <h1>Update page</h1>
    <form method="POST" enctype="multipart/form-data" data-persist="garlic"
          action="{{ route('pages.update', $page->slug) }}" class="col-8">
        @csrf
        @include('backend.pages._form')

        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Update page"/>
        </div>
    </form>
@endsection