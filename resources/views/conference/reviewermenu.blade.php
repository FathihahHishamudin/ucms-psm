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
            <div class="header-font">REVIEWER MENU</div>
        </div>
        
        <div class="m-4">
            @if($paper)
                <table class="table-fixed psub">
                    <tr>
                        <th>No</th>
                        <th>Paper Title</th>
                        <th>Full Paper</th>
                        <th>Correction Full Paper</th>
                    </tr>
                    
                    @foreach ($paper as $paper)
                        
                        <tr>
                            <td class="w-1/10 px-4 py-1">{{ $loop->iteration }}</td>
                            <td class="w-1/2 px-4 py-1">{{$paper->paper_title}}</td>
                            @if($paper->full_paper)
                                <td class="w-1/5 px-4 py-1">
                                    @php $revfp =  App\Http\Controllers\ReviewsController::getFPReviewID($paper);
                                    @endphp
                                    <a href="{{ url('/conf/'.$conf->Conference_abbr.'/reviewermenu/'.$revfp->Review_id)}}">{{$revfp->status}} <br>( {{$revfp->p_status}} )</a>
                                    
                                </td>
                            @else
                                <td class="w-1/5 px-4 py-1">N/A</td>
                            @endif
                            @if(($paper->Correction_fp) && ($paper->stat_fp == "Weak Acceptance"))
                                <td class="w-1/5 px-4 py-1">
                                    @php $revcfp =  App\Http\Controllers\ReviewsController::getCFPReviewID($paper);
                                    @endphp
                                    {{$revcfp->status}} ( {{$revcfp->p_status}} )
                                </td>
                            @else
                                <td class="w-1/5 px-4 py-1">N/A</td>
                            @endif
                        </tr>

                    @endforeach
                </table>
            @endif
        </div>
    </div>
</body>
@endsection