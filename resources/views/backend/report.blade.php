<x-backend-layout>

	<x-slot name='title'>Report</x-slot>
    <div class="content-wrapper" style="min-height: 1518.06px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Report</li>
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
                        Report
                    </h3>
                 
                </div>
                <div class="card-body">
                	<div class="row">
                	  <div class="form-group col-md-4">
                                    <label>Designation <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="designation">
                                       <option value="" selected>Select Designation</option>
                                        @foreach($data as $dat)
                                       <option value="">{{$dat->role_name}} </option>  
                                        @endforeach 
                                    </select>    
                     </div> 

                      <div class="form-group col-md-4">
                                    <label>Select Employee</label>
                                    <select class="form-control select2" name="assign_account_manager" id="assign_account_manager">
                                       <option value="" >Select Employee</option>
                                       <option value="" ></option>   
                                    </select>
                       </div> 
						<div class="col-MD-4"> 
							<button type="submit" class="btn btn-primary">Generate Report</button>
						</div>
					</div>
				</div>
			</div>
		</section>

		 <section class="content">
            <div class="card card-primary card-outline">
                <table class="table  table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Total Consultant</th>
                               <th>Net Margin</th>
                               <th>Month</th>
                            </tr>
                        </thead>
                         <tbody>
                         	<td></td>
                         	<td></td>
                         	<td></td>

                        </tbody>
                    </table>
                
               
            </div>
        </section>
</div>

</x-backend-layout>