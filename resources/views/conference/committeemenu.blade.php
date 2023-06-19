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
            <div class="header-font">COMMITTE MENU</div>
        </div>
        <div class="pcmenu">
            @if($cfrole == "CHAIR" or $cfrole == "CO-CHAIR")
                <div class="pcmenu list">
                    <a class="desc mt40 mb60" href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/updateconf' }}"><i class="bi bi-pencil-square"></i><b>&nbsp; &nbsp; Update Conference Details</b></a>
                </div>
                <div class="pcmenu list">
                    <a class="desc mt40 mb60" href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/fees' }}"><i class="bi bi-cash-coin"></i><b>&nbsp; &nbsp; Conference Fees</b></a>
                </div>
                <div class="pcmenu list">
                    <a class="desc mt40 mb60" href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/participants' }}"><i class="bi bi-people-fill"></i><b>&nbsp; &nbsp; Conference Participants</b></a>
                </div>
                <div class="pcmenu list">
                    <a class="desc mt40 mb60" href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/updateconf' }}"><i class="bi bi-file-earmark-text-fill"></i><b>&nbsp; &nbsp; Conference Papers</b></a>
                </div>
                <div class="pcmenu list">
                    <a class="desc mt40 mb60" href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/updateconf' }}"><i class="bi bi-person-lines-fill"></i><b>&nbsp; &nbsp; Conference Reviewers</b></a>
                </div>
                @if($cfrole == "CHAIR")
                    <div class="pcmenu list">
                        <a class="desc mt40 mb60" href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/updateconf' }}"><i class="bi bi-person-check-fill"></i><b>&nbsp; &nbsp; Conference Co-Chairs</b></a>
                    </div>
                @endif
            @endif
        </div>
        
        
    </div>
</body>
@endsection