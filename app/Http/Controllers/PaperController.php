<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Conference;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaperController extends Controller
{
    public function updatePaperDet(Request $request, $abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        
        if($conf)
        {
            $paper = null;
            if(Auth::check())
            {
                $aut = Author::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

                if($aut)
                {
                    $paper = Paper::where('Author_id', $aut->Author_id)->where('Conference_id', $conf->Conference_id)->first();
                }
                else { $paper = null; }

                if($paper)
                {
                    $paper->paper_title = $request->input('title');
                    $paper->abstract = $request->input('abstract');
                    $paper->save();
                    
                    return redirect()->back()->with('success', 'Paper Details updated successfully.');
                }
                else
                {
                    return redirect()->back()->with('error', 'Paper not found.');
                }
                
            }
            else
            {
                return redirect()->back()->with('error', 'Paper not found.');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Paper not found.');
        }
    }
}
