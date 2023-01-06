<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use App\Models\Role;
use App\Models\EmployeeCategory;
use App\Models\Designation;
use App\Models\Education;
use App\Models\EmploymentDetails;
use App\Models\SalaryType;
use App\Models\Department;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\VendorCost;
use App\Models\Attendance;
use App\Models\EmergencyContact;
use App\Models\WorkingHour;
use App\Imports\WorkingHourImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use Auth;
use DataTables;
use DB;
class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = User::whereNotIn('role_id',[1])->orderBy('first_name','ASC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('start_date', function ($row){
                        return date('d-m-Y',strtotime($row->start_date));
                    })

                     ->editColumn('status', function ($row){
                        if($row->account_status==1){
                            return '<span class="badge badge-success">Active</span>';
                        }else{
                            return '<span class="badge badge-danger">Inactive</span>';
                        }
                        
                    })
                    ->editColumn('assign_delivery_manager', function ($row){
                    if($row->assign_delivery_manager !=''){
                    return  @$row->assignDeliveryManager->first_name.' '.@$row->assignDeliveryManager->last_name;
                    }

                    })

                    ->editColumn('assign_recruiter_lead', function ($row){
                    if($row->assign_recruiter_lead !=''){
                    return  @$row->assignRecruiterLead->first_name.' '.@$row->assignRecruiterLead->last_name;
                    }

                    })

                    ->editColumn('assign_recruiter', function ($row){
                    if($row->assign_recruiter !=''){
                    return  @$row->assignRecruiter->first_name.' '.@$row->assignRecruiter->last_name;
                    }

                    })


                    ->editColumn('assign_account_manager', function ($row){
                    if($row->assign_account_manager !=''){
                    return  @$row->assignAccountManager->first_name.' '.@$row->assignAccountManager->last_name;
                    }

                    })

                    ->editColumn('assign_bdm', function ($row){
                    if($row->assign_bdm !=''){
                    return  @$row->assignBdm->first_name.' '.@$row->assignBdm->last_name;
                    }

                    })
                    ->editColumn('assign_vp', function ($row){
                    if($row->assign_vp !=''){
                    return  @$row->assignVp->first_name.' '.@$row->assignVp->last_name;
                    }

                    })

                    ->editColumn('create_by', function ($row){
                        return  @$row->create_by->first_name.' '.@$row->create_by->last_name;
                    })
                  
                     ->editColumn('role_id', function ($row){
                       return  $row->role->role_name ?? '';
                    })

                    ->addColumn('action', function($row){
                      
                         $edit=route('admin.employee.edit',['emp'=>$row->emp_id]);
                         $view=route('admin.employee.view',['emp'=>$row->emp_id]);

                           $btn = '<a href="'.$edit.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> <a href="'.$view.'" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
      

        return view('backend.employee.list');
    }
    
    public function add()
    {   
        $report = User::where('role_id',2)->get();
        $employeeCategory=EmployeeCategory::orderBy('category_name','ASC')->where('is_parient',0)->get();
        $role = Role::whereNotIn('id',[1,9])->get();
        $report_type = Role::whereNotIn('id',[1])->get();

        $department=Department::orderBy('department','ASC')->get();
        $salaryType=SalaryType::orderBy('salary_type','ASC')->get();
        $country=Country::orderBy('name','ASC')->get();
       $designation=Designation::orderBy('designation','ASC')->get();
        $allUsers=User::get();

        return view('backend.employee.add',['role'=>$role,'report'=>$report,
            'employeeCategory'=>$employeeCategory,'department'=>$department,'salaryType'=>$salaryType,'country'=>$country,'designation'=>$designation,
            'allUsers'=>$allUsers,'report_type'=>$report_type]);
    }

   

    public function profile()
    {
        return view('backend.employee.profile');
    }

    public function store(Request $request){
      

        $this->validate($request, [
            'alies_name'=> 'nullable|string|max:70',
            'first_name'=> 'required|string|max:45',
            'last_name'=> 'required|string|max:45',
            'middle_name'=> 'nullable|string|max:45',
            'email'=> 'required|unique:users,email|max:100',
            'gender'=> 'required|in:male,female',
            'marital_status'=> 'nullable',
            'married_date'=>'string|nullable|max:20',
            'mobile_number'=> 'nullable|string|max:15',
            'start_date'=> 'required|string|max:15',
            'dob'=> 'required|string|max:15',
            'blood_group'=>'string|nullable|max:20',
            'emergency_contact'=>'string|nullable|max:20',
            'designation'=> 'required|string',
            'country'=> 'nullable|string',
            'current_address'=> 'nullable|string',
            'permanent_address'=> 'nullable|string',
            'department'=> 'required|string',
            'salary_type'=> 'required|string|exists:salary_types,salary_type',
            'shift_timing'=> 'nullable|max:100',
            'working_type'=> 'required|string|in:WFH,OFFICE,HYBRID',
        ]);
          
         $store=$request->all();
        $avatar_file = $request->file('profile_image');
        if ($avatar_file) {
              $avatar_old=Auth::user()->avatar;
            //Delete old image
                if(!empty($avatar_old)){
                    
                    $imageArr=explode("storage/user/",$avatar_old);
                    Storage::disk('user')->delete($imageArr);
                 }
            //update new image   
            $store['avatar'] = rand(1000, 9990) . date('ymd') . '.' . $avatar_file->getClientOriginalExtension();
            $avatar_file->storeAs('user',$store['avatar']);
            
        }
       $store['account_status']= 1;
       $store['emp_id']= $this->generateEmployeeId();
       $store['password']= bcrypt($store['emp_id']);
        $insert=User::create($store);
        if($insert){
            return redirect('admin/employee')->with('success', 'Employee profile has been created.');
        }else{
            return redirect('admin/employee')->with('error', 'Failed to create employee profile.');
        }
    }

 public function edit(Request $request)
    {
          $report = User::where('role_id',2)->get();
        if(! isset($request->emp)){
            return Redirect::back()->with('error', 'Invalid employee please try again latter.');
            exit;
        }

        $data = User::where('emp_id',$request->emp)->first();
        if(empty($data)){
           return Redirect::back()->with('error', 'Invalid employee please try again latter.');
         exit;
        }

       
        $department=Department::orderBy('department','ASC')->get();
        $salaryType=SalaryType::orderBy('salary_type','ASC')->get();
        $role = Role::whereNotIn('id',[1,9])->get();
        $country=Country::orderBy('name','ASC')->get();
         $designation=Designation::orderBy('designation','ASC')->get();
        $allUsers=User::get();
           $placement_type = Role::whereNotIn('id',[1])->get();
        return view('backend.employee.edit',['role'=>$role,'report'=>$report,'data'=>$data,'department'=>$department,'salaryType'=>$salaryType,'country'=>$country,'allUsers'=>$allUsers,'designation'=>$designation]);

    }
   public function update(Request $request){
   

           $this->validate($request, [
            'alies_name'=> 'nullable|string|max:70',
            'first_name'=> 'required|string|max:45',
            'last_name'=> 'required|string|max:45',
            'middle_name'=> 'nullable|string|max:45',
           
            'gender'=> 'required|in:male,female',
            'marital_status'=> 'nullable',
            'married_date'=>'string|nullable|max:20',
            'mobile_number'=> 'nullable|string|max:15',
            'start_date'=> 'required|string|max:15',
            'dob'=> 'required|string|max:15',
            'blood_group'=>'string|nullable|max:20',
            'emergency_contact'=>'string|nullable|max:20',
            'designation'=> 'required|string',
            'country'=> 'nullable|string',
            'current_address'=> 'nullable|string',
            'permanent_address'=> 'nullable|string',
            'department'=> 'required|string',
            'salary_type'=> 'required|string|exists:salary_types,salary_type',
            'shift_timing'=> 'nullable|max:100',
            'working_type'=> 'required|string|in:WFH,OFFICE,HYBRID',
        ]);
          $store=$request->all();
         unset($store['email']);
          unset($store['_token']);
           unset($store['old_avatar']);
          
         unset($store['profile_image']);
         if(isset($request->account_status)){
             unset($store['account_status']);
           $store['account_status']=$request->account_status;
         }
         
         if(!empty($request->start_date)){
             unset($store['start_date']);
            $store['start_date']=date("Y-m-d",strtotime($request->start_date));
         }

          if(!empty($request->dob)){
             unset($store['dob']);
            $store['dob']=date("Y-m-d",strtotime($request->dob));
         }


         $avatar_file = $request->file('profile_image');
        if ($avatar_file) {
              $avatar_old=$request->old_avatar;
               if(!empty($avatar_old)){
                    $imageArr=explode("storage/user/",$avatar_old);
                    Storage::disk('user')->delete($imageArr);
                 }
            //update new image   
           $store['avatar'] = rand(1000, 9990).date('ymd'). '.' .$avatar_file->getClientOriginalExtension();
            $avatar_file->storeAs('user',$store['avatar']);
        }

        $update=User::where('id',$request->id)->update($store);
        if( $update==1){
         return Redirect::back()->with('success', 'Employee profile has been updated.');
        }else{
         return Redirect::back()->with('error', 'Failed to update  employee profile.');
        }
    }

    public function generateEmployeeId() {
        $num = User::get()->count();
        ++$num; // add 1;
        $len = strlen($num);
        for($i=$len; $i< 4; ++$i) {
         $num = '0'.$num;
        }
        return 'RSO'.date('y').$num;
    }
    
    public function deleteProfileImage(Request $request){
        $avatar=User::where('emp_id',$request->emp_id)->value('avatar');
        if(!empty($avatar)){
            $imageArr=explode("storage/user/",$avatar);
            Storage::disk('user')->delete($imageArr); 
            $delete=User::where('emp_id',$request->emp_id)->update(['avatar'=>'']);
            return Redirect::back()->with('error', 'Delete image has been successfully.');
            exit;
        }

         return Redirect::back()->with('error', 'Failed to remove image.');
    }

    function net_margin_calculate($vms_cost, $bill_rate, $w2_payrate,$over_loading_cost){

       // $totalBillRate=$bill_rate;
      /*
          $after_disount=$bill_rate*$vms_cost;
          $before_discount=$bill_rate;

      */
          if($vms_cost !=0){
            $bill_rate=$bill_rate*$vms_cost; //after discount
          }

       //if discount vms cost
       // if(!empty($vms_cost)){
       //     $totalBillRate= abs($bill_rate-$vms_cost);
       // }

         $overLoadingCost=$w2_payrate*$over_loading_cost;
         
          $AftertotalOverLoadingCost=$w2_payrate+$overLoadingCost;

          $net_margin=abs($bill_rate-$AftertotalOverLoadingCost);

       return $net_margin;
    }

 
   public function working_hour(Request $request)
    {

         if ($request->ajax()) {
             $data = WorkingHour::groupBy('user_id')->select('user_id', DB::raw('sum(working_hours) as working_hours'))->whereMonth('start_date',date('m'))->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                        ->editColumn('user_id', function ($row){
                       return  $row->user->first_name.' '.$row->user->last_name ?? '';
                    })
                        
                          ->addColumn('emp_id', function($row){     
                        return @$row->user->emp_id ?? '-';
                    })
                   ->addColumn('net_margin', function($row){     
                        return @$row->user->net_margin ?? '-';
                    })
                   // ->addColumn('commission', function($row){     
                   //      return $this->requestorCalculateComission($row->user_id, $row->working_hours);
                   //  })
                    ->rawColumns([''])
                    ->make(true);
        }
      
        return view('backend.employee.hour');
    }

    public function importHours() 
    {
        
        Excel::import(new WorkingHourImport,request()->file('working_hour_file'));     
        return back();
    }



    function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));

        //Apply above formula.
       $week= $this->weekOfYear($date) - $this->weekOfYear($firstOfMonth) + 1;
        return $week;
    }

    function weekOfYear($date) {
        $weekOfYear = intval(date("W", $date));
        if (date('n', $date) == "1" && $weekOfYear > 51) {
            // It's the last week of the previos year.
            return 0;
        }
        else if (date('n', $date) == "12" && $weekOfYear == 1) {
            // It's the first week of the next year.
            return 53;
        }
        else {
            // It's a "normal" week.
            return $weekOfYear;
        }
    }


//Show comission 
 public function allconsultentUser($internalEmpId){
     $commission=[];
     $teams = User::where('assign_recruiter',@$internalEmpId)->get();
     if(count($teams)>0){
        foreach($teams as $data){
              $hoursArr=$data['working_hours'];
               $hours= $hoursArr[0]['working_hours'] ?? 0;
             if($hours !=0){
                 $commission[]=$this->requestorCalculateComission($data->id, $hours);
             }
        }
     }

    return  $commission=array_sum($commission) ?? 0;
 }
   

public function view(Request $request)
    {
        $data = User::where('emp_id',@$request->emp)->first();
        if(empty($data)){
             return Redirect::back()->with('error','Failed to view profile');
            exit;
        }
        $education = Education::where('user_id',@$data->id)->get();
        $emergencyContact = EmergencyContact::where('user_id',@$data->id)->get();
        $workExperience = EmploymentDetails::where('user_id',$data->id)->get();
        $Attendance = Attendance::where('user_id',@$data->id)
        ->whereDate('created_at',date('Y-m-d'))->first();

        
          $commission=0;

        $todo=Todo::where('user_id',$data->id)->orderBy('id','DESC')->get();
        $teams=[];
        if($data->role_id==3){
            $teams = User::where('assign_delivery_manager',@$data->id)->get();
        }elseif($data->role_id==4){
            $commission=$this->recruiterLeadComission($data->id);
         
            $teams = User::where('assign_recruiter_lead',@$data->id)->get();
        }elseif($data->role_id==5){
            $teams = User::where('assign_recruiter',@$data->id)->get();
             $commission=$this->allconsultentUser($data->id);
        }elseif($data->role_id==6){
            $teams = User::where('assign_account_manager',@$data->id)->get();
             $direct_commission=$this->accountManagerDirectCommission($data->id);
             $indirect_commission=0;

             
              $commission='Direct commission: <span class="badge badge-success">'.$direct_commission.'</span> 
              Indirect commission<span class="badge badge-success">'.$indirect_commission.'</span>';
             
        }elseif($data->role_id==7){
            $teams = User::where('assign_bdm',@$data->id)->get();
        }elseif($data->role_id==8){
            $teams = User::where('assign_vp',@$data->id)->get();
        }
     
       $birthday = User::whereMonth('dob',date('m'))->get();
        return view('backend.employee.view',['data'=>$data,'education'=>$education,'workExperience'=>$workExperience,'Attendance'=>$Attendance,'todo'=>$todo,'teams'=>$teams,'commission'=>$commission,'emergencyContact'=>$emergencyContact,'birthday'=> $birthday]);
    }

   
    
    public function addEmergency(Request $request){

        $this->validate($request, [
            'name'=> 'required',
            'relation_type'=> 'required',
            'contact_number'=> 'required',
        ]);

        $store=array(
            'user_id'=> $request->user_id,
            'name'=>$request->name,
            'relation_type'=>$request->relation_type,
            'contact_number'=>$request->contact_number,
        );

        $insert=EmergencyContact::create($store);

        if($insert){
           return Redirect::back()->with('success', 'Emergency Contact has been updated ');
        }else{
            return Redirect::back()->with('error', 'Failed to update emergency contact ');
        }

    }
   
    public function updateEmergency(Request $request){
        $this->validate($request, [
            'name'=> 'required',
            'relation_type'=> 'required',
            'contact_number'=> 'required',
        ]);

        $store=array(
            'name'=>$request->name,
            'relation_type'=>$request->relation_type,
            'contact_number'=>$request->contact_number,
        );
       

        $insert=EmergencyContact::where('id',$request->id)->update($store);

        if($insert==1){
           return Redirect::back()->with('success', 'Emergency Contact has been updated');
        }else{
            return Redirect::back()->with('error', 'Failed to update emergency contact');
        }
        
    }

       public function editEmergencyContact(Request $request){
         $data=EmergencyContact::where('id',$request->id)->first();
         return response()->json($data);       
      }
    public function deleteEmergency(Request $request){
        $delete = EmergencyContact::where('id',$request->id)->delete();
           if($delete==1){
            return Redirect::back()->with('success', 'Emergency Contact has been deleted ');
        }else{
            return Redirect::back()->with('error', 'Failed to deleteemergency contact ');
        }
        
    }
}
