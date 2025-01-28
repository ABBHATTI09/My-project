<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Mail;
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

}
