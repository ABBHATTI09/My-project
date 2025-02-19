<?php
$user_id=session('user_id');
$user = \App\Models\User::find($user_id);
 ?>

<!-- Changed Password Model start-->
   <!-- Default Modal -->
   <div class="col-lg-4 col-md-6">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        

                        <!-- Modal -->
                        <div class="modal fade  @if ($errors->has('previouspassword') ||$errors->has('newpassword')||$errors->has('newconfirmpassword')) show @endif" id="changeModal" tabindex="-1" aria-hidden="true"  @if ($errors->has('previouspassword') ||$errors->has('newpassword')||$errors->has('newconfirmpassword')) style="display: block;" @endif >
                        
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Change Password</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <form action="{{route('change.password',$user->id)}}" method="POST">
                                @csrf
                            <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Previous Password</label>
                                    <input type="password" id="nameBasic" class="form-control" name="previouspassword" placeholder="Enter Previous password" aria-describedby="p_password"             value="{{ old('previouspassword') }}"    required/>
                                    
                                  </div>
                                  
                                                    </div>
                                     @error('previouspassword')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">New Password</label>
                                    <input type="password" id="nameBasic" class="form-control" name="newpassword" placeholder="Enter new password" value="{{ old('newpassword') }}" aria-describedby="n_password" required/>
                                  </div>
                                </div>
                                @error('newpassword')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">New Confirm Password</label>
                                    <input type="password" id="nameBasic" class="form-control" name="newconfirmpassword" placeholder="Enter new confirm password"  value="{{ old('newconfirmpassword') }}"  aria-describedby="confirm_password" required/>
                                  </div>
                                </div>
                                @error('newconfirmpassword')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" class="btn btn-primary"> changes password</button>
                              </div>

                            </div>
                            </form>

                          </div>
                        </div>
                      </div>
                    </div>

 <!-- Changed Password Model end-->
<div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg
                  width="25"
                  viewBox="0 0 25 42"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <defs>
                    <path
                      d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                      id="path-1"
                    ></path>
                    <path
                      d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                      id="path-3"
                    ></path>
                    <path
                      d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                      id="path-4"
                    ></path>
                    <path
                      d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                      id="path-5"
                    ></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                          id="Triangle"
                          transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                        >
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
             
            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <a href="{{route('dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            <!--Admin role start-->
            @if($user->role_id==1)
             <!-- doctor -->
             <li class="menu-item {{ request()->routeIs('doctor.index') ? 'active' : '' }}">
              <a href="{{route('doctor.index')}}" class="menu-link ">
                <i class="menu-icon tf-icons fa fa-user-md"></i>
                <div data-i18n="Layouts">Doctor</div>
              </a>
              </li>

              <!-- users -->
              <li class="menu-item {{ request()->routeIs('patient.index') ? 'active' : '' }}">
                <a href="{{route('patient.index')}}" class="menu-link ">
                  <i class="menu-icon tf-icons bx bx-user-circle"></i>
                  <div data-i18n="Layouts">User/Patient</div>
                </a>
              </li>
              <!-- Mediator-->
              <li class="menu-item {{ request()->routeIs('mediator.index') ? 'active' : '' }}">
                <a href="{{route('mediator.index')}}" class="menu-link ">
                  <i class="menu-icon tf-icons bx bx-recycle"></i>
                  <div data-i18n="Layouts">Mediator</div>
                </a>
              </li>

           @endif
           <!--Admin role end-->
        <!--Doctor role start-->
        @if($user->role_id==2)
             <!-- doctor -->
             <li class="menu-item {{ request()->routeIs('upcoming.appointment') ? 'active' : '' }}">
              <a href="{{route('upcoming.appointment')}}" class="menu-link ">
                <i class="menu-icon tf-icons fa fa-user-md"></i>
                <div data-i18n="Layouts">Upcoming Appointments</div>
              </a>
              </li>

              <!-- users -->
              <li class="menu-item {{ request()->routeIs('appointment.records') ? 'active' : '' }}">
                <a href="{{route('appointment.records')}}" class="menu-link ">
                  <i class="menu-icon tf-icons bx bx-user-circle"></i>
                  <div data-i18n="Layouts">Patient Records</div>
                </a>
              </li>  
           @endif
        
        <!--Doctor role end-->

        <!--User role start-->
        @if($user->role_id==3)
             <!-- doctor -->
             <!-- <li class="menu-item {{ request()->routeIs('booking.index') ? 'active' : '' }}">
              <a href="{{route('booking.index')}}" class="menu-link ">
                <i class="menu-icon tf-icons fa fa-user-md"></i>
                <div data-i18n="Layouts">Book Appointment</div>
              </a>
              </li> -->

              <!-- users -->
              <li class="menu-item {{ request()->routeIs('appointment.index') ? 'active' : '' }}">
                <a href="{{route('appointment.index')}}" class="menu-link ">
                  <i class="menu-icon tf-icons bx bx-user-circle"></i>
                  <div data-i18n="Layouts">My Appointments</div>
                </a>
              </li>
           @endif
        <!--User role end-->
        <!--Mediator Role start-->
        @if($user->role_id==4)
        <!--Upcoming appointment-->
        <li class="menu-item {{ request()->routeIs('patient.appointments') ? 'active' : '' }}">
              <a href="{{route('patient.appointments')}}" class="menu-link ">
                <i class="menu-icon tf-icons fa fa-user-md"></i>
                <div data-i18n="Layouts">Patient Appointments</div>
              </a>
              </li>

              <!-- users -->
              <li class="menu-item {{ request()->routeIs('appointment.records') ? 'active' : '' }}">
                <a href="{{route('appointment.records')}}" class="menu-link ">
                  <i class="menu-icon tf-icons bx bx-user-circle"></i>
                  <div data-i18n="Layouts">Patient Records</div>
                </a>
              </li>  


        @endif
        <!--Mediator Role end-->

             
           
           
           
            
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
         
        <div class="layout-page">
        @session('success')
                  <div class="alert alert-success" role="alert"> 
                      {{ $value }}
                  </div>
              @endsession

              @session('error')
                  <div class="alert alert-danger" role="alert"> 
                      {{ $value }}
                  </div>
              @endsession
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl mb-3 navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)"> 
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
             
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                
                <!--User Role name-->
                <li>Logged In As 
                  @if($user->role_id==1)
                  Admin
                  @endif
                  @if($user->role_id==2)
                  Doctor
                  @endif
                  @if($user->role_id==3)
                  Users / Patient
                  @endif
                  @if($user->role_id==4)
                  Mediator 
                  @endif
                </li>
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar ">
                      <!-- <img src="{{asset('images/'.$user->image)}}" alt class="w-px-40 h-100 rounded-circle" /> -->
                        @if($user->image)
                            <img src="{{ asset('images/' . $user->image) }}" alt="Admin" class="rounded-circle" width="150">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Admin" class="rounded-circle" width="150">
                        @endif
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <!-- <img src="{{asset('images/'.$user->image)}}" alt class="w-px-40 h-100 rounded-circle" /> -->
                                @if($user->image)
                                    <img src="{{ asset('images/' . $user->image) }}" alt="Admin" class="rounded-circle" width="150">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" alt="Admin" class="rounded-circle" width="150">
                                @endif
                            </div>
                          </div>
                          <div class="flex-grow">
                            <span class="fw-semibold d-block">{{$user->fname}} {{$user->lname}}</span>
                             <small class="text-muted">
                              @if($user->role_id==1)
                              Admin
                              @endif
                              @if($user->role_id==2)
                              Doctor
                              @endif
                              @if($user->role_id==3)
                              Users / Patient
                              @endif
                              @if($user->role_id==4)
                              Mediator
                              @endif
                             </small>
                             
                          </div>
                        </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('profile',$user_id)}}" >
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                      
                    </li>
                    <li>
                      <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#changeModal" >
                        <i class="bx bx-key me-2"></i>
                        <span class="align-middle">Change Password</span>
                      </a>
                    </li>
                    <!-- <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li> -->
                    
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->