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
    }

    .topbarlogo {
        background-color: #e4e4e4;
        margin: auto;
        padding: 10px 0px;
    }

    .center {
    display: block;   
    margin-left: auto;
    margin-right: auto;
    }

    #ucms {
        padding-top: 5px;
        font-size: 24px;
        font-weight: bold;
    }
</style>

<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="topbar">
    <div class="topbarlogo">
        <a href="{{ url('/') }}"><img src="/image/UTMlogo2.png" alt="UTM Logo" width="350px" class="center"></a>
    </div>
    <div id="ucms">
        UTM CONFERENCE MANAGEMENT SYSTEM
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