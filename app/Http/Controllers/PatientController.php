<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Mail;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(){
        $patients=User::Where('role_id',3)->latest()->paginate(5);
      //  dd($patients);
        return view('patient.index',compact('patients'));
    }

    public function create(){
        return view('patient.create');
    }

    //patient store data
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
     
 
        return redirect('/patient')->with('success','new Patient details added');
      //  dd($user);
     }

     //edit data

    public function edit($id,request $request){

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required|numeric|digits_between:10,16',
            'email'=>'required|email',
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
           return redirect('/patient')->with('success',' patient details updated');

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
        
        return back()->with('success','Patient deleted !!');


    }

    public function show($id){
        $patient=User::where('id',$id)->first();

        return view('patient.show',compact('patient'));
    }
 
}
