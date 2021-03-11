@extends('layouts.backend')

@section('content')
    <div class="flex-center col-4">
        <img src="/avatar/{{ $user->avatar }}" class="avatar">
        <h1>{{ $user->name }}'s Profile</h1>
        <p>Hi, I'm {{$user->name}}</p>
        <p>You can contact me by {{$user->email}}</p>
    </div>
@endsection