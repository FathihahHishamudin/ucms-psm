@extends('layouts.navbar-loggedin')
@include('layouts.styles')
@include('layouts.confstyles')

@section('content')
<body>
    <div class="dropdown">
        <button class="dropbtn">
            <div class="column side"></div>
            <div class="column middle">{{$conf->Conference_name}}</div>
            @auth
                @if($cfrole != null)
                    <div class="column side">[ {{$cfrole}} ]</div>
                @endif
            @endauth
        </button>
        <div class="dropdown-content">
            <a href="{{ url('/conf/'.$conf->Conference_abbr)}}">HOME</a>
            <a href="#">REGISTRATION</a>
            <a href="{{ url('/conf/'.$conf->Conference_abbr).'/contactus' }}">CONTACT US</a>
            @if ($cfrole=="CHAIR" or $cfrole=="CO-CHAIR" or $cfrole=="REVIEWER")
                <a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu' }}">COMMITTEE MENU</a>
            @endif
        </div>
    </div>

    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">CONFERENCE FEES</div>
        </div>

        <div class="text-end">
            <a href="" class="btn btn-lg btn-dark rounded-circle shadow" data-bs-toggle="modal" data-bs-target="#addFeeModal" title="Add new fee">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="45" fill="currentColor" class="bi bi-plus-lg " viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
            </a>
        </div>

        <div class="py-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($fees as $fees)
                    <div class="col">
                        <div class="card shadow h-100">
                            <div class="card-header">
                                <h4 class="card-title text-center"><b>FEE</b></h4>
                            </div>
                            <!-- Card details -->
                            <div class="card-body">
                                <p class="card-text">
                                    <i class="bi bi-person"> {{ $fees->Type }}</i> <br> 
                                    <i class="bi bi-tag"> {{ $fees->Fee_details }}</i> <br> 
                                    <i class="bi bi-pin-angle"> {{ $fees->Currency }} {{ $fees->amount }}</i> 
                                </p>
                                <!-- Buttons -->
                                <div class="text-end">
                                    <!-- Edit button -->
                                    <a href="{{ url('/conf/'.$conf->Conference_abbr).'/committeemenu/edit-fees/'.($fees->Fees_id) }}" class="btn btn-sm btn-secondary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- Delete button -->
                                    <form action="{{ url('/delete-fee/'.$fees->Fee_id) }}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-sm btn-danger mt-3" type="submit" onclick="return confirm('Confirm delete');" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>  
                                    <!-- Date created -->
                                    <small class="text-muted">
                                        created {{ $fees->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <!-- to call the add pakage modal -->
    

@include('chair.modal.newFee')
@endsection
</body>