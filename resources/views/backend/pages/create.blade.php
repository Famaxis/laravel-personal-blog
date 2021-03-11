@extends('layouts.backend')

@section('content')
    <h1>Create page</h1>
    <form method="POST" enctype="multipart/form-data" data-persist="garlic" action="{{ route('pages.store') }}"
          class="col-8">
        @csrf
        @include('backend.pages._form')

        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Create page"/>
        </div>
    </form>
@endsection