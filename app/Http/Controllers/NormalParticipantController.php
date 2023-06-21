<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Conference;
use App\Models\Normal_Participant;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class NormalParticipantController extends Controller
{
    public function participantlistinit($abbr){
        
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $listauthor = Author::where('Conference_id', $conf->Conference_id)->get();
/*         $listnpar = Normal_Participant::where('Conference_id', $conf->Conference_id);
 */
        return view('chair.participant', ['conf'=>$conf, 'listauthor'=> $listauthor]);
    }

    public function participantlist($abbr){
        
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $listauthor = Author::select('User_id')->where('Conference_id', $conf->Conference_id)->get();
        $listnpar = Normal_Participant::select('User_id')->where('Conference_id', $conf->Conference_id)->get();
        
        $alluid = $listauthor->concat($listnpar);

        $parti = User::whereIn('id', $alluid)->get();

        

        return view('chair.participant', ['conf'=>$conf, 'parti'=> $parti]);
    }

}
