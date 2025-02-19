@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
 <!-- Layout wrapper -->
<?php
$user_id=session('user_id');
$user = \App\Models\User::find($user_id);
$role_id=Session('user_role_id');

 ?>
                

                <div class="layout-wrapper">
        <!-- Layout container -->
        <div class="layout-container">
            <!-- Content wrapper -->
            <div class="content-wrapper">
              @if($role_id==1)
                <!-- Admin Dashboard -->
                <div id="admin-dashboard" class="container-xxl flex-grow-1 container-p-y">
                    <h4>Admin Dashboard</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Doctor Records</h5>
                                    <p>Mange to doctor details to admin etc.</p>
                                    <a href="{{route('doctor.index')}}" class="btn btn-primary">Manage Doctors</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-success">Patient Reports</h5>
                                    <p>Mange to Patient details to admin etc.</p>
                                    <a href="{{route('patient.index')}}" class="btn btn-success">Mange Patients</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @elseif($role_id==2)
                <!-- Doctor Dashboard -->
                <div id="doctor-dashboard" class="container-xxl flex-grow-1 container-p-y">
                    <h4>Doctor Dashboard</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-warning">Upcoming Appointments</h5>
                                    <p>Review your appointments for the day.</p>
                                    <a href="{{route('upcoming.appointment')}}" class="btn btn-warning">View  Appointments</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-info">Patient Records</h5>
                                    <p>Access patient medical records securely.</p>
                                    <a href="{{route('appointment.records')}}" class="btn btn-info">View Records</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @elseif($role_id==3)
                <!-- User (Patient) Dashboard -->
                <div id="user-dashboard" class="container-xxl flex-grow-1 container-p-y">
                    <h4>User (Patient) Dashboard</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Book Appointment</h5>
                                    <p>Schedule a visit with a doctor of your choice.</p>
                                    <a href="{{route('booking.index')}}" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                  
                                    <h5 class="card-title text-success">My Appointments</h5>
                                    <p>View your upcoming and past appointments.</p>
                                    <a href="{{route('appointment.index')}}" class="btn btn-success">View Appointments</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($role_id==4)
                <!-- Doctor Dashboard -->
                <div id="doctor-dashboard" class="container-xxl flex-grow-1 container-p-y">
                    <h4>Mediator Dashboard</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-warning">Upcoming Appointments</h5>
                                    <p>Review your appointments for the day.</p>
                                    <a href="{{route('patient.appointments')}}" class="btn btn-warning">View  Appointments</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-info">Patient Records</h5>
                                    <p>Access patient medical records securely.</p>
                                    <a href="{{route('appointment.records')}}" class="btn btn-info">View Records</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @endif
            </div>
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

@endsection