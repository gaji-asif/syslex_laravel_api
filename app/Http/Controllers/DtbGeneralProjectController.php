<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbProject;
use App\DtbActivityLog;

class DtbGeneralProjectController extends Controller
{


    public function index()
    {
        $DtbProject = DtbProject::find($id);
        if (empty($DtbProject)) {
           return redirect('project');
        }
    }


    public function settings(Request $request,$id)
    {
        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Project Name'
        );

        $DtbProject = DtbProject::find($id);
        
        if (empty($DtbProject)) {
           return redirect('projects');
        }

        
        //project general settings home
        return view('dashboard',compact('id','DtbProject', 'common_array'));
    }



    public function updateprojectinfo(Request $request,$id)
    {

        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $data = request()->validate([
            'project_name'=>'required',
            'project_key'=>'required',
            'project_detail'=>'',
            'is_archive'=>'',
        ]);


          if (!empty($request->get('is_archive'))) {
            $archive = 1;
          }else{
            $archive = 0;
          }


        $DtbProject = DtbProject::where('id',$id)->first();
        $DtbProject->project_name  = $request->get('project_name');
        $DtbProject->project_key  = $request->get('project_key');
        $DtbProject->project_detail  = $request->get('project_detail');
        $DtbProject->is_archived  = $archive;
        $DtbProject->save();
        DtbActivityLog::updateActivityLog('updated', 'project info');
        //return view('dashboard',compact('id','DtbProject'))->with('message', 'Information has been updated');
        return redirect()->route('project.settings',$id)->with('message', 'Information has been updated',['id' => $id,'DtbProject' => $DtbProject]);

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        // //session existance checking
        // if (!Session()->has('user_id')) {
        //     return redirect('login');
        // }
        
        // return view('settings.developerSettings.projects.show',compact('id'));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

     public function destroy(Request $request,$id)
    {
        DtbProject::find($request->projectid)->delete($request->projectid);
        DtbActivityLog::updateActivityLog('deleted', 'project');

      echo "Record has been deleted";
    }

}
