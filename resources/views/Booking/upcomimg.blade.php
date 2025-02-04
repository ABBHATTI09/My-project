@extends('layouts.main')
@section('title','Upcoming Appointments Page')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Appointment /</span> Upcoming Appointments List</h4>
            
              

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
                <!-- <a href="{{route('booking.index')}}" class="btn btn-primary"> Add Appointment</a> -->
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
                        <th>Mediator Status</th>
                        <th>Doctor Status</th>
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
                            <span class="badge bg-label-success ">Normal Booking</span>
                           @else
                           <span class="badge bg-label-danger ">Emergency Booking</span>
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
                        <td style="text-align:center;">
                          @if($appointment->doctor_status==1)
                          <span class="badge bg-label-success ">Completed</span>
                          @elseif($appointment->doctor_status==2)
                          <span class="badge bg-label-warning ">Not-Completed</span>
                          @else
                          --
                          @endif
                        </td>
                        <td>
                        <div class="btn-group">
                          <a href="" data-bs-toggle="modal" data-bs-target="#editTask{{$appointment->id}}" class="btn" ><i class="bx bx-edit-alt" title="Edit"></i></a>
                        
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
                                <h5 class="modal-title" id="editTask"> Doctor Appointment Detail</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>

                              <form action="{{route('appointment.doctorstatus',$appointment->id)}}" method="POST">
                                @csrf
                            <div class="modal-body">
                              
                               
                               
               
                                    <div class="row">
                                      <div class="col mb-3">
                                          <label for="statusDropdown" class="form-label">Appointment Status</label>
                                          <select id="statusDropdown" class="form-control" name="status" >
                                          <option value=""disabled>---choose User status---</option>
                                          <option value="0">Pending</option>
                                          <option value="1">Completed</option>
                                          <option value="2">Not-Completed</option>
                                         
                                          </select>
                                          @error('status')
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
                                <button type="submit" class="btn btn-primary">Update</button>
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

@endsection