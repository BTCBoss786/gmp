<?php

use App\Http\Controllers\GrievanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('logout')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/grievance/add', [GrievanceController::class, 'add'])->name('grievance.add');
    Route::post('/grievance/add', [GrievanceController::class, 'store']);
    Route::get('/grievance/track', [GrievanceController::class, 'track'])->name('grievance.track');
    Route::post('/grievance/track', [GrievanceController::class, 'show']);
    Route::get('/login', [OfficerController::class, 'login'])->name('officer.login');
    Route::post('/login', [OfficerController::class, 'check']);
});

Route::middleware('login')->group(function (){
    Route::get('/officer/dashboard', [OfficerController::class, 'dashboard'])->name('officer.dashboard');
    Route::get('/logout', [OfficerController::class, 'logout'])->name('officer.logout');
    Route::get('/officer/add', [OfficerController::class, 'add'])->name('officer.add');
    Route::post('/officer/add', [OfficerController::class, 'store']);
    Route::get('/officer/manage', [OfficerController::class, 'manage'])->name('officer.manage');
    Route::put('/officer/manage', [OfficerController::class, 'status']);
    Route::get('/officer/profile', [OfficerController::class, 'profile'])->name('officer.profile');
    Route::put('/officer/profile', [OfficerController::class, 'edit']);
    Route::get('/grievance/pending', [GrievanceController::class, 'pending'])->name('grievance.pending');
    Route::put('/grievance/pending', [GrievanceController::class, 'replied']);
    Route::get('/grievance/{token}/reply', [GrievanceController::class, 'reply'])->name('grievance.reply');
    Route::get('/grievance/resolve', [GrievanceController::class, 'resolve'])->name('grievance.resolve');
    Route::get('/grievance/report', [GrievanceController::class, 'report'])->name('grievance.report');
});

