<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;

class FeesController extends Controller
{
    public function index($abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $fees = Fees::where('Conference_id', $conf->Conference_id)->get();

        // Check if the conference was found
        if ($conf) {

            if(Auth::check()) 
            {
                $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
                $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

                if      ($ch != null)    {   $cfrole = "CHAIR";  }
                elseif  ($coch != null)  {    $cfrole = "CO-CHAIR";  }   
                else                     {    $cfrole = null;}

                if($cfrole != null)
                {
                    return view('chair.fees',['fees'=> $fees, 'conf'=>$conf, 'cfrole'=>$cfrole]);
                }
                else
                {
                    return redirect()->back()->with('error', 'Unauthorized access.');
                }

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

    public function store(Request $request, $abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();

        // Check if the conference was found
        if ($conf)
        {
            $fee = new Fees();

            $fee->Conference_id = $conf->Conference_id;
            $fee->Type = $request->input('type');
            $fee->Fee_details = $request->input('details');
            $fee->Amount = $request->input('amount');
        
            $fee->save();

            return redirect()->back()->with('success', 'Conference created successfully.');
        }
        else
        {
            return redirect()->back()->with('error', 'Conference not found.');
        }

    }

}
