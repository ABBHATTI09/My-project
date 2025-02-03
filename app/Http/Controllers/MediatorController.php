<?php

namespace App\Http\Controllers;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Http\Request;

class MediatorController extends Controller
{
    // Mediator index
    public function index(){
        $mediators=User::Where('role_id',4)->latest()->paginate(5);
       // dd($mediators);

        return view('mediator.index',compact('mediators'));
    }

    //Mediator crate form
    public function create(){
        return view('mediator.create');
    }

    //store data 
    public function store(request $request){
      //  dd($request->all());
      $request->validate([
        'first_name'=>'required',
        'last_name'=>'required',
        'phone_number'=>'required|numeric|digits_between:10,16',
        'email'=>'required|email|unique:users',
        'status'=>'required|not_in:---choose Mediator status---',
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
   return redirect('/mediator')->with('success','new mediator details added');

    }

    //mediator details edit
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
        //   dd($request->all());
           
           $doctor=User::where('id',$id)->update([
            'fname'=>$request->first_name,
            'lname'=>$request->last_name,
            'phone'=>$request->phone_number,
            'email'=>$request->email,
            'status'=>$request->status,
            
           ]);
           return redirect('/mediator')->with('success',' Mediator details updated');


    }
    //mediator deleted

    public function delete($id){
        // dd($id);
         $doctor=User::findOrFail($id);
         $doctor->delete();
         
         return back()->with('success','Mediator deleted !!');
 
 
     }
 

}
