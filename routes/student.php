<?php


use Illuminate\Support\Facades\Route;



Route::get('student/links', function(){
    return view('student-panel.student_links');
});