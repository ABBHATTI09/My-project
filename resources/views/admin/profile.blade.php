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
@endsection