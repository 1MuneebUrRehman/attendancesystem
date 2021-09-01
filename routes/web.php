<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/markattendance', [AttendanceController::class, 'markattendance'])->name('markattendance')->middleware('auth');
Route::post('/markedattendance', [AttendanceController::class, 'markedattendance'])->name('markedattendance')->middleware('auth');
Route::get('/viewattendance', [AttendanceController::class, 'viewattendance'])->name('viewattendance')->middleware('auth');
Route::get('/leave', [AttendanceController::class, 'leave'])->name('leave')->middleware('auth');
Route::post('/leaverequest', [AttendanceController::class, 'leaverequest'])->name('leaverequest')->middleware('auth');
Route::get('/editprofile', [AttendanceController::class, 'editprofile'])->name('editprofile')->middleware('auth');
Route::post('/updateprofile/{id}', [AttendanceController::class, 'updateprofile'])->name('profile.update')->middleware('auth');


Route::get('admin/home', [AdminController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/viewrecords', [AdminController::class, 'viewrecords'])->name('admin.viewrecords')->middleware('is_admin');
Route::get('admin/deleteuser/{id}', [AdminController::class, 'deleteuser'])->name('admin.deleteuser')->middleware('is_admin');
Route::get('admin/viewattendance', [AdminController::class, 'viewattendance'])->name('admin.viewattendance')->middleware('is_admin');
Route::get('admin/viewattendance/{id}', [AdminController::class, 'viewattendanceuser'])->name('admin.viewattendanceuser')->middleware('is_admin');
Route::get('admin/addattendance/{id}', [AdminController::class, 'addattendanceuser'])->name('admin.addattendance')->middleware('is_admin');
Route::post('admin/addattendance', [AdminController::class, 'addattendanceusercreate'])->name('admin.addattendanceuser')->middleware('is_admin');
Route::get('admin/viewattendance/edit/{id}', [AdminController::class, 'viewattendanceuseredit'])->name('admin.viewattendanceuseredit')->middleware('is_admin');
Route::post('admin/viewattendance/update/{id}', [AdminController::class, 'viewattendanceuserupdate'])->name('admin.viewattendanceuserupdate')->middleware('is_admin');
Route::get('admin/viewattendance/delete/{id}', [AdminController::class, 'viewattendanceuserdelete'])->name('admin.viewattendanceuserdelete')->middleware('is_admin');

// Leave Module
Route::get('admin/leavemodule', [AdminController::class,'leavemodule'])->name('admin.leavemodule')->middleware('is_admin');
Route::get('admin/leaveaccept/{id}', [AdminController::class,'leaveaccept'])->name('admin.leaveaccept')->middleware('is_admin');
Route::get('admin/leavereject/{id}', [AdminController::class,'leavereject'])->name('admin.leavereject')->middleware('is_admin');
Route::post('admin/attendancedetails', [AdminController::class,'attendancedetails'])->name('admin.attendancedetails')->middleware('is_admin');
Route::get('admin/attendancedetailsdata', [AdminController::class,'attendancedetailsdate'])->name('admin.attendancedetailsdate')->middleware('is_admin');

// PDF
Route::get('/admin/pdfgenerate', [AdminController::class,'pdfgeneratereport'])->name('admin.pdfgenerate')->middleware('is_admin');
Route::post('/admin/pdfgenerateuser', [AdminController::class,'pdfgeneratereportuser'])->name('admin.pdfgenerateuser')->middleware('is_admin');
Route::post('/admin/pdfgeneratereportall', [AdminController::class,'pdfgeneratereportall'])->name('admin.pdfgeneratereportall')->middleware('is_admin');


