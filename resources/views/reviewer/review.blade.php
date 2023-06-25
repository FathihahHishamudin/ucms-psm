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
            <div class="header-font">PAPER REVIEW</div>
        </div>

        <div class="p-3 pb-0 text-xl" style="color: #3A0000;"><b>Paper Details</b></div>        
        <hr class="new1">

        <table class="md:table-fixed text-lg paper-det-table m-4">
            <tr>
                <td class="w-1/5 px-4 py-2" style="text-align: right;">Title :</td>
                <td class="w-4/5 py-2">{{ $paper->paper_title}} </td>
            </tr>
            <tr>
                <td class="w-1/5 px-4 py-2" style="text-align: right;">Download Paper :</td>
                <td class="w-4/5 py-2">
                    <a class="buttonlike" href="{{ asset('upload/papers/' . $paper->full_paper) }}" target="_blank">View the Manuscript</a>
                </td>
            </tr>
            <tr>
                <td class="w-1/5 px-4 py-2" style="text-align: right;">Review Status :</td>
                @if ($reviews->status == "To Review")
                    <td class="w-4/5 py-2"><button id="reviewFormButton" class="buttonlike">Review Now</button></td>
                @elseif ($reviews->status == "Reviewed")
                    <td class="w-4/5 py-2"> Reviewed ({{$reviews->p_status}}) </td>
                @endif
            </tr>
        </table>
        <hr class="new1">
        
<!-- -------------------------section------------------------- -->
        <div class="mt-5" id="reviewFormSection" style="display: none;">
            <div class="p-3 pb-0 text-xl" style="color: #3A0000;"><b>REVIEW NOW: Paper Reviewing Form</b></div>        
            <hr class="new1">
            <div class="rfkotakA">
                <form id="subRevForm" action="{{ route('review.update', ['rId' => $reviews->Review_id]) }}" method="POST">  <!--------------------- form start -------------------->
                    @csrf
                    @method('PUT')

                    <div class="rfkotakB">
                        <div class="text-lg mb-3">
                            <table class="table-auto text-lg"><tr>
                                <td class="px-2"><b>Conference Name: </b></td>
                                <td class="px-2"> {{$conf->Conference_name}}</td>
                            </tr></table>
                            <table class="table-auto text-lg"><tr>
                                <td class="px-2"><b>Paper ID : </b></td>
                                <td class="px-2"> {{$conf->Conference_abbr}}-{{$paper->Paper_id}}</td>
                            </tr></table>
                            <table class="table-auto text-lg"><tr>
                                <td class="px-2"><b>Paper Title: </b></td>
                                <td class="px-2"> {{$paper->paper_title}}</td>
                            </tr></table>
                        </div>
                        
                        <hr class="new2">

                        <div>
                            <p class="text-lg mt-2">Rate the manuscript from 0 to 5, poor to best respectively.</p>

                            <div>
                                <table class="md:table-fixed rftable">
                                    <tr>
                                        <th class="w-1/5 px-4">No</th>
                                        <th class="w-3/5 px-4">Reviews Item</th>
                                        <th class="w-20">Points</th>
                                    </tr>
                                    <tr>
                                        <td class="w-1/5 px-4">1</td>
                                        <td class="w-3/5 px-4" style="text-align: left;">Originality of Work</td>
                                        <td class="w-1/5">
                                            <select id="ori" name="ori" class="calculate-select" style="padding: 0px;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/5 px-4">2</td>
                                        <td class="w-3/5 px-4" style="text-align: left;">Originality of Reference</td>
                                        <td class="w-1/5">
                                            <select id="ref" name="ref" class="calculate-select" style="padding: 0px;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/5 px-4">3</td>
                                        <td class="w-3/5 px-4" style="text-align: left;">Relevance to the Conference</td>
                                        <td class="w-1/5">
                                            <select id="rel" name="rel" class="calculate-select" style="padding: 0px;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/5 px-4">4</td>
                                        <td class="w-3/5 px-4" style="text-align: left;">Suitability of Research Methodology</td>
                                        <td class="w-1/5">
                                            <select id="sui" name="sui" class="calculate-select" style="padding: 0px;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/5 px-4">5</td>
                                        <td class="w-3/5 px-4" style="text-align: left;">Novelty of Findings</td>
                                        <td class="w-1/5">
                                            <select id="fin" name="fin" class="calculate-select" style="padding: 0px;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/5 px-4">6</td>
                                        <td class="w-3/5 px-4" style="text-align: left;">Language Quality</td>
                                        <td class="w-1/5">
                                            <select id="lan" name="lan" class="calculate-select" style="padding: 0px;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <table class="md:table-fixed rftable mt-1 mb-4">
                                    <tr>
                                        <td class="px-4" style="text-align: right; background: #e6dada;">Total Points</td>
                                        <td class="w-20" style="text-align: center; background: #6a1515; color: white;">
                                            <span id="total">0</span>/30
                                            <input type="hidden" id="total-input" name="total" value="0">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <hr class="new2">
                        <p class="text-lg mt-2">The paper status is automatically assigned based on the <b><u>total points</u></b> given.</p>

                        <div class="radioreview">
                            
                            <input type="radio" id="sa" name="pstat" value="Strong Acceptence" disabled>
                            <label for="ac">&nbsp; Strong Acceptence</label><br>
                            <input type="radio" id="ac" name="pstat" value="Accepted" disabled>
                            <label for="ac">&nbsp; Accepted</label><br>
                            <input type="radio" id="wa" name="pstat" value="Weak Acceptence" disabled>
                            <label for="ac">&nbsp; Weak Acceptence</label><br>
                            <input type="radio" id="re" name="pstat" value="Rejected" disabled>
                            <label for="ac">&nbsp; Rejected</label><br>

                            <input type="hidden" id="pstat-hidden" name="pstat-hidden">
                        </div>

                        <div class="reviewcommentarea">
                            <div class="rcatitle">
                                <b style="font-size: 19px; color:#3a0000; padding-right:5px;">Comment</b>
                            </div>
                            <textarea style="resize:none; height: 83px; width: 560px; margin:auto;" name="comment" id="comment"></textarea>
                        </div>


                    </div>
                    <div class="mt-2 flex justify-center items-center">
                        <input id="default-checkbox" type="checkbox" value="" class="text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" required>
                        <label for="default-checkbox" class="text-lg" style="color: #3A0000;">
                            &nbsp;&nbsp;I have read the manuscript and gave reviews based on the manuscript
                        </label>
                    </div>

                    <div class="flex justify-center">
                        <button id="submitBtn" type="submit" class="reviewsubmitbtn">Submit</button>
                    </div>                    
                </form> <!------------------------ where form end ---------------------------->
                
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var button = document.getElementById('reviewFormButton');
            var section = document.getElementById('reviewFormSection');

            button.addEventListener('click', function () {
                if (section.style.display === 'none') {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.calculate-select').on('change', function () {
                calculateTotal();
                updateRadioSelection();
            });

            function calculateTotal() {
                var total = 0;

                $('.calculate-select').each(function () {
                    var selectedOption = parseInt($(this).val()) || 0;
                    total += selectedOption;
                });

                $('#total').text(total);
                $('#total-input').val(total);
            }

            function updateRadioSelection() {
                var total = parseInt($('#total').text());

                if (total >= 0 && total <= 11) {
                    $('input[name="pstat"]').prop('checked', false);
                    $('#re').prop('checked', true);
                    $('#pstat-hidden').val("Rejected");
                } else if (total >= 12 && total <= 17) {
                    $('input[name="pstat"]').prop('checked', false);
                    $('#wa').prop('checked', true);
                    $('#pstat-hidden').val("Weak Acceptance");
                } else if (total >= 18 && total <= 23) {
                    $('input[name="pstat"]').prop('checked', false);
                    $('#ac').prop('checked', true);
                    $('#pstat-hidden').val("Accepted");
                }   else if (total >= 24 && total <= 30) {
                    $('input[name="pstat"]').prop('checked', false);
                    $('#sa').prop('checked', true);
                    $('#pstat-hidden').val("Strong Acceptance");
                }
            }

            // Handle form submission
            $('#submitBtn').on('click', function (e) {
                var checkbox = $('#default-checkbox');
                if (checkbox.is(':checked')) {
                    e.preventDefault(); // Prevent the default form submission

                    // Show confirmation dialog
                    if (confirm("Are you sure you want to submit? You won't be able to modify after your submission.")) {
                        // Proceed with the form submission
                        $('form').submit();
                    }
                }
            });

            // Initially update the radio selection on page load
            updateRadioSelection();
        });
    </script>
    
    
    
</body>
@endsection