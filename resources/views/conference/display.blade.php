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
            @if ($cfrole=="CHAIR" or $cfrole=="CO-CHAIR")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu' }}">COMMITTEE MENU</a>
            @endif
            @if ($cfrole=="REVIEWER")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/reviewermenu' }}">REVIEWER MENU</a>
            @endif
            @if ($cfrole=="AUTHOR")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/mypaper' }}">MY PAPER</a>
            @endif
        </div>
    </div>


    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">HOME</div>
        </div>

        @if($conf->Conference_announcement)
            <div class="announ mt40">
                <div class="cem">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <b>ANNOUNCEMENT !</b> <hr><br>
                    {{$conf->Conference_announcement}}
                </div>
            </div>
        @endif

        <div class="title">{{$conf->Conference_name}}</div>
        <div class="abbr">({{$conf->Conference_abbr}})</div>
        <div class="datevenue">{{$conf->Conference_date}}</div>
        <div class="datevenue mb60">{{$conf->Conference_venue}}</div>
        <hr>
        
        <div class="desc mt40 mb60">{{$conf->Conference_desc}}</div>
    </div>
</body>
@endsection