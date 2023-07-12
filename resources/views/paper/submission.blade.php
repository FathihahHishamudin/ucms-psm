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
                INFORMATION ON PAPERS SUBMISSION   ({{$paper->conference->Conference_abbr}}-{{$paper->Paper_id}})
            </div>

            <div class="m-4 text-lg">
                Conference Committee can check the papers that has been submitted by Author <b>{{$paper->paperauthor->authoruser->Salutation}} {{$paper->paperauthor->authoruser->First_name}} {{$paper->paperauthor->authoruser->Last_name}}</b> <br>
                Conference Committee is able to remove papers that has been submitted but doesn't match the needed format. <br>
                Paper that has been reviewed by reviewer can no longer be removed.
            </div>

            <hr class="new1">

            @if (!$paper->full_paper)
                <div class="m-4 text-lg">
                {{$paper->paperauthor->authoruser->Salutation}} {{$paper->paperauthor->authoruser->First_name}} {{$paper->paperauthor->authoruser->Last_name}} has not uploaded his/her full paper to the system.
                </div>
            @else
                <table class="mt-5 table table-bordered" style="width: 90%; margin:auto;">
                    <tr>
                        <td><b>Full Paper</b></td>
                        <td><a href="{{ asset('upload/papers/' . $paper->full_paper) }}" target="_blank">View Uploaded Full Paper</a></td>
                        @php $rfpstat = App\Http\Controllers\ReviewsController::getFPreviewstatus($paper);
                        @endphp
                        <form method="POST" action="{{ route('delete') }}" class="delete-form">
                            @csrf
                            <input type="hidden" name="paper_id_fp" value="{{ $paper->Paper_id }}">
                            <input type="hidden" name="paper_id_fpb" value="{{ $paper->Paper_id }}">
                            @if($rfpstat == "belum")
                                <td style="background-color: maroon; color:white; font-weight:bold;">
                                    <button class="deleteBtn" style="width:100%; height:100%;" type="submit">DELETE</button>
                                </td>
                            @elseif($rfpstat == "dah" || $rfpstat == "sudah")
                                <td style="background-color: lightgrey; color:white; font-weight:bold;">
                                    <button class="deleteBtn" style="width:100%; height:100%;" type="submit" disabled>DELETE</button>
                                </td>
                            @endif
                        </form>
                    </tr>
                    @if($paper->full_paper_br != null)
                        <tr>
                            <td><b>Full Paper (For Blind Review)</b></td>
                            <td><a href="{{ asset('upload/papers/' . $paper->full_paper_br) }}" target="_blank">View Uploaded Full Paper (For Blind Review)</a></td>
                            @php $rfpstat = App\Http\Controllers\ReviewsController::getFPreviewstatus($paper);
                            @endphp
                            <form method="POST" action="{{ route('delete') }}" class="delete-form">
                                @csrf
                                <input type="hidden" name="paper_id_fp" value="{{ $paper->Paper_id }}">
                                <input type="hidden" name="paper_id_fpb" value="{{ $paper->Paper_id }}">
                                @if($rfpstat == "belum")
                                    <td style="background-color: maroon; color:white; font-weight:bold;">
                                        <button class="deleteBtn" style="width:100%; height:100%;" type="submit">DELETE</button>
                                    </td>
                                @elseif($rfpstat == "dah" || $rfpstat == "sudah")
                                    <td style="background-color: lightgrey; color:white; font-weight:bold;">
                                        <button class="deleteBtn" style="width:100%; height:100%;" type="submit" disabled>DELETE</button>
                                    </td>
                                @endif
                            </form>
                        </tr>
                    @endif
                    @if($paper->Correction_fp != null)
                        <tr>
                            <td><b>Correction Full Paper</b></td>
                            <td><a href="{{ asset('upload/papers/' . $paper->Correction_fp) }}" target="_blank">View Uploaded Correction Full Paper</a></td>
                            @php $rcfpstat = App\Http\Controllers\ReviewsController::getCFPreviewstatus($paper);
                            @endphp
                            <form method="POST" action="{{ route('delete') }}" class="delete-form">
                                @csrf
                                <input type="hidden" name="paper_id_cfp" value="{{ $paper->Paper_id }}">
                                <input type="hidden" name="paper_id_cfpb" value="{{ $paper->Paper_id }}">
                                @if($rcfpstat == "belum")
                                    <td style="background-color: maroon; color:white; font-weight:bold;">
                                        <button class="deleteBtn" style="width:100%; height:100%;" type="submit">DELETE</button>
                                    </td>
                                @elseif($rcfpstat == "dah" || $rcfpstat == "sudah")
                                    <td style="background-color: lightgrey; color:white; font-weight:bold;">
                                        <button class="deleteBtn" style="width:100%; height:100%;" type="submit" disabled>DELETE</button>
                                    </td>
                                @endif
                            </form>
                        </tr>
                    @endif
                    @if($paper->Correction_fp_br != null)
                        <tr>
                            <td><b>Correction Full Paper (For Blind Review)</b></td>
                            <td><a href="{{ asset('upload/papers/' . $paper->Correction_fp_br) }}" target="_blank">View Uploaded Correction Full Paper (For Blind Review)</a></td>
                            @php $rcfpstat = App\Http\Controllers\ReviewsController::getCFPreviewstatus($paper);
                            @endphp
                            <form method="POST" action="{{ route('delete') }}" class="delete-form">
                                @csrf
                                <input type="hidden" name="paper_id_cfp" value="{{ $paper->Paper_id }}">
                                <input type="hidden" name="paper_id_cfpb" value="{{ $paper->Paper_id }}">
                                @if($rcfpstat == "belum")
                                    <td style="background-color: maroon; color:white; font-weight:bold;">
                                        <button class="deleteBtn" style="width:100%; height:100%;" type="submit">DELETE</button>
                                    </td>
                                @elseif($rcfpstat == "dah" || $rcfpstat == "sudah")
                                    <td style="background-color: lightgrey; color:white; font-weight:bold;">
                                        <button class="deleteBtn" style="width:100%; height:100%;" type="submit" disabled>DELETE</button>
                                    </td>
                                @endif
                            </form>
                        </tr>
                    @endif
                    @if($paper->cr_paper != null)
                        <tr>
                            <td><b>Camera Ready Paper</b></td>
                            <td><a href="{{ asset('upload/papers/' . $paper->cr_paper) }}" target="_blank">Camera Ready Paper</a></td>
                            <td style="background-color: maroon; color:white; font-weight:bold;">
                                <form method="POST" action="{{ route('delete') }}" class="delete-form">
                                    @csrf
                                    <input type="hidden" name="paper_id_cr" value="{{ $paper->Paper_id }}">
                                    <button class="deleteBtn" style="width:100%; height:100%;" type="submit">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                </table>
            
            @endif
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.deleteBtn').on('click', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Show confirmation dialog
            if (confirm("\nConfirm delete?\n\nYou cannot recover the file after deletion.")) {
                // Proceed with the form submission of the parent form
                $(this).closest('form').submit();
            }
        });
    </script>
</body>
@endsection