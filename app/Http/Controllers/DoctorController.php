<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Mail;
use Str;
use Crypt;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(){
        $doctors=User::Where('role_id',2)->latest()->paginate(5);
       // dd($user);
        return view('doctor.index',compact('doctors'));
    }
    //create doctor form
    public function create(){
        return view('doctor.create');
    }

    // doctor store data
    public function store(request $request){
       // dd($request->all());
       $request->validate([
        'first_name'=>'required',
        'last_name'=>'required',
        'phone_number'=>'required|numeric|digits_between:10,16',
        'email'=>'required|email|unique:users',
        'status'=>'required|not_in:---choose User status---',
        'password'=>'required|min:6',
        'confirm_password'=>'required|min:6|same:password',
       ]);

       $user=new User();
       $user->fname=$request->first_name;
       $user->lname=$request->last_name;
       $user->email=$request->email;
       $user->phone=$request->phone_number;
       $user->status=$request->status;
       $user->role_id=$request->role_id;
       $user->password=Hash::make($request->password);
       $user->password_original=$request->password;

       $user->save();
       $email=$request->email;
       $password=$request->password;

       // Mail send id and password
       Mail::send('doctor.sendmail', ['email' => $email,'password'=>$password], function($message) use($request){
        $message->to($request->email);
        $message->subject('Your Account create Application');
    });
    //   dd($password);
      // dd($user);
    

       return redirect('/doctor')->with('success','new doctor details added');
     //  dd($user);
    }

    //edit data

    public function edit($id,request $request){

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required|numeric|digits_between:10,16',
            'email'=>'required|unique:users,email,' . $id,
            
            'status'=>'required|not_in:---choose User status---',
          //  'password'=>'required|min:6',
          //  'confirm_password'=>'required|min:6|same:password',
           ]);
           
           $doctor=User::where('id',$id)->update([
            'fname'=>$request->first_name,
            'lname'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone_number,
            'status'=>$request->status,
            
           ]);
           return redirect('/doctor')->with('success',' doctor details updated');

       // $doctor=User::where('id',$id)->first();

       // dd($id);
   
    // Passing the doctor data to the view
  //  return view('doctor.edit', compact('doctor'));

    }

    //update
    public function update(request $request,$id){

    }
    //delete 

    public function delete($id){
       // dd($id);
        $doctor=User::findOrFail($id);
        $doctor->delete();
        
        return back()->with('success','Doctor deleted !!');


    }

    public function show($id){
        $doctor=User::where('id',$id)->first();

        return view('doctor.show',compact('doctor'));
    }

    //doctor edit details without login
    public function doctorwithout($token){
     // dd($token);
      $decode_token=base64_decode($token);
     // dd($decode_token);
       
        $user=User::where('profile_token',$decode_token)->first();
       // dd($user->profile_token_expire_at);
       if ($user && !is_null($user->profile_token_expire_at)) {
        if (now()->greaterThan($user->profile_token_expire_at)) {
        //  dd('ab');
        //  dd('ab');
        $user->profile_token = null;
        $user->profile_token_expire_at = null;
        $user->save();
       

      }
    }
     // dd('ab1');
  
  
      //  dd($user);
     // $data

      //  dd($token);
      //  dd($token);
        return view('doctor.withoutlogin.edit',['token'=>$token,'user'=>$user]);

    } 
    //sendlink function
    public function sendlink($id){
       // dd('ab');
      // dd($id);
      $user1=User::where('id',$id)->first();

      //create to profile token 
      $first_name=isset($user1->fname) ?$user1->fname:'';
      $randomNumbers = mt_rand(1000000000, 9999999999); 
      $randomLetters = Str::random(4); 
      $firstnamepart=substr($first_name,0,3);
      //profile token;
      $token="{$firstnamepart}_{$randomNumbers}_{$randomLetters}";
      //expire time
      $expirationTime = now()->addMinutes(10);
     // dd($expirationTime);
    //  dd($token);
    //  dd($firstnamepart);
      //dd($randomLetters);
      //dd($randomNumbers);
     // dd($first_name);
      //dd($user1);

    
      //$token = ;
    //  $secure_token=base64_encode($token);
    //  $return_token=base64_decode($secure_token);
     // dd($token);
     // dd($token);
     //  dd($return_token);
      $user=User::where('id',$id)->update(['profile_token'=>$token,'profile_token_expire_at'=>$expirationTime]);
      $users=User::where('id',$id)->first();
      $encode_token=base64_encode($token);
     // $decode_token=base64_decode($profile_token);
    //  dd($decode_token);
      
      $email=$users->email;
   //   dd($email);
      $data=[
        'name' =>$users->fname.' '.$users->lname,
        

      ];

      Mail::send('mail.editprofile',['token'=>$encode_token,'data'=>$data],function($message) use ($email){
        $message->to($email);
        $message->subject('Edit Profile Details');
    
         
      });
      return back()->with('success','Edit profile link sended');
  
    //  dd($token);
     // dd($user->email);
    }
    //edit profile
    public function editprofile(request $request){
       // dd($request->all());
        $validatedata=$request->validate([
           'date_of_birth'=>'required|date',
           'age'=>'required',
           'gender'=>'required',
           'address'=>'required',
           'city'=>'required',
           'state'=>'required',
           'country'=>'required',
           'zipcode'=>'required',
           'language'=>'required',


        ]);
        $data=[
            'dob'=>$request->date_of_birth,
            'age'=>$request->age,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'country'=>$request->country,
            'zipcode'=>$request->zipcode,
            'language'=>$request->language,
            'profile_token'=>null,
            'profile_token_expire_at'=>null,

        ];
        $decode_token=base64_decode($request->token);
       // dd($decode_token);

       // dd($request->token);  
        $user = User::where('profile_token', $decode_token)->update($data);
      //  dd($user);
            //  $user->update($data);
        return view('doctor.submitform');
    
        //  dd($user);
      //  dd($request->all());
    }
    //submit form
    public function submiteditform(){
        return view('doctor.submitform');
    }

}
