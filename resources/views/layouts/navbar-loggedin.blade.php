<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<style>
    .topbar {
        margin: auto;
        width: 64%;
        text-align: center;
        background-color: #e4e4e4;
        display: flex;
        justify-content: center;
    }

    .menu{
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .left-menu{
        display: flex;
        justify-content: flex-start;
    }

    .right-menu{
        display: flex;
        justify-content: flex-end;
        flex-direction: column;
        margin-right: 20px;
        margin-bottom: 10px;
    }

    .links{
        display: flex;
        flex-direction: row;
        font-size: 16px;
        justify-content: right;
    }

    .hiname{
        font-size: 18px;
        text-align: right;
    }

    .ulogo {
        padding: 10px 0px 10px 10px;
    }

    .center {
        display: block;   
        margin-left: auto;
        margin-right: auto;
    }

    #ucms {
        padding-top: 40px;
        font-size: 20px;
        font-weight: bold;
    }
</style>

<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="topbar">
    <div class="menu">
        <div class="left-menu">
            <div class="ulogo">
            <a href="{{ url('/') }}"><img src="/image/UTMlogo2.png" alt="UTM Logo" width="200px" class="center"></a>
            </div>
            <div id="ucms">UTM CONFERENCE MANAGEMENT SYSTEM</div>
        </div>
        <div class="right-menu">
            @auth
                <div class="hiname">
                    Hi <b>{{Auth::user()->First_name}} {{Auth::user()->Last_name}}</b>
                </div>
                <div class="links">
                    @if (request()->route()->getName() == 'dashboard')
                        <div class="myprofile">
                            <a href="{{ route('profile.show') }}">{{ __('My Profile') }}</a>
                        </div>
                    @else
                    <div class="mydashboard">
                            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                        </div>
                    @endif
                    <b class="px-2">|</b>
                    <div class="logout">
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <a href="{{ route('logout') }}"
                                @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                            </a>
                        </form>
                        
                    </div>
                </div>
            @else
                <div class="links">
                    <div class="myprofile">
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                    <b class="px-2">|</b>
                    <div class="mydash">
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
    

  @if($errors->any())
    @foreach($errors->all() as $error)
      <div class="alert alert-warning" role="alert">
        {{$error}}
      </div>
    @endforeach
  @endif
  
  @yield('content')

</body>
</html>