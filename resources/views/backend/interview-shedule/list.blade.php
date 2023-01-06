<x-backend-layout>
   <x-slot name='title'>Interview shedule</x-slot>
   <div class="content-wrapper" style="min-height: 1518.06px;">
      <style type="text/css">
         ul.inteview-shedule-list li span{
            font-size: 11px;
         }
      </style>
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                     <li class="breadcrumb-item active">Interview shedule</li>
                  </ol>
               </div>
            </div>
         </div>
      </section>
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
      <section class="content">
         <div class="card card-primary card-outline">
            <div class="card-header">
               <h3 class="card-title">
                  Interview List
               </h3>
               <a  href="#" class="btn btn-primary float-sm-right" data-toggle="modal" data-target="#addinterview"><i class="fa fa-plus"></i> Interview
               </a>
            </div>
            <div class="card-body">
               <div class="row">
                  @if(count($InterviewShedule)>0)
                  @foreach($InterviewShedule as $data)
                  <div class="col-md-4">
                     <div class="card @if($data->status==0) card-warning @elseif($data->status==1)  card-primary @elseif($data->status==2) card-success @else card-danger  @endif ">
                        <div class="card-header">
                           <h3 class="card-title">{{$data->company_name}}</h3>
                           <div class="card-tools">
                            
                            
                              <a  href="#" type="button" data-id="{{$data->id}}" class="btn btn-tool editinterview" ><i class="fas fa-edit"></i>
                              </a>
                                <a href="{{route('admin.interview-shedule.delete',['id'=>$data->id])}}" type="button" class="btn btn-tool" ><i class="fas fa-times"></i>
                              </a>
                           </div>
                        </div>
                        <div class="card-body">
                              <ul class="inteview-shedule-list">
                                 <li>Hr Name: <span>{{$data->hr_name}}</span></li>
                                 <li>Contact Number: <span>{{$data->contact_number}}</span> </li>
                                 <li>Status: @if($data->status==0) 
                                    <span class="badge badge-warning">Pending</span> 
                                    @elseif($data->status==1) 
                                    <span class="badge badge-primary">1st Round clear</span>  
                                    @elseif($data->status==2) 
                                        <span class="badge badge-success">2st Round clear</span>  
                                   @else
                                       <span class="badge badge-danger">Hold</span>  
                                    @endif
                                 </li>
                                  <li>Location: <span>{{$data->location}}</span></li>
                                 <li>Note: <span>{{$data->description}}</span></li>
                                 
                              </ul>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  {{ $InterviewShedule->links() }}
                  @endif
                 
                
               </div>
            </div>
            <div class="card-footer clearfix">
            </div>
         </div>
      </section>
   </div>
   <!--Interview Add-->
   <div class="modal fade" id="addinterview" tabindex="-1" role="dialog" aria-labelledby="addinterview" aria-hidden="true">
      <form action="{{route('admin.interview-shedule.create')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="modal-dialog modal-dialog-centered" role="">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Add Interview</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="form-group col-md-12">
                        <label>Employee<span class="text-danger">*</span></label>                     
                        <select class="form-control select2" name="user_id">
                           <option value="">Select Employee</option>
                           @foreach($employees as $emp_data)
                           <option value="{{$emp_data->id}}">{{$emp_data->first_name}} {{$emp_data->last_name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-12">
                        <label>Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Hr Name </label>
                        <input type="text" name="hr_name" class="form-control" placeholder="Hr Name" value="">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Contact Number <span class="text-danger">*</span></label>
                        <input type="text" maxlength="10" name="contact_number" class="form-control" placeholder="Contact Number" value="">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Location </label>
                        <input type="text" name="location"  class="form-control" placeholder="Enter location">
                     </div>

                     <div class="form-group col-md-6">
                        <label>Status<span class="text-danger">*</span></label>                     
                        <select class="form-control select2" name="status">
                           <option value="">Select</option>
                           <option value="Pending">Pending</option>
                           <option value="first round done">First Round Done</option>
                           <option value="second round done">Second Round Done</option>
                           <option value="final round done">Final Round Done</option>
                           <option value="assignment submit">Assignment Submit</option>
                           <option value="reschedule">Reschedule</option>
                           <option value="result awaiting">Result Awaiting</option>
                        </select>
                     </div>
                     <div class="form-group col-md-12">
                        <label>Description </label>
                        <textarea name="description"  class="form-control" placeholder="Enter description" ></textarea>
                        
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <!--Interview Edit-->
   <div class="modal fade" id="editinterview" tabindex="-1" role="dialog" aria-labelledby="editinterview" aria-hidden="true">
       <form action="{{route('admin.interview-shedule.update')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="modal-dialog modal-dialog-centered" role="">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Edit Interview</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="form-group col-md-12">
                        <label>Employee<span class="text-danger">*</span></label>                     
                        <select class="form-control select2" id="user_id" name="user_id">
                           <option value="">Select Employee</option>
                           @foreach($employees as $emp_data)
                           <option value="{{$emp_data->id}}">{{$emp_data->first_name}} {{$emp_data->last_name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-12">
                        <label>Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" >
                     </div>
                     <div class="form-group col-md-6">
                        <label>Hr Name </label>
                        <input type="text" name="hr_name" id="hr_name" class="form-control" placeholder="Hr Name" >
                     </div>
                     <div class="form-group col-md-6">
                        <label>Contact Number <span class="text-danger">*</span></label>
                        <input type="text" maxlength="10" id="contact_number" name="contact_number" class="form-control" placeholder="Contact Number" value="">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Location </label>
                        <input type="text" name="location" id="location" class="form-control" placeholder="Enter location">
                     </div>

                     <div class="form-group col-md-6">
                        <label>Status<span class="text-danger">*</span></label>                     
                        <select class="form-control select2" id="status" name="status">
                           <option value="">Select</option>
                           <option value="Pending">Pending</option>
                           <option value="first round done">First Round Done</option>
                           <option value="second round done">Second Round Done</option>
                           <option value="final round done">Final Round Done</option>
                           <option value="assignment submit">Assignment Submit</option>
                           <option value="reschedule">Reschedule</option>
                           <option value="result awaiting">Result Awaiting</option>
                        </select>
                     </div>
                     <div class="form-group col-md-12">
                        <label>Description </label>
                        <textarea name="description"  id="description" class="form-control" placeholder="Enter description" ></textarea>
                        
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
    
   </div>
</x-backend-layout>
<script>
   $('body').on('click', '.editinterview', function () {
     var id = $(this).data('id');
     $.get("{{ route('admin.interview-shedule.edit') }}" +'?id=' + id, function (data) {
        
         $('#company_name').val(data.company_name);
         $('#hr_name').val(data.hr_name);
         $('#editinterview').modal('show');
         $('#contact_number').val(data.contact_number);
         $('#location').val(data.location);
        $('#description').val(data.description);

        $('#user_id option[value="'+data.user_id+'"]').attr("selected",true);
        $('#status option[value="'+data.status+'"]').attr("selected",true);
      })
        
 });
</script>