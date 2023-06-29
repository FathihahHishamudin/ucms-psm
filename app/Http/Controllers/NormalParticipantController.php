<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Conference;
use App\Models\Normal_Participant;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;

class NormalParticipantController extends Controller
{
    public function participantlist($abbr){
        
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        if (!$conf) {
            return redirect()->back()->with('error', "Conference not found");
        }

        $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if          ($ch != null)    {   $cfrole = "CHAIR";     }
        elseif      ($coch != null)  {   $cfrole = "CO-CHAIR";  }
        else                         {   $cfrole = null;        }
        
        if (!$cfrole) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $listauthor = Author::where('Conference_id', $conf->Conference_id)->get();
        $listnpar = Normal_Participant::where('Conference_id', $conf->Conference_id)->get();

        return view('chair.participant', ['conf'=>$conf, 'listauthor'=> $listauthor, 'listnpar'=> $listnpar, 'cfrole'=> $cfrole]);
    }

}
