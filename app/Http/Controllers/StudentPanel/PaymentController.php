<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Auth;

class PaymentController extends Controller
{
    public function showPayment(){

        // $matricule = Auth::guard('student')->user()->matricule;
        return view('student-panel.payment');
    }

    public function payment(Request $request){
        $request->validate([
            'number' => 'required',
        ]);

        Payment::create([
            'number' => $request->number,
            'amount' => 300,
            'student_id' => Auth::guard('student')->user()->id,
        ]);

        return redirect()->route('student.payment')->with('message', 'Payment Done Successfully');


    }
}
