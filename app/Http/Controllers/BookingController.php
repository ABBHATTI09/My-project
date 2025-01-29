<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Bookingpatient;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        $user_id=session('user_id');
        $user=User::where('id',$user_id)->first();
        $doctors = User::where('role_id', 2)->where('status', 1)->get();
    //    dd($active_doctor);
     //   dd($user);

      //  dd(session('user_id'));
        return view('Booking.index',compact('user','doctors'));
    }

    //booking store
    public function store(request $request){
       // dd($request->all());
       $request->validate([
        'patient_name'=>'required',
        'doctor_name'=>'required',
        'appointment_date'=>'required',
        'appointment_time'=>'required',
        'booking_type'=>'required',

       ]);

       $booking=new Bookingpatient();
       $booking->patient_id=$request->patient_name;
       $booking->doctor_id=$request->doctor_name;
       $booking->appointment_date=$request->appointment_date;
       $booking->appointment_time=$request->appointment_time;
       $booking->booking_type=$request->booking_type;

       $booking->save();

       return redirect('myappointments')->with('success','Your appointment has been successfully booked.');



    }

    public function appointment(){
        $appointments = Bookingpatient::with(['patient','doctor'])->latest()->paginate(5);
        return view('Booking.appointments',compact('appointments'));
    }

    public function upcoming_appointment(){
        $user_id=session('user_id');
        $appointments = Bookingpatient::where('doctor_id',$user_id)->with(['patient','doctor'])->latest()->paginate(5);
        return view('Booking.upcomimg',compact('appointments'));
    }

    public function records(){
        return view('Booking.record');
    }
}
