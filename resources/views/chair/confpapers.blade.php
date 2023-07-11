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
                                @if ($listpaper->stat_fp == "Strong Acceptence")
                                    <i class="bi bi-circle-fill text-success"></i>
                                @elseif ($listpaper->stat_fp == "Accepted")
                                    <i class="bi bi-circle-fill text-info"></i>
                                @elseif ($listpaper->stat_fp == "Weak Acceptence")
                                    <i class="bi bi-circle-fill text-warning"></i>
                                @elseif ($listpaper->stat_fp == "Rejected")
                                    <i class="bi bi-circle-fill text-danger"></i>
                                @else
                                    <i class="bi bi-circle"></i>
                                @endif
                                </a>
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