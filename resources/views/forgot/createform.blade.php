@extends('layouts.main')
@section('title','Forgot Password')
@section('content')
 <!-- Content -->

 <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Forgot Password -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                
                  <span class="app-brand-text demo text-body fw-bolder"></span>
                </a>
              </div>

              <!-- /Logo -->
              <h4 class="mb-2">Forgot Password?</h4>
              <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
              <form id="" class="mb-3" action="{{route('forgot.password.mail')}}" method="POST">
                @csrf

                @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                        </div>
                @endif
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autofocus
                  />
                  @error('email')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
              </form>
              <div class="text-center">
                <a href="{{route('login')}}" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Back to login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
    </div>

    <!-- / Content -->

@endsection