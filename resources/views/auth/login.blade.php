<!DOCTYPE html>
<html lang="en" dir="{{ Utility::getValByName('SITE_RTL') == 'on' ? 'rtl' : '' }}">

<head>

    <title>{{ env('APP_NAME') }}</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    >

</head>
<body style="background: #e8e8e8">

<!-- Favicon icon -->
@php
    $logo=\App\Models\Utility::get_file('uploads/logo/');

@endphp
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card m-5 p-5">

            <div class="row">
                <div class="col-lg-6 col-12 d-none d-sm-block" style="background: #584ed2">

                        <div class="p-4">
                            <img width="200" height="300"
                                 src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                                 >
                        </div>

                </div>
                {{--                    <img class="col-lg-6 col-12 d-none d-sm-block" src="{{$logo.'/construction.jpg'}}">--}}

                <div class="col-lg-6 col-12 p-4 " style="background: #e8e8e8">

                    {{--                    <div class="card p-2"  style="background: #584ed2"  >--}}
                    {{--                        <center>--}}
                    {{--                            <img width="150" height="200"--}}
                    {{--                                 src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"--}}
                    {{--                                 alt="{{ config('app.name', 'Posgo') }}" class="logo logo-lg">--}}
                    {{--                        </center>--}}
                    {{--                    </div>--}}

                    <div class="">
                        <h2 class="mt-3 f-w-600">{{ 'Login' }}</h2>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-text">{{ session('error') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    onclick="this.parentElement.style.display='none';">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif



                    @if (Session::has('message'))
                        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show ">
                            {{ Session::get('message') }}
                            <button type="button" class="btn-close mt-3" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" id="form_data" action="{{ route('login') }}" role="form">
                        @csrf
                        <div class="">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" placeholder="{{ __('Email') }}"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <label class="form-label">{{ __('Password') }}</label>
                                    </div>

                                </div>

                                <input id="input-password" type="password" placeholder="{{ __('Password') }}"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                                @enderror
                            </div>


                            @if (env('RECAPTCHA_MODULE') == 'yes')
                                <div class="form-group mb-3">
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                    <span class="small text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            @endif


                            <div class="d-grid">
                                <button type="submit" style="background: #584ed2" class="btn btn-primary btn-block mt-2"
                                        id="login_button">{{ __('Login') }}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>

