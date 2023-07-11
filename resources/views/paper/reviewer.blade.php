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
                INFORMATION ON CONFERENCE PAPER'S REVIEWERS   ({{$paper->conference->Conference_abbr}}-{{$paper->Paper_id}})
            </div>
            <div class="m-4 text-lg">
                Conference Committee can assign reviewer to the paper submitted by Author <b>{{$paper->paperauthor->authoruser->Salutation}} {{$paper->paperauthor->authoruser->First_name}} {{$paper->paperauthor->authoruser->Last_name}}</b> <br>
                One paper shall be assigned to 2 separate reviewers. <br>
            </div>

            <hr class="new1">

            <div class="cochair-list-box">
                <div class="ca-head my-2">Reviewer </div>
                
                @if ($acount > 0 && $acount != null)
                    <table class="table table-bordered coch-table">
                        <tr>
                            <th class="coch-table-left">Reviewer Full Name</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($a as $rv)
                            <tr>
                                <td class="coch-table-left">{{$rv->user->First_name}} {{$rv->user->Last_name}}</td>
                                <td>{{$rv->user->email}}</td>
                                <td>Accept</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p style="font-size: 16px; padding-left:10px;">There are no reviewers for this conference. Please invite at most 2 users of the system to be a Reviewer.</p>
                @endif
            </div>

            <div class="cochair-list-box">
                <div class="ca-head my-2">Pending Reviewer </div>
                
                @if ($pcount > 0)
                    
                    <p style="font-size: 16px; padding-left:10px;">There can only be 2 reviewers assigned to a conference paper. Remove the pending reviewer if you want to invite other reviewer.</p> <br>
                    <table class="table table-bordered coch-table" style="width: 90%;">
                        <tr>
                            <th class="coch-table-left">Pending Full Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Remove</th>
                        </tr>
                        @foreach ($p as $rv)
                            <tr>
                                <td class="coch-table-left">{{$rv->user->First_name}} {{$rv->user->Last_name}}</td>
                                <td>{{$rv->user->email}}</td>
                                <td>{{$rv->status}}</td>
                                <form action="{{ url($conf->Conference_abbr.'/delete-assgreviewer/'.$rv->id) }}" method="post">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                    <td><button type="submit" onclick="return confirm('Are you sure you want to delete the Pending Reviewer?');" title="Pending Reviewer Delete"><i class="bi bi-trash"></i></button></td>
                                </form>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p style="font-size: 16px; padding-left:10px;">There are no pending reviewers for this conference. Please invite at most 2 users of the system to be a Reviewer.</p>
                @endif
            </div>

            @if ($rcount > 0)
                <div class="cochair-list-box">
                    <div class="ca-head my-2">Rejected Reviewer </div>
                    
                    <p style="font-size: 16px; padding-left:10px;">Please remove the rejected reviewer to be able to invite reviewer.</p> <br>
                
                    <table class="table table-bordered coch-table" style="width: 90%;">
                        <tr>
                            <th class="coch-table-left">Reject Reviewer Full Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Remove</th>
                        </tr>
                        @foreach ($r as $rv)
                            <tr>
                                <td class="coch-table-left">{{$rv->user->First_name}} {{$rv->user->Last_name}}</td>
                                <td>{{$rv->user->email}}</td>
                                <td>{{$rv->status}}</td>
                                <form action="{{ url($conf->Conference_abbr.'/delete-assgreviewer/'.$rv->id) }}" method="post">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                    <td><button type="submit" onclick="return confirm('Are you sure you want to delete the Rejected Reviewer?');" title="Rejected Reviewer Delete"><i class="bi bi-trash"></i></button></td>
                                </form>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
        @if(($acount+$pcount+$rcount)<2 && ($paper->full_paper))
            <div class="cochair-assign">
                <form method="post" action="{{ url('/conf/'.$conf->Conference_abbr.'/addreviewer/'.$paper->Paper_id) }}"> <!-- tambah url -->
                @csrf
                    <div class="cochair-assign-header">Add Reviewer</div>
                    <div class="text-muted">*The invitee must be a user in UTM Conference Management System</div>
                    <div class="cochair-assign-email">
                        <input type="email" name="email" id="email" placeholder="enter email address to invite" required style="width: 70%; text-align: center;">
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="reviewsubmitbtn" onclick="return confirm('Are you sure you want to invite this user?');">Send Invite</button>              
                    </div> 
                </form>
            </div>
        @endif
    </div>
</body>
@endsection