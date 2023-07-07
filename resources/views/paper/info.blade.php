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
            <div class="header-font pl-3"><a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/papers' }}"><i class="bi bi-arrow-left-circle-fill">&nbsp;BACK</i></a></div>
        </div>

        <div class="papersec-box">
            <div class="pdet-header-line">
                INFORMATION ON CONFERENCE PAPER   ({{$paper->conference->Conference_abbr}}-{{$paper->Paper_id}})
            </div>
            
            @if($paper->paper_title == null)
            <div class="upddet">
                <i class="text-danger bi bi-exclamation-lg"></i>Author haven't submit their <b>paper details</b> to the system. 
            </div>
            @endif

            <table class="mt-4 table-fixed paper-det-table" style="text-align: justify;">
                <tr >
                    <td class="w-1/4 px-2 py-1"><b>Paper ID</b></td>
                    <td class="w-3/4 pr-4 py-1"><b>: {{$paper->Paper_id}}</b></td>
                </tr>
                <tr >
                    <td class="w-1/4 px-2 py-1"><b>Author Name</b></td>
                    <td class="w-1/4 pr-4 py-1"><b>: {{$paper->paperauthor->authoruser->Salutation}} {{$paper->paperauthor->authoruser->First_name}} {{$paper->paperauthor->authoruser->Last_name}}</b></td>
                </tr>
                <tr >
                    <td class="w-1/4 px-2 py-1"><b>Author Association</b></td>
                    <td class="w-1/4 pr-4 py-1"><b>: {{$paper->paperauthor->authoruser->Association}}</b></td>
                </tr>
                <tr>
                    <td class="w-1/4 px-2 py-1" class="det-left"><b>Paper Title</b></td>
                    <td class="w-3/4 pr-4 py-1" style="text-transform: uppercase;"><b>: {{$paper->paper_title}}</b></td>
                </tr>
                <tr>
                    <td class="w-1/4 px-2 py-1" class="det-left"><b>Paper Abstract</b></td>
                    @if($paper->abstract == null)
                        <td class="w-3/4 pr-4 py-1"><b>: <b class="text-red-600">Abstract has not been uploaded</b></b></td>
                    @else
                        <td class="w-3/4 pr-4 py-1"><b>: <b class="text-green-600">{{$paper->abstract}}</b></b></td>
                    @endif
                </tr>
            </table>
        </div>

    </div>
    
</body>
@endsection