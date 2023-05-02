@extends('layouts.navbar')
@include('layouts.styles')


@section('content')
<body>
    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">WELCOME</div>
        </div>
        <div class="page-info">
            <p>Register an account now to be able to use UTM Conference Management System!
            <br> Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </div>
        
        <div id="register-container">    

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" class="w-full max-w-lg">
                @csrf

                
                    <div class="form1">
                        <x-label class="form1-label" for="email" value="{{ __('Email*') }}" />
                        <x-input class="form1-input" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        
                    </div>

                    <div class="form1">
                        <x-label class="form1-label" for="password" value="{{ __('Password*') }}" />
                        <x-input class="form1-input" id="password" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="form1">
                        <x-label class="form1-label" for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input class="form1-input" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="form1 mt-5">
                        <x-label class="form1-label" for="salutation" value="{{ __('Title*') }}" />
                        <x-input class="form1-input" id="salutation" type="text" name="salutation" :value="old('salutation')" required  autocomplete="salutation" />
                    </div>

                    <div class="form1">
                        <x-label class="form1-label" for="fname" value="{{ __('Full Name*') }}" />
                        <x-input class="form1-input" id="fname" placeholder="First Name" type="text" name="fname" :value="old('fname')" required  autocomplete="fname" />
                        <x-input class="form1-input" id="lname" placeholder="Last Name" type="text" name="lname" :value="old('lname')" required  autocomplete="lname" />
                    </div>

                    <div class="form1">
                        <x-label class="form1-label" for="assoc" value="{{ __('Association*') }}" />
                        <x-input class="form1-input2" id="assoc" type="text" name="assoc" :value="old('assoc')" required  autocomplete="assoc" />
                    </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-2">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-center mt-4 ">
                    
                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
            
        </div>

    </div>
</body>
@endsection