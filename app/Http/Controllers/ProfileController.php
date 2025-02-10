<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Session;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function changepassword(request $request,$id){
         //
         // dd($id);
         $request->validate([
            'previouspassword'=>'required|min:6',
            'newpassword'=>'required|min:6',
            'newconfirmpassword'=>'required|same:newpassword'
        ]);
        $user = User::where(['id'=>$id])->first();
        if($user && Hash::Check($request->previouspassword,$user->password)){
            $user1=User::where('email',$user->email)->update(['password'=>Hash::make($request->newpassword)]);
            return back()->with('success', 'You have successfully changed your password'); 


        }else{
            return back()->with('error', 'The previous password is incorrect.')->withInput();
        }
      //  dd($changePassword);

    }

    public function profile($id){
      //  dd($id);
      $session_id=Session::get('user_id');
      if($session_id!=$id){
        return back();
       }else{
        $data=User::where('id',$id)->first();
        return view('admin.profile',compact('data'));
       }


    }

    //edit data
    public function edit($id,request $request){
       // dd($id);
       $request->validate([
        'first_name'=>'required',
        'last_name'=>'required',
        'phone_number'=>'required|numeric|digits_between:10,16',
        'email'=>'required|unique:users,email,' . $id,
        'date_of_birth'=>'required|date',
        'age'=>'required',
        'gender'=>'required',
        'address'=>'required',
        'city'=>'required',
        'state'=>'required',
        'country'=>'required',
        'zipcode'=>'required',
        'language'=>'required',
        
      //  'status'=>'required|not_in:---choose User status---',
      //  'password'=>'required|min:6',
      //  'confirm_password'=>'required|min:6|same:password',
       ]);
       
       $doctor=User::where('id',$id)->update([
        'fname'=>$request->first_name,
        'lname'=>$request->last_name,
        'phone'=>$request->phone_number,
        'email'=>$request->email,
        'dob'=>$request->date_of_birth,
        'age'=>$request->age,
        'gender'=>$request->gender,
        'address'=>$request->address,
        'city'=>$request->city,
        'state'=>$request->state,
        'country'=>$request->country,
        'zipCode'=>$request->zipcode,
        'language'=>$request->language,
       // 'status'=>$request->status,
        
       ]);
       return redirect('profile/' . $id)->with('success', 'Your profile details have been updated successfully.');

    }

    public function upload(request $request){
      //  dd($request->all());
      $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
       ]);
       $imageName = time().'.'.$request->image->extension();  
       $request->image->move(public_path('images'), $imageName);
       $user=User::where('id',$request->user_id)->update(['image' => $imageName]);

       return back()->with('success', 'You have successfully uploaded the image')->with('image', $imageName); 

       
    }
    
}
