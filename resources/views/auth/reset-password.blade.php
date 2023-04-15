@extends('layouts.master')

@section('content')
@php
$lang = (!empty(\Cookie::get('language'))) ? \Cookie::get('language') : 'en';
@endphp
<div class="change-language-front-form form-group auth-lang">
    <select name="language" id="language" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        @foreach(\App\Models\Utility::languages() as $language)
            <option @if($lang == $language) selected @endif value="{{ route('login', $language) }}">{{Str::upper($language)}}</option>
        @endforeach
    </select>
</div>
<div class="col-sm-8 col-lg-4">
    <div class="row justify-content-center mb-3">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset(Storage::url('logo/logo-blue.png')) }}" width="80%" height="auto" class="auth-logo">
        </a>
    </div>
    <div class="card shadow zindex-100 mb-0">
        <div class="card-body px-md-5 py-5">
            <div class="mb-3">
                <h6 class="h3">{{__('Reset Password')}}</h6>
            </div>
            <span class="clearfix"></span>
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span class="alert-text">{{ session('error') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <span class="auth-errors">
                    <h4>{{ $errors->first() }}</h4>
                </span>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <div class="form-group">
                    <label class="form-control-label">{{ __('Email address') }}</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input id="email" type="email"  placeholder="{{ __('Email') }}"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-control-label">{{ __('Password') }}</label>
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password" type="password" placeholder="{{ __('Password') }}"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="current-password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label">{{ __('Confirm Password') }}</label>
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}"
                               class="form-control" name="password_confirmation" required autocomplete="current-password">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill login-do-btn">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
