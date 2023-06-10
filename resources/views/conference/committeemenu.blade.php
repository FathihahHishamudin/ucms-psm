@extends('layouts.navbar-loggedin')
@include('layouts.styles')
@include('layouts.confstyles')

@section('content')
<body>
    <div class="dropdown">
    <button class="dropbtn">
            <div class="column side"></div>
            <div class="column middle">{{$conf->Conference_name}}</div>
            @auth
                @if($cfrole != null)
                    <div class="column side">[ {{$cfrole}} ]</div>
                @endif
            @endauth
        </button>
        <div class="dropdown-content">
            <a href="{{ url('/conf/'.$conf->Conference_abbr)}}">HOME</a>
            <a href="#">REGISTRATION</a>
            <a href="{{ url('/conf/'.$conf->Conference_abbr).'/contactus' }}">CONTACT US</a>
            @if ($cfrole=="CHAIR" or $cfrole=="CO-CHAIR" or $cfrole=="REVIEWER")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu' }}">COMMITTEE MENU</a>
            @endif
        </div>
    </div>


    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">COMMITTE MENU</div>
        </div>
        <div class="pcmenu">
            @if($cfrole == "CHAIR" or $cfrole == "CO-CHAIR")
                <div class="pcmenu list">
                    <a class="desc mt40 mb60" href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/updateconf' }}"><i class="bi bi-pencil-square">   </i>UPDATE CONFERENCE DETAILS</a>
                </div>
            @endif
        </div>
        
        
    </div>
</body>
@endsection