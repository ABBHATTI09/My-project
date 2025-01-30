@extends('layouts.main')
@section('title','My Appointments Page')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Appointment /</span> My Appointments List</h4>
            
              

              <!-- Basic Bootstrap Table -->
              <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
              <!-- Search -->
              <!-- <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <input
                    type="text"
                    class="form-control border-0 shadow-block"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                  <i class="bx bx-search fs-4 lh-0"></i>

                </div>
              </div> -->
              <!-- /Search -->
              <!-- <input type="text" name="search" placeholder="search..."     value="{{ request('search') }}"> -->
                <a href="{{route('booking.index')}}" class="btn btn-primary"> Add Appointment</a>
                </div>

                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> No.</th>
                        <th>Patient name</th>
                        <th>Doctor Name</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Booking Type</th>
                        <th>Appointment Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @if(!empty($appointments))  <!-- Check if tasks are not empty -->
                    <?php         $i = ($appointments->currentPage() - 1) * $appointments->perPage() + 1;?>

                      @foreach($appointments as $appointment)

                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$appointment->patient->fname}} {{$appointment->patient->lname}}</td>
                        <td>{{$appointment->doctor->fname}} {{$appointment->doctor->lname}}</td>
                        <td>{{$appointment->appointment_date}}</td>
                        <td>{{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>                        
                        <td>@if($appointment->booking_type==1)
                            <span class="badge bg-label-success me-1">Normal Booking</span>
                           @else
                           <span class="badge bg-label-danger me-1">Emergency Booking</span>
                           @endif
                        </td>
                        <td>
                            @if($appointment->status==1)
                            <span class="badge bg-label-danger ">Reject</span>

                            @elseif($appointment->status==2)
                            <span class="badge bg-label-success ">Approval</span>

                            @elseif($appointment->status==3)
                            <span class="badge bg-label-info ">closed</span>

                            @else
                            <span class="badge bg-label-warning ">Pending</span>

                            @endif
                        </td>
                        <td>
                        <div class="btn-group">
                          <a href="" data-bs-toggle="modal" data-bs-target="#editTask{{$appointment->id}}" class="btn" ><i class="bx bx-edit-alt" title="Edit"></i></a>
                          <a href="{{route('appointment.delete',$appointment->id)}}" class="btn btn-delete" > <i class="bx bx-trash" title="Delete"></i></a> 
                        
                      </div>
                      
<!-- edit task Model start-->
   <!-- Default Modal -->
   <div class="col-lg-4 col-md-6">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        

                        <!-- Modal -->
                        <div class="modal fade  @if ($errors->has('first_name') ||$errors->has('last_name')||$errors->has('status')||$errors->has('email')||$errors->has('phone_number')) show @endif" id="editTask{{$appointment->id}}" tabindex="-1" aria-hidden="true"  @if ($errors->has('first_name') ||$errors->has('last_name')||$errors->has('status')||$errors->has('email')||$errors->has('phone_number')) style="display: block;" @endif >
                        
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editTask">Edit Doctor Details</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>

                              <form action="{{route('booking.edit',$appointment->id)}}" method="POST">
                                @csrf
                            <div class="modal-body">
                                <div class="row">
                                  
                                  <div class="col mb-6">
                                  <label class="form-label" for="patient-select">Patient Full Name</label>
                                    <select class="form-control" name="patient_name" id="patient-select">
                                        <option value="" disabled>Select Patient</option>
                                        <option value="{{$appointment->patient_id}}">
                                            {{$appointment->patient->fname}} {{$appointment->patient->lname}}
                                        </option>
                                    </select>
                                    @error('patient_name')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                  
                                  
                                                    </div>

                                <div class="row">
                                  <div class="col mb-3">
                                  <label class="form-label" for="patient-select">Select Doctor</label>
                                      <select class="form-control" name="doctor_name" id="patient-select">
                                          <option value="" disabled>Select Doctor</option>
                                          @foreach($doctors as $doctor)
                                          <option value="{{ $doctor->id }}" 
                                              {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                              {{ $doctor->fname }} {{ $doctor->lname }}
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
                                <div class="row">
                                  <div class="col mb-3">
                                  <label for="date_of_suggest">Select Date</label>
                                <input 
                                type="date" 
                                class="form-control" 
                                id="date_of_suggest" 
                                name="appointment_date" 
                                value="{{$appointment->appointment_date}}"
                                min="1980-01-01" 
                                />
                                @error('appointment_date')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>
               
                                    <div class="row">
                                      <div class="col mb-3">
                                      <label for="to_time">Select Time</label>
                                <input 
                                type="time" 
                                class="form-control" 
                                id="to_time" 
                                name="appointment_time" 
                                value="{{$appointment->appointment_time}}"
                                />
                                @error('appointment_time')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                      </div>
                                    </div>
                                    <div class="row">
                                <div class="col-md-12">
                                <label class="form-label" for="basic-default-fullname">Booking Type</label>
                         <div class="col-sm-112">
                          <select name="booking_type" id="booking_type" class="form-control">
                            <option value="" disabled class="text-center">---choose Booking Type---</option>
                            <option value="1" {{ old('booking_type', isset($appointment->booking_type) ? $appointment->booking_type : '') == 1 ? 'selected' : '' }}>Normal Booking</option>
                            <option value="0" {{ old('booking_type', isset($appointment->booking_type) ? $appointment->booking_type : '') == 0 ? 'selected' : '' }}>Emergency Booking</option>
                          </select>
                          @error('booking_type')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                         
                                </div>
                              </div>

                               
                              </div>
                            
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </div>

                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

 <!-- edit Task Model end-->



                        </td>
                      </tr>
                      <?php $i++;?>

                      @endforeach
                      @else
                        <tr>
                        <td colspan="5" class="text-center">No Data Available</td>
                        </tr>
                      @endif

                     
                    </tbody>
                  </table>
                </div>
                <!-- Pagination Links -->
                <div class="d-flex justify-content-end mt-3">
                {{ $appointments->links('pagination::bootstrap-5') }}

                </div>

              </div>
              <!--/ Basic Bootstrap Table -->
              </div>
              </div>

              <script>
                document.addEventListener('DOMContentLoaded', function() {
    const deleteBtns = document.querySelectorAll('.btn-delete');

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevents the link's default behavior
            const deleteUrl = this.getAttribute('href');
            
            // Set the URL of the confirmation button
            document.getElementById('confirmDelete').setAttribute('href', deleteUrl);
            
            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            myModal.show();
        });
    });
});

              </script>
              <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this task?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="confirmDelete">Delete</a>
            </div>
        </div>
    </div>
</div>
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