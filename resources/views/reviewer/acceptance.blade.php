@extends('layouts.navbar')
@include('layouts.styles')
@include('layouts.confstyles')


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
                    <div>
                        <table class="m-4 table-fixed psub">
                            <tr>
                               <th>NO</th>
                               <th>PAPER DETAILS</th>
                               <th>ACCEPTANCE STATUS</th> 
                            </tr>
                        @foreach($assg as $row)
                            @php $paper =  App\Http\Controllers\ReviewsController::getpaper($row); @endphp
                                <tr>
                                    <td rowspan="2" style="width: 10%;">{{ $loop->iteration }}</td>
                                    <td style="width: 70%; text-align:left;">Paper Title: <br>{{ $paper->paper_title }}</td>
                                    <td style="width: 20%;">
                                        <select name="status[]">
                                            <option value="Pending">Pending</option>
                                            <option value="Accept">Accept</option>
                                            <option value="Reject">Reject</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td colspan="2" style="text-align: justify;">
                                        Abstract: <br>
                                    
                                        {{$paper->abstract}}
                                    </td>
                                </tr>
                            <!-- Include a hidden input field to send the reviewer ID along with the status -->
                            <input type="hidden" name="assgIds[]" value="{{ $row->id }}">
                        @endforeach
                        </table>
                    </div>
                    

                    <div class="flex justify-center">
                        <button type="submit" class="reviewsubmitbtn">Submit</button>
                    </div>
                </form>
            @else
                <p style="margin: 40px 50px 40px 50px;">You have no paper assigned that need to be accepted or declined at the moment</p>
            @endif
        </div>
    </div>
</div>
@endsection