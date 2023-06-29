@extends('layouts.navbar')
@include('layouts.styles')
@include('layouts.confstyles')


@section('content')
<body>
    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">CONFERENCE CO-CHAIR ROLE ACCEPTANCE</div>
        </div>

        <div>
            @if($ada)
                <div class="assgcochairbox">
                    <p style="text-align: center; margin: 40px;"> You have been invited to be a <br><b>CO-CHAIR</b><br> for <br><b style="text-transform: uppercase;">{{$assg->conference->Conference_name}} ({{$assg->conference->Conference_abbr}})</b></p>
                </div>
                <div class="text-center">
                    <form method="POST" action="{{ route('cochair.accept') }}" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="assgIdA" value="{{$assg->id}}">
                        <button type="submit" id="acceptcoBtn" class="acceptco">ACCEPT</button>
                    </form>
                    &nbsp;
                    <form method="POST" action="{{ route('cochair.decline') }}" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="assgIdD" value="{{$assg->id}}">
                        <button type="submit" id="declinecoBtn" class="declineco">DECLINE</button>
                    </form>
                </div>

                

            @else
                <p style="margin: 40px 50px 40px 50px;">You have not been assigned as a co-chair for this conference</p>
            @endif

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $('.acceptco').on('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Show confirmation dialog
        if (confirm("\nAre you sure you want to ACCEPT the role?\n\nPlease note that you won't be able to modify your choice.")) {
            // Proceed with the form submission
            $(this).closest('form').submit();
        }
    });

    $('.declineco').on('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Show confirmation dialog
        if (confirm("\nAre you sure you want to DECLINE the role?\n\nPlease note that you won't be able to modify your choice.")) {
            // Proceed with the form submission
            $(this).closest('form').submit();
        }
    });
</script>
</body>
@endsection