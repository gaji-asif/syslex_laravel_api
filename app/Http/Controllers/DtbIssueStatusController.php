<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbIssueStatus;
use App\DtbActivityLog;
use App\DtbProject;


class DtbIssueStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {

        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }


        $DtbProject = DtbProject::find($id);
        if (empty($DtbProject)) {
           return redirect('projects');
        }

        $common_array = array(
            'content_heading' => 'Project Settings'
        );


        $loggedindeveloper = Session::get('developer_id');
        $DtbIssueStatus = DtbIssueStatus::where('project_id',$id)->where('is_true',1)->orderBy('ordering','ASC')->get();
        // $DtbIssueStatus = DtbIssueStatus::where('project_id',$id)->where('is_complete',0)->orderBy('ordering','ASC')->get();
        return view('settings.generalSettings.statussetting.index',compact('DtbIssueStatus','id', 'common_array'));


    }

   


    public function updateOrder(Request $request){

     $statuses = DtbIssueStatus::all();

        foreach ($statuses as $status) {

            $status->timestamps = false; // To disable update_at field updation
            $id = $status->id;
            echo $id;
            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $status->update(['ordering' => $order['position']]);
                }
            }

        }

         return response('Update Successfully.', 200);

    }






    public function create()
    {
       
    }


    public function store(Request $request,$id)
    {
        
       $data = request()->validate([
            'status_name'=>'required',
            'color'=> 'required',
            'is_complete'=> '',
            'project_id'=>'',
        ]);

        $lastInsertID = DtbIssueStatus::create($data)->id;


        if($lastInsertID){
            $status_issue = DtbIssueStatus::find($lastInsertID);
            $status_issue->condition_id = $lastInsertID;
            $result = $status_issue->update();
        }

        $another_issue = new DtbIssueStatus;
        $another_issue->project_id = $request->project_id;
        $another_issue->status_name = "not:".$request->status_name;
        $another_issue->is_complete = 0;
        $another_issue->color = $request->color;
        $another_issue->condition_id = $lastInsertID;
        $another_issue->is_true = 0;
        $another_issue->save();
        
        DtbActivityLog::updateActivityLogPro('added', 'status', $id);
        echo "data submitted";

    }



    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        //
    }



    public function update(Request $request, $id)
    {


       // foreach ($request->color as $color) {
       //     echo $color;
       // }

        $data = request()->validate([
            'status_name'=>'required',
            'color'=>'',
            'project_id'=>'',
            'oldcolor'=>'',
            'iscompletes'=>'',
        ]);


          // echo "statusid : ".$request->id;
          // echo "projectid : ".$request->project_id;
          // echo "status_name : ".$request->status_name;
            //echo "ddd : ".$request->iscompletes;

        //$DtbIssueStatus = DtbIssueStatus::find($request->statusid);
        $DtbIssueStatus = DtbIssueStatus::where('id',$request->statusid)->first();

        $DtbIssueStatus->status_name  = $request->get('status_name');
        $DtbIssueStatus->is_complete  = $request->get('iscompletes');
        $DtbIssueStatus->is_feedback  = $request->get('isfeedback');
        if ($request->get('color')=="") {
            $DtbIssueStatus->color  = $request->get('oldcolor');
        }else{
            $DtbIssueStatus->color  = $request->get('color');
        }
        
        $DtbIssueStatus->project_id  = $request->get('projectid');

        $DtbIssueStatus->save();
        DtbActivityLog::updateActivityLogPro('updated', 'status', $id);
        echo "Successfully Updated";
    }




    public function destroy(Request $request,$id)
    {
        //DtbIssueStatus::find($request->id)->delete($request->id);
        DtbIssueStatus::where('condition_id',$request->id)->delete();
        // return response()->json([
        //     'success' => 'Record deleted successfully!'
        // ]);
        //DtbActivityLog::updateActivityLog('deleted', 'status');
        DtbActivityLog::updateActivityLogPro('deleted', 'status', $id);
        echo "Record has been deleted";
    }


}
