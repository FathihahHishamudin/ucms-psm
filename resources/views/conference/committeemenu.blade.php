@extends('layouts.navbar-loggedin')
@include('layouts.styles')
@include('layouts.confstyles')

@section('content')
<body>
    <div class="dropdown">
        <button class="dropbtn">{{$conf->Conference_name}}</button>
        <div class="dropdown-content">
            <a href="{{ url('/conf/'.$conf->Conference_abbr)}}">HOME</a>
            <a href="#">REGISTRATION</a>
            <a href="{{ url('/conf/'.$conf->Conference_abbr).'/contactus' }}">CONTACT US</a>
            @auth
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu' }}">COMMITTEE MENU</a>
            @endauth
        </div>
    </div>


    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">COMMITTE MENU</div>
        </div>

        <a class="desc mt40 mb60" href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/updateconf' }}">UPDATE CONFERENCE DETAILS</a>
        
    </div>
</body>
@endsection