<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentPanel\auth\AuthController;



Route::get('/student/login', [AuthController::class, 'showLogin'])->name('student.login');
Route::get('/student/signup', [AuthController::class, 'showSignup'])->name('student.signup');

Route::post('/student/signup', [AuthController::class, 'signup'])->name('student.signup.perform');
Route::post('/student/login', [AuthController::class, 'login'])->name('student.login.perform');