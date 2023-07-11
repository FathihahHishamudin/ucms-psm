<?php

namespace App\Http\Controllers;

use App\Models\assignReviewer;
use App\Models\Conference;
use App\Models\Paper;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;
use App\Models\Reviewer;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                            return redirect()->back()->with('error', 'You are UNAUTHORIZE to access the page.');
                        }
                    }
                    return redirect()->back()->with('error', 'You are UNAUTHORIZE to access the page.');
                }
                return redirect()->back()->with('error', 'Paper not found');
            }
            return redirect()->back()->with('error', 'Review not found');
        }
        return redirect()->back()->with('error', 'Conference not found');

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
        $reviewer = Reviewer::where('User_id', Auth::user()->id)->first();
        $revfp = Reviews::where('Review_id', $p->review1_fp_id)->where('Reviewer_id', $reviewer->Reviewer_id)
                        ->orWhere('Review_id', $p->review2_fp_id)->where('Reviewer_id', $reviewer->Reviewer_id)
                        ->first();

        return $revfp;
    }

    public static function getCFPReviewID($p) {
        $revcfp = Reviews::where('Review_id', $p->review1_cfp_id)
                        ->orWhere('Review_id', $p->review2_cfp_id)
                        ->first();

        return $revcfp;
    }

    public function showAcceptPage ($abbr, $uId)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        
        if ($uId == Auth::user()->id) {
            $ada = null;

            $assg = assignReviewer::where('Conference_id', $conf->Conference_id)
                                    ->where ('User_id', Auth::user()->id)
                                    ->where ('status', "Pending")
                                    ->get();
            if ($assg->isNotEmpty()) {
                $ada = "ada";
            }

            return view('reviewer.acceptance', compact('assg', 'ada'));
        }
        return redirect('/')->with('error', 'Unauthorized Access!');
    }

    public static function getpaper($pId) {
        $paper = Paper::where('Paper_id', $pId->Paper_id)->first();
        return $paper;
    }

    public function updateStatus(Request $request)
    {
        $statuses = $request->input('status');
        $assignIds = $request->input('assgIds');
    
        foreach ($assignIds as $index => $assignId) {
            DB::table('assign_reviewer')
                ->where('id', '=', $assignId)
                ->update(['status' => $statuses[$index]]);

            $assign = AssignReviewer::find($assignId);
            $paperId = $assign->Paper_id;

            $paper = Paper::find($paperId);

            if ($assign->status == "Accept") {
                
                $rev = null;
                $rev = Reviewer::where('User_id', Auth::user()->id)->where('Conference_id', $paper->Conference_id)->first(); //already a reviewer for this conference
                
                if ($rev) {
                    if ($paper->r1_id == null) {
                        $revipa = new Reviews();
                        $revipa->Paper_id = $paper->Paper_id;
                        $revipa->Reviewer_id = $rev->Reviewer_id;
                        $revipa->save();

                        $paper->update(["r1_id" => $rev->Reviewer_id, "review1_fp_id" =>$revipa->Review_id,]);
                    }
                    elseif ($paper->r2_id == null) {
                        $revipa = new Reviews();
                        $revipa->Paper_id = $paper->Paper_id;
                        $revipa->Reviewer_id = $rev->Reviewer_id;
                        $revipa->save();

                        $paper->update(["r2_id" => $rev->Reviewer_id, "review2_fp_id" =>$revipa->Review_id,]);
                    }
                }
                else {
                    $rev = new Reviewer();
                    $rev->User_id = Auth::user()->id;
                    $rev->conference_id = $paper->Conference_id;

                    $rev->save();

                    if ($paper->r1_id == null) {
                        $revipa = new Reviews();
                        $revipa->Paper_id = $paper->Paper_id;
                        $revipa->Reviewer_id = $rev->Reviewer_id;
                        $revipa->save();

                        $paper->update(["r1_id" => $rev->Reviewer_id, "review1_fp_id" =>$revipa->Review_id,]);
                    }
                    elseif ($paper->r2_id == null) {
                        $revipa = new Reviews();
                        $revipa->Paper_id = $paper->Paper_id;
                        $revipa->Reviewer_id = $rev->Reviewer_id;
                        $revipa->save();

                        $paper->update(["r2_id" => $rev->Reviewer_id, "review2_fp_id" =>$revipa->Review_id,]);
                    }
                }
                //delete row in assgreviewer table
                $assign->delete();
            }
        }
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function deleteassg ($abbr, $rId)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $chair = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $cochair = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if ($chair || $cochair) {

            assignReviewer::find($rId)->delete();
            return redirect()->back()->with('success', 'You have successfully remove the the invited reviewer!');
        }

        return redirect()->back()->with('error', 'Unable to remove the invited reviewer!');
    }
}
