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
            <div class="header-font">CONFERENCE PARTICIPANT LIST</div>
        </div>

        <div>
            <p class="mx-3 my-3">Note for Payment Status icon:</p>
            <p class="mx-5 my-3"><i class="bi bi-x-lg text-danger">&nbsp;- Have not upload/paid</i></p>
            <p class="mx-5 my-3"><i class="bi bi-exclamation-circle-fill text-warning">&nbsp;- Have upload (committee need to check to change status)</i></p>
            <p class="mx-5 my-3"><i class="bi bi-check-lg text-success">&nbsp;- Paid</i></p>
        </div>

        @if($listauthor || $listnpar)    
            <table id="confe">
                <tr>
                    <th>Participant Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Payment Status</th>
                </tr>
                @foreach($listauthor as $listaut)
                <tr>
                    <td>{{$listaut->authoruser->First_name}} {{$listaut->authoruser->Last_name}}</td>
                    <td>{{$listaut->authoruser->email}}</td>
                    <td class="text-center">{{$listaut->payment->fee->Type}}</td>
                    <td class="text-center">
                        @if($listaut->payment->payment_status == 'Unpaid')
                            <i class="fs-4 bi bi-x-lg text-danger"></i>
                        @elseif ($listaut->payment->payment_status == 'Pending')
                            <a href="#" data-bs-toggle="modal" data-bs-target="#updPayModalA{{ $listaut->Author_id }}">
                                <i class="fs-4 bi bi-exclamation-circle-fill text-warning"></i>
                            </a>
                        @else
                            <i class="fs-4 bi bi-check-lg text-success"></i>
                        @endif
                    </td>
                </tr>
                @endforeach
                @foreach($listnpar as $listnp)
                <tr>
                    <td>{{$listnp->user->First_name}} {{$listnp->user->Last_name}}</td>
                    <td>{{$listnp->user->email}}</td>
                    <td  class="text-center">{{$listnp->payment->fee->Type}}</td>
                    <td class="text-center">
                        @if($listnp->payment->payment_status == 'Unpaid')
                            <i class="fs-4 bi bi-x-lg text-danger"></i>
                        @elseif ($listnp->payment->payment_status == 'Pending')
                            <a href="#" data-bs-toggle="modal" data-bs-target="#updPayModalB{{ $listnp->Participant_id }}">
                                <i class="fs-4 bi bi-exclamation-circle-fill text-warning"></i>
                            </a>
                        @else
                            <i class="fs-4 bi bi-check-lg text-success"></i>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table> 
        @endif

        
    @include('chair.modal.updatepayauthor')  
    @include('chair.modal.updatepaylistener')  

                
    </div>
</body>
@endsection