@extends('layouts.backend')

@section('content')
<div class="container">
<h1>Project settings</h1>
    <form action="{{ route('settings.update') }}" method="POST">
    @csrf
        <fieldset class="form-group">
            <label for="site_name">Site name</label>
            <input type="text" name="site_name" value="{{ $settings->site_name }}" id="site_name" required>
        </fieldset>

        <fieldset class="form-group col-4">
            <label class="paper-switch-2">
                <input id="comments_allowed" name="comments_allowed" type="checkbox" value="1"
                       @if($settings->comments_allowed)
                       checked
                       @endif
                />
                <span class="paper-switch-slider round"></span>
            </label>
            <label for="comments_allowed" class="paper-switch-2-label">
                Allow comments
            </label>
        </fieldset>

        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Update">
        </div>
    </form>
</div>
@endsection