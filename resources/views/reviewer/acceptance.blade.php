@extends('layouts.navbar')
@include('layouts.styles')


@section('content')
<div>
    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">PAPER REVIEW ACCEPTANCE</div>
        </div>
        <div>
            @if($ada)
                <form method="POST" action="{{ route('reviewer.updateStatus') }}">
                    @csrf

                    @foreach($assg as $row)
                        <div>
                            @php $paper =  App\Http\Controllers\ReviewsController::getpaper($row); @endphp
                            <p>{{ $paper->paper_title }}</p>

                            <select name="status[]">
                                <option value="Pending">Pending</option>
                                <option value="Accept">Accept</option>
                                <option value="Reject">Reject</option>
                            </select>

                            <!-- Include a hidden input field to send the reviewer ID along with the status -->
                            <input type="hidden" name="assgIds[]" value="{{ $row->id }}">
                        </div>
                    @endforeach

                    <button type="submit">Submit</button>
                </form>
            @else
                <p style="margin: 40px 50px 40px 50px;">You have no paper assigned that need to be accepted or declined at the moment</p>
            @endif
        </div>
    </div>
</div>
@endsection