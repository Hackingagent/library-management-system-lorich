<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentPanel\auth\AuthController;
use App\Http\Controllers\StudentPanel\PaymentController;



Route::get('/student/login', [AuthController::class, 'showLogin'])->name('student.login');
Route::get('/student/signup', [AuthController::class, 'showSignup'])->name('student.signup');

Route::post('/student/signup', [AuthController::class, 'signup'])->name('student.signup.perform');
Route::post('/student/login', [AuthController::class, 'login'])->name('student.login.perform');


Route::get('/student/payment', [PaymentController::class, 'showPayment'])->name('student.payment');

Route::post('/student/payment', [PaymentController::class, 'payment'])->name('student.payment.perform');