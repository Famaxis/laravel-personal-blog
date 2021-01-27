@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row flex-center">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body margin-large">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="flex-center">
                            <fieldset class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="@error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>

                            <fieldset class="form-group">
                                <label class="paper-switch-2">
                                    <input id="remember" name="remember" id="remember"
                                           type="checkbox" {{ old('remember') ? 'checked' : '' }}/>
                                    <span class="paper-switch-slider round"></span>
                                </label>
                                <label for="remember" class="paper-switch-2-label">
                                    Remember Me
                                </label>
                            </fieldset>

                            <div class="row">
                                <button type="submit" class="paper-btn btn-secondary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
