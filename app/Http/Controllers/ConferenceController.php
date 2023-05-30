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
    public function list(){
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

    public function show ($abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        
        // Check if the conference was found
        if ($conf) {
            // Conference found, pass it to a view
            return view('conference.display',['conf'=>$conf]);
        } else {
            // Conference not found, handle the error -- error not work but it does redirect back
            return redirect()->back()->with('error', 'Conference not found.');
        }
    }

    public function contact ($abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        
        // Check if the conference was found
        if ($conf) {
            // Conference found, pass it to a view
            return view('conference.contactus',['conf'=>$conf]);
        } else {
            // Conference not found, handle the error -- error not work but it does redirect back
            return redirect()->back()->with('error', 'Conference not found.');
        }
    }

    public function comenu($abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        
        // Check if the conference was found
        if ($conf) {
            $chair = PC_Chair::where('Conference_id', $conf->Conference_id)->first();
            
            // Check if the chair was found and the chair's user ID matches the logged-in user's ID
            if ($chair && $chair->User_id == Auth::user()->id) {
                // Conference and chair found, and user ID matches, pass them to the view
                return view('conference.committeemenu', [
                    'conf' => $conf,
                    'chair' => $chair
                ]);
            } else {
                // Chair not found or user ID does not match, handle the error
                return redirect()->back()->with('error', 'Unauthorized access.');
            }
        } else {
            // Conference not found, handle the error
            return redirect()->back()->with('error', 'Conference not found.');
        }
    }

    public function edit($abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        
        // Check if the conference was found
        if ($conf) {
            $chair = PC_Chair::where('Conference_id', $conf->Conference_id)->first();
            
            // Check if the chair was found and the chair's user ID matches the logged-in user's ID
            if ($chair && $chair->User_id == Auth::user()->id) {
                // Conference and chair found, and user ID matches, pass them to the view
                return view('conference.update', [
                    'conf' => $conf,
                    'chair' => $chair
                ]);
            } else {
                // Chair not found or user ID does not match, handle the error
                return redirect()->back()->with('error', 'Unauthorized access.');
            }
        } else {
            // Conference not found, handle the error
            return redirect()->back()->with('error', 'Conference not found.');
        }
       
    }

    public function update(Request $request, $abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $confe=Conference::findOrFail($conf->Conference_id);

        if ($confe) {
            $confe->update([
                "Conference_name" => $request->name,
                "Conference_abbr" => $request->abbre,
                "Conference_date" => $request->date,
                "Conference_venue" => $request->venue,
                "Conference_desc" => $request->description,
                "Conference_org" => $request->org,
            ]);

            return redirect()->back()->with('success', 'Conference updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Conference not found.');
        }
    }
    
}
