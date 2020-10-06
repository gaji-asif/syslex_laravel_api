<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbIssueCategory;
use App\DtbActivityLog;
use App\DtbProject;

class DtbIssueCategoryController extends Controller
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
        $dtbissuecategory = DtbIssueCategory::where('project_id',$id)->orderBy('ordering','ASC')->get();
        return view('settings.generalSettings.categoriesSettings.index',compact('dtbissuecategory','id', 'common_array'));


    }



    public function updateOrder(Request $request){

     $issuecategoris = DtbIssueCategory::all();

        foreach ($issuecategoris as $issuecat) {

            $issuecat->timestamps = false; // To disable update_at field updation
            $id = $issuecat->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $issuecat->update(['ordering' => $order['position']]);
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
            'category_name'=>'required',
            'points'=>'',
            'details'=>'',
            'project_id'=>'',
        ]);

        DtbIssueCategory::create($data);
        DtbActivityLog::updateActivityLogPro('added', 'category', $id);
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
            'category_name'=>'required',
            'points'=>'',
            'details'=>'',
            'project_id'=>'',
        ]);


        //$DtbGenIssueType = DtbGenIssueType::find($request->issueid);
        $DtbIssueCats = DtbIssueCategory::where('id',$request->issueid)->first();

        $DtbIssueCats->category_name  = $request->get('category_name');
        $DtbIssueCats->points  = $request->get('points');
        $DtbIssueCats->details  = $request->get('details');

        $DtbIssueCats->project_id  = $request->get('projectid');

        $DtbIssueCats->save();
        DtbActivityLog::updateActivityLogPro('updated', 'category', $id);
        echo "Successfully Updated";
    }




    public function destroy(Request $request,$id)
    {
        DtbIssueCategory::find($request->id)->delete($request->id);
        // return response()->json([
        //     'success' => 'Record deleted successfully!'
        // ]);
        DtbActivityLog::updateActivityLogPro('deleted', 'category', $id);
        echo "Record has been deleted";
    }






}
