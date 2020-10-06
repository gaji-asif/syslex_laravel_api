<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbGenIssueType;
use App\DtbActivityLog;

class DtbGenIssueTypeController extends Controller
{


    public function index($id)
    {

        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        
        $common_array = array(
            'content_heading' => 'Project Settings'
        );

        $loggedindeveloper = Session::get('developer_id');

        $dtbissuetype = DtbGenIssueType::where('project_id',$id)->orderBy('ordering','ASC')->get();

        return view('settings.generalSettings.issuetypesetting.index',compact('dtbissuetype','id', 'common_array'));



    }



    public function updateOrder(Request $request){

     $issuetypes = DtbGenIssueType::all();

        foreach ($issuetypes as $issuetype) {

            $issuetype->timestamps = false; // To disable update_at field updation
            $id = $issuetype->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $issuetype->update(['ordering' => $order['position']]);
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
            'issue_type'=>'required',
            'color'=> 'required',
            'project_id'=>'',
        ]);

        DtbGenIssueType::create($data);
        DtbActivityLog::updateActivityLogPro('added', 'issue type', $id);
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
            'issue_type'=>'required',
            'color'=>'',
            'project_id'=>'',
            'oldcolor'=>'',
        ]);


        //$DtbGenIssueType = DtbGenIssueType::find($request->issueid);
        $DtbGenIssueType = DtbGenIssueType::where('id',$request->issueid)->first();

        $DtbGenIssueType->issue_type  = $request->get('issue_type');

        if ($request->get('color')=="") {
            $DtbGenIssueType->color  = $request->get('oldcolor');
        }else{
            $DtbGenIssueType->color  = $request->get('color');
        }

        $DtbGenIssueType->project_id  = $request->get('projectid');

        $DtbGenIssueType->save();
        DtbActivityLog::updateActivityLogPro('updated', 'issue type', $id);
        echo "Successfully Updated";
    }



    public function destroy(Request $request,$id)
    {
        DtbGenIssueType::find($request->id)->delete($request->id);
        // return response()->json([
        //     'success' => 'Record deleted successfully!'
        // ]);
        DtbActivityLog::updateActivityLogPro('deleted', 'issue type', $id);
        echo "Record has been deleted";
    }
}
