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
                        <td><span class="text-green-600"><b>Submitted</b></span></td>
                        <td><button id="tButton1">View</button></td>
                    @endif
                </tr>
                <tr>
                    <td>Correction Paper Submission</td>
                    @if($paper->Correction_fp == null)
                        <td><span class="text-red-600"><b>None </b></span>(<span class="text-red-600"><b>-</b></span>)</td>
                        @if($paper->full_paper == null)
                            <td><button id="tButton2" disabled>Submit</button></td>
                        @endif
                        @if($paper->full_paper !== null) <!-- tak guna elseif sebab it doesn't work -->
                            <td><button id="tButton2">Submit</button></td>
                        @endif
                    @else
                        <td><span class="text-green-600"><b>Submitted</b></span></td>
                        <td><button id="tButton2">View</button></td>
                    @endif
                    
                </tr>
                <tr>
                    <td>Camera-Ready Paper Submission</td>
                    @if($paper->cr_paper == null)
                        <td><span class="text-red-600"><b>None </b></span>(<span class="text-red-600"><b>-</b></span>)</td>
                        @if($paper->Correction_fp == null)
                            <td><button id="tButton3" disabled>Submit</button></td>
                        @endif
                        @if($paper->Correction_fp !== null) <!-- tak guna elseif sebab it doesn't work -->
                            <td><button id="tButton3">Submit</button></td>
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
                            <a href="{{ asset('upload/papers/' . $paper->full_paper) }}" target="_blank">View Uploaded Full Paper</a>
                            <form method="POST" action="{{ route('delete') }}">
                                @csrf
                                <input type="hidden" name="paper_id_fp" value="{{ $paper->Paper_id }}">
                                <button type="submit">Delete</button>
                            </form>
                        @else
                            <p>Please submit the full paper in <b>file type: PDF</b></p>
                            <form method="POST" action="{{ url('/conf/'.$conf->Conference_abbr).'/mypaper/upload' }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="fullpaper" name="fullpaper"><br>
                                <button type="submit" id="uploadBtn" disabled autofocus>UPLOAD</button>
                            </form>

                            <script>
                                document.getElementById('fullpaper').addEventListener('change', function() {
                                    document.getElementById('uploadBtn').disabled = this.files.length === 0;
                                });
                            </script>
                        @endif
                    </div>

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
                            <a href="{{ asset('upload/papers/' . $paper->Correction_fp) }}" target="_blank">View Uploaded Correction Paper</a>
                            <form method="POST" action="{{ route('delete') }}">
                                @csrf
                                <input type="hidden" name="paper_id_cfp" value="{{ $paper->Paper_id }}">
                                <button type="submit">Delete</button>
                            </form>
                        @else
                            <p>Please submit the correction paper in <b>file type: PDF</b></p>
                            <form method="POST" action="{{ url('/conf/'.$conf->Conference_abbr).'/mypaper/upload' }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="corpaper" name="correctionpaper"><br>
                                <button type="submit" id="uploadBtnCP" disabled>UPLOAD</button>
                            </form>

                            <script>
                                document.getElementById('corpaper').addEventListener('change', function() {
                                    document.getElementById('uploadBtnCP').disabled = this.files.length === 0;
                                });
                            </script>
                        @endif
                    </div>

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
                                <button type="submit">Delete</button>
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