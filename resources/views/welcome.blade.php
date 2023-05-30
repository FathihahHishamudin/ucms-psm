@extends('layouts.navbar')
@include('layouts.styles')


@section('content')

    
    <body>
        <div>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif            
        </div>
        <div class="container-tengah">
            <div class="header-line">
                <div class="header-font">ACTIVE CONFERENCES</div>
            </div>
            
            <table id="confe">
                <tr>
                    <th>Conference</th>
                    <th>Date</th>
                </tr>
                @foreach($conf as $conf)
                <tr>
                    <td>{{$conf->Conference_name}}</td>
                    <td>{{$conf->Conference_date}}</td>
                </tr>
                @endforeach
                @forelse ($conf as $conf)
                    @empty
                    <tr>There is no activ</tr>
                @endforelse
            </table>
            
                
        </div>
    </body>
@endsection
