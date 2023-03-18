@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg bg-light">
                <div class="card-header">{{ isset($authgroup) ? ucwords("管理者") : ""}} {{ __('Login') }}</div>

                <div class="card-body">
                    @isset($authgroup)
                    <form method="POST" action="{{ url("login/$authgroup") }}">
                    @else
                    <form method="POST" action="{{ route('login') }}">
                     @endisset
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container-fluid vh-100">
    <div class="">
        <div class="rounded d-flex justify-content-center">
            <div class="col-md-4 col-sm-12 shadow-lg pt-2 px-4 pb-5 bg-light">
                <div class="text-center">
                    <h3 class="text-primary m-3">{{ isset($authgroup) ? ucwords("管理者") : ""}}LogIn</h3>
                </div>
                @isset($authgroup)
                    <form method="POST" action="{{ url("login/$authgroup") }}">
                    @else
                    <form method="POST" action="{{ route('login') }}">
                     @endisset
                        @csrf
                    <div class="">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary"><i
                                    class="bi bi-person-plus-fill text-white"></i></span>
                            {{-- <input type="text" class="form-control" placeholder="E-Mail Address"> --}}
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-primary"><i
                                    class="bi bi-key-fill text-white"></i></span>
                            {{-- <input type="password" class="form-control" placeholder="Password"> --}}
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('次回から自動的にログインする') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mr-3">
                            <div class="d-flex align-items-center justify-content-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('パスワードをお忘れの方') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
