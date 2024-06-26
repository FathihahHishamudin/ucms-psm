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
            @if ($cfrole == "AUTHOR" || $cfrole == "LISTENER")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/payment' }}">PAYMENT</a>
            @endif
        </div>
    </div>

    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">MY PAPER</div>
        </div>

        <div class="papersec-box">
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
                    <td class="w-1/4 px-4 py-1"><b>Paper ID</b></td>
                    <td class="w-3/4 px-4 py-1"><b>: {{$paper->Paper_id}}</b></td>
                </tr>
                <tr>
                    <td class="w-1/4 px-4 py-1" class="det-left"><b>Paper Title</b></td>
                    <td class="w-3/4 px-4 py-1"><b>: {{$paper->paper_title}}</b></td>
                </tr>
                <tr>
                    <td class="w-1/4 px-4 py-1" class="det-left"><b>Paper Abstract Status</b></td>
                    @if($paper->abstract == null)
                        <td class="w-3/4 px-4 py-1"><b>: <b class="text-red-600">Abstract has not been uploaded</b></b></td>
                    @else
                        <td class="w-3/4 px-4 py-1"><b>: <b class="text-green-600">Abstract has been uploaded</b></b></td>
                    @endif
                </tr>
            </table>
        </div>

        <hr class="new1">

        <div class="papersec-box">
            <div class="papersec-boxhead">Submission Status</div>
            <table class="psub">
                <tr>
                    <th>Item</th>
                    <th>Submission Status (Paper Status)</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>Full Paper Submission</td>
                    @if($paper->full_paper == null)
                        <td><span class="text-red-600"><b>None </b></span>(<span class="text-red-600"><b>-</b></span>)</td>
                        @if($paper->abstract == null)
                            <td><button id="tButton1" disabled>Submit</button></td>
                        @endif
                        @if($paper->abstract !== null)
                            <td><button id="tButton1">Submit</button></td>
                        @endif
                    @else
                        <td><span class="text-green-600"><b>Submitted</b></span>
                        @if ($paper->stat_fp == null)
                            (<span class="text-primary"><b>Pending</b></span>)
                            </td>
                            <td><button id="tButton1">View</button></td>
                        @elseif ($paper->stat_fp == "Rejected")
                            (<span class="text-danger"><b>Rejected</b></span>)
                            </td>
                            <td><button id="tButton1">View Review</button></td>
                        @else
                            (<span class="text-green-400"><b>{{$paper->stat_fp}}</b></span>)
                            </td>
                            <td><button id="tButton1">View Review</button></td>
                        @endif
                    @endif
                </tr>
                <tr>
                    <td>Correction Paper Submission</td>
                    @if($paper->Correction_fp == null)
                        <td><span class="text-red-600"><b>None </b></span>(<span class="text-red-600"><b>-</b></span>)</td>
                        @if($paper->stat_fp == null || $paper->stat_fp == "Rejected" || $paper->stat_fp == "Strong Acceptance")
                            <td><button id="tButton2" disabled>Submit</button></td>
                        @elseif($paper->stat_fp == "Accepted" || $paper->stat_fp == "Weak Acceptance")
                            <td><button id="tButton2">Submit</button></td>
                        @endif
                    @else
                        <td><span class="text-green-600"><b>Submitted</b></span>
                        @if ($paper->stat_fp == "Weak Acceptance" && $paper->stat_cfp == null)
                            (<span class="text-primary"><b>Pending</b></span>)
                            </td>
                            <td><button id="tButton2">View</button></td>
                        @elseif ($paper->stat_cfp == "Rejected")
                            (<span class="text-danger"><b>{{$paper->stat_cfp}}</b></span>)
                            </td>
                            <td><button id="tButton2">View Review</button></td>
                        @elseif ($paper->stat_cfp == "Accepted")
                            (<span class="text-green-400"><b>{{$paper->stat_cfp}}</b></span>)
                            </td>
                            <td><button id="tButton2">View Review</button></td>
                        @elseif ($paper->stat_fp == "Accepted")
                            </td>
                            <td><button id="tButton2">View</button></td>
                        @endif
                    @endif
                    
                </tr>
                <tr>
                    <td>Camera-Ready Paper Submission</td>
                    @if($paper->cr_paper == null)
                        <td><span class="text-red-600"><b>None </b></span>(<span class="text-red-600"><b>-</b></span>)</td>
                        @if(($paper->stat_fp == "Rejected") || ($paper->stat_fp == "Accepted" && $paper->Correction_fp == null) || ($paper->stat_fp == "Weak Acceptance" && $paper->Correction_fp == null) || ($paper->stat_fp == "Weak Acceptance" && $paper->stat_cfp == null))
                            <td><button id="tButton3" disabled>Submit</button></td>
                        @elseif($paper->stat_fp == "Strong Acceptance")
                            <td><button id="tButton3">Submit</button></td>
                        @elseif($paper->stat_fp == "Accepted" && $paper->Correction_fp != null)
                            <td><button id="tButton3">Submit</button></td>
                        @elseif($paper->stat_fp == "Weak Acceptance" && $paper->stat_cfp != null)
                            @if($paper->stat_cfp == "Accepted")
                                <td><button id="tButton3">Submit</button></td>
                            @elseif($paper->stat_cfp == "Rejected")
                                <td><button id="tButton3" disabled>Submit</button></td>
                            @endif
                        @endif
                    @else
                        <td><span class="text-green-600"><b>Submitted</b></span></td>
                        <td><button id="tButton3">View</button></td>
                    @endif
                    
                </tr>
            </table>
        </div>
<!-- -------------------------section------------------------- -->
        <div id="tSection1" style="display: none;">
            <div>
                <hr class="new1">
                <div class="papersec-box">
                    <div class="papersec-boxhead">Full Paper Submission</div>

                    <div class="paperSubmitBox">
                        <div class="paperSubmitHeader">Full Paper Submission</div>

                        @if($paper->full_paper)
                            <a href="{{ asset('upload/papers/' . $paper->full_paper) }}" target="_blank">View Uploaded Full Paper</a> <br>
                            <a href="{{ asset('upload/papers/' . $paper->full_paper_br) }}" target="_blank">View Uploaded Full Paper (Blind Review)</a>
                            @php $rfpstat = App\Http\Controllers\ReviewsController::getFPreviewstatus($paper);
                            @endphp
                            @if($rfpstat == "belum")
                                <form method="POST" action="{{ route('delete') }}">
                                    @csrf
                                    <input type="hidden" name="paper_id_fp" value="{{ $paper->Paper_id }}">
                                    <input type="hidden" name="paper_id_fpb" value="{{ $paper->Paper_id }}">
                                    <button type="submit" onclick="return confirm('Are you sure you want to Delete the paper?\nYou cannot undo your deletion.');">Delete</button>
                                </form>
                            @elseif ($rfpstat == "dah" || $rfpstat == "sudah")
                                <p>This paper can no longer be removed as it has been reviewed by a reviewer.</p>
                            @endif
                        @else
                            <p>Please submit the full paper in <b>file type: PDF</b></p>
                            <form method="POST" action="{{ url('/conf/'.$conf->Conference_abbr).'/mypaper/upload' }}" enctype="multipart/form-data">
                                @csrf
                                <input style="margin-bottom: 10px;" type="file" id="fullpaper" name="fullpaper" required><br>
                                <p>Please submit the full paper (Blind Review) in <b>file type: PDF</b></p>
                                <input type="file" id="fullpaperbr" name="fullpaperbr" required><br>
                                <button type="submit" id="uploadBtn" autofocus>UPLOAD</button>
                            </form>
                        @endif
                    </div>

                    @if($paper->stat_fp)
                        <div class="mt-5 papersec-boxhead">Full Paper Review</div>
                        <div class="p-4" style="border: maroon 2px solid; border-radius:16px;">
                            <div class="upddet">
                                @if($paper->stat_fp == "Strong Acceptance")
                                    <i class="text-danger bi bi-exclamation-lg"></i><i class="text-danger bi bi-exclamation-lg"></i>&nbsp; Author can directly upload the camera-ready paper to the system. 
                                @elseif($paper->stat_fp == "Accepted")
                                    <i class="text-danger bi bi-exclamation-lg"></i><i class="text-danger bi bi-exclamation-lg"></i>&nbsp; Author need to revise the paper based on Reviewers' comments and submit the correction full paper. The correction full paper won't be reviewed and Author can directly upload the camera-ready paper to the system. 
                                @elseif($paper->stat_fp == "Weak Acceptance")
                                    <i class="text-danger bi bi-exclamation-lg"></i><i class="text-danger bi bi-exclamation-lg"></i>&nbsp; Author need to revise the paper based on Reviewers' comments and submit the correction full paper. The correction full paper will be reviewed by the Reviewers before Author can upload the camera-ready paper to the system.
                                @elseif($paper->stat_fp == "Rejected")
                                    <i class="text-danger bi bi-exclamation-lg"></i><i class="text-danger bi bi-exclamation-lg"></i>&nbsp; Author's paper is rejected. Author cannot submit any papers to the system anymore. 
                                @endif
                            </div>
                            <table class="table table-borderless text-lg">
                                <tr >
                                    <td style="text-align:right; width: 15%;"><b>Paper Status</b></td>
                                    @if ($paper->stat_fp == "Rejected")
                                        <td class="text-danger" style="text-align:justify;">: <b> {{$paper->stat_fp}}</b> </td>
                                    @else
                                        <td class="text-green-400" style="text-align:justify;">: <b> {{$paper->stat_fp}}</b> </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td style="text-align:right;"><b>Reviewer 1 Comment</b></td>
                                    <td style="text-align:justify;">: {{$paper->fpreview1->comment}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;"><b>Reviewer 2 Comment</b></td>
                                    <td style="text-align:justify;">: {{$paper->fpreview2->comment}}</td>
                                </tr>
                            </table>                        
                        </div>
                    @endif

                </div>
            </div>

        </div>

        <div id="tSection2" style="display: none;">
            <div>
                <hr class="new1">
                <div class="papersec-box">
                    <div class="papersec-boxhead">Correction Paper Submission</div>

                    <div class="paperSubmitBox">
                        <div class="paperSubmitHeader">Correction Paper Submission</div>
                        
                        @if($paper->Correction_fp)
                            <a href="{{ asset('upload/papers/' . $paper->Correction_fp) }}" target="_blank">View Uploaded Correction Paper</a> <br>
                            <a href="{{ asset('upload/papers/' . $paper->Correction_fp_br) }}" target="_blank">View Uploaded Correction Paper (Blind Review)</a>
                            @php $rcfpstat = App\Http\Controllers\ReviewsController::getCFPreviewstatus($paper);
                            @endphp
                            @if($rcfpstat == "belum")
                                <form method="POST" action="{{ route('delete') }}">
                                    @csrf
                                    <input type="hidden" name="paper_id_cfp" value="{{ $paper->Paper_id }}">
                                    <input type="hidden" name="paper_id_cfpb" value="{{ $paper->Paper_id }}">
                                    <button type="submit" onclick="return confirm('Are you sure you want to Delete the paper?\nYou cannot undo your deletion.');">Delete</button>
                                </form>
                            @elseif ($rcfpstat == "dah" || $rcfpstat == "sudah")
                                <p>This paper can no longer be removed as it has been reviewed by a reviewer.</p>
                            @endif
                        @else
                            <p>Please submit the correction paper in <b>file type: PDF</b></p>
                            <form method="POST" action="{{ url('/conf/'.$conf->Conference_abbr).'/mypaper/upload' }}" enctype="multipart/form-data">
                                @csrf
                                <input style="margin-bottom: 10px;" type="file" id="corpaper" name="correctionpaper" required><br>
                                <p>Please submit the correction paper (Blind Review) in <b>file type: PDF</b></p>
                                <input type="file" id="corpaperbr" name="correctionpaperbr" required><br>
                                <button type="submit" id="uploadBtnCP" disabled>UPLOAD</button>
                            </form>

                            <script>
                                document.getElementById('corpaper').addEventListener('change', function() {
                                    document.getElementById('uploadBtnCP').disabled = this.files.length === 0;
                                });
                            </script>
                        @endif
                    </div>

                    @if($paper->stat_cfp)
                        <div class="mt-5 papersec-boxhead">Correction Full Paper Review</div>
                        <div class="p-4" style="border: maroon 2px solid; border-radius:16px;">
                            <div class="upddet">
                                @if($paper->stat_cfp == "Accepted")
                                    <i class="text-danger bi bi-exclamation-lg"></i><i class="text-danger bi bi-exclamation-lg"></i>&nbsp; Author can upload the camera-ready paper to the system. 
                                @elseif($paper->stat_cfp == "Rejected")
                                    <i class="text-danger bi bi-exclamation-lg"></i><i class="text-danger bi bi-exclamation-lg"></i>&nbsp; Author's correction paper is rejected. Author cannot submit any papers to the system anymore. 
                                @endif
                            </div>
                            <table class="table table-borderless text-lg">
                                <tr >
                                    <td style="text-align:right; width: 15%;"><b>Paper Status</b></td>
                                    @if ($paper->stat_cfp == "Rejected")
                                        <td class="text-danger" style="text-align:justify;">: <b> {{$paper->stat_cfp}}</b> </td>
                                    @else
                                        <td class="text-green-400" style="text-align:justify;">: <b> {{$paper->stat_cfp}}</b> </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td style="text-align:right;"><b>Reviewer 1 Comment</b></td>
                                    <td style="text-align:justify;">: {{$paper->cfpreview1->comment}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;"><b>Reviewer 2 Comment</b></td>
                                    <td style="text-align:justify;">: {{$paper->cfpreview2->comment}}</td>
                                </tr>
                            </table>                        
                        </div>
                    @endif

                </div>
            </div>

        </div>

        <div id="tSection3" style="display: none;">
            <div>
                <hr class="new1">
                <div class="papersec-box">
                    <div class="papersec-boxhead">Camera Ready Paper Submission</div>                    
                    <div class="paperSubmitBox">
                        <div class="paperSubmitHeader">Camera Ready Paper Submission</div>
                        @if($paper->cr_paper)
                            <a href="{{ asset('upload/papers/' . $paper->cr_paper) }}" target="_blank">View Uploaded Camera Ready Paper</a>
                            <form method="POST" action="{{ route('delete') }}">
                                @csrf
                                <input type="hidden" name="paper_id_cr" value="{{ $paper->Paper_id }}">
                                <button type="submit" onclick="return confirm('Are you sure you want to Delete the paper?\nYou cannot undo your deletion.');">Delete</button>
                            </form>
                        @else
                            <p>Please submit the camera ready paper in <b>file type: PDF</b></p>
                            <form method="POST" action="{{ url('/conf/'.$conf->Conference_abbr).'/mypaper/upload' }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="camready" name="crpaper"><br>
                                <button type="submit" id="uploadBtnCR" disabled>Upload</button>
                            </form>

                            <script>
                                document.getElementById('camready').addEventListener('change', function() {
                                    document.getElementById('uploadBtnCR').disabled = this.files.length === 0;
                                });
                            </script>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
@include('author.modal.edit-paper-det')   

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var button1 = document.getElementById('tButton1');
            var button2 = document.getElementById('tButton2');
            var button3 = document.getElementById('tButton3');
            var section1 = document.getElementById('tSection1');
            var section2 = document.getElementById('tSection2');
            var section3 = document.getElementById('tSection3');

            button1.addEventListener('click', function () {
                toggleSection(section1);
            });

            button2.addEventListener('click', function () {
                toggleSection(section2);
            });

            button3.addEventListener('click', function () {
                toggleSection(section3);
            });

            function toggleSection(targetSection) {
                var sections = [section1, section2, section3];

                for (var i = 0; i < sections.length; i++) {
                    if (sections[i] === targetSection) {
                        if (sections[i].style.display === 'block') {
                            sections[i].style.display = 'none';
                        } else {
                            sections[i].style.display = 'block';
                            sections[i].scrollIntoView({ behavior: 'smooth' }); // Scroll to the section
                        }
                    } else {
                        sections[i].style.display = 'none';
                    }
                }
            }
        });
    </script>


</body>
@endsection