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
            <div class="header-font">CONFERENCE PAPER SUBMISSION</div>
        </div>
        <div class="text-lg" style="margin:20px; display: flex;">
            <div style="width:60%; border-right:2px solid lightgrey;">
                <div><u><b>STATUS COLUMN LEGEND</b></u></div>
            
                <table class="statlegend">
                    <tr style="text-decoration: underline;">
                        <td>SYMBOL</td>
                        <td>FULL PAPER STATUS</td>
                        <td>CORRECTION PAPER STATUS</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-circle-fill text-success"></i></td>
                        <td>Strong Acceptence/Accepted</td>
                        <td>N/A</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-circle-fill text-warning"></i><i class="bi bi-circle-fill text-success"></i></td>
                        <td>Weak Acceptence</td>
                        <td>Accepted</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-circle-fill text-warning"></i><i class="bi bi-circle-fill text-danger"></i></td>
                        <td>Weak Acceptence</td>
                        <td>Rejected</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-circle-fill text-danger"></i></td>
                        <td>Rejected</td>
                        <td>N/A</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-circle"></i></td>
                        <td>Not Yet Given</td>
                        <td>N/A</td>
                    </tr>
                </table>
            
            </div>
            <div class="text-lg" style="margin-left: 40px;">
                <div style="margin-bottom: 10px;"><u><b>REVIEWER COLUMN LEGEND</b></u></div>
                <table class="ml-2 statlegend">
                    <tr style="background-color: lightgray;">
                        <td colspan="2">X ( Y | Z )</td>
                    </tr>
                    <tr>
                        <td>X</td>
                        <td>Number of <u>approved</u> reviewer</td>
                    </tr>
                    <tr>
                        <td>Y</td>
                        <td>Number of <u>pending</u> reviewer</td>
                    </tr>
                    <tr>
                        <td>Z</td>
                        <td>Number of <u>declined</u> reviewer</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <hr class="new1">
        

        <div class="p-4">
            @if($listpapers)
                <table class="table table-bordered text-center" style="border: 1px solid black;">
                    <tr style="background-color: lightgrey;">
                        <th>Author</th>
                        <th>Title</th>
                        <th>Info</th>
                        <th>Submission</th>
                        <th>Status</th>
                        <th>Reviewer</th>
                    </tr>
                    @foreach ($listpapers as $listpaper)
                        <tr>
                            <td class="align-middle" style="width: 20%;">{{$listpaper->paperauthor->authoruser->First_name}} {{$listpaper->paperauthor->authoruser->Last_name}}</td>
                            <td class="align-middle" style="width: 40%;">{{$listpaper->paper_title}}</td>
                            <td class="align-middle" style="width: 10%;"><a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/papers/'.$listpaper->Paper_id.'/infopage' }}"><i class="bi bi-info-circle-fill"></i></a></td>
                            <td class="align-middle" style="width: 10%;"><a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/papers/'.$listpaper->Paper_id.'/subpage' }}"><i class="bi bi-file-pdf-fill"></i></a></td>
                            <td class="align-middle" style="width: 10%;"><a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/papers/'.$listpaper->Paper_id.'/statuspage' }}">
                                @if ($listpaper->stat_fp == "Strong Acceptance")
                                    <i class="bi bi-circle-fill text-success"></i></a>
                                @elseif ($listpaper->stat_fp == "Accepted")
                                    <i class="bi bi-circle-fill text-success"></i></a>
                                @elseif ($listpaper->stat_fp == "Weak Acceptance")
                                    <i class="bi bi-circle-fill text-warning"></i></a>
                                    <a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/papers/'.$listpaper->Paper_id.'/statuspagecor' }}">
                                        @if ($listpaper->stat_cfp == "Accepted")
                                            <i class="bi bi-circle-fill text-success"></i>
                                        @elseif ($listpaper->stat_cfp == "Rejected")
                                            <i class="bi bi-circle-fill text-danger"></i>
                                        @else
                                            <i class="bi bi-circle"></i></a>
                                        @endif
                                    </a>
                                @elseif ($listpaper->stat_fp == "Rejected")
                                    <i class="bi bi-circle-fill text-danger"></i></a>
                                @else
                                    <i class="bi bi-circle"></i></a>
                                @endif
                            </td>
                            @php $raccept = App\Http\Controllers\PCChairController::getreviewerA($listpaper->Paper_id);
                            @endphp
                            @php $rpending = App\Http\Controllers\PCChairController::getreviewerP($listpaper->Paper_id);
                            @endphp
                            @php $rdecline = App\Http\Controllers\PCChairController::getreviewerD($listpaper->Paper_id);
                            @endphp
                            <td class="align-middle" style="width: 10%;"><a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/papers/'.$listpaper->Paper_id.'/reviewerpage' }}">
                                {{$raccept}}({{$rpending}}|{{$rdecline}})
                            </a></td>
                        </tr>

                    @endforeach
                </table>
            @else

            @endif
        </div>
    </div>
</body>
@endsection