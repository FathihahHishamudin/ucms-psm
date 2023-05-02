@extends('layouts.navbar')
@include('layouts.styles')


@section('content')
<body>
    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">WELCOME</div>
        </div>
        <div class="page-info">
            <p>Log in to your account to be able to use UTM Conference Management System!
            <br>Don’t have an account yet? <a href="{{ route('register') }}">Register Now</a></p>
        </div>
        
        <div id="login-container">
            
            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form1">
                    <x-label class="form-login-label" for="email" value="{{ __('Email*') }}" />
                    <x-input class="form-login-input" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="form1">
                    <x-label class="form-login-label" for="password" value="{{ __('Password*') }}" />
                    <x-input class="form-login-input" id="password" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-button class="ml-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
                <div class="flex items-center justify-center mt-4">
                     @if (Route::has('password.request'))
                        <p>Forgot password? <a href="{{ route('password.request') }}">
                            {{ __('Click here to reset') }}
                        </a></p> 
                    @endif
                </div>
            </form>
        </div>

    </div>
</body>
@endsection