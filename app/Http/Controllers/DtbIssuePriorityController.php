<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbIssuePriority;
use App\DtbActivityLog;
use App\DtbProject;

class DtbIssuePriorityController extends Controller
{
   


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

        $dtbpriorities = DtbIssuePriority::where('project_id',$id)->orderBy('ordering','ASC')->get();

        return view('settings.generalSettings.prioritySettings.index',compact('dtbpriorities','id', 'common_array'));



        // $projectlist = DtbGenIssueType::all();
       // return response()->json($dtbissuetype);
        //return view('projects.index',compact('projectlist'));

        // return Response::json(array(
        //     'issue_type' => $projectlist->issue_type,
        //     'color' => $projectlist->color,
        //     'ordering' => $projectlist->issue_type,
        // ));


    }




    public function updateOrder(Request $request){

     $dtbpriorities = DtbIssuePriority::all();

        foreach ($dtbpriorities as $dtbpriority) {

            $dtbpriority->timestamps = false; // To disable update_at field updation
            $id = $dtbpriority->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $dtbpriority->update(['ordering' => $order['position']]);
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
            'priority_name'=>'required',
            'color'=> 'required',
            'project_id'=>'',
        ]);

        DtbIssuePriority::create($data);
        DtbActivityLog::updateActivityLogPro('added', 'priority', $id);
        echo "data submitted";
       // return redirect('projects/create')->with('status', 'Data has been submitted!');

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


        $data = request()->validate([
            'priority_name'=>'required',
            'color'=>'',
            'project_id'=>'',
            'oldcolor'=>'',
        ]);


          // echo "issueid : ".$request->id;
          // echo "projectid : ".$request->project_id;
          // echo "issue_type : ".$request->issue_type;
          // echo "color : ".$request->color;

        //$DtbGenIssueType = DtbGenIssueType::find($request->issueid);
        $dtbpriority = DtbIssuePriority::where('id',$request->priorityid)->first();

        $dtbpriority->priority_name  = $request->get('priority_name');

        if ($request->get('color') == "") {
            $dtbpriority->color = $request->get('oldcolor');
        }else{
            $dtbpriority->color = $request->get('color');
        }

        $dtbpriority->project_id = $request->get('projectid');

        $dtbpriority->save();
        DtbActivityLog::updateActivityLogPro('updated', 'priority', $id);
        echo "Successfully Updated";
    }




    public function destroy(Request $request,$id)
    {
        DtbIssuePriority::find($request->id)->delete($request->id);
         DtbActivityLog::updateActivityLogPro('deleted', 'priority', $id);
        // return response()->json([
        //     'success' => 'Record deleted successfully!'
        // ]);
        echo "Record has been deleted";
    }









}
