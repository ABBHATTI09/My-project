@extends('layouts.main')
@section('title','Register Page')

@section('content')
<!-- Content -->
<div class="background-image">
<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-left">
                
                  <span class="app-brand-text demo text-body fw-bolder">Doctor Register</span>
                </a>
              </div>
              <div>
                <a href="{{route('user.register')}}"><i class="menu-icon tf-icons fa fa-user-md"> Patient</i>  </a>
              </div>
              <!-- /Logo -->
            
              <form id="" class="mb-3" action="{{route('doctor.store.self')}}" method="POST">
                  @csrf
                  <input type="hidden" name="role_id" value="2" />

                  <div class="row">
                      <!-- Firstname -->
                      <div class="col-md-6 mb-3">
                          <label for="fname" class="form-label">Firstname</label>
                          <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter your Firstname" value="{{old('fname')}}" autofocus />
                          @error('fname')
                              <span class="text-danger"><strong>{{ $message }}</strong></span>
                          @enderror
                      </div>

                      <!-- Lastname -->
                      <div class="col-md-6 mb-3">
                          <label for="lname" class="form-label">Lastname</label>
                          <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your Lastname" value="{{old('lname')}}" />
                          @error('lname')
                              <span class="text-danger"><strong>{{ $message }}</strong></span>
                          @enderror
                      </div>
                  </div>

                  <div class="row">
                      <!-- Phone Number -->
                      <div class="col-md-6 mb-3">
                          <label for="phone" class="form-label">Phone Number</label>
                          <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your Phone Number" value="{{old('phone')}}" />
                          @error('phone')
                              <span class="text-danger"><strong>{{ $message }}</strong></span>
                          @enderror
                      </div>

                      <!-- Email -->
                      <div class="col-md-6 mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email" value="{{old('email')}}" />
                          @error('email')
                              <span class="text-danger"><strong>{{ $message }}</strong></span>
                          @enderror
                      </div>
                  </div>

                  <div class="row">
                      <!-- Password -->
                      <div class="col-md-6 mb-3 form-password-toggle">
                          <label class="form-label" for="password">Password</label>
                          <div class="input-group input-group-merge">
                              <input type="password" id="password" class="form-control" name="password" placeholder="********" value="{{old('password')}}" />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                          @error('password')
                              <span class="text-danger"><strong>{{ $message }}</strong></span>
                          @enderror
                      </div>

                      <!-- Confirm Password -->
                      <div class="col-md-6 mb-3 form-password-toggle">
                          <label class="form-label" for="confirm_password">Confirm Password</label>
                          <div class="input-group input-group-merge">
                              <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="********" value="{{old('confirm_password')}}" />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                          @error('confirm_password')
                              <span class="text-danger"><strong>{{ $message }}</strong></span>
                          @enderror
                      </div>
                  </div>

                  <button class="btn btn-primary d-grid w-100">Register</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="{{ route('login')}}">
                  <span>login your Account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>
    </div>
    <!-- / Content -->

@endsection