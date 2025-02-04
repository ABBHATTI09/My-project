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

        $mediator=User::where('role_id',4)->where('status',1)->first();
        dd($mediator);
       // dd($user1);
        $email=$user->email;
        $mediator_email=$mediator->email;
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

        $mediator=User::where('role_id',4)->where('status',1)->first();
      //  dd($mediator);
        
        $email=$user->email;
        $mediator_email=$mediator->email;

        
       // dd($user);
        $data=[
            'patient_name'=>$user->fname.' '.$user->lname,
            'doctor_name'=>$user1->fname.' '.$user1->lname,
            'appointment_date'=>$request->appointment_date,
            'appointment_time'=>$request->appointment_time,
            'booking_type'=>$request->booking_type,
            'status'=>0,
        ];
       // dd($data);
        // Patient to confirm booking
       
 

       }
      // dd($mediator_email);
       $booking->save();
       // Mail Patient
       Mail::send('mail.bookingconfirm', ['data' => $data], function($message) use($email){
        $message->to($email);
        $message->subject('Appointment Booking Confirmation');
        });
        // Mail Doctor
        Mail::send('mail.doctorshow', ['data' => $data], function($message) use($mediator_email){
            $message->to($mediator_email);
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
      if($booking->mediator_status !=0){
        return back()->with('error',"Your appointment details have not changed because the meditor doctor's status has been updated.");
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
        if($doctor->status !=0){
            return back()->with('error','Appointment cannot be deleted because it has been confirmed by the doctor');
          //  dd('ab');
        }
        dd($doctor);
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
       // dd($request->all());
        $booking_status = Bookingpatient::where('id', $id)->update(['status' => $request->status,'doctor_id'=>$request->doctor_name]);
        $appointments=Bookingpatient::where('id',$id)
        ->with(['patient','doctor'])->first();
       $patient_email=$appointments->patient->email;
       $doctor_email=$appointments->doctor->email;

       //mediator details
       
        $data=[
            'patient_name'=>$appointments->patient->fname.' '.$appointments->patient->lname,
            'doctor_name'=>$appointments->doctor->fname.' '.$appointments->doctor->lname,
            'appointment_date'=>$appointments->appointment_date,
            'appointment_time'=>$appointments->appointment_time,
            'booking_type'=>$appointments->booking_type,
            'status'=>$request->status,
        ];
      //
      //  dd($doctor_email);
        // status rejected
        if($request->status==1){
            Mail::send('mail.doctorstatus', ['data' => $data], function($message) use($patient_email){
                $message->to($patient_email);
                $message->subject('Appointment Booking Status Updated');
                }); 
    
        }
        //mail doctor
        if($request->status==2){
            Mail::send('mail.doctorshow', ['data' => $data], function($message) use($doctor_email){
                $message->to($doctor_email);
                $message->subject('Appointment Booking Confirmation');
                });
    

        }

        //mail update booking 
        // Mail::send('mail.doctorstatus', ['data' => $data], function($message) use($email){
        //     $message->to($email);
        //     $message->subject('Appointment Booking Status Updated');
        //     }); 


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
        $appointments = Bookingpatient::where('status','!=',0)
        // ->where('appointment_date','<',today())
        //  ->where('appointment_time', '<', date('H:i:s'))
        ->with(['patient','doctor'])
        ->latest()
        ->paginate(5);

        return view('Booking.record',compact('appointments'));
    }

    // Patient Appointment
    public function patient_appointment(){
       // $user_id=session('user_id');
        $appointments = Bookingpatient::where('status',0)
       // ->where('appointment_date','>=',today())
        ->with(['patient','doctor'])->latest()->paginate(5);
        $doctors = User::where('role_id', 2)->where('status', 1)->get();

        return view('mediator.appointment',compact('appointments','doctors'));
    }

    //doctor status
    public function appointment_doctorstatus($id,request $request){
     //   dd($request->all());
     $booking_status = Bookingpatient::where('id', $id)->update(['doctor_status' => $request->status]);

     $appointments=Bookingpatient::where('id',$id)
     ->with(['patient','doctor'])->first();
     
    $patient_email=$appointments->patient->email;
    $doctor_email=$appointments->doctor->email;
    //mediator status
    $mediator=User::where('role_id',4)->where('status',1)->first();
    $mediator_email=$mediator->email;
   // dd($mediator);
     $data=[
         'patient_name'=>$appointments->patient->fname.' '.$appointments->patient->lname,
         'doctor_name'=>$appointments->doctor->fname.' '.$appointments->doctor->lname,
         'mediator_name'=>$mediator->fname.' '.$mediator->lname,
         'appointment_date'=>$appointments->appointment_date,
         'appointment_time'=>$appointments->appointment_time,
         'booking_type'=>$appointments->booking_type,
         'status'=>$appointments->status,
         'doctor_status'=>$appointments->doctor_status,
     ];

     //doctor status completed
        //doctor to mediator mail
        Mail::send('mediator.doctortomediator', ['data' => $data], function($message) use($mediator_email){
            $message->to($mediator_email);
            $message->subject('Appointment Completion Status');
            });


        //doctor to patient
        Mail::send('mediator.doctortopatient', ['data' => $data], function($message) use($patient_email){
            $message->to($patient_email);
            $message->subject('Appointment Completion Status');
            });


     return back()->with('success','Updated Appointment status');
     //doctor status Not-completed
   


    }
}
