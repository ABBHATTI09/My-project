<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Account settings - Account | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
        @if(!Empty($user) && $user->profile_token !=null)
        <!-- Layout container -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
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

              <form action="{{route('editprofile.update')}}" method="post" enctype="multipart/form-data">
                @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="row">
                <div class="col-md-12">
                 
                  <div class="card mb-4">
                    <h5 class="card-header">Doctor Details</h5>
                    <!-- Account -->
                    <!-- <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img
                                src="{{ asset('images/default.jpg') }}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"  
                                width="100"
                                id="uploadedAvatar"
                                />
                                
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                         

                        </div>
                      </div>
                    </div>
                    <hr class="my-0" /> -->
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <!--person details -->
                        
                        <div class="row">
                            <h2>Personal Details:</h2>
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" value="{{ old('firstName', $user->fname) }}" autofocus readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="lastName" id="lastName" value="{{old('lastName',$user->lname)}}" autofocus readonly/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{old('email',$user->email)}}" placeholder="john.doe@example.com" autofocus readonly/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-merge">
                                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="{{old('phoneNumber',$user->phone)}}" placeholder="" autofocus readonly/>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="date_of_birth">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{old('dob')}}"  placeholder="" />
                                @error('date_of_birth')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Age</label>
                                
                                <input type="number" id="age" name="age" class="form-control" value="{{old('age')}}" placeholder=""  readonly />
                                @error('age')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="" class="form-label">Gender</label>
                                <select id="" class="select2 form-select" name="gender">
                                <option value=" "  seleted>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                               
                                </select>
                                @error('gender')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                        </div>
                        <!--address-->
                        <div class="row">
                        <h2>Address Details:</h2>

                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                                @error('address')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Morbi" />
                                @error('city')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input class="form-control" type="text" id="state" name="state" placeholder="Gujarat" />
                                @error('state')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="Bharat"  />
                                @error('country')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" name="zipcode" placeholder="363660" maxlength="6" />
                                @error('zipcode')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <!--professinal-->
                        <div class="row">
                        <h2>Other Details:</h2>

                            <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">Language</label>
                                <select id="language" name="language" class="select2 form-select">
                                <option value="">Select Language</option>
                                <option value="gujarati">Gujarati</option>
                                <option value="Hindi">Hindi</option>
                                <option value="english">English</option>
                                <option value="french">French</option>
                                <option value="german">German</option>
                                <option value="portuguese">Portuguese</option>
                                </select>
                            </div>
                                    @error('language')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                          
                        </div>



                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Submit</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
              </form>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @else
    <div class="alert alert-danger text-center"> 
                      Token is Invalid
                  </div>
                      @endif
  </body>
</html>
<script>
  //before 18 year 
    let today_date=new Date();
    let minDate=new Date();
    minDate.setFullYear(today_date.getFullYear() - 18);

    let formattedDate = minDate.toISOString().split("T")[0];
    document.getElementById("date_of_birth").setAttribute("max", formattedDate);

  //calculate
  document.addEventListener("DOMContentLoaded", function() {
    let dob=document.getElementById('date_of_birth');
    let Age=document.getElementById('age');

    dob.addEventListener('change',function(){
     // alert('ab');
     let dob = new Date(this.value);
            let today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
           // alert(age);
        Age.value = age > 0 ? age : 0;


    });
  });





</script>
