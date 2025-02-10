@extends('layouts.main')
@section('title','Profile Page')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile /</span> Profile</h4>

              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <form action="{{route('profile.upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if($data->image)
                                <img
                                src="{{ asset('images/'.$data->image) }}"
                                alt="user"
                                class="d-block rounded"
                                height="100"  
                                width="100"
                                id="uploadedAvatar"
                                />
                                @else
                                <img
                                src="{{ asset('images/default.jpg') }}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"  
                                width="100"
                                id="uploadedAvatar"
                                />
                                @endif
                                
                               
                                <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                    type="file"
                                    id="upload"
                                    name="image"
                                    class="account-file-input"
                                    hidden
                                    accept="image/png, image/jpeg"
                                    />
                                </label>
                                <button type="submit" class="btn btn-success mb-4">Save</button>

                                

                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">

                      <form id="" method="POST" action="{{route('profile.edit',$data->id)}}">
                        @csrf
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="first_name"
                              value="{{old('first_name',$data->fname)}}"
                              autofocus
                            />
                            @error('first_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{old('last_name',$data->lname)}}" />
                            @error('last_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="{{old('email',$data->email)}}"
                            />
                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <input
                                type="text"
                                id="phoneNumber"
                                name="phone_number"
                                class="form-control"
                                value="{{old('phone_number',$data->phone)}}"
                              />
                              @error('phone_number')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                                <label class="form-label" for="date_of_birth">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{old('dob',$data->dob)}}"  placeholder="" />
                                @error('date_of_birth')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Age</label>
                                
                                <input type="number" id="age" name="age" class="form-control" value="{{old('age',$data->age)}}" placeholder=""  readonly />
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
                                <option value="male"{{ old('gender', isset($data->gender) ? $data->gender : '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female"{{ old('gender', isset($data->gender) ? $data->gender : '') == 'female' ? 'selected' : '' }} >Female</option>
                               
                                </select>
                                @error('gender')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                      
                        </div>
                        <div class="row">
                        <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{old('address',$data->address)}}" placeholder="Address" />
                                @error('address')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{old('city',$data->city)}}" placeholder="Morbi" />
                                @error('city')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input class="form-control" type="text" id="state" name="state" value="{{old('state',$data->state)}}" placeholder="Gujarat" />
                                @error('state')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{old('country',$data->country)}}" placeholder="Bharat"  />
                                @error('country')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" name="zipcode" value="{{old('zipcode',$data->zipCode)}}"placeholder="363660" maxlength="6" />
                                @error('zipcode')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="row">
                        <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">Language</label>
                                <select id="language" name="language" class="select2 form-select">
                                <option value="">Select Language</option>
                                <option value="gujarati" {{ old('language', isset($data->language) ? $data->language : '') == 'gujarati' ? 'selected' : '' }}>Gujarati</option>
                                <option value="Hindi"{{ old('language', isset($data->language) ? $data->language : '') == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                                <option value="english"{{ old('language', isset($data->language) ? $data->language : '') == 'english' ? 'selected' : '' }}>English</option>
                                <option value="french"{{ old('language', isset($data->language) ? $data->language : '') == 'french' ? 'selected' : '' }}>French</option>
                                <option value="german"{{ old('language', isset($data->language) ? $data->language : '') == 'german' ? 'selected' : '' }}>German</option>
                                <option value="portuguese"{{ old('language', isset($data->language) ? $data->language : '') == 'portuguese' ? 'selected' : '' }}>Portuguese</option>
                                </select>
                            </div>
                                    @error('language')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                          
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
          <script>
    document.getElementById('upload').addEventListener('change', function (event) {
     //   alert('ab');
        const [file] = event.target.files; // Get the selected file
        if (file) {
            const uploadedAvatar = document.getElementById('uploadedAvatar'); // Get the img element
            uploadedAvatar.src = URL.createObjectURL(file); // Update image src with selected file
        }
    });
</script> 

  <!-- Date and Time-->

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

@endsection