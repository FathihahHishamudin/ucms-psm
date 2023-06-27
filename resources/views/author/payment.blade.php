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
            @if ($cfrole == "AUTHOR")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/mypaper' }}">MY PAPER</a>
            @endif
            @if ($cfrole == "AUTHOR" || $cfrole == "LISTENER")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/payment' }}">PAYMENT</a>
            @endif
        </div>
    </div>

    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">MY PAYMENT</div>
        </div>
        <div class="payment-container">
            <div class="payment-header">Payment Details of User {{Auth::user()->First_name}} {{Auth::user()->Last_name}}</div>
            <div class="paym-det-box">
                <hr class="new1">
                <table class="table table-borderless" style="font-size: 17px;">
                    <tr>
                        <td class="kol-left">Name:</td>
                        <td class="kol-right">{{Auth::user()->First_name}} {{Auth::user()->Last_name}}</td>
                    </tr>
                    <tr>
                        <td class="kol-left">Registered As:</td>
                        <td class="kol-right">{{$payment->fee->Type}}</td>
                    </tr>
                    <tr>
                        <td class="kol-left">Details:</td>
                        <td class="kol-right">{{$payment->fee->Fee_details}}</td>
                    </tr>
                    <tr>
                        <td class="kol-left">Amount to Pay:</td>
                        <td class="kol-right">{{$payment->fee->Currency}} {{$payment->fee->amount}}</td>
                    </tr>
                    <tr>
                        <td class="kol-left">Status:</td>
                        <td class="kol-right">{{$payment->payment_status}}</td>
                    </tr>
                    <tr>
                        <td class="kol-left"><b>Upload Proof of Payment:</b></td>
                        <td class="kol-right">
                            @if ($payment->file)
                                <a href="{{ asset('upload/proofpayment/' . $payment->file) }}" target="_blank">View Uploaded Proof of Payment</a>
                                <form method="POST" action="{{ route('delete-pop') }}" style="display: inline; margin-left:10px">
                                    @csrf
                                    <input type="hidden" name="popId" value="{{ $payment->Payment_id }}">
                                    <button id="delpopBtn" type="submit">Remove</button>
                                </form>
                            @else
                                <form method="POST" action="{{ url('/conf/'.$conf->Conference_abbr).'/payment/upload' }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="proofpayment" name="proofpayment">
                                    <button type="submit" id="proofPaymentBtn" disabled autofocus>UPLOAD</button>
                                    <br><span class="fst-italic text-muted">*jpeg, jpg, png, pdf</span>
                                </form>

                                <script>
                                    document.getElementById('proofpayment').addEventListener('change', function() {
                                        document.getElementById('proofPaymentBtn').disabled = this.files.length === 0;
                                    });
                                </script>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#delpopBtn').on('click', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Show confirmation dialog
            if (confirm("\nAre you sure you want to remove the Proof of Payment file?\n\nPlease note that you won't be able to undo your action.")) {
                // Proceed with the form submission
                $('form').submit();
            }
        });
    </script>
</body>
@endsection