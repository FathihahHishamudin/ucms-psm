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
            <div class="header-font">REGISTER CONFERENCE</div>
        </div>
        
        @if($conffee->isEmpty())
            cjaadnadcn
        @else
            <div class="page-info">
                <p>Registration to <span style="text-transform: uppercase;"> {{ $conf->Conference_name }} </span> ({{ $conf->Conference_abbr }}) conference is now open!!
                <br>You can choose to participate as a listener or as an author.</p>
            </div>
            <div class="m-5">
                <hr class="new1">
                <table class="text-xl table table-borderless">
                    <tr class="bor-bot">
                        <th>Type</th>
                        <th style="text-align: center;">Details</th>
                        <th style="text-align: center;">Amount</th>
                    </tr>
                    @foreach ($conffee as $fee)
                        <tr>
                            <td>{{$fee->Type}}</td>
                            <td style="text-align: center;">{{$fee->Fee_details}}</td>
                            <td style="text-align: center;">{{$fee->Currency}} {{$fee->amount}}</td>
                        </tr>
                    @endforeach  
                </table>
                <hr class="new1">
                <div class="registerconferencebox text-xl">
                    <form method="POST" action="{{ url('/conf/'.$conf->Conference_abbr).'/register/addParticipant'}}">
                    {{csrf_field()}}
                        <div style="font-weight: bold;">
                            Select Participant Type
                        </div>
                        <div class="px-5 py-3">
                            @foreach ($conffee as $fee)
                                <label class="checkcontainer" for="fee_{{ $fee->Fee_id }}">{{$fee->Fee_details}} ({{$fee->Type}})
                                    <input type="radio" id="fee_{{ $fee->Fee_id }}" name="parType" value="{{$fee->Fee_id}}" data-fee-type="{{$fee->Type}}" required>
                                    <span class="radiobtn"></span>
                                </label>
                            @endforeach 
                        </div>


                        <div class="flex justify-center">
                            <button type="submit" id="addparsubmitBtn" class="reviewsubmitbtn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#addparsubmitBtn').on('click', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Check if a radio button is selected
            if ($('input[name="parType"]:checked').length === 0) {
                alert('Please select a participant type.');
                return; // Stop further execution
            }

            // Get the selected fee type
            var feeType = $('input[name="parType"]:checked').data('fee-type');

            // Show confirmation dialog with fee type
            if (confirm("\nAre you sure you want to register as " + feeType + "?\n\nPlease note that you won't be able to modify your registration.")) {
                // Proceed with the form submission
                $('form').submit();
            }
        });
    </script>

</body>
@endsection