<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Paper;
use App\Models\Reviewer;
use App\Models\Reviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    //
    public function review ($abbr, $rId)
    {
        
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $reviews = Reviews::find($rId);

        if ($conf) {
            if ($reviews) {
                $paper = Paper::where('Paper_id', $reviews->Paper_id);
                if ($paper) {
                    if (Auth::check()) {
                        $reviewer = Reviewer::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
                        
                        if  ($reviewer != null)       {    $cfrole = "REVIEWER";   }
                        else                     {    $cfrole = null;       }

                        if($cfrole != null)
                        {
                            return view('reviewer.review', ['conf' => $conf, 'cfrole' => $cfrole, 'paper' => $paper, 'reviews' => $reviews]);
                        }
                        else
                        {
                            return redirect()->back()->with('error', 'Unauthorized access.');
                        }
                    }
                }
            }
        }

    }

    public static function getFPReviewID($p) {
        $revfp = Reviews::where('Review_id', $p->review1_fp_id)
                        ->orWhere('Review_id', $p->review2_fp_id)
                        ->first();

        return $revfp;
    }

    public static function getCFPReviewID($p) {
        $revcfp = Reviews::where('Review_id', $p->review1_cfp_id)
                        ->orWhere('Review_id', $p->review2_cfp_id)
                        ->first();

        return $revcfp;
    }
}
