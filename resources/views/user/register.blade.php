@extends('layouts.main')
@section('title','Register Page')

@section('content')
<!-- Content -->

<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                
                  <span class="app-brand-text demo text-body fw-bolder">Patient Register</span>
                </a>
              </div>
              <div>
                <a href="{{route('doctor.register')}}"><i class="menu-icon tf-icons fa fa-user-md"> Doctor</i>  </a>
              </div>
              <!-- /Logo -->
            

              <form id="" class="mb-3" action="{{route('user.store.self')}}" method="POST">
                @csrf
                <!-- firstname -->
                <input type="hidden" name="role_id"  value="3" />
                <div class="mb-3">
                  <label for="fname" class="form-label">Firstname</label>
                  <input
                    type="text"
                    class="form-control"
                    id="fname"
                    name="fname"
                    placeholder="Enter your Firstname"
                    value="{{old('fname')}}"
                    autofocus
                  />
                </div>
                @error('fname')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                <!-- lastname -->
                <div class="mb-3">
                  <label for="lname" class="form-label">Lastname</label>
                  <input
                    type="text"
                    class="form-control"
                    id="lname"
                    name="lname"
                    placeholder="Enter your lastname"
                    value="{{old('lname')}}"
                    autofocus
                  />
                </div>
                @error('lname')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                <!-- Phone Number -->
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input
                    type="number"
                    class="form-control"
                    id="phone"
                    name="phone"
                    placeholder="Enter your Phone Number"
                    value="{{old('phone')}}"
                    autofocus
                  />
                </div>
                @error('phone')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                

                
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{old('email')}}" />
                </div>
                @error('email')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      value="{{old('password')}}"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                @error('password')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <!-- Confirm Password-->
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="confirm_password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      value="{{old('password')}}"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                @error('confirm_password')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror



                
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

    <!-- / Content -->

@endsection