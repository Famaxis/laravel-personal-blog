@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row flex-center">
            <div>
                <div class="flex-center">
                    <img src="/avatar/{{ $user->avatar }}" style="max-height:150px; float:left; border-radius:50%; margin-right:25px;">
                    <h2>{{ $user->name }}'s Profile</h2>
                </div>

                <form enctype="multipart/form-data" action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="row flex-spaces">
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" name="name" value="{{$user->name}}" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" value="{{$user->email}}" id="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image-update">Update Profile Image</label>
                        <input type="file" name="avatar"  class="input-block"  id="image-update">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="paper-btn btn-secondary" value="Update">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection