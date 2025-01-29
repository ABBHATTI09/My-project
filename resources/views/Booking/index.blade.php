@extends('layouts.main')
@section('title','Booking index')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Booking Appointment</h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Booking Appointment</h5>
                      <a href="{{route('appointment.index')}}" class="btn btn-primary">Back</a>

                    </div>
                    <div class="card-body">
                      <form action="{{route('booking.store')}}" method="POST">
                        @csrf
                        <!--Patient name with id-->
                        <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label" for="patient-select">Patient Full Name</label>
                            <select class="form-control" name="patient_name" id="patient-select">
                                <option value="" disabled>Select Patient</option>
                                <option value="{{$user->id}}">
                                    {{$user->fname}}{{$user->lname}}
                                </option>
                            </select>
                                    @error('patient_name')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                           

                        <!--doctor name with id-->
                        <div class="col-sm-6">
                            <label class="form-label" for="patient-select">Select Doctor</label>
                            <select class="form-control" name="doctor_name" id="patient-select">
                                <option value="" disabled>Select Doctor</option>
                                @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">
                                    {{$doctor->fname}}{{$doctor->lname}}
                                </option>
                                @endforeach
                            </select>
                            @error('doctor_name')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                        </div>
                       
                      
                       
                        <div class="form-row">
                            <!-- Date Selection -->
                            <div class="row">
                            <div class="form-group col-sm-6 col-md-6 ">
                                <label for="date_of_suggest">Select Date</label>
                                <input 
                                type="date" 
                                class="form-control" 
                                id="date_of_suggest" 
                                name="appointment_date" 
                                value=""
                                min="1980-01-01" 
                                />
                                @error('appointment_date')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <!-- Time Selection -->
                            <div class="form-group col-sm-6 col-md-6 ">
                                <label for="to_time">Select Time</label>
                                <input 
                                type="time" 
                                class="form-control" 
                                id="to_time" 
                                name="appointment_time" 
                                value=""
                                />
                                @error('appointment_time')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            </div>
                            </div>

                         <!--booking type 1-normal and 0-Emergency -->
                         <div class="row">
                         <div class=" form-group col-sm-6 col-md-6">
                         <label class="form-label" for="basic-default-fullname">Booking Type</label>
                         <div class="col-sm-112">
                          <select name="booking_type" id="booking_type" class="form-control">
                            <option value="" disabled class="text-center">---choose Booking Type---</option>
                            <option value="1" {{ old('booking_type') == 1 ? 'selected' : '' }}>Normal Booking</option>
                            <option value="0" {{ old('booking_type') == 0 ? 'selected' : '' }}>Emergency Booking</option>
                          </select>
                          @error('booking_type')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                         
                        </div>
                        </div>
                        
                        <div class="mb-3 mt-3">
                        <button type="submit" class="btn btn-primary">Booking</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- / Content -->

           

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->


          <!-- JavaScript to Set Min Date & Time -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Set minimum date to today
        let today = new Date().toISOString().split('T')[0]; 
        document.getElementById("date_of_suggest").setAttribute("min", today);

        // Function to update the minimum time if today is selected
        document.getElementById("date_of_suggest").addEventListener("change", function() {
            let selectedDate = this.value;
            let now = new Date();
            let currentTime = now.toTimeString().slice(0,5); // Get HH:MM format

            // If today is selected, set min time to current time
            if (selectedDate === today) {
                document.getElementById("to_time").setAttribute("min", currentTime);
            } else {
                document.getElementById("to_time").removeAttribute("min");
            }
        });
    });
</script>
@endsection