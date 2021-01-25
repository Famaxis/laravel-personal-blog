@extends('layouts.backend')

@section('content')
<div class="container">

    <form action="{{ route('settings.update') }}" method="POST">
    @csrf
        <div class="form-group">
            <label for="name">Site name</label>
            <input type="text" name="name" value="{{ config('settings.site_name') }}" id="name" required>
        </div>
        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Update">
        </div>
    </form>
</div>
@endsection