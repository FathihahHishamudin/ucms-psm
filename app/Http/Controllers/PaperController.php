<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Conference;
use App\Models\Paper;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaperController extends Controller
{
    public function index ($abbr){
        $conf = Conference::where('Conference_abbr', $abbr)->first();

        if (!$conf) {
            return redirect()->back()->with('error', 'Conference not found.');
        }

        $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if          ($ch != null)    {   $cfrole = "CHAIR";     }
        elseif      ($coch != null)  {   $cfrole = "CO-CHAIR";  }
        else                         {   $cfrole = null;        }
        
        if (!$cfrole) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $listp = Paper::where('Conference_id', $conf->Conference_id)->whereNull('paper_title')->get();
        $listpa = Paper::where('Conference_id', $conf->Conference_id)->whereNotNull('paper_title')->get();

        $listpapers = $listpa->concat($listp);

        return view('chair.confpapers', ['conf'=>$conf, 'listpapers'=> $listpapers, 'cfrole'=> $cfrole]);
        
    }

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
    
        if ($request->hasFile('fullpaper') && $request->hasFile('fullpaperbr')){
            // Validate the uploaded file
            $request->validate([
                'fullpaper' => 'required|mimes:pdf|max:20480', // Adjust the maximum file size if needed
                'fullpaperbr' => 'required|mimes:pdf|max:20480', // Adjust the maximum file size if needed
            ]);

            // Check if file is present
            if (!$request->hasFile('fullpaper')) {
                return redirect()->back()->with('error', 'Please select a file to upload.');
            }
            if (!$request->hasFile('fullpaperbr')) {
                return redirect()->back()->with('error', 'Please select a file to upload.');
            }
        
            // Store the uploaded file
            $file = $request->file('fullpaper');
            $paper->full_paper=$conf->Conference_abbr."_".$aut->Author_id."_FP.".$file->getClientOriginalExtension();   //save file to the database
            $file->move(\public_path("/upload/papers"), $paper->full_paper);
            $request['fullpaper']=$paper->full_paper;
            $paper->save();

            // Store the uploaded file
            $filee = $request->file('fullpaperbr');
            $paper->full_paper_br=$conf->Conference_abbr."_".$aut->Author_id."_FPBR.".$file->getClientOriginalExtension();   //save file to the database
            $filee->move(\public_path("/upload/papers"), $paper->full_paper_br);
            $request['fullpaperbr']=$paper->full_paper_br;
            $paper->save();
        }
        elseif ($request->hasFile('correctionpaper')) {
            // Validate the uploaded file
            $request->validate([
                'correctionpaper' => 'required|mimes:pdf|max:20480', // Adjust the maximum file size if needed
            ]);
        
            // Store the uploaded file
            $file = $request->file('correctionpaper');
            $paper->Correction_fp=$conf->Conference_abbr."_".$aut->Author_id."_CFP.".$file->getClientOriginalExtension();   //save file to the database
            $file->move(\public_path("/upload/papers"), $paper->Correction_fp);
            $request['correctionpaper']=$paper->Correction_fp;
            $paper->save();
        }
        elseif ($request->hasFile('crpaper')) {
            // Validate the uploaded file
            $request->validate([
                'crpaper' => 'required|mimes:pdf|max:20480', // Adjust the maximum file size if needed
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

    public function delete(Request $request)
    {
        if ($request->hasAny('paper_id_fp')) {
            $paperId = $request->input('paper_id_fp');
            $paper = Paper::find($paperId);

            if ($paper){
                if ($paper->full_paper) {
                    $file = public_path('upload/papers/'.$paper->full_paper);
                    if (file_exists($file)) {
                        unlink($file);
                    }

                    $paper->full_paper = null;
                    $paper->save();

                    return redirect()->back()->with('success', 'File fp deleted successfully!');
                }

                return "File not found or already deleted.";
            }

            return "Paper not found";
        }
        elseif ($request->hasAny('paper_id_cfp'))
        {
            $paperId = $request->input('paper_id_cfp');
            $paper = Paper::find($paperId);

            if ($paper){
                if ($paper->Correction_fp) {
                    $file = public_path('upload/papers/'.$paper->Correction_fp);
                    if (file_exists($file)) {
                        unlink($file);
                    }

                    $paper->Correction_fp = null;
                    $paper->save();

                    return redirect()->back()->with('success', 'File cfp deleted successfully!');
                }

                return "File not found or already deleted.";
            }

            return "Paper not found";
        }
        elseif ($request->hasAny('paper_id_cr')) {
            $paperId = $request->input('paper_id_cr');
            $paper = Paper::find($paperId);

            if ($paper){
                if ($paper->cr_paper) {
                    $file = public_path('upload/papers/'.$paper->cr_paper);
                    if (file_exists($file)) {
                        unlink($file);
                    }

                    $paper->cr_paper = null;
                    $paper->save();

                    return redirect()->back()->with('success', 'File crp deleted successfully!');
                }

                return "File not found or already deleted.";
            }

            return "Paper not found";
        }
    }

}
