@extends('layouts.navbar-loggedin')
@include('layouts.styles')

@section('content')
<body>
    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">MANAGE YOUR CONFERENCE HERE</div>
        </div>
        <div class="page-info">
            <p>Apply to manage your conference on UTM Conference Management System now to enjoy organizining your conference with ease!</p>

            <p>Do note that once the application is <span style="color: rgb(101 163 13);">succesfull</span>, {{Auth::user()->Salutation}} <b>{{Auth::user()->First_name}} {{Auth::user()->Last_name}}</b> will be appointed as the <b>PC Chair</b>.</p>
        </div>

        <!-- Form -->

        <div id="create-conf-container">

            <form method="POST" action="{{ url('/create-conf') }}" class="w-full max-w-lg">
            @csrf

                <div class="form1">
                    <x-label class="form2-label" for="orgname" value="{{ __('Organizer’s Name*') }}" />
                    <x-input class="form2-input" id="orgname" type="text" name="orgname" required />
                </div>

                <div class="form1">
                    <x-label class="form2-label" for="orgweb" value="{{ __('Conference’s Website (if any)') }}" />
                    <x-input class="form2-input" id="orgweb" type="text" name="orgweb" />
                </div>

                <div class="form1">
                    <x-label class="form2-label" for="cname" value="{{ __('Conference Name*') }}" />
                    <x-input class="form2-input" id="cname" type="text" name="cname" required />
                </div>

                <div class="form1">
                    <x-label class="form2-label" for="cabbr" value="{{ __('Conference Abbreviation*') }}" />
                    <x-input class="form2-input" id="cabbr" type="text" name="cabbr" required />
                </div>

                <div class="form1">
                    <x-label class="form2-label" for="cdate" value="{{ __('Conference Date*') }}" />
                    <x-input class="form2-input" id="cdate" type="text" name="cdate" required />
                </div>

                <div class="form1">
                    <x-label class="form2-label" for="cvenue" value="{{ __('Location*') }}" />
                    <x-input class="form2-input" id="cvenue" type="text" name="cvenue" required />
                </div>

                <div class="flex items-center justify-center mt-4 ">
                    
                    <x-button class="ml-4">
                        {{ __('Submit Conference Details') }}
                    </x-button>
                </div>

            </form>

        </div>

        

    </div>

</body>
@endsection