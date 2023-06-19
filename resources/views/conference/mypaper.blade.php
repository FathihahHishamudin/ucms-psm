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
            <div class="header-font">MY PAPER</div>
        </div>

        <div class="pdetails-box">
            <div class="pdet-header-line">
                My Paper Details   
                <a href="" style="padding-left: 10px;" data-bs-toggle="modal" data-bs-target="#updatePaperDet" title="Update paper details">
                    <i style="font-size: 16px;" class="bi bi-pencil-square"></i>
                </a>
            </div>
            
            @if($paper->paper_title == null)
            <div class="upddet">
                <i class="text-danger bi bi-exclamation-lg"></i>Please update your <b>paper details</b> to be able to upload your paper to the system. 
            </div>
            @endif

            <table class="table-fixed paper-det-table">
                <tr >
                    <td class="w-1/4 px-4 py-2"><b>Paper ID</b></td>
                    <td class="w-3/4 px-4 py-2"><b>: {{$paper->Paper_id}}</b></td>
                </tr>
                <tr>
                    <td class="w-1/4 px-4 py-2" class="det-left"><b>Paper Title</b></td>
                    <td class="w-3/4 px-4 py-2"><b>: {{$paper->paper_title}}</b></td>
                </tr>
                <tr>
                    <td class="w-1/4 px-4 py-2" class="det-left"><b>Paper Abstract Status</b></td>
                    @if($paper->abstract == null)
                        <td class="w-3/4 px-4 py-2"><b>: <b class="text-red-600">Abstract has not been uploaded</b></b></td>
                    @else
                        <td class="w-3/4 px-4 py-2"><b>: <b class="text-green-600">Abstract has been uploaded</b></b></td>
                    @endif
                </tr>
            </table>

        </div>
    </div>
@include('author.modal.edit-paper-det')    
</body>
@endsection