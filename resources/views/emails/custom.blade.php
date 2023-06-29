<!DOCTYPE html>
<html>
<head>
    <title>Invitation as a PC Co-Chair</title>
</head>
<body>
    <h1>Invitation as a PC Co-Chair for {{$confe->Conference_name}} ({{$confe->Conference_abbr}})</h1>
    
    <br>
    <h2>Hello {{ $user->Salutation }} {{ $user->First_name }} {{ $user->Last_name }},</h2>
    <br>
    <p>You have been invited to be a PC Co-Chair for <span style="text-transform: uppercase; font-weight:bold;">{{$confe->Conference_name}} ({{$confe->Conference_abbr}})</span>. Please consider accepting the invitation and joining the conference as a PC Co-Chair.</p>
    <a href="{{ url('/cochairrole/'.$confe->Conference_abbr.'/'.$user->id) }}">Click here to Accept or Decline the invitation</a>
    <p>Thank you.</p>
</body>
</html>
