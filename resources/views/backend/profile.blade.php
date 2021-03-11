@extends('layouts.backend')

@section('content')
    <div class="flex-center col-4">
        <img src="/avatar/{{ $user->avatar }}" class="avatar">
        <h1>{{ $user->name }}'s Profile</h1>
    </div>

    <form enctype="multipart/form-data" action="{{ route('profile.update') }}" method="POST" class="col-3">
        @csrf

        <div class="row flex-edges">
            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" name="name" value="{{$user->name}}" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" value="{{$user->email}}" id="email" required>
            </div>
        </div>

        <div class="form-group">
            <label for="image-update">Update profile image:</label>
            @error('avatar')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="file" name="avatar" class="input-block" id="image-update">
        </div>
        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Update">
        </div>
    </form>


    <form method="POST" action="{{ route('profile.password_change') }}" class="col-3">
        @csrf

        <h2>Password change</h2>

        @error('current_password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="row flex-edges">
            <div class="form-group">
                <label for="password">Current Password:</label>
                <input id="password" type="password" class="form-control" name="current_password"
                       autocomplete="current-password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input id="new_password" type="password" class="form-control" name="new_password"
                       autocomplete="current-password" required>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Update password">
        </div>
    </form>
@endsection