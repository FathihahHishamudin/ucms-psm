<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PC_Chair;
use App\Models\PC_Cochair;
use App\Models\Author;
use App\Models\Conference;
use App\Models\Normal_Participant;
use App\Models\Reviewer;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $role=Auth::user()->role;
        $user_id=Auth::user()->id;

        $data = [
            'fname' => Auth:: user()->First_name,
            'lname' => Auth:: user()->Last_name,
            'userId' => Auth:: user()->id,
        ];

        $chairs = PC_Chair :: where ('User_id', $user_id)->with('conference')->get();
        $cochairs = PC_CoChair :: where ('User_id', $user_id)->with('conference')->get();
        $reviewer = Reviewer :: where ('User_id', $user_id)->with('conference')->get();
        $author = Author :: where ('User_id', $user_id)->with('conference')->get();
        $np = Normal_Participant :: where ('User_id', $user_id)->with('conference')->get();


/*        
        if($role=='1'){
            return view('admin.dashboard', compact('hallSum','packageSum','bookingSum', 'date', 'userData','locationKL','locationJB','locationP','locationM'));   
        }else{
            return view('dashboard', $data);
        }
*/
        return view('dashboard')->with('chairs', $chairs)->with('cochairs', $cochairs)->with('reviewer', $reviewer)->with('author', $author)->with('np', $np)->with('data', $data);
    }

    public static function getConferenceName($id){
        //$confname = Conference::query();
        //$confname = Conference::select('Conference_name')->where('Conference_id', $id)->first();
        $confname = DB::table('conferences')->where('Conference_id', $id)->value('Conference_name');    
        //$confname->where('Conference_id', $id)->value('Conference_name');
        return $confname;
    }

    public static function getConferenceAbbr($id){
        //$confname = Conference::query();
        //$confname = Conference::select('Conference_name')->where('Conference_id', $id)->first();
        $confabbr = DB::table('conferences')->where('Conference_id', $id)->value('Conference_abbr');    
        //$confname->where('Conference_id', $id)->value('Conference_name');
        return $confabbr;
    }
}
