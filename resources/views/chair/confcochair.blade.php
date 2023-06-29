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

        <div class="cochair-list-box">
            <div class="ca-head my-2">PC Co Chair</div>
            
            @if($accept == "ada")
                <table class="table table-bordered coch-table">
                    <tr>
                        <th class="coch-table-left">PC Co-Chair Full Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Remove</th>
                    </tr>
                    @foreach ($ccA as $rowa)
                    <tr>
                        <td class="coch-table-left">{{$rowa->user->First_name}} {{$rowa->user->Last_name}}</td>
                        <td>{{$rowa->user->email}}</td>
                        <td>{{$rowa->Co_status}}</td>
                        <form action="{{ url($conf->Conference_abbr.'/delete-cochair/'.$rowa->CoChair_id) }}" method="post">
                            {{csrf_field()}}
                            {{ method_field('DELETE') }}
                            <td><button type="submit" onclick="return confirm('Are you sure you want to delete the Co-Chair?');" title="CoChair Delete"><i class="bi bi-trash"></i></button></td>
                        </form>
                    </tr>
                    @endforeach
                </table>
            @else
                <p style="font-size: 16px; padding-left:10px;">There is no pending CoChair/s for this conference. Please invite a user of the system to be a CoChair</p>
            @endif
                
        </div>

        <div class="cochair-list-box">
            <div class="ca-head my-2">Pending PC Co Chair</div>

            @if($pending == "ada")
                <table class="table table-bordered coch-table" style="width: 70%;">
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Remove</th>
                    </tr>
                    @foreach ($ccP as $rowp)
                    <tr>
                        <td>{{$rowp->user->email}}</td>
                        <td>{{$rowp->status}}</td>
                        <form action="{{ url($conf->Conference_abbr.'/delete-pending-cochair/'.$rowp->id) }}" method="post">
                            {{csrf_field()}}
                            {{ method_field('DELETE') }}
                            <td><button type="submit" onclick="return confirm('Are you sure you want to delete the Pending invited Co-Chair?');" title="CoChair Delete"><i class="bi bi-trash"></i></button></td>
                        </form>
                    </tr>
                    @endforeach
                </table>
            @else
                <p style="font-size: 16px; padding-left:10px;">There is no pending CoChair/s for this conference. Please invite a user of the system to be a CoChair</p>
            @endif
        </div>

        <div class="cochair-assign">
            <form method="post" action="{{ url('/conf/'.$conf->Conference_abbr.'/addcochair') }}"> <!-- tambah url -->
            @csrf
                <div class="cochair-assign-header">Add PC Co-Chair</div>
                <div class="text-muted">*The invitee must be a user in UTM Conference Management System</div>
                <div class="cochair-assign-email">
                    <input type="email" name="email" id="email" placeholder="enter email address to invite" required style="width: 70%; text-align: center;">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="reviewsubmitbtn" onclick="return confirm('Are you sure you want to invite this user?');">Send Invite</button>              
                </div> 
            </form>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
@endsection