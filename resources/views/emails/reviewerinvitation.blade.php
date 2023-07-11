<!DOCTYPE html>
<html>
    <head>
        <title>Invitation as a Reviewer</title>
    </head>
    
    <body>
        <h1>{{$confe->Conference_name}} ({{$confe->Conference_abbr}})</h1>

        <h2><i>Review for # {{$confe->Conference_abbr}}-{{$paper->Paper_id}}: {{$paper->paper_title}}</i></h4>
        <br>
        <h4>Hello {{ $user->Salutation }} {{ $user->First_name }} {{ $user->Last_name }},</h4>
        <br>
        <p>We are honoured to invite you to review a paper that has been submitted to <span style="text-transform: uppercase; font-weight:bold;">{{$confe->Conference_name}} ({{$confe->Conference_abbr}})</span>. 
        Please consider accepting the invitation and joining the conference as a Reviewer. The details of the paper is as below:</p>
        <table style="text-align: justify;">
            <tr>
                <td><b>Paper title</b></td>
                <td>{{$paper->paper_title}}</td>
            </tr>
            <tr>
                <td><b>Conference</b></td>
                <td>{{$confe->Conference_name}}</td>
            </tr>
            <tr>
                <td><b>Abstract</b></td>
                <td>{{$paper->abstract}}</td>
            </tr>
        </table>
        <br><hr><br>
        Please click the link below to ACCEPT/DECLINE the invitation. Once you accept the review, you can complete it.
        <br>
        <a href="{{ url('/reviewacceptance/'.$confe->Conference_abbr.'/'.$user->id) }}">Click here to Accept or Decline the invitation</a>
        <p>Thank you,</p>
        <p>{{$confe->Conference_name}}</p>
    </body>
</html>