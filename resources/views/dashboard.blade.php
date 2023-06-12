@extends('layouts.navbar-loggedin')
@include('layouts.styles')


@section('content')
<body>
    <div class="container-tengah">
        <div class="header-line">
            <div class="header-font">DASHBOARD</div>
        </div>
        <div class="page-info">
            <p>Below is your active role</p>
        </div>

        <div class="dashboard-page">
            <!-- PC-Chair role-->
            <div class="role">
                <div class="menu dashboard-u">
                    <div class="red-font text-xl">PC-Chair</div>
                    <a class="red-font text-xl font-bold underline" href="{{url('/create-conf')}}">Create Your Conference</a>
                </div>
                <div class="mb-4 mt-2 ml-lg-5">
                    @foreach($chairs as $chairs)
                    <div >
                        <table>
                            <tbody>
                                <tr>
                                    @php $confname = App\Http\Controllers\DashboardController::getConferenceName($chairs->Conference_id);
                                    @endphp
                                    @php $confabbr = App\Http\Controllers\DashboardController::getConferenceAbbr($chairs->Conference_id);
                                    @endphp
                                    <div class="listrole"><a href="{{ url('/conf/'.$confabbr) }}">{{$confname}}</a></div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    @forelse ($chairs as $chairs)
                        @empty
                        <div class="listrole border-0">
                        You have not been assigned as a PC-Chair in any active conferences.    
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- PC-Cochair role-->
            <div class="role">
                <div class="dashboard-u">
                    <div class="red-font text-xl">PC-CoChair</div>
                </div>
                <div class="mb-4 mt-2 ml-lg-5">
                    @foreach($cochairs as $cochairs)
                    <div >
                        <table>
                            <tbody>
                                <tr>
                                    @php $confname = App\Http\Controllers\DashboardController::getConferenceName($cochairs->Conference_id);
                                    @endphp
                                    <div class="listrole">{{$confname}}</div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    @forelse ($cochairs as $cochairs)
                        @empty
                        <div class="listrole border-0">
                        You have not been assigned as a PC-CoChair in any active conferences.    
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Reviewers role-->
            <div class="role">
                <div class="dashboard-u">
                    <div class="red-font text-xl">Reviewer</div>
                </div>
                <div class="mb-4 mt-2 ml-lg-5">
                    @foreach($reviewer as $reviewer)
                    <div >
                        <table>
                            <tbody>
                                <tr>
                                    @php $confname = App\Http\Controllers\DashboardController::getConferenceName($reviewer->Conference_id);
                                    @endphp
                                    <div class="listrole">{{$confname}}</div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    @forelse ($reviewer as $reviewer)
                        @empty
                        <div class="listrole border-0">
                        You have not been assigned as a Reviewer in any active conferences.    
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Authors role-->
            <div class="role">
                <div class="dashboard-u">
                    <div class="red-font text-xl">Author</div>
                </div>
                <div class="mb-4 mt-2 ml-lg-5">
                    @foreach($author as $author)
                    <div >
                        <table>
                            <tbody>
                                <tr>
                                    @php $confname = App\Http\Controllers\DashboardController::getConferenceName($author->Conference_id);
                                    @endphp
                                    <div class="listrole">{{$confname}}</div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    @forelse ($author as $author)
                        @empty
                        <div class="listrole border-0">
                        You have not registered in any active conferences as an Author.    
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Normal Participant role-->
            <div class="role">
                <div class="dashboard-u">
                    <div class="red-font text-xl">Normal Participant</div>
                </div>
                <div class="mb-4 mt-2 ml-lg-5">
                    @foreach($np as $np)
                    <div >
                        <table>
                            <tbody>
                                <tr>
                                    @php $confname = App\Http\Controllers\DashboardController::getConferenceName($np->Conference_id);
                                    @endphp
                                    <div class="listrole">{{$confname}}</div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    @forelse ($np as $np)
                        @empty
                        <div class="listrole border-0">
                        You have not registered in any active conferences as a Normal Participant.    
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</body>
@endsection