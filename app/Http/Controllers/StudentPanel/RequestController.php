<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\book;
use App\Models\settings;
use App\Models\Request as studentRequest;
use Auth;

class RequestController extends Controller
{
    public function showRequest(book $book){

        $setting = settings::latest()->first();



        return view('student-panel.request', compact(['book', 'setting']));
    }

    public function request(Request $request, $id){
        // dd($request);

        $request->validate([
            'day' => 'required',
        ]);

        studentRequest::create([
            'day' => $request->day,
            'student_id' => Auth::guard('student')->user()->id,
            'book_id' => $id
        ]);

        $book =  book::where('id', $id)->first();

        return redirect()->route('student.request', $book)->with('message', 'Request Sent Successfully');

    }

    public function adminRequestShow(){

        $requests =  studentRequest::with(['student', 'book'])->get();

        return view('request.index', compact('requests'));
    }

    public function adminDelete($id){
        $request = studentRequest::find($id);

        $request->delete();

        return redirect()->route('admin.request.show')->with('message', 'Delete Request Successfully');
    }
}
