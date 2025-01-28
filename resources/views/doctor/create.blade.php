@extends('layouts.main')
@section('title','Doctor Form')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Doctor Form </h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Docotor Form </h5>
                      <a href="{{route('doctor.index')}}" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-body">
                      <form action="{{route('doctor.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="role_id"  value="2" />

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">First Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" name="first_name" value="{{old('first_name')}}" placeholder="Enter First Name" />
                            @error('first_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-company" >Last Name</label>
                          <div class="col-sm-10">
                            <input

                              type="text"
                              class="form-control"
                              id="basic-default-company"
                              name="last_name"
                              value="{{old('last_name')}}"
                              placeholder="Enter last name"
                            />
                            @error('last_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <input
                                type="email"
                                id="basic-default-email"
                                class="form-control"
                                placeholder="Enter Email"
                                 name="email"
                                 value="{{old('email')}}"
                                aria-label="john.doe"
                                aria-describedby="basic-default-email2"
                              />
                              
                            </div>
                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone No</label>
                          <div class="col-sm-10">
                            <input
                              type="text"
                              id="basic-default-phone"
                              class="form-control phone-mask"
                              placeholder="Enter Phone Number"
                              name="phone_number"
                              value="{{old('phone_number')}}"
                              aria-label="658 799 8941"
                              aria-describedby="basic-default-phone"
                            />
                            @error('phone_number')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-phone">Status</label>
                          <div class="col-sm-10">
                          <select name="status" id="status" class="form-control">
                            <option value="">---choose User status---</option>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>In-Active</option>
                          </select>
                          @error('status')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                         
                        </div>
                       
                        <div class="row mb-3 form-password-toggle">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Password</label>
                          <div class="col-sm-10">
                          <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      value="{{old('password')}}"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>    
                  @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                      </div>
                        </div>
                        <div class="row mb-3 form-password-toggle">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Confirm password</label>
                          <div class="col-sm-10">
                          <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="confirm_password"
                      value="{{old('confirm_password')}}"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>   
                  @error('confirm_password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    
                       </div>
                        </div>
                        
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Basic with Icons -->
                
                
                
              </div>
            </div>
            <!-- / Content -->
@endsection