<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use App\Models\User;
use DataTables;
use App\Interfaces\InterviewStatus;
use Redirect;
use App\Models\InterviewShedule;
class InterviewSheduleController extends Controller
{
    public function index(Request $request){
        $employees=User::where('role_id',2)->get();
         $InterviewShedule=InterviewShedule::orderBy('id','DESC')->paginate(10);
         return view('backend.interview-shedule.list',['employees'=>$employees,'InterviewShedule'=>$InterviewShedule]);

    }

    public function store(Request $request)
    {
         $this->validate($request, [
            'company_name'=> 'required',
            'hr_name'=> 'nullable',
            'user_id'=> 'required',
            'contact_number'=> 'required|string',
            'location'=> 'nullable|string',
            'description'=>'nullable'

        ]);
       $data=$request->all();

        $data['status']=0;
        $insert=InterviewShedule::create($data);
        if($insert){
             return redirect('admin/interview-shedule')->with('success', 'Interview shedule has been created ');
        }else{
             return redirect('admin/interview-shedule')->with('error', 'failed to create interview shedule ');
        }

    }
       public function edit(Request $request){

        $data=InterviewShedule::where('id',$request->id)->first();

        return  response()->json($data);

    }


    // public function edit(Request $request){
    //       $data= Holiday::where('id',$request->id)->first();
         
    //     return response()->json($data);         
    // } 

    public function update(Request $request){
          $this->validate($request, [
            'company_name'=> 'required',
            'hr_name'=> 'nullable',
            'user_id'=> 'required',
            'contact_number'=> 'required|string',
            'location'=> 'nullable|string',
            'description'=>'nullable'
        ]);

         $data=$request->all();
         $data['status']=0;
         
         $insert = InterviewShedule::where('id',$request->id)->update($data);
           if($insert==1){
           return redirect('admin/interview-shedule')->with('success', 'Interview has been updated ');
        }else{
            return redirect('admin/interview-shedule')->with('error', 'failed to update interview ');
        }

     }

    public function delete(Request $request){
          $delete = InterviewShedule::where('id',$request->id)->delete();
           if($delete==1){
            return Redirect::back()->with('success', 'Interview has been deleted ');
        }else{
            return Redirect::back()->with('error', 'Failed to delete interview ');
        }
    } 
}
