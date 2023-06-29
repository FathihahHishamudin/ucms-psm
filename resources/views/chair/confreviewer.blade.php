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
            <div class="header-font">PC CO-CHAIR</div>
        </div>    
        
        <div class="m-5">
            <div class="ml-1 mb-3 rev-list-header text-xl">List of reviewers and the paper assigned</div>

            @if($ada)
                <div class="m-1">
                    <table class="table table-bordered" style="text-align: center; font-size: 16px; border:1px solid black;">
                        <tr style="background-color: lightgray;">
                            <th>Reviewer Name</th>
                            <th>Email</th>
                            <th>Paper Assigned</th>
                        </tr>
                        @foreach ($reviewers as $reviewer)
                            <tr>
                                <td>{{$reviewer->user->First_name}} {{$reviewer->user->Last_name}}</td>
                                <td>{{$reviewer->user->email}}</td>
                                @php 
                                    $papers = \App\Http\Controllers\ReviewerController::getAssignedPaper($reviewer->Reviewer_id, $conf->Conference_id);
                                @endphp
                                <td>
                                    @if($papers->isNotEmpty())
                                        @foreach ($papers as $paper)    
                                            {{$conf->Conference_abbr}}-{{$paper->Paper_id}}, 
                                        @endforeach
                                    @else
                                        None
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <p>There is no reviewer in your conference. You can add reviewer/s after author submit their paper.</p>
            @endif
        </div>
    </div>
</body>
@endsection