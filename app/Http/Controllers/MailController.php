<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CustomEmail;
use App\Models\assignCochair;
use App\Models\assignReviewer;
use App\Models\Author;
use App\Models\Conference;
use App\Models\Normal_Participant;
use App\Models\Paper;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;
use App\Models\Reviewer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Support\Facades\DB;
use App\Mail\InviteReviewer;
use Carbon\Carbon;
use Swift_Events_SendEvent;

class MailController extends Controller
{
    public function coChairInvitation(Request $request, $abbr)
    {
        $confe = Conference::where('Conference_abbr', $abbr)->first();

        // Step 1: Validate conference
        if (!$confe) {
            return redirect()->back()->with('error', "Conference is not found.");
        }

        $email = $request->input('email');

        // Step 2: Validate that the email belongs to a user in the system
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('error', "The invited PC Co-Chair must already have an account in UTM Conference Management System!");
        }

        $c = PC_Chair::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();
        $cc = PC_CoChair::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();
        $r = Reviewer::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();
        $a = Author::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();
        $np = Normal_Participant::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();

        // Step 3: Check if the user is not a conference chair, co-chair, reviewer, listener, or author
        if($c || $cc || $r || $a || $np) {
            return redirect()->back()->with('error', "The invited PC Co-Chair already have a role in the conference!");
        }

        $acc = assignCochair::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();

        //Step 4: Check if the user has been invited to be a co chair but status still pending
        if ($acc) {
            return redirect()->back()->with('error', "The invited PC Co-Chair has already been invited before and their invitation status is still Pending");
        }

        //Step 5: Send email invitation
        $this->sendCustomEmail($user, $confe);

        return redirect('/conf/' . $confe->Conference_abbr . '/committeemenu/cochair');

    }

    public function sendCustomEmail(User $user, Conference $confe)
    {
        $conf = DB::select('select * from conferences');
    
        try {
            Mail::to($user->email)->send(new CustomEmail($user, $confe));
            $status = 'success';
            $message = 'Email sent successfully';
            if ($status == "success") {
                // Step 6: Add a row in assign_cochair table
                AssignCochair::create([
                    'Conference_id' => $confe->Conference_id,
                    'User_id' => $user->id,
                    'status' => 'Pending',
                ]);

                return redirect('/conf/' . $confe->Conference_abbr . '/committeemenu/cochair');
            }
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Email not sent and the user of the keyed in email address is failed to be invited as a PC Co-Chair of this conference';

            return redirect()->back()->with($status, $message);
        }
    }
    
    public function reviewerInvitation (Request $request, $abbr, $pId)
    {

        $confe = Conference::where('Conference_abbr', $abbr)->first();
        $paper = Paper::where('Paper_id', $pId)->first();
        // Step 1: Validate conference
        if (!$confe) {
            return redirect()->back()->with('error', "Conference is not found.");
        }
        if (!$paper) {
            return redirect()->back()->with('error', "Paper is not found.");
        }

        $email = $request->input('email');

        // Step 2: Validate that the email belongs to a user in the system
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('error', "The invited Reviewer must already have an account in UTM Conference Management System!");
        }

        $c = PC_Chair::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();
        $cc = PC_CoChair::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();
        $a = Author::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();
        $np = Normal_Participant::where('Conference_id', $confe->Conference_id)->where('User_id', $user->id)->first();

        // Step 3: Check if the user is not a conference chair, co-chair, reviewer, listener, or author
        if($c || $cc || $a || $np) {
            return redirect()->back()->with('error', "The invited Reviewer already have a role beside reviewer in the conference!");
        }

        $acc = assignReviewer::where('Paper_id', $paper->Paper_id)->where('User_id', $user->id)->first();

        //Step 4: Check if the user has been invited to be a reviewer but status still pending
        if ($acc) {
            return redirect()->back()->with('error', "The invited Reviewer has already been invited before and their invitation status is still Pending or Decline. Please delete them to reinvite again.");
        }

        $acr = Reviewer::where('Conference_id', $paper->Conference_id)->where('User_id', $user->id)->first();
        if ($acr) {
            if(($paper->r1_id == $acr->Reviewer_id) || ($paper->r2_id == $acr->Reviewer_id)) {
                return redirect()->back()->with('error', "The invited Reviewer is already a reviewer for this paper.");
            }
        }

        //Step 5: Send email invitation
        $this->sendReviewerInvitationEmail($user, $confe, $paper);

        return redirect('/conf/' . $confe->Conference_abbr . '/committeemenu/papers/'.$paper->Paper_id.'/reviewerpage');
    }

    public function sendReviewerInvitationEmail(User $user, Conference $confe, Paper $paper)
    {
        try {
            Mail::to($user->email)->send(new InviteReviewer($user, $confe, $paper));
            $status = 'success';
            $message = 'Email sent successfully';
            $dueDate = Carbon::now()->addDays(7)->toDateString();
            if ($status == "success") {
                // Step 6: Add a row in assign_reviewer table
                assignReviewer::create([
                    'Conference_id' => $confe->Conference_id,
                    'Paper_id' => $paper->Paper_id,
                    'User_id' => $user->id,
                    'status' => 'Pending',
                    'due' => $dueDate,
                ]);
    
                // Redirect the user to the desired URL
                return redirect('/conf/' . $confe->Conference_abbr . '/committeemenu/papers/'.$paper->Paper_id.'/reviewerpage');
            }
        } catch (\Exception $e) {
            $status = 'error';
            $message = 'Email not sent and the user of the keyed-in email address is failed to be invited as a PC Co-Chair of this conference';
    
            // Handle the error condition accordingly (e.g., log the error, display an error message, etc.)
            return redirect()->back()->with($status, $message);
        }
    }

}
