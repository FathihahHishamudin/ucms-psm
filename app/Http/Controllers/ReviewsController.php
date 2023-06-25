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
                $paper = Paper::where('Paper_id', $reviews->Paper_id)->first();
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

    public function update(Request $request, $rId)
    {
        // Find the review by ID
        $review = Reviews::findOrFail($rId);

        if ($review) {
            $review->originality = $request->input('ori');
            $review->relevance = $request->input('rel');
            $review->suitable = $request->input('sui');
            $review->findings = $request->input('fin');
            $review->reference = $request->input('ref');
            $review->language = $request->input('lan');
            $total = $request->input('ori') + $request->input('ref') + $request->input('rel') + $request->input('sui') + $request->input('fin') + $request->input('lan');
            $review->total = $total;
            $review->status = "Reviewed";
            $review->p_status = $request->input('pstat-hidden');
            $review->comment = $request->input('comment');
            $review->save();

            // Redirect or return a response as desired
            return redirect()->back()->with('success', 'Review updated successfully');
        }

        // Redirect or return a response as desired
        return redirect()->back()->with('error', 'Review not updated');
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
