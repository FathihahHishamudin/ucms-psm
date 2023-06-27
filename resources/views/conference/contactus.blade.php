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
            <a href="{{ url('/conf/'.$conf->Conference_abbr).'/register' }}">REGISTRATION</a>
            @endif
            <a href="{{ url('/conf/'.$conf->Conference_abbr).'/contactus' }}">CONTACT US</a>
            @if ($cfrole=="CHAIR" or $cfrole=="CO-CHAIR" or $cfrole=="REVIEWER")
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
            <div class="header-font">CONTACT US</div>
        </div>

        <div class="mt40 desc">
            <table class="table-fixed" style="font-size: 18px;">
                <tr>
                    <td class="w-2/5 px-4 py-1"><b>Conference Organizer</b></td>
                    <td class="w-3/5 px-4 py-1"> {{$conf->Conference_org}} </td>
                </tr>
                @if($conf->Conference_website)
                    <tr>
                        <td class="w-2/5 px-4 py-1"><b>Conference's website</b></td>
                        <td class="w-3/5 px-4 py-1"><a href="{{$conf->Conference_website}}" style="text-decoration: underline; color:blue;"  target="_blank">{{$conf->Conference_website}}</a></td>
                    </tr>
                @endif
                <tr>
                    <td class="w-2/5 px-4 py-1"><b>Conference Chair's email</b></td>
                    <td class="w-3/5 px-4 py-1"><a href="mailto:{{$confchairu->email}}?subject=Conference%20Enquiry" style="text-decoration: underline; color:blue;">{{$confchairu->email}}</a> </td>
                </tr>
            </table>
        </div>       

    </div>
</body>
@endsection