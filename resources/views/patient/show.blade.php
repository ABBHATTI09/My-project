@extends('layouts.main')
@section('title','Task Form')
@section('content')
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Patient/</span>Patient Details</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center">
              <h4 class="mb-0">Task Details</h4>
                <a href="{{route('patient.index')}}" class="btn btn-primary">Back</a>
                </div>
                    <div class="card-body">
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">patient Name</label>
                          <div class="col-sm-10">
                            {{ $patient->fname}} {{$patient->lname}}                         
                          </div>
                          
                        </div>
                       
                        
                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Email</label>
                          <div class="col-sm-10">
                            {{ $patient->email}}
                         
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Phone Number</label>
                          <div class="col-sm-10">
                            {{ $patient->phone}}
                         
                        </div>
                          
                          
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Status</label>
                          <div class="col-sm-10">
                          @if(!empty($patient->status))
                            {{$patient->status}}
                          @else
                            {{ 'In-Active'}}
                          @endif

                          
                          </div>
                          
                        </div>
                        
                    </div>
                  </div>
                </div>
                <!-- Basic with Icons -->
                
              </div>
            </div>
            <!-- / Content -->

           

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
@endsection