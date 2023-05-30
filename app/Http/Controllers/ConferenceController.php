<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\PC_Chair;
use App\Models\AreaofInterest;
use Illuminate\Support\Facades\Auth;
use DB;

class ConferenceController extends Controller
{
    public function index(){
        $conf = DB::select('select * from conferences');
        return view('welcome',['conf'=>$conf]);
    }

    public function create(Request $request)
    {

        $conf = new Conference();
        $conf->conference_org = $request->input('orgname');
        
        $webinput = $request->input('orgweb');
        if ($webinput) {
            $conf->conference_website = $request->input('orgweb');
        }

        $conf->conference_name = $request->input('cname');
        $conf->Conference_abbr = $request->input('cabbr');
        $conf->conference_date = $request->input('cdate');
        $conf->conference_venue = $request->input('cvenue');

        $conf->save();

        //area of interest
            // Retrieve the trimmed values from the request
            $trimmedValues = $request->input('cinterest');
            
            // Split the values by comma
            $valuesArray = explode(',', $trimmedValues);
            
            // Trim each value to remove leading/trailing spaces
            $trimmedValues = array_map('trim', $valuesArray);
            
            // Insert each value as a new row in the table
            foreach ($trimmedValues as $value) {
                AreaofInterest::create([
                    'Conference_id' => $conf->id,
                    'AoI_name' => $value
                ]);
            }

        $chair = new PC_Chair();
        $chair->User_id = Auth::user()->id;

        $chair->Conference_id = $conf->id;

        $chair->save();

        return redirect()->back()->with('success', 'Conference created successfully.');

    }

    
}
