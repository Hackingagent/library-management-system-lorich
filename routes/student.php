<?php


use Illuminate\Support\Facades\Route;



Route::get('links', function(){
    return view('student-panel.student_links');
});