<?php

namespace App\Http\Controllers;

use App\Models\assignCochair;
use App\Models\Conference;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PCCoChairController extends Controller
{
    public function index($abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();

        // Check if the conference was found
        if ($conf) {
            if(Auth::check()) 
            {
                $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

                if      ($ch != null)    {   $cfrole = "CHAIR";  }
                else                     {    $cfrole = null;}

                if($cfrole != null)
                {   
                    $ccA = PC_CoChair::where('Conference_id', $conf->Conference_id)->get();
                    $ccP = assignCochair::where('Conference_id', $conf->Conference_id)->where('status', "Pending")->get();

                    if($ccA->isEmpty()) { $accept = "tiada"; }
                    else                { $accept = "ada"; }

                    if($ccP->isEmpty()) { $pending = "tiada"; }
                    else                { $pending = "ada"; }

                    return view('chair.confcochair',['conf'=>$conf, 'cfrole'=>$cfrole, 
                                                    'ccA'=>$ccA, 'accept'=>$accept,
                                                    'ccP'=>$ccP, 'pending'=>$pending]);
                }
                else
                {   return redirect()->back()->with('error', 'Unauthorized access.');}

            }
            else{
                // Chair/coChair not found or user ID does not match, handle the error
                return redirect()->back()->with('error', 'Unauthorized access.');
            }
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        else {
            // Conference not found, handle the error
            return redirect()->back()->with('error', 'Conference not found.');
        }
    }

    public function showPage ($abbr, $uId)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();

        if ($conf && $uId == Auth::user()->id) {
            $ada = null;

            $assg = assignCochair::where('Conference_id', $conf->Conference_id)
                                ->where ('User_id', Auth::user()->id)
                                ->where ('status', "Pending")
                                ->first();

            if ($assg) {
                $ada = "ada";
            }

            return view ('cochair.acceptance', compact('assg', 'ada'));
        }
        return redirect()->back()->with('error', "You don't have the access to the Page");
    }

    public function accept (Request $request)
    {
        $assg = assignCochair::find($request->assgIdA);

        if ($assg) {
            $cochair = new PC_CoChair();
            $cochair->User_id = $assg->User_id;
            $cochair->Conference_id = $assg->Conference_id;
            $cochair->Co_status = "Accept";
            $cochair->save();

            $assg->delete();

            return redirect ('/')->with('success', 'You have accept the invitation as a cochair!');
        }

        return redirect()->back()->with('error', 'Unable to accept the invitation!');
    }

    public function decline (Request $request)
    {
        $assg = assignCochair::find($request->assgIdD);

        if ($assg) {

            $assg->delete();

            return redirect ('/')->with('success', 'You have decline the invitation to be a cochair!');
        }

        return redirect()->back()->with('error', 'Unable to decline the invitation!');
    }

    public function deletecochair ($abbr, $coId)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $chair = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if ($chair) {

            PC_CoChair::find($coId)->delete();
            return redirect()->back()->with('success', 'You have successfully remove the user from the conference cochair!');
        }

        return redirect()->back()->with('error', 'Unable to remove the cochair.');
    }

    public function deletepending ($abbr, $pcoId)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $chair = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if ($chair) {

            assignCochair::find($pcoId)->delete();
            return redirect()->back()->with('success', 'You have successfully remove the pending invited cochair!');
        }

        return redirect()->back()->with('error', 'Unable to remove the pending invited cochair!');
    }

}