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
     
        <!-- Layout container -->
     

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

              <div class="row">
                <div class="col-md-12">
                 
                  <div class="card mb-4">
                    <h5 class="card-header">Doctor Details</h5>
                    <!-- Account -->
                    <div class="card-body">
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
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <!--person details -->
                        
                        <div class="row">
                            <h2>Personal Details:</h2>
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" value="John" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="lastName" id="lastName" value="Doe" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email" value="john.doe@example.com" placeholder="john.doe@example.com" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-merge">
                                <span class="input-group-text">US (+1)</span>
                                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="202 555 0111" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Organization</label>
                                <input type="text" class="form-control" id="organization" name="organization" value="ThemeSelection" />
                            </div>
                        </div>
                        <!--address-->
                        <div class="row">
                        <h2>Address Details:</h2>

                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input class="form-control" type="text" id="state" name="state" placeholder="California" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">Country</label>
                                <select id="country" class="select2 form-select">
                                <option value="">Select</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Canada">Canada</option>
                                <option value="India">India</option>
                                <option value="United States">United States</option>
                                <!-- Add other countries as needed -->
                                </select>
                            </div>
                        </div>

                        <!--professinal-->
                        <div class="row">
                        <h2>Other Details:</h2>

                            <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">Language</label>
                                <select id="language" class="select2 form-select">
                                <option value="">Select Language</option>
                                <option value="en">English</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                                <option value="pt">Portuguese</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="timeZones" class="form-label">Timezone</label>
                                <select id="timeZones" class="select2 form-select">
                                <option value="">Select Timezone</option>
                                <option value="-12">(GMT-12:00) International Date Line West</option>
                                <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                <option value="-10">(GMT-10:00) Hawaii</option>
                                <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                                <!-- Add other timezones as needed -->
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="currency" class="form-label">Currency</label>
                                <select id="currency" class="select2 form-select">
                                <option value="">Select Currency</option>
                                <option value="usd">USD</option>
                                <option value="euro">Euro</option>
                                <option value="pound">Pound</option>
                                <option value="bitcoin">Bitcoin</option>
                                </select>
                            </div>
                        </div>



                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
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
  </body>
</html>
