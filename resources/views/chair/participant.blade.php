@extends('layouts.navbar-loggedin')
@include('layouts.styles')


@section('content')
<body>
<div class="dropdown">
    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">CONFERENCE PARTICIPANT LIST</div>
        </div>
            
         <table id="confe">
            <tr>
                <th>Participant Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Payment Status</th>
            </tr>
            @foreach($parti as $parti)
            <tr>
                <td>{{$parti->Salutation}} {{$parti->First_name}} {{$parti->Last_name}}</td>
                <td>{{$parti->email}}</td>
                <td></td>
                <td>a</td>
            </tr>
            @endforeach
            @forelse ($parti as $parti)
                @empty
                    <tr>There is no active conference</tr>
                @endforelse
        </table> 

        
            
                
    </div>
</body>
@endsection