<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//login 

//dashboard
//check login 
Route::middleware('Checklogin')->group(function(){
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard');
    Route::get('/logout',[UserController::class,'logout'])->name('logout');

    //Profile 
    Route::get('/profile/{id}',[ProfileController::class,'profile'])->name('profile');
    Route::post('/profile/edit/{id}',[ProfileController::class,'edit'])->name('profile.edit');
    //profile Image 
    Route::post('/profile/upload',[ProfileController::class,'upload'])->name('profile.upload');
    //change password
    Route::post('profile/changepassword/{userid}',[ProfileController::class,'changepassword'])->name('change.password');

    Route::middleware('AdminMiddleware')->group(function(){

    //admin add doctor and Patient/user

    //doctor
    Route::get('/doctor',[DoctorController::class,'index'])->name('doctor.index');
    Route::get('/doctor/add',[DoctorController::class,'create'])->name('doctor.create');
    Route::post('/doctore/add/store',[DoctorController::class,'store'])->name('doctor.store');
    Route::post('/doctor/edit/{id}',[DoctorController::class,'edit'])->name('doctor.edit');
   // Route::post('/doctor/update/{id}',[DoctorController::class,'update'])->name('doctor.update');
    Route::get('/doctor/delete/{id}',[DoctorController::class,'delete'])->name('doctor.delete');
   // Route::get('/doctor/detail/{id}',[DoctorController::class,'show'])->name('doctor.show');

    //patient 
    Route::get('/patient',[PatientController::class,'index'])->name('patient.index');
    Route::get('/patient/add',[PatientController::class,'create'])->name('patient.create');
    Route::post('/patient/add/store',[PatientController::class,'store'])->name('patient.store');
    Route::post('/patient/edit/{id}',[PatientController::class,'edit'])->name('patient.edit');
    Route::get('/patient/delete/{id}',[PatientController::class,'delete'])->name('patient.delete');
    });

    //Booking and appointments
    Route::get('/booking',[BookingController::class,'index'])->name('booking.index');
    Route::get('/myappointments',[BookingController::class,'appointment'])->name('appointment.index');

    //Upcomming appointments and Rercords
    Route::get('/upcoming/appointments',[BookingController::class,'upcoming_appointment'])->name('upcoming.appointment');
    Route::get('/appointment/records',[BookingController::class,'records'])->name('appointment.records');

});

//check logout
Route::middleware('Checklogout')->group(function(){
    

Route::get('/', function () {
    return view('admin.login');
});
    Route::get('/login',[UserController::class,'index'])->name('login');
Route::post('/login-verification',[UserController::class,'login_verify'])->name('login.verification');
//register
Route::get('/register',[UserController::class,'register'])->name('user.register');
Route::post('/register/store',[UserController::class,'user_store'])->name('user.store.self');
Route::get('/doctor_register',[UserController::class,'doctor_register'])->name('doctor.register');
Route::post('/doctor_register/store',[UserController::class,'doctor_store'])->name('doctor.store.self');
//email verify 
Route::get('/email-verification',[UserController::class,'verify'])->name('email.verify');
Route::get('/resend-email',[UserController::class,'resend_mail'])->name('email.resend');
Route::post('/resend-email',[UserController::class,'resend_email_store'])->name('email.resend.store');

// forgot password
Route::get('forgot-password',[ForgotPasswordController::class,'forgotform'])->name('forgot.password');
Route::post('forgot-password',[ForgotPasswordController::class,'sendmail'])->name('forgot.password.mail');

//reset password
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password',[ForgotPasswordController::class,'Resetpasswordsubmit'])->name('reset.password.post');




});