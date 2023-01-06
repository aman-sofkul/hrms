<!--
   Project Name: HRMS
   Version: 1.0.0
   Description: 
   Author: Aditya Shivhare
   -->
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ $title }} </title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet"
         href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- JQVMap -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
      <!-- summernote -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
      <link rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
      <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--Custome Css-->
      <link rel="stylesheet" href="{{ asset('backend/dist/css/custome.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css')}}">
      <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{ asset('backend/dist/css/custome.css') }}">
   </head>
   <body class="hold-transition @if(Auth::user()->role_id==1)sidebar-mini layout-fixed @else sidebar-mini sidebar-collapse @endif">
      <div class="wrapper">
         <!-- Preloader -->
         <!--  <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
            </div> -->
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                     class="fa fa-bars"></i></a>
               </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
               <!-- Navbar Search -->
               <!-- Messages Dropdown Menu -->
               
               <li class="nav-item">
                  <a class="nav-link" role="button" href="{{ route('logout') }}"
                     onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fa fa-solid fa-power-off"></i>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
               </li>
            </ul>
         </nav>
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         @if(Auth::user()->role_id==1)
             @include('components.admin-left-sidebar')
         @else
            @include('components.employee-sidebar')
         @endif
         <!-- Content Wrapper. Contains page content -->
         <!--Main Content-->
         {{ $slot }}
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; {{date('Y')}} <a href="https://HRMS.com">HRMS</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            </div>
         </footer>
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
         </aside>
         <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
         $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- ChartJS -->
      <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
      <!-- Sparkline -->
      <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
      <!-- JQVMap -->
      <script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
      <script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
      <!-- jQuery Knob Chart -->
      <script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
      <!-- daterangepicker -->
      <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
      <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
      <!-- Tempusdominus Bootstrap 4 -->
      <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
      <!-- Summernote -->
      <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
      <!-- overlayScrollbars -->
      <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
      <!-- AdminLTE for demo purposes -->
      <!--   <script src="{{ asset('backend/dist/js/demo.js') }}"></script> -->
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
      <script type="text/javascript">
         $('.select2').select2();
         
         //Initialize Select2 Elements
         $('.select2bs4').select2({
         theme: 'bootstrap4'
         });

//education
         $(function () {
         
         $('#education').DataTable({
           processing: true,
           serverSide: true,
          ajax: "{{ route('admin.employee.education',['user_id'=>@$_GET['id']]) }}",
           columns: [
           {data: 'qualification', name: 'qualification'},
           {data: 'board_of_education', name: 'board_of_education'},
         
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'file', name: 'file'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
         });
         
         });
 
         //Attendence
         $(function () {
         
         $('#emp_attend').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ route('admin.employee.attendance') }}",
           columns: [
           {data: 'employee_id', name: 'employee_id'},
           {data: 'employee_name', name: 'employee_name'},
         
            {data: 'punch_in', name: 'punch_in'},
            {data: 'punch_out', name: 'punch_out'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
         });
         
         });


         //WOrking Hours
          $(function () {
         
         $('#working_hours_list').DataTable({
           processing: true,
           serverSide: true,

           ajax: "{{ route('admin.employee.hour') }}",
           columns: [
            {data: 'emp_id', name: 'emp_id'},
               {data: 'user_id', name: 'user_id'},

               {data: 'working_hours', name: 'working_hours'},
               //{data: 'start_date', name: 'start_date'},
               //{data: 'end_date', name: 'end_date'},
               {data: 'net_margin', name: 'net_margin'},
              // {data: 'commission', name: 'commission'},
           ],
            initComplete: function () {
               var r = $('#working_hours_list tfoot tr');

              $('#working_hours_list thead').append(r);
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");

                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }

         });
         
         });



         
         $(function () {
            $('#category').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.category') }}",
            columns: [
               {data: 'DT_RowIndex',name: 'DT_RowIndex'},
             
               {data: 'category_name', name: 'category_name'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            });
         });

          $(function () {
            $('#roles').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.role') }}",
            columns: [
               {data: 'DT_RowIndex',name: 'DT_RowIndex'},
             
               {data: 'role_name', name: 'role_name'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            });
         });
         
         $(function () {
         
         var table = $('#employee').DataTable({
               processing: true,
               serverSide: true,
               scrollX: true,
         
               ajax: "{{ route('admin.employee') }}",
               columns: [
                {data: 'action', name: 'action', orderable: false, searchable: false},
               {data: 'emp_id', name: 'emp_id'},
               {data: 'designation', name:'designation'},
               {data: 'first_name', name:'first_name'},
               {data: 'last_name', name: 'last_name'},
               
               {data: 'status', name: 'status'},
               {data: 'mobile_number', name: 'mobile_number'},
               {data: 'email', name: 'email'},
                     {data: 'start_date', name: 'start_date'},
              
               {data: 'create_by', name: 'create_by'},
               {data: 'assign_recruiter', name: 'assign_recruiter'},
               {data: 'assign_recruiter_lead', name: 'assign_recruiter_lead'},
               {data: 'assign_delivery_manager', name: 'assign_delivery_manager'},
               {data: 'assign_bdm', name: 'assign_bdm'},
               {data: 'assign_vp', name: 'assign_vp'},
               {data: 'assign_account_manager', name: 'assign_account_manager'},
         
         
              
               ]
         });
         
         });
         
         
         
         $("#employmentCategory").change(function() {
           var employmentCategory = $("#employmentCategory").val();
           $.post(
           '{{ url('/employment-type') }}',
           {
           _token: '{{ csrf_token() }}',
           employmentCategory : employmentCategory,
           },
           function(data) {
           var listitems='<option value="" selected>Select employment type</option>';
           var data =  JSON.parse(data)
               var select = $("#employmentType");
               $.each(data, function(key, value) {
                    console.log(value['category_name'] );
                     listitems += '<option value=' + value['id'] + '>' + value['category_name'] + '</option>';
               });
         
               select.html(listitems);
         
           }
           );
         });
         
         //Get States
         $("#country").change(function() {
           var country = $("#country").val();
          console.log(country);
           $.post(
           '{{ url('/get-states') }}',
           {
           _token: '{{ csrf_token() }}',
           country : country,
           },
           function(data) {
           var listitems='<option value="" selected>Select State</option>';
           var data =  JSON.parse(data)
               var select = $("#state");
               $.each(data, function(key, value) {
                    
                     listitems += '<option value=' + value['name'] + '>' + value['name'] + '</option>';
               });
         
               select.html(listitems);
         
           }
           );
         });
         
         $("#state").change(function() {
           var state = $("#country").val();
           $.post(
           '{{ url('/get-cities') }}',
           {
           _token: '{{ csrf_token() }}',
           state : state,
           },
           function(data) {
           var listitems='<option value="" selected>Select City</option>';
           var data =  JSON.parse(data)
               var select = $("#city");
               $.each(data, function(key, value) {
                    
                     listitems += '<option value=' + value['name'] + '>' + value['name'] + '</option>';
               });
         
               select.html(listitems);
         
           }
           );
         });
         
         
         var btnUpload = $("#profile_image"),
         btnOuter = $(".button_outer");
         
         btnUpload.on("change", function(e){
           var ext = btnUpload.val().split('.').pop().toLowerCase();
           if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
               $(".profile_image_error").text("Not an Image...");
           } else {
               $(".profile_image_error").text("");
               $(".profile-img-remove-btn").show();
               $(".profile-img-upload-btn").hide();
               // btnOuter.addClass("file_uploading");
               // setTimeout(function(){
               //     btnOuter.addClass("profile_image");
               // },3000);
               console.log(e.target.files[0]);
               var uploadedFile = URL.createObjectURL(e.target.files[0]);
                $("#preview_image").attr("src",uploadedFile);
             
           }
         });
         
         $(".profile-img-remove-btn").on("click", function(e){
          
         
           $("#profile_image").remove();
           location.reload();
          
         });
         $("#datetimepicker1").datetimepicker({
         format: 'DD/MM/YYYY',
         allowInputToggle: true
         });
         
         /*    for (const key of formData.keys()) {
         var field=$("#formBannerid #"+key).val();
         if(field !=''){
         $("#formBannerid #"+key).css('border','');
         }
         }*/
         
         /*var formData = new FormData($('#employee_form'));
         
         
         console.log(formData);*/
         
   
         $("#rowAdder").click(function () {
            newRowAdd =
            '<div id="row"> <div class="input-group m-3">' +
            '<div class="input-group-prepend">' +
            '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            '<i class="bi bi-trash"></i> Remove</button> </div>' +
            '<select class="form-control" name="employmentType"  id="employmentType"><option value="">Select Document Type</option><option value="Copy Passport">Copy Passport</option><option value="Copy of Educational Certificates">Copy of Educational Certificates</option><option value="ervice / Relieving letter from the last/current employer">Service / Relieving letter from the last/current employer</option><option value="Last drawn Pay slips of three months">Last drawn Pay slips of three months</option><option value="P.F Number (if available)">P.F Number (if available)</option><option value="PAN Card & Aadhar card copy">PAN Card & Aadhar card copy</option>option value="Recent Form - 16 from last/current employer">Recent Form - 16 from last/current employer</option><option value="One color passport photograph">One color passport photograph</option></select><input type="file" class="form-control m-input"> </div> </div>';
         
            $('#newinput').append(newRowAdd);
         });
         
         $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
         });
         
      $("body").on("click", "#Calculater", function () {
      var hours = $("#hours").val();
      var user_id = $("#user_id").val();
      $.post(
      '{{ url('/calculater-comission') }}',
      {
      _token: '{{ csrf_token() }}',
      hours : hours,
      user_id : user_id,
      },
      function(data) {
      if(data==''){
      $('#total_comission').html('<div class="alert alert-danger alert-dismissible">Failed to calculate comission</div>');
      }else{
      $('#total_comission').html('<div class="alert alert-success alert-dismissible">Total commission is '+data+'</div>');

      }



      });
      })
   

      $("body").on("input", "#bill_rate", function () {
        total_bill_rate();
      });

      $("body").on("change", "#vms_cost", function () {
        total_bill_rate();
      });

       $("body").on("input", "#w2_pay_rate", function () {
        over_loading_cost();
      });

      function total_bill_rate(){
         var bill_rate= $('#bill_rate').val();
         if(bill_rate==''){
           var bill_rate=0;
         }
         var vms_cost= $('#vms_cost').val();
         var total=bill_rate;
         if(vms_cost !=''){
         var total=bill_rate-vms_cost;
         }
         var total=Math.abs(total)
         $('#total_bill_rate').val(Math.abs(total));

        return total;
      }

       function over_loading_cost(){
         var w2_pay_rate= $('#w2_pay_rate').val();
         if(w2_pay_rate==''){
           var w2_pay_rate=0;
         }
         var over_loading_cost= 20;
         var total_overloading_cost=w2_pay_rate*over_loading_cost;
         $('#total_overloading_cost').val(total_overloading_cost);

         var w2_after_overloading_cost=w2_pay_rate+total_overloading_cost;
         $('#w2_after_overloading_cost').val(w2_after_overloading_cost);

         var net_margin=total_bill_rate()-w2_after_overloading_cost;

         $('#net_margin').val(Math.abs(net_margin));

      }

      //Get Requter tyoe
      $("#placement").change(function() {
           var id = $("#placement").val();
         
           $.post(
           '{{ url('/get-role-users') }}',
           {
           _token: '{{ csrf_token() }}',
           id : id,
           },
           function(data) {
           var listitems='<option value="" selected>Select Report To</option>';
           var data =  JSON.parse(data)
               var select = $("#report_to");
               $.each(data, function(key, value) {
                    
                     listitems += '<option value=' + value['id'] + '>' + value['first_name'] + value['last_name'] +'</option>';
               });
         
               select.html(listitems);
         
           }
           );
         });


$('body').on('click', '.editEmpEducation', function () {
     var customerid = $(this).data('id');
   
       
     $.get("{{ route('admin.employee.education.edit') }}" +'?id=' + customerid, function (data) {
         $('#educationEditEmp').modal('show');
console.log(data);
       $('#edu_id').val(data.id);
         $('#qualification').val(data.qualification);
         $('#start_date').val(data.start_date);
         $('#end_date').val(data.end_date);
         $('#board_of_education').val(data.board_of_education);
         $('#old_document').val(data.file);
        
     })
 });


/*Edit emergency contact*/
$('body').on('click', '.editEmergencyContact', function () {
     var customerid = $(this).data('id');
  
     $.get("{{ route('employee.emergency-contact.edit') }}" +'?id=' + customerid, function (data) {
         $('#editEmergencyContact').modal('show');

         $('#id').val(data.id);
         $('#relation_type').val(data.relation_type);
         $('#name').val(data.name);
         $('#contact_number').val(data.contact_number);
       
        
     })
 });

$('body').on('click', '.editEmpEmployement', function () {
     var customerid = $(this).data('id');
     $.get("{{ route('admin.employee.employment.details') }}" +'?id=' + customerid, function (data) {
         $('#editEmployement').modal('show');

         $('#id').val(data.id);
         $('#job_title').val(data.job_title);
         $('#company_name').val(data.company_name);
         $('#location').val(data.location);
          $('#work_start_date').val(data.start_date);
          $('#work_end_date').val(data.end_date);
          var status= data.currently_work_here;
          if(status==1){
             $('#currently_work_here').prop('checked', true);
          }else{
            $('#currently_work_here').prop('checked', false);
          } 
        
     })
 });

function changeDateInput(x) {
 $(x).attr('type', 'date');
}

   $(function () {
         
         $('#education').DataTable({
           processing: true,
           serverSide: true,
          ajax: "{{ route('admin.employee.education',['user_id'=>@$_GET['id']]) }}",
           columns: [
           {data: 'qualification', name: 'qualification'},
           {data: 'board_of_education', name: 'board_of_education'},
         
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'file', name: 'file'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
         });
         
         });

 
   $(document).ready(function(){
   $(".currently_work_here").click(function(){
      if ($(this).is(":checked")) {
          $(".employement_end_date").hide();
      }else{
        $(".employement_end_date").show();
      }  
   });
 });
$(document).ready(function(){
   $(".merried_status").click(function(){
      if ($(this).val()==1) {
   
          $("#date_of_marriage").show();
      }else{
        $("#date_of_marriage").hide();
      }  
   });
 });


   $(function () {
         
         $('#holiday').DataTable({
           processing: true,
           serverSide: true,
          ajax: "",
           columns: [
           {data: 'holiday_name', name: 'holiday_name'},
           {data: 'date', name: 'date'},
         
            {data: 'year', name: 'year'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
         });
         
         });

   $('body').on('click', '.holidayeditmodel', function () {
     var customerid = $(this).data('id');
     $.get("{{ route('admin.holiday.edit') }}" +'?id=' + customerid, function (data) {
         $('#editholiday').modal('show');

         $('#id').val(data.id);
         $('#holiday_name').val(data.holiday_name);
         $('#date').val(data.date);
         $('#year').val(data.year);

         
        
     })
 });

   $(function () {
         
         $('#todoList').DataTable({
           processing: true,
           serverSide: true,
          ajax: "",
           columns: [
           {data: 'create_by', name: 'create_by'},
           {data: 'user_id', name: 'user_id'},      
            {data: 'comment', name: 'comment'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
         });
         
         });

   $('body').on('click', '.todoeditmodel', function () {
     var customerid = $(this).data('id');
     $.get("{{ route('admin.todo.edit') }}" +'?id=' + customerid, function (data) {
         $('#edittodo').modal('show');
         $('#id').val(data.id);
         $('#create_by').val(data.create_by);
         $('#user_id').val(data.user_id);
         $('#comment').val(data.comment);        
     })
 });

   $(function () {
         
         $('#leaveList').DataTable({
           processing: true,
           serverSide: true,
          ajax: "",
           columns: [
           {data: 'create_by', name: 'create_by'},
           {data: 'leave_type', name: 'leave_type'},      
            {data: 'leave_name', name: 'leave_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
         });
         
         });

    $('body').on('click', '.leaveeditmodel', function () {
     var customerid = $(this).data('id');
     $.get("{{ route('admin.leave.edit') }}" +'?id=' + customerid, function (data) {
         $('#editleave').modal('show');
         $('#create_by').val(data.create_by);
         $('#leave_type').val(data.leave_type);
         $('#leave_name').val(data.leave_name);
      })
        
 });





       $("#assign_account_manager").on('change',function(){
          $("#accout_manager_commission_type").show();
        });
        
//Hide Rate section


$("#designation").on('change',function(){
var   id=$(this).val();
if(id !=11){
$("#rate_section").hide();
}
});
      </script>
   </body>
</html>