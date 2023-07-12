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
                [CORRECTION PAPER] INFORMATION ON CONFERENCE PAPER STATUS   ({{$paper->conference->Conference_abbr}}-{{$paper->Paper_id}})
            </div>
            <div class="m-4 text-lg">
                Conference Committee need to give <b>FINAL STATUS</b> to the paper based on the reviews given by the reviewers.<br>
                The submitted final status cannot be modified. <br>
            </div>

            <hr class="new1">

            <div class="finalstatuscfp">
                <div class="mt-4 text-lg" style="text-decoration: underline; text-align:center;">
                    <b>FINAL STATUS (CORRECTION FULL PAPER)</b>
                </div>
                <table class="mt-1 table table-bordered stat-tab" style="border-color: #9d6567;">
                    @if($paper->review1_cfp_id)
                        <tr>
                            <td class="stat-tab-left" style="background-color: #6A1515;" rowspan="2"> Reviewer 1</td>
                            <td>{{$paper->cfpreview1->status}} ({{$paper->cfpreview1->p_status}})</td>
                            <td>Total Point: <b>{{$paper->cfpreview1->total}}</b>/30</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{$paper->cfpreview1->comment}}</td>
                        </tr>
                    @endif
                    @if($paper->review2_cfp_id)
                        <tr>
                            <td class="stat-tab-left" style="background-color: #6A1515;" rowspan="2"> Reviewer 2</td>
                            <td>{{$paper->cfpreview2->status}} ({{$paper->cfpreview2->p_status}})</td>
                            <td>Total Point: <b>{{$paper->cfpreview2->total}}</b>/30</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{$paper->cfpreview2->comment}}</td>
                        </tr>
                    @endif
                    @php $rcfpstat = App\Http\Controllers\ReviewsController::getCFPreviewstatus($paper);
                    @endphp
                    @if ($rcfpstat == "sudah")
                        @if($paper->stat_cfp)
                            <tr>
                                <td class="stat-tab-left" style="background-color: #6A1515;" >FINAL STATUS</td>
                                <td colspan="2" style="background-color: #9d6567;" >
                                    <select name="correctionfinalstatus" id="correctionfinalstatus" disabled>
                                        <option value="Accepted" {{ $paper->stat_cfp == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Rejected" {{ $paper->stat_cfp == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="stat-tab-left" style="background-color: #6A1515;" >FINAL STATUS</td>
                                <form action="{{ url('/conf/'.$conf->Conference_abbr.'/committeemenu/papers/'.$paper->Paper_id.'/statuspage/updatecor') }}" method="post" >
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                    <td colspan="2" style="background-color: #9d6567;" >
                                        <select name="correctionfinalstatus" id="correctionfinalstatus" required>
                                            <option value="" disabled selected>Select an option</option>
                                            <option value="Accepted">Accepted</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>

                                        <input type="hidden" name="pId" value="{{ $paper->Paper_id }}">
                                        <div class="flex justify-center">
                                            <button type="submit" class="reviewsubmitbtn" onclick="return confirm('Are you sure you want to submit the selected final status?\nYou cannot modify your submission.');">Submit</button>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td class="stat-tab-left" style="background-color: #6A1515;" >FINAL STATUS</td>
                            <td colspan="2">Final Status cannot be assigned as the paper has not been reviewed by <b>both</b> Reviewers</td>
                        </tr>
                    @endif
                </table>

            </div>


        </div>

    </div>
</body>
@endsection