<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Conference;
use App\Models\Normal_Participant;
use App\Models\Payment;
use App\Models\PC_Chair;
use App\Models\PC_CoChair;
use App\Models\Reviewer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index ($abbr) {
        $conf = Conference::where('Conference_abbr', $abbr)->first();


        if ($conf) {
            if (Auth::check()) {
                $ch = PC_Chair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
                $coch = PC_CoChair::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
                $rev = Reviewer::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
                $np = Normal_Participant::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
                $aut = Author::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

                if      ($ch != null)    {   $cfrole = "CHAIR";  }
                elseif  ($coch != null)  {    $cfrole = "CO-CHAIR";  }   
                elseif  ($rev != null)   {    $cfrole = "REVIEWER";}
                elseif  ($np != null)    {    $cfrole = "LISTENER";}
                elseif  ($aut != null)   {    $cfrole = "AUTHOR";}
                else                     {    $cfrole = null;}

                if ($cfrole == "AUTHOR") {
                    $payment = Payment::where('Payment_id', $aut->Payment_id)->first();
                    return view('author.payment',['conf'=>$conf, 'cfrole'=>$cfrole, 'payment'=>$payment]);
                }
                elseif ($cfrole == "LISTENER") {
                    $payment = Payment::where('Payment_id', $np->Payment_id)->first();
                    return view('author.payment',['conf'=>$conf, 'cfrole'=>$cfrole, 'payment'=>$payment]);

                }

                return redirect()->back()->with('error', 'cfrole bukan author atau listener');
            }
            return redirect()->back()->with('error', 'auth check tak dapat');
        }
        return redirect()->back()->with('error', 'tak jumpa conf');
    }

    public function upload (Request $request, $abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $aut = Author::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();
        $nor = Normal_Participant::where('User_id', Auth::user()->id)->where('Conference_id', $conf->Conference_id)->first();

        if ($aut) {
            $payment = Payment::where('Payment_id', $aut->Payment_id)->first();
            if ($request->hasFile('proofpayment')) {
                // Validate the uploaded file
                $request->validate([
                    'proofpayment' => 'required|mimes:jpeg,jpg,png,pdf|max:20480', // Adjust the maximum file size if needed
                ]);

                // Check if file is present
                if (!$request->hasFile('proofpayment')) {
                    return redirect()->back()->with('error', 'Please select a file to upload.');
                }

                // Store the uploaded file
                $file = $request->file('proofpayment');
                $payment->file=$conf->Conference_abbr."_AUTHOR_".$aut->Author_id."_ProofOfPayment.".$file->getClientOriginalExtension();   //save file to the database
                $file->move(\public_path("/upload/proofpayment"), $payment->file);
                $request['proofpayment']=$payment->file;
                $payment->payment_status = "Pending";
                $payment->save();

                return redirect()->back()->with('success', 'Proof of Payment has been uploaded successfully.');
            }
            return redirect()->back()->with('error', 'Please upload a file.');
        }
        elseif ($nor){
            $payment = Payment::where('Payment_id', $nor->Payment_id)->first();
            if ($request->hasFile('proofpayment')) {
                // check betul tak file
                $request->validate([
                    'proofpayment' => 'required|mimes:jpeg,jpg,png,pdf|max:20480',
                ]);

                // check lagi..
                if (!$request->hasFile('proofpayment')) {
                    return redirect()->back()->with('error', 'Please select a file to upload.');
                }

                // store the uploaded file nama jadi TFC4.LISTENER.{}.
                $file = $request->file('proofpayment');
                $payment->file=$conf->Conference_abbr."_LISTENER_".$nor->Participant_id."_ProofOfPayment.".$file->getClientOriginalExtension();  
                $file->move(\public_path("/upload/proofpayment"), $payment->file);
                $request['proofpayment']=$payment->file;
                $payment->payment_status = "Pending";
                $payment->save();

                return redirect()->back()->with('success', 'Proof of Payment has been uploaded successfully.');
            }
            return redirect()->back()->with('error', 'Participant, Please upload a file.');        
        }
        return redirect()->back()->with('error', 'Error occured');        
    }

    public function delete(Request $request)
    {
        if ($request->hasAny('popId')) {
            $paymentId = $request->input('popId');
            $payment = Payment::find($paymentId);

            if ($payment) {
                if ($payment->file) {
                    $file = public_path('upload/proofpayment/'.$payment->file);
                    if (file_exists($file)) {
                        unlink($file);
                    }

                    $payment->file = null;
                    $payment->payment_status = "Unpaid";
                    $payment->save();

                    return redirect()->back()->with('success', 'Proof of Payment has been deleted successfully!');
                }
                return redirect()->back()->with('error', 'File not found or already deleted.');
            }
            return redirect()->back()->with('error', 'Payment details not found');
        }
        return redirect()->back()->with('error', 'error occured');
    }

    public function update(Request $request, $abbr)
    {
        $conf = Conference::where('Conference_abbr', $abbr)->first();
        $payId = $request->input('pid');
        $pay = Payment::where('Payment_id', $payId)->first();

        if ($pay) {
            $pay->update([
                "payment_status" => $request->status,
            ]);

            if($pay->payment_status == "Unpaid") {
                if ($pay->file) {
                    $file = public_path('upload/proofpayment/'.$pay->file);
                    if (file_exists($file)) {
                        unlink($file);
                    }
                    $pay->file = null;
                    $pay->save();
                }
            }
            return redirect()->back()->with('success', 'Payment status updated successfully.');
        }
        else {
            return redirect()->back()->with('error', 'Payment not found.');
        }

    }
}
