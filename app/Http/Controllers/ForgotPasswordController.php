<?php

namespace App\Http\Controllers;
use App\Models\User;
use Mail;
use Hash;
use Str;
use DB;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function forgotform(){
        return view('forgot.createform');
    }

    //send mail
    public function sendmail(request $request){
         //     dd("ab");
         $request->validate([
            'email'=>'required|email|exists:users',
        ]);
        $token = Str::random(64);
        //dd($token);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token, 
            'created_at' => now()
          ]);

          Mail::send('mail.forgotpassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', 'We have e-mailed your password reset link!');

    }
    //reset password form
    public function showResetPasswordForm($token) { 
        return view('forgot.resetpassword', ['token' => $token]);
     }

    //reset password submit 
    public function Resetpasswordsubmit(request $request){
      //  dd($request->all());
      $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
      ]);
      $updatePassword = DB::table('password_reset_tokens')->where(['email' => $request->email, 'token' => $request->token])->first();

      if(!$updatePassword){
        return back()->withInput()->with('error','Invalid Token');
      }
      $user=User::where('email',$request->email)->update(['password'=>Hash::make($request->password)]);
      DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
      return redirect('/login')->with('success', 'Your password has been changed!');
  
    }
}
