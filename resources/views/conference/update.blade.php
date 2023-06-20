@extends('layouts.navbar-loggedin')
@include('layouts.styles')
@include('layouts.confstyles')

@section('content')
<body>
    <div class="dropdown">
    <button class="dropbtn">
            <div class="column side">
                <i class="bi bi-caret-down-fill" style="font-size: 30px; float:right; padding-top:3%"></i>
            </div>
            <div class="column middle">{{$conf->Conference_name}}</div>
            @auth
                @if($cfrole != null)
                    <div class="column side">[ {{$cfrole}} ]</div>
                @endif
            @endauth
        </button>
        <div class="dropdown-content">
            <a href="{{ url('/conf/'.$conf->Conference_abbr)}}">HOME</a>
            @if ($cfrole == null)
                <a href="#">REGISTRATION</a>
            @endif
            <a href="{{ url('/conf/'.$conf->Conference_abbr).'/contactus' }}">CONTACT US</a>
            @if ($cfrole=="CHAIR" or $cfrole=="CO-CHAIR" or $cfrole=="REVIEWER")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu' }}">COMMITTEE MENU</a>
            @endif
            @if ($cfrole=="AUTHOR")
            <a href="{{ url('/conf/'.$conf->Conference_abbr).'/mypaper' }}">MY PAPER</a>
            @endif
        </div>
    </div>


    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">UPDATE CONFERENCE DETAILS</div>
        </div>

        
            <!-- Container for edit form -->
            <div class="container shadow p-4 mt-4 rounded bg-white border-outline">
                <form method="post" action="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/updateconf'}}" enctype="multipart/form-data">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                    <!--Conference's ID -->
                    <div class="form-group mb-3">
                        <label for="id"><b>ID</b></label>
                        <input type="text" name="id" value="{{$conf->Conference_id }}" class="form-control" placeholder="ID" disabled>
                    </div>
                    <!--Conference's Name -->
                    <div class="form-group mb-3">
                        <label for="name"><b>Conference Name</b></label>
                        <input type="text" name="name" value="{{$conf->Conference_name }}" class="form-control" placeholder="Conference Name" required>
                    </div>
                    <!--Conference's Abbreviation -->
                    <div class="form-group mb-3">
                        <label for="abbr"><b>Conference Abbreviation</b></label>
                        <input type="text" name="abbre" value="{{$conf->Conference_abbr }}" class="form-control" placeholder="Conference Abbreviation" required>
                    </div>
                    <!--Conference's Date -->
                    <div class="form-group mb-3">
                        <label for="date"><b>Conference Date</b></label>
                        <input type="text" name="date" value="{{$conf->Conference_date }}" class="form-control" placeholder="Conference Date" required>
                    </div>
                    <!--Conference's Venue/Location -->
                    <div class="form-group mb-3">
                        <label for="venue"><b>Conference Venue/Location</b></label>
                        <input type="text" name="venue" value="{{$conf->Conference_venue }}" class="form-control" placeholder="Conference Venue" required>
                    </div>
                    <!--Conference's Description -->
                    <div class="form-group mb-3">
                        <label for="description"><b>Conference Description</b></label>
                        <textarea class="form-control" rows="4" name="description" placeholder="Description" required>{{$conf->Conference_desc}}</textarea>
                    </div>
                    <!--Conference's Organization Name-->
                    <div class="form-group mb-3">
                        <label for="org"><b>Conference Organization Name</b></label>
                        <input type="text" name="org" value="{{$conf->Conference_org }}" class="form-control" placeholder="Conference Organization" required>
                    </div>
                    <!--Conference's Organization Website-->
                    <div class="form-group mb-3">
                        <label for="web"><b>Conference Organization Website</b></label>
                        <input type="text" name="web" value="{{$conf->Conference_website }}" class="form-control" placeholder="Conference Website">
                    </div>
                    <!--Conference's  Announcement-->
                    <div class="form-group mb-3">
                        <label for="announcement"><b>Conference Announcement</b></label>
                        <textarea class="form-control" rows="4" name="announcement" placeholder="Conference Announcement">{{$conf->Conference_announcement}}</textarea>
                    </div>

                    <!-- Save change button -->
                    <div class="flex items-center justify-center mt-4">
                    <x-button class="ml-4">
                        {{ __('Save Changes') }}
                    </x-button>
                </div>
                </form>
            </div>
      
        
        
    </div>
</body>
@endsection