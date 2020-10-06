<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbVersion;
use App\DtbActivityLog;
use App\DtbProject;

class DtbVersionController extends Controller
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

     $DtbGenVersion = DtbVersion::where('project_id',$id)->orderBy('ordering','ASC')->get();

     return view('settings.generalSettings.versionsSettings.index',compact('DtbGenVersion','id', 'common_array'));



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

   $genversions = DtbVersion::all();

   foreach ($genversions as $genversion) {

            $genversion->timestamps = false; // To disable update_at field updation
            $id = $genversion->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $genversion->update(['ordering' => $order['position']]);
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
            'version_name'=>'required',
            'start_date'=>'',
            'color'=>'',
            'end_date'=>'',
            'project_id'=>'',
        ]);

        DtbVersion::create($data);
        DtbActivityLog::updateActivityLogPro('added', 'version', $id);
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


       // foreach ($request->color as $color) {
       //     echo $color;
       // }

        $data = request()->validate([
            'version_name'=>'required',
            'color'=>'',
            'start_date'=>'',
            'end_date'=>'',
            'project_id'=>'',
        ]);


          // echo "issueid : ".$request->versionid;
          // echo "projectid : ".$request->projectid;
          // echo "end_date : ".$request->end_date;


        //$DtbGenIssueType = DtbGenIssueType::find($request->issueid);
        $Dtbgenversions = DtbVersion::where('id',$request->versionid)->first();
        $Dtbgenversions->version_name  = $request->get('version_name');

        if ($request->get('color')=="") {
            $Dtbgenversions->color  = $request->get('oldcolor');
        }else{
            $Dtbgenversions->color  = $request->get('color');
        }

        $Dtbgenversions->start_date  = $request->get('start_date');
        $Dtbgenversions->end_date  = $request->get('end_date');
        $Dtbgenversions->project_id  = $request->get('projectid');
        $Dtbgenversions->save();
        DtbActivityLog::updateActivityLogPro('updated', 'version', $id);
        echo "Successfully Updated";
    }




    public function destroy(Request $request,$id)
    {
        DtbVersion::find($request->id)->delete($request->id);
        // return response()->json([
        //     'success' => 'Record deleted successfully!'
        // ]);
        DtbActivityLog::updateActivityLogPro('deleted', 'version', $id);
        echo "Record has been deleted";
    }




}
