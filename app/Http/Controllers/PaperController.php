<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Conference;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    
    //-----------------------------------------------------------------------------------------------------------//
    
    public function upload(Request $request, $abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $aut = Author::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $paper = Paper::where('Author_id', $aut->Author_id)->where('Conference_id', $conf->Conference_id)->first();
    
        if ($request->hasFile('pdf_file')){
            // Validate the uploaded file
            $request->validate([
                'pdf_file' => 'required|mimes:pdf|max:2048', // Adjust the maximum file size if needed
            ]);
        
            // Store the uploaded file
            $file = $request->file('pdf_file');
            $paper->full_paper=time()."_".$aut->Author_id."_".$file->getClientOriginalName();   //save file to the database
            $file->move(\public_path("/upload/papers"), $paper->full_paper);
            $request['pdf_file']=$paper->full_paper;
            $paper->save();
        }
        elseif ($request->hasFile('correctionpaper')) {
            // Validate the uploaded file
            $request->validate([
                'correctionpaper' => 'required|mimes:pdf|max:2048', // Adjust the maximum file size if needed
            ]);
        
            // Store the uploaded file
            $file = $request->file('correctionpaper');
            $paper->Correction_fp=time()."_".$aut->Author_id."_".$file->getClientOriginalName();   //save file to the database
            $file->move(\public_path("/upload/papers"), $paper->Correction_fp);
            $request['correctionpaper']=$paper->Correction_fp;
            $paper->save();
        }
        else {
            // Validate the uploaded file
            $request->validate([
                'crpaper' => 'required|mimes:pdf|max:2048', // Adjust the maximum file size if needed
            ]);
        
            // Store the uploaded file
            $file = $request->file('crpaper');
            $paper->cr_paper=time()."_".$aut->Author_id."_".$file->getClientOriginalName();   //save file to the database
            $file->move(\public_path("/upload/papers"), $paper->cr_paper);
            $request['crpaper']=$paper->cr_paper;
            $paper->save();
        }
    
        return redirect()->back()->with('success', 'Paper uploaded successfully.');
    }
}
