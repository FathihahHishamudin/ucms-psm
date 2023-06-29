<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Paper;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewerController extends Controller
{
    public function index($abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();

        // Check if the conference was found
        if ($conf) {
            if(Auth::check()) 
            {
                $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
                $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

                if          ($ch != null)    {   $cfrole = "CHAIR";     }
                elseif      ($coch != null)  {   $cfrole = "CO-CHAIR";  }
                else                         {   $cfrole = null;        }

                if($cfrole != null)
                {
                    $reviewers = Reviewer::where('Conference_id', $conf->Conference_id)->get();

                    if($reviewers->isEmpty())   { $ada = null; }
                    else                        { $ada = "1"; }

                    return view('chair.confreviewer',['conf'=>$conf, 'cfrole'=>$cfrole,
                                                    'reviewers'=>$reviewers, 'ada'=>$ada]);
                }
                else
                {   return redirect()->back()->with('error', 'Unauthorized access.');}

            }
            else{
                // Chair/coChair not found or user ID does not match, handle the error
                return redirect()->back()->with('error', 'Unauthorized access.');
            }
        }
        else {
            // Conference not found, handle the error
            return redirect()->back()->with('error', 'Conference not found.');
        }
    }

    public static function getAssignedPaper($rId, $cId) {

        $rev = Reviewer::where('Reviewer_id', $rId)->get();
                
        if ($rev->isNotEmpty()) {
            $paper = Paper::where('r1_id', $rId)
                ->where('Conference_id', $cId)
                ->orWhere('r2_id', $rId)
                ->where('Conference_id', $cId)
                ->get();
        }
        else {$paper = null;}
        
        return $paper;
    }
}
