<?php

namespace App\Http\Controllers;

use App\Models\assignReviewer;
use App\Models\Conference;
use App\Models\Paper;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PCChairController extends Controller
{
    public function infopage ($abbr, $pId){
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $paper = Paper::where ('Paper_id', $pId)->first();

        if (!$conf) {
            return redirect()->back()->with('error', 'Conference not found.');
        }

        if (!$paper) {
            return redirect()->back()->with('error', 'Paper not found.');
        }

        $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if          ($ch != null)    {   $cfrole = "CHAIR";     }
        elseif      ($coch != null)  {   $cfrole = "CO-CHAIR";  }
        else                         {   $cfrole = null;        }
        
        if (!$cfrole) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        return view('paper.info', ['conf'=>$conf, 'paper'=> $paper, 'cfrole'=> $cfrole]);
        
    }

    public function subpage ($abbr, $pId){
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $paper = Paper::where ('Paper_id', $pId)->first();

        if (!$conf) {
            return redirect()->back()->with('error', 'Conference not found.');
        }

        if (!$paper) {
            return redirect()->back()->with('error', 'Paper not found.');
        }

        $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if          ($ch != null)    {   $cfrole = "CHAIR";     }
        elseif      ($coch != null)  {   $cfrole = "CO-CHAIR";  }
        else                         {   $cfrole = null;        }
        
        if (!$cfrole) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        return view('paper.submission', ['conf'=>$conf, 'paper'=> $paper, 'cfrole'=> $cfrole]);
        
    }

    public function statuspage ($abbr, $pId){
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $paper = Paper::where ('Paper_id', $pId)->first();

        if (!$conf) {
            return redirect()->back()->with('error', 'Conference not found.');
        }

        if (!$paper) {
            return redirect()->back()->with('error', 'Paper not found.');
        }

        $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if          ($ch != null)    {   $cfrole = "CHAIR";     }
        elseif      ($coch != null)  {   $cfrole = "CO-CHAIR";  }
        else                         {   $cfrole = null;        }
        
        if (!$cfrole) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        return view('paper.status', ['conf'=>$conf, 'paper'=> $paper, 'cfrole'=> $cfrole]);
        
    }

    public function statuspagecor ($abbr, $pId){
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $paper = Paper::where ('Paper_id', $pId)->first();

        if (!$conf) {
            return redirect()->back()->with('error', 'Conference not found.');
        }

        if (!$paper) {
            return redirect()->back()->with('error', 'Paper not found.');
        }

        $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if          ($ch != null)    {   $cfrole = "CHAIR";     }
        elseif      ($coch != null)  {   $cfrole = "CO-CHAIR";  }
        else                         {   $cfrole = null;        }
        
        if (!$cfrole) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
        return view('paper.statuscor', ['conf'=>$conf, 'paper'=> $paper, 'cfrole'=> $cfrole]);
        
    }

    public function reviewerpage ($abbr, $pId){
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $paper = Paper::where ('Paper_id', $pId)->first();

        if (!$conf) {
            return redirect()->back()->with('error', 'Conference not found.');
        }

        if (!$paper) {
            return redirect()->back()->with('error', 'Paper not found.');
        }

        $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if          ($ch != null)    {   $cfrole = "CHAIR";     }
        elseif      ($coch != null)  {   $cfrole = "CO-CHAIR";  }
        else                         {   $cfrole = null;        }
        
        if (!$cfrole) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        if($paper->r1_id && $paper->r2_id) {
            $acount = 2;
            $a = Reviewer::where('Reviewer_id', $paper->r1_id)->orWhere('Reviewer_id', $paper->r2_id)->get();

        } elseif ($paper->r1_id || $paper->r2_id) {
            $acount = 1;
            $a = Reviewer::where('Reviewer_id', $paper->r1_id)->orWhere('Reviewer_id', $paper->r2_id)->get();
        } else {
            $acount = 0;
            $a = null;
        }

        $pcount = 0;
        $rcount = 0;


        $p = assignReviewer::where('Paper_id', $paper->Paper_id)->where('status', "Pending")->get();
        $pcount = assignReviewer::where('Paper_id', $paper->Paper_id)->where('status', "Pending")->count();
        $r = assignReviewer::where('Paper_id', $paper->Paper_id)->where('status', "Reject")->get();
        $rcount = assignReviewer::where('Paper_id', $paper->Paper_id)->where('status', "Reject")->count();

        $count = $acount + $pcount + $rcount;
        
        return view('paper.reviewer', ['conf'=>$conf, 'paper'=> $paper, 'cfrole'=> $cfrole, 
                                        'acount'=>$acount, 'pcount'=>$pcount, 'rcount'=>$rcount,
                                        'a'=>$a, 'p'=>$p, 'r'=>$r, 'count'=> $count]);
        
    }

    public static function getreviewerA($id){
        $paper = Paper::where ('Paper_id', $id)->first();
        $raccept = null;

        if($paper->r1_id && $paper->r2_id) {
            $raccept = 2;
        } elseif ($paper->r1_id || $paper->r2_id) {
            $raccept = 1;
        } else {
            $raccept = 0;
        }
        
        return $raccept;
    }
    public static function getreviewerP($id){
        $paper = Paper::where ('Paper_id', $id)->first();
        $rpending = assignReviewer::where('Paper_id', $paper->Paper_id)->where('Conference_id', $paper->Conference_id)->where('status', "Pending")->count();

        return $rpending;        
    }
    public static function getreviewerD($id){
        $paper = Paper::where ('Paper_id', $id)->first();
        $rdecline = assignReviewer::where('Paper_id', $paper->Paper_id)->where('Conference_id', $paper->Conference_id)->where('status', "Reject")->count();

        return $rdecline;
    }
}
