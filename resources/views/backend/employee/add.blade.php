<x-backend-layout>
   <x-slot name='title'>Employee</x-slot>
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Employee </li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <form action="{{ route('admin.employee.create') }}" method="post" enctype="multipart/form-data">
         @csrf
         <!-- Main content -->
         <section class="content">
            <div class="container">
               <div class="row">
                  <!-- /.col -->
                  <div class="col-md-9">
                     @if (session('success'))
                     <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                     </div>
                     @endif
                     @if (session('error'))
                     <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                     </div>
                     @endif
                     <div class="col-sm-12">
                        <!-- About Me Box -->
                        <div class="card card">
                           <div class="card-header">
                              <h3 class="card-title">General Information</h3>
                             <a class="btn btn-primary float-sm-right" href="{{route('admin.employee')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to  Employees

                              </a>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                              
                              <input type="hidden" name="role_id" value="2">
                                 <div class="form-group col-md-4">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="{{ old('first_name') }}">
                                    @if ($errors->has('first_name'))
                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Middle Name </label>
                                    <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="form-control" placeholder="Enter middle name">
                                    @if ($errors->has('middle_name'))
                                    <div class="error">{{ $errors->first('middle_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Enter last name">
                                    @if ($errors->has('last_name'))
                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Gender <span class="text-danger">*</span></label>
                                    <br>
                                    <label class="radio-inline"><input type="radio" name="gender" value="male" @if(old('gender') == 'male')checked @endif> Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female" @if(old('gender') == 'female')checked @endif> Female</label>
                                    @if ($errors->has('gender'))
                                    <div class="error">{{ $errors->first('gender') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Marital status </label>
                                    <br>
                                    <label class="radio-inline">
                                       <input type="radio" name="marital_status" class="merried_status" value="1" @if(old('marital_status') == '1')checked @endif> Married</label>
                                    
                                    <label class="radio-inline"><input type="radio" name="marital_status" value="0" @if(old('marital_status') == '0')checked @endif class="merried_status"> Unmarried</label>
                                    @if ($errors->has('marital_status'))
                                    <div class="error">{{ $errors->first('marital_status') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4" id="date_of_marriage" style="display: none;">
                                    <label>Date of marriage </label>
                                    
                                     <input type="text" name="married_date" value="{{ old('married_date') }}" class="form-control"  onfocus="this.type='date'" >
                                   
                                    @if ($errors->has('married_date'))
                                    <div class="error">{{ $errors->first('married_date') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Mobile Number </label>
                                    <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" class="form-control" placeholder="Enter mobile number" >
                                    @if ($errors->has('mobile_number'))
                                    <div class="error">{{ $errors->first('mobile_number') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Date of Joining <span class="text-danger">*</span></label>
                                    <input type="text" name="start_date" value="{{ old('start_date') }}" class="form-control" placeholder="Enter Joining date"  onfocus="this.type='date'">
                                    @if ($errors->has('start_date'))
                                    <div class="error">{{ $errors->first('start_date') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                    <input type="text" name="dob" value="{{ old('dob') }}" class="form-control"   onfocus="this.type='date'">
                                    @if ($errors->has('dob'))
                                    <div class="error">{{ $errors->first('dob') }}</div>
                                    @endif
                                 </div>
                                  <div class="form-group col-md-4">
                                    <label>Blood Group </label>
                                    <input type="text" name="blood_group" value="{{ old('blood_group') }}" class="form-control"  >
                                    @if ($errors->has('blood_group'))
                                    <div class="error">{{ $errors->first('blood_group') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Emergency contact No </label>
                                    <input type="text" name="emergency_contact" value="{{ old('emergency_contact') }}" class="form-control"  placeholder="Emergency contact">
                                    @if ($errors->has('emergency_contact'))
                                    <div class="error">{{ $errors->first('emergency_contact') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Designation <span class="text-danger">*</span></label>
                                    <select class="form-control select2"  id="designation" name="designation">
                                       <option value="" selected>Select Designation</option>
                                       @if(count($designation)>0)
                                       @foreach($designation as $designationdata)
                                       <option value="{{$designationdata->designation}}" @if(old('designation') == $designationdata->designation)selected @endif> {{$designationdata->designation}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    @if ($errors->has('designation'))
                                    <div class="error">{{ $errors->first('designation') }}</div>
                                    @endif
                                 </div>
                              </div>
                           </div>
                           <!-- /.card-body -->
                           <div class="card-footer">
                           </div>
                        </div>
                        <!-- /.card-header -->
                     </div>
                     <!-- /.card -->
                     <!--Location Address-->
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">Location/Address</h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label>Countries</label>
                                    <select class="form-control select2" name="country" id="country">
                                       <option value="" selected>Select Country</option>
                                       @if(count($country)>0)
                                       @foreach($country as $countryData)
                                       <option value="{{$countryData->name}}" @if(old('country') == $countryData->name)selected @endif>{{ $countryData->name }}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    @if ($errors->has('country'))
                                    <div class="error">{{ $errors->first('country') }}</div>
                                    @endif
                                 </div>
                               
                                 <div class="form-group col-md-6">
                                    <label>Current Address</label>
                                    <textarea class="form-control" rows="2" cols="20" name="current_address" placeholder="Enter Current Address">
                                        {{ old('current_address') }}
                                     </textarea>
                                    @if ($errors->has('current_address'))
                                    <div class="error">{{ $errors->first('current_address') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label>Permanent Address</label>
                                    <textarea class="form-control" rows="2" cols="20" name="permanent_address" placeholder="Enter Permanent Address">
                                    {{ old('permanent_address') }}
                                    </textarea>
                                    @if ($errors->has('permanent_address'))
                                    <div class="error">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                 </div>
                              </div>
                              <!--/.row-->
                           </div>
                           <!--/.card-body-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <!--/.Location Address-->
                     <div class="col-sm-12">
                        <div class="card card">
                           <div class="card-header">
                              <h3 class="card-title">Employement Section</h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                                 
                               
                                 <div class="form-group col-md-4">
                                    <label>Payroll frequency <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="salary_type">
                                       <option value="" >Payroll frequency</option>
                                       @if(count($salaryType)>0)
                                       @foreach($salaryType as $salaryData)
                                       <option value="{{$salaryData->salary_type}}"  @if(old('salary_type')==$salaryData->salary_type) selected @endif>{{$salaryData->salary_type}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    @if ($errors->has('salary_type'))
                                    <div class="error">{{ $errors->first('salary_type') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="department">
                                       <option value="" >Select Department</option>
                                       @if(count($department)>0)
                                       @foreach($department as $departmentData)
                                       <option value="{{$departmentData->department}}" 
                                       @if(old('department')== $departmentData->department) selected @endif>
                                       {{$departmentData->department}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    @if ($errors->has('department'))
                                    <div class="error">{{ $errors->first('department') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Working Type <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="working_type">
                                       <option value="" >Select Working Type</option>
                                       <option value="WFH" @if(old('working_type') == 'WFH')selected @endif>WFH</option>
                                       <option value="OFFICE" @if(old('working_type') == 'OFFICE')selected @endif>OFFICE</option>
                                       <option value="HYBRID" @if(old('working_type') == 'HYBRID')selected @endif>HYBRID</option>
                                    </select>
                                    @if ($errors->has('working_type'))
                                    <div class="error">{{ $errors->first('working_type') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Shift Timing </label>
                                    <input type="text" name="shift_timing" class="form-control" value="{{old('shift_timing')}}">
                                    @if ($errors->has('shift_timing'))
                                    <div class="error">{{ $errors->first('shift_timing') }}</div>
                                    @endif
                                 </div>
                              </div>
                              <!--/.row-->
                           </div>
                           <!--/.card-body-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <div class="col-sm-12">
                        <div class="card card">
                           <div class="card-header">
                              <h3 class="card-title">Assign Placement</h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                                 <div class="form-group col-md-4">
                                    <label>Assign Recruiter </label>
                                    <select class="form-control select2" name="assign_recruiter" id="assign_recruiter">
                                       <option value="" >Select assign recruiter</option>
                                       @foreach ($allUsers as $allUser)
                                       @if($allUser->role_id == 5)
                                       <option value="{{$allUser->id}}" >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_recruiter'))
                                    <div class="error">{{ $errors->first('assign_recruiter') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Assign Recruiter Lead </label>
                                    <select class="form-control select2" name="assign_recruiter_lead" id="assign_recruiter_lead">
                                       <option value="" >Select Report to</option>
                                       @foreach ($allUsers as $allUser)
                                       @if($allUser->role_id == 4)
                                       <option value="{{$allUser->id}}" >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_recruiter_lead'))
                                    <div class="error">{{ $errors->first('assign_recruiter_lead') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Assign Delivery Manager </label>
                                    <select class="form-control select2" name="assign_delivery_manager" id="assign_delivery_manager">
                                       <option value="" >Select Delivery Manager</option>
                                       @foreach ($allUsers as $allUser)
                                       @if($allUser->role_id == 3)
                                       <option value="{{$allUser->id}}" >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_delivery_manager'))
                                    <div class="error">{{ $errors->first('assign_delivery_manager') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Assign BDM </label>
                                    <select class="form-control select2" name="assign_bdm" id="assign_bdm">
                                       <option value="" >Select Assign BDM</option>
                                       @foreach ($allUsers as $allUser)
                                       @if($allUser->role_id == 7)
                                       <option value="{{$allUser->id}}" >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_bdm'))
                                    <div class="error">{{ $errors->first('assign_bdm') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Assign VP </label>
                                    <select class="form-control select2" name="assign_vp" id="assign_vp">
                                       <option value="" >Select Assign VP</option>
                                       @foreach ($allUsers as $allUser)
                                       @if($allUser->role_id == 8)
                                       <option value="{{$allUser->id}}" >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_vp'))
                                    <div class="error">{{ $errors->first('assign_vp') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label> Assign Account Manager </label>
                                    <select class="form-control select2" name="assign_account_manager" id="assign_account_manager">
                                       <option value="" >Select Account Manager</option>
                                       @foreach ($allUsers as $allUser)
                                       @if($allUser->role_id == 6)
                                       <option value="{{$allUser->id}}" >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_account_manager'))
                                    <div class="error">{{ $errors->first('assign_account_manager') }}</div>
                                    @endif
                                 </div>

                                
                              </div>
                              <!--/.row-->
                           </div>
                           <!--/.card-body-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <!--/.col-sm-12-->
                    
                     <!--/.col-sm-12-->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3">
                     <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                           <div class="text-center">
                              <img class="profile-user-img img-fluid img-circle" id="preview_image" src="{{asset('images/dummy-profile.png')}}" alt="User profile picture">
                           </div>
                           <p class="text-muted text-center">Profile Image</p>
                           <div class="error profile_image_error"></div>
                           <div class="btn_upload">
                              <input type="file" name="profile_image" id="profile_image" accept="image/png, image/jpeg, image/gif" height="90" >
                              <a href="#" class="btn btn-primary btn-block profile-img-upload-btn"><i class="fa fa-camera" aria-hidden="true"></i> <b>Upload Image</b></a>
                           </div>
                           <a href="#" class="btn btn-danger btn-block profile-img-remove-btn" style="display: none;"><i class="fa fa-trash" aria-hidden="true"></i> <b>Remove Image</b></a>
                        </div>
                        <div class="card-footer">
                           
                           <button type="submit" class="btn btn-primary btn-sm float-sm-right">Save Changes</button>
                           <a href="{{url('admin/employee/add')}}"  class="btn btn-danger btn-sm">Cancel</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </section>
      </form>
      <!-- /.content -->
   </div>
   </div>
</x-backend-layout>