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
    //edit booking ppointment 
    public function booking_edit($id,request $request){
       // dd($id);
      // dd($request->all());
       $request->validate([
        'patient_name'=>'required',
        'doctor_name'=>'required',
        'appointment_date'=>'required',
        'appointment_time'=>'required',
        'booking_type'=>'required',
       ]);

       $booking=Bookingpatient::find($id);
      // dd($booking);
      if($booking->status !=0){
        return back()->with('error',"Your appointment details have not changed because the doctor's status has been updated.");
      }
       $booking->patient_id=$request->patient_name;
       $booking->doctor_id=$request->doctor_name;
       $booking->appointment_date=$request->appointment_date;
       $booking->appointment_time=$request->appointment_time;
       $booking->booking_type=$request->booking_type;

       $booking->update();
       return back()->with('success','Your appointment details have been updated');
    }

    //delete appointment booking
    public function appointment_delete($id){
        $doctor=Bookingpatient::findOrFail($id);
        $doctor->delete();
        
        return back()->with('success','Appointment deleted !!');

    }

    public function appointment(){
        $appointments = Bookingpatient::with(['patient','doctor'])->latest()->paginate(5);
        $doctors = User::where('role_id', 2)->where('status', 1)->get();
        return view('Booking.appointments',compact('appointments','doctors'));
    }

    public function upcoming_appointment(){
        $user_id=session('user_id');
        $appointments = Bookingpatient::where('doctor_id',$user_id)->with(['patient','doctor'])->latest()->paginate(5);
        return view('Booking.upcomimg',compact('appointments'));
    }

    //change appointment status
    public function appointment_status($id,request $request){
        $booking_status = Bookingpatient::where('id', $id)->update(['status' => $request->status]);
        return back()->with('success','The appointment status has been updated.');
      //  dd($request->all());
       // dd($id);
    }

    public function records(){
        return view('Booking.record');
    }
}
