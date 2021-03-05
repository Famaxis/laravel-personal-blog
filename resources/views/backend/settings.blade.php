@extends('layouts.backend')

@section('content')
<div class="container row">
<h1>Project settings</h1>
    <form action="{{ route('settings.update') }}" method="POST" class="col-6">
    @csrf
        <fieldset class="form-group settings">
            <label for="site_name">Site name:</label>
            <input type="text" name="site_name" value="{{ $settings->site_name }}" id="site_name" required>
        </fieldset>

        <fieldset class="form-group settings">
            <label class="paper-switch-2">
                <input id="comments_allowed" name="comments_allowed" type="checkbox" value="1"
                        {{ ($settings->comments_allowed) ? 'checked' : '' }}
                />
                <span class="paper-switch-slider round"></span>
            </label>
            <label for="comments_allowed" class="paper-switch-2-label">
                Allow comments?
            </label>
            <p class="annotation">Existing comments still will be shown.</p>
        </fieldset>

        <fieldset class="form-group settings">
            <label class="paper-switch-2">
                <input id="confirm_deletion" name="confirm_deletion" type="checkbox" value="1"
                        {{ ($settings->confirm_deletion) ? 'checked' : '' }}
                />
                <span class="paper-switch-slider round"></span>
            </label>
            <label for="confirm_deletion" class="paper-switch-2-label">
                Confirm deletion?
            </label>
            <p class="annotation">This is about posts, pages and templates. Not the comments.</p>
        </fieldset>

        <fieldset class="form-group settings">
            <legend>Pick a main color theme:</legend>
            <label for="blue" class="paper-radio">
                <input type="radio" name="main_template" id="blue" value="blue" {{ ($settings->main_template==='blue')? "checked" : "" }} >
                <span>Blue</span>
            </label>
            <label for="red" class="paper-radio">
                <input type="radio" name="main_template" id="red" value="red" {{ ($settings->main_template==='red')? "checked" : "" }} >
                <span>Red</span>
            </label>
            <label for="purple" class="paper-radio">
                <input type="radio" name="main_template" id="purple" value="purple" {{ ($settings->main_template==='purple')? "checked" : "" }} >
                <span>Purple</span>
            </label>
            <label for="sand" class="paper-radio">
                <input type="radio" name="main_template" id="sand" value="sand" {{ ($settings->main_template==='sand')? "checked" : "" }} >
                <span>Sand</span>
            </label>
        </fieldset>

        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Update">
        </div>
    </form>

    <div class="form-group col-4">
        <h2>Caching</h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <a class="paper-btn btn-warning" href="{{ route('settings.cache_clear') }}">Clear cache</a>
        <a class="paper-btn btn-success" href="{{ route('settings.cache_make') }}">Cache again</a>
    </div>

</div>
@endsection