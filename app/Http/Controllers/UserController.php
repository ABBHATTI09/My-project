<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Str;
use Mail;
use Session;

class UserController extends Controller
{
    //login page
    public function index(){
        return view('admin.login');
    }

    //User register page
    public function register(){
        return view('user.register');
    }

    //Doctor regiter page
    public function doctor_register(){
        return view('doctor.register');
    }

    //login verify
    public function login_verify(request $request){
        $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required'
        ]);
        $user=User::where('email',$request->email)->first();
       // dd($user);
       //token verifcation error
       if(!is_null($user->verification_token)){
        return back()->with('error','Please verify your registered email address to activate your account');
       }
        // status active after login 
        if($user->status==0){
            return back()->with('error','Your account is currently In-Active. Please contact the admin to active your account.');
        }
    //    dd($user);
       if($user && Hash::Check($request->password,$user->password)){
        Session::put('user_id', $user->id);

        Session::put('user_role_id',$user->role_id);
      //  dd($user->role_id);

        return redirect('dashboard')->with('success','You have  Login successfully.');
       }else{
        return redirect('login')->with('error','Invalid  password')->withInput($request->only('email'));
       }

    }

    //logout 
    public function logout(){
        Session::forget('user_id');

        return redirect('login')->with('success','You have been logged out.');

    }


    //dashboard
    public function dashboard(){
        return view('admin.dashboard');
    }

    //doctor store data
    public function doctor_store(request $request){
      // dd($request->all());
       $request->validate([
        'fname'=>'required',
        'lname'=>'required',
        'phone'=>'required|numeric|digits_between:10,16',
        'email'=>'required|email|unique:users',
        //'status'=>'required|not_in:---choose User status---',
        'password'=>'required|min:6',
        'confirm_password'=>'required|min:6|same:password',
       ]);
       $token=Str::random(40);
       $expirationTime = now()->addMinutes(10);


       $user=new User();
       $user->fname=$request->fname;
       $user->lname=$request->lname;
       $user->email=$request->email;
       $user->phone=$request->phone;
      // $user->status=$request->status;
       $user->role_id=$request->role_id;
       $user->password=Hash::make($request->password);
       $user->password_original=$request->password;
       $user->verification_token=$token;
       $user->token_expire_at=$expirationTime;

       $user->save();
      // $email=$request->email;
       Mail::send('mail.sendmail', ['token' => $token], function($message) use($request){
        $message->to($request->email);
        $message->subject('Your Account verification');
       });
       return redirect('resend-email')->with('success','Please verify your account by checking the confirmation email sent to your registered email address');
       //   return redirect('login')->with('success','Your register successfully ');
    }

     //user store data
     public function user_store(request $request){
        // dd($request->all());
         $request->validate([
          'fname'=>'required',
          'lname'=>'required',
          'phone'=>'required|numeric|digits_between:10,16',
          'email'=>'required|email|unique:users',
          //'status'=>'required|not_in:---choose User status---',
          'password'=>'required|min:6',
          'confirm_password'=>'required|min:6|same:password',
         ]);
         $token=Str::random(40);
         $expirationTime = now()->addMinutes(10);
  
         $user=new User();
         $user->fname=$request->fname;
         $user->lname=$request->lname;
         $user->email=$request->email;
         $user->phone=$request->phone;
        // $user->status=$request->status;
         $user->role_id=$request->role_id;
         $user->password=Hash::make($request->password);
         $user->password_original=$request->password;
         $user->verification_token=$token;
         $user->token_expire_at=$expirationTime;
  
  
         $user->save();
         Mail::send('mail.sendmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Your Account verification');
           });
        //    return redirect('login')->with('success','Please verify your account by checking the confirmation email sent to your registered email address');
         return redirect('resend-email')->with('success','Please verify your account by checking the confirmation email sent to your registered email address');
  
      }


      public function verify(Request $request){
        $token = $request->query('token');
     //   dd($token);
        $user = User::where('verification_token', $token)->first();
        
        if (!$user) {
            return redirect('login')->with('error','Invalid Token');
        }
        if (now()->greaterThan($user->token_expire_at)) {
            return redirect('login')->with('error','Token has expired');
        }
    
    
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->status=1;
        $user->token_expire_at = null;
        $user->save();
    
        return redirect('login')->with('success','Your email has been successfully verified');
    

    }

    //resend email view
    public function resend_mail(){
        return view('mail.resendmail');
    }

    //resend email data store and change token
    public function resend_email_store(request $request){
     //  dd('ab');
        $request->validate([
            'email'=>'required|email|exists:users'
        ]);
        $user=User::where('email',$request->email)->first();
        //dd($user);
        if ($user && $user->token_expire_at && now()->greaterThan($user->token_expire_at)) {
         //   dd('ab1');
            $newToken = Str::random(40);
            $expirationTime = now()->addMinutes(10);
    
            $user->verification_token = $newToken;
            $user->token_expire_at = $expirationTime;
            $user->save();
            
            Mail::send('mail.sendmail', ['token' => $newToken], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Verify your Email');
            });
    
           return back()->with('success','A new verification email has been sent to your registered email address. Please check your inbox');
        }
      //  dd('ab2');

        //email already verify
        if ($user->verification_token==null) {
           // dd('ab');
            return back()->with('success','Your email address has already been verified');
        }
      //  dd('ab2');
        //before expire token resend mail

        if ($user->verification_token) {
        //    dd('ab4');
            Mail::send('mail.sendmail', ['token' => $user->verification_token], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Verify your Email');
            });
    
            return back()->with('success','A verification email has been successfully sent to your registered email address');
        }
        dd('ab3');
    
    }

  

}
