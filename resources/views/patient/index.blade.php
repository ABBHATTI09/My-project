@extends('layouts.main')
@section('title','patient Page')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">patient /</span> patient List</h4>
            
              

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
                <a href="{{route('patient.create')}}" class="btn btn-primary"> Add Patient</a>
                </div>

                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> No.</th>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @if(!empty($patients))  <!-- Check if tasks are not empty -->
                    <?php         $i = ($patients->currentPage() - 1) * $patients->perPage() + 1;?>

                      @foreach($patients as $patient)

                      <tr>
                        <td>{{$i}}</td>
                        <td><a href="">{{ $patient->fname }} {{$patient->lname}}</a></td>
                        <td>{{ $patient->email }}</td>
                        <td>{{$patient->phone}}</td>
                        <td>@if($patient->status==1)
                            <span class="badge bg-label-success me-1">Active</span>
                           @else
                           <span class="badge bg-label-warning me-1">In-Active</span>
                           @endif
                        </td>
                        <td>
                        <div class="btn-group">
                          <a href="" data-bs-toggle="modal" data-bs-target="#editTask{{$patient->id}}" class="btn" ><i class="bx bx-edit-alt" title="Edit"></i></a>
                          <a href="{{route('patient.delete',$patient->id)}}" class="btn btn-delete" > <i class="bx bx-trash" title="Delete"></i></a> 
                        
                      </div>
                      
<!-- edit task Model start-->
   <!-- Default Modal -->
   <div class="col-lg-4 col-md-6">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        
<!-- Modal -->
<div 
    class="modal fade @if (old('patient_id') == $patient->id && ($errors->has('first_name') || $errors->has('last_name') || $errors->has('status') || $errors->has('email') || $errors->has('phone_number'))) show @endif" 
    id="editTask{{$patient->id}}" 
    tabindex="-1" 
    aria-hidden="true" 
    @if (old('patient_id') == $patient->id && ($errors->has('first_name') || $errors->has('last_name') || $errors->has('status') || $errors->has('email') || $errors->has('phone_number'))) 
        style="display: block;" 
    @endif
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTask{{$patient->id}}">Edit Patient Details</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            
            <!-- Form -->
            <form action="{{ route('patient.edit', $patient->id) }}" method="POST">
                @csrf
                <!-- Include patient ID -->
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                
                <div class="modal-body">
                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="firstName{{$patient->id}}" class="form-label">First Name</label>
                        <input 
                            type="text" 
                            id="firstName{{$patient->id}}" 
                            class="form-control" 
                            name="first_name" 
                            value="{{ old('first_name', $patient->fname) }}" 
                        />
                        @error('first_name')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="lastName{{$patient->id}}" class="form-label">Last Name</label>
                        <input 
                            type="text" 
                            id="lastName{{$patient->id}}" 
                            class="form-control" 
                            name="last_name" 
                            value="{{ old('last_name', $patient->lname) }}" 
                        />
                        @error('last_name')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email{{$patient->id}}" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            id="email{{$patient->id}}" 
                            class="form-control" 
                            name="email" 
                            value="{{ old('email', $patient->email) }}" 
                        />
                        @error('email')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label for="phone{{$patient->id}}" class="form-label">Phone Number</label>
                        <input 
                            type="text" 
                            id="phone{{$patient->id}}" 
                            class="form-control" 
                            name="phone_number" 
                            value="{{ old('phone_number', $patient->phone) }}" 
                        />
                        @error('phone_number')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status{{$patient->id}}" class="form-label">Task Status</label>
                        <select id="status{{$patient->id}}" class="form-control" name="status">
                            <option value="" disabled >---choose User status---</option>
                            <option value="1" {{ old('status', $patient->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $patient->status) == '0' ? 'selected' : '' }}>In-Active</option>
                        </select>
                        @error('status')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>



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
                {{ $patients->links('pagination::bootstrap-5') }}

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