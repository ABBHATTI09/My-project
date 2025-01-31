<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Bookingpatient;
use Carbon;
use Mail;
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
      // dd($request->booking_type);
       if($request->booking_type==0){
        $request->validate([
            'patient_name'=>'required',
            'doctor_name'=>'required',
           // 'appointment_date'=>'required',
           // 'appointment_time'=>'required',
            'booking_type'=>'required',
    
           ]);
    

       }else{
        $request->validate([
            'patient_name'=>'required',
            'doctor_name'=>'required',
            'appointment_date'=>'required',
            'appointment_time'=>'required',
            'booking_type'=>'required',
    
           ]);
    
       }
       $booking=new Bookingpatient();
       date_default_timezone_set('Asia/Kolkata');


       if($request->booking_type==0){
      //  dd(date('H:i:s'));
        $booking->patient_id=$request->patient_name;
        $booking->doctor_id=$request->doctor_name;
        $booking->appointment_date=date('Y-m-d');
        $booking->appointment_time=date('H:i:s');
        $booking->booking_type=$request->booking_type;

        $user=User::find($request->patient_name);
        $user1=User::find($request->doctor_name);

        $email=$user->email;
        $doctor_email=$user1->email;
      //  dd($user->email);
       // dd($user);
        $data=[
            'patient_name'=>$user->fname.' '.$user->lname,
            'doctor_name'=>$user1->fname.' '.$user1->lname,
            'appointment_date'=>$request->appointment_date,
            'appointment_time'=>$request->appointment_time,
            'booking_type'=>$request->booking_type,
        ];
      //  dd($data);
        // Patient to confirm booking
       

        

       }else{
        $booking->patient_id=$request->patient_name;
        $booking->doctor_id=$request->doctor_name;
        $booking->appointment_date=$request->appointment_date;
        $booking->appointment_time=$request->appointment_time;
        $booking->booking_type=$request->booking_type;

        $user=User::find($request->patient_name);
        $user1=User::find($request->doctor_name);

        $email=$user->email;
        $doctor_email=$user1->email;

        
       // dd($user);
        $data=[
            'patient_name'=>$user->fname.' '.$user->lname,
            'doctor_name'=>$user1->fname.' '.$user1->lname,
            'appointment_date'=>$request->appointment_date,
            'appointment_time'=>$request->appointment_time,
            'booking_type'=>$request->booking_type,
        ];
       // dd($data);
        // Patient to confirm booking
       
 

       }
       $booking->save();
       // Mail Patient
       Mail::send('mail.bookingconfirm', ['data' => $data], function($message) use($email){
        $message->to($email);
        $message->subject('Appointment Booking Confirmation');
        });
        // Mail Doctor
        Mail::send('mail.doctorshow', ['data' => $data], function($message) use($doctor_email){
            $message->to($doctor_email);
            $message->subject('Appointment Booking Confirmation');
            });


      
      
       return redirect('myappointments')->with('success','Your appointment has been successfully booked.');



    }
    //edit booking ppointment 
    public function booking_edit($id,request $request){
        date_default_timezone_set('Asia/Kolkata');
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

    public function appointment(Request $request)
{
    $query = Bookingpatient::with(['patient', 'doctor'])->latest();

    if ($request->has('search')) {
        $search = $request->input('search');
        
        $query->where(function($query) use ($search) {
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('fname', 'like', '%'.$search.'%')
                  ->orWhere('lname', 'like', '%'.$search.'%');
            })
            ->orWhereHas('doctor', function($q) use ($search) {
                $q->where('fname', 'like', '%'.$search.'%')
                  ->orWhere('lname', 'like', '%'.$search.'%');
            })
            ->orwhere('appointment_date','like','%'.$search.'%')
            ->orwhere('appointment_time','like','%'.$search.'%');
        });
    }

    $appointments = $query->latest()->paginate(5);

    $doctors = User::where('role_id', 2)->where('status', 1)->get();

    return view('Booking.appointments', compact('appointments', 'doctors'));
}


    public function upcoming_appointment(){
        $user_id=session('user_id');
        $appointments = Bookingpatient::where('doctor_id',$user_id)
        ->where('appointment_date','>=',today())
        ->with(['patient','doctor'])->latest()->paginate(5);
        return view('Booking.upcomimg',compact('appointments'));
    }

    //change appointment status
    public function appointment_status($id,request $request){
        $booking_status = Bookingpatient::where('id', $id)->update(['status' => $request->status]);
        $appointments=Bookingpatient::where('id',$id)
        ->with(['patient','doctor'])->first();
       $email=$appointments->patient->email;
        $data=[
            'patient_name'=>$appointments->patient->fname.' '.$appointments->patient->lname,
            'doctor_name'=>$appointments->doctor->fname.' '.$appointments->doctor->fname,
            'appointment_date'=>$appointments->appointment_date,
            'appointment_time'=>$appointments->appointment_time,
            'booking_type'=>$appointments->booking_type,
            'status'=>$request->status,
        ];

        //mail update booking status to patient/user
        Mail::send('mail.doctorstatus', ['data' => $data], function($message) use($email){
            $message->to($email);
            $message->subject('Appointment Booking Status Updated');
            }); 


        return back()->with('success','The appointment status has been updated.');
      //  dd($request->all());
       // dd($id);
    }

    public function records(){
        $user_id=session('user_id');
        date_default_timezone_set('Asia/Kolkata');
      //  dd(now());
     // dd(today());
   //  dd(date('H:i:s'));
        $appointments = Bookingpatient::where('doctor_id',$user_id)
        ->where('appointment_date','<',today())
        //  ->where('appointment_time', '<', date('H:i:s'))
        ->with(['patient','doctor'])
        ->latest()
        ->paginate(5);

        return view('Booking.record',compact('appointments'));
    }
}
