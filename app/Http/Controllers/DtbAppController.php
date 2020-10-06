<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbApp;
use App\DtbScreenGroup;
use App\DtbActivityLog;
use Storage;

class DtbAppController extends Controller
{


    public function index($id)
    {
        //session existance checking
        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Apps List'
        );



        $dtbapps = DtbApp::where('dtb_apps.project_id',$id)
        ->leftJoin('dtb_screen_groups', function($join) {
          $join->on('dtb_apps.screen_group_id', '=', 'dtb_screen_groups.id');
        })
        ->orderBy('dtb_apps.ordering','ASC')->get(['dtb_apps.id','dtb_apps.app_name','dtb_apps.app_short_name','dtb_apps.target_sdk','dtb_apps.deployment_target','dtb_apps.deploy_url','dtb_apps.ide_version','dtb_apps.company_name','dtb_apps.repo','dtb_apps.screen_group_id','dtb_apps.created_at','dtb_apps.is_archived','dtb_apps.ordering','dtb_screen_groups.screen_group_name']);
        return view('settings.generalSettings.appsettings.index',compact('dtbapps','id','common_array'));
    }






    public function create($id)
    {
       $common_array = array(
            'content_heading' => 'Add New App'
        );

       $loggedindeveloper = Session::get('developer_id');

       $screengrouplist = DtbScreenGroup::all()->where('developer_id',$loggedindeveloper)->where('project_id',$id);

       return view('settings.generalSettings.appsettings.create',compact('id','screengrouplist', 'common_array'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request,$id)
    {

        $data = request()->validate([
        'project_id'=>'required',
        'app_name'=> 'required',
        'app_short_name'=> '',
        'target_sdk'=> '',
        'repo'=> '',
        'deploy_url'=> '',
        'deployment_target'=> '',
        'company_name'=> '',
        'ide_version'=> '',
        'screen_group_id'=> '',
        'memo'=> '',
        ]);

        if ($data) {
            DtbApp::create($data);
            DtbActivityLog::updateActivityLogPro('added', 'app', $id);
            return redirect('project/'.$id.'/apps/create')->with('message', 'Data has been submitted!');
        }else{
            return redirect('project/'.$id.'/apps/create')->with('message', 'Something went wrong,try again please');
        }

       
    }



    public function show(Request $request, $id,$appid)
    {


        $common_array = array(
          'content_heading' => 'Apps'
        );

        //$appdata = DtbApp::where('id',$appid)->first();

        $appdata = DtbApp::where('dtb_apps.id',$appid)
        ->leftJoin('dtb_screen_groups', function($join) {
          $join->on('dtb_apps.screen_group_id', '=', 'dtb_screen_groups.id');
        })
        ->orderBy('dtb_apps.ordering','ASC')->first(['dtb_apps.id','dtb_apps.app_name','dtb_apps.app_short_name','dtb_apps.target_sdk','dtb_apps.deployment_target','dtb_apps.deploy_url','dtb_apps.ide_version','dtb_apps.memo','dtb_apps.company_name','dtb_apps.repo','dtb_apps.screen_group_id','dtb_apps.ordering','dtb_apps.created_at','dtb_screen_groups.screen_group_name']);


//if query result is empty
        if (empty($appdata)) {
            $common_array = array(
                'content_heading' => 'Apps List'
            );
            $dtbapps = DtbApp::where('dtb_apps.project_id',$id)
            ->leftJoin('dtb_screen_groups', function($join) {
              $join->on('dtb_apps.screen_group_id', '=', 'dtb_screen_groups.id');
            })
            ->orderBy('dtb_apps.ordering','ASC')->get(['dtb_apps.id','dtb_apps.app_name','dtb_apps.app_short_name','dtb_apps.target_sdk','dtb_apps.deployment_target','dtb_apps.deploy_url','dtb_apps.ide_version','dtb_apps.company_name','dtb_apps.repo','dtb_apps.screen_group_id','dtb_apps.created_at','dtb_apps.ordering','dtb_screen_groups.screen_group_name']);

               return view('settings.generalSettings.appsettings.index',compact('dtbapps','id','common_array'));
        }




            return view('settings.generalSettings.appsettings.show',compact('appdata','id','appid','common_array'));
    }



    public function edit($id,$appid)
    {


        $loggedindeveloper = Session::get('developer_id');
        $appdata = DtbApp::where('id',$appid)->first();

        $screengrouplist = DtbScreenGroup::all()->where('developer_id',$loggedindeveloper)->where('project_id',$id);


        $common_array = array(
            'content_heading' => 'Apps Edit'
        );


//if query result is empty
        if (empty($appdata)) {
            $common_array = array(
                'content_heading' => 'Apps List'
            );
            $dtbapps = DtbApp::where('dtb_apps.project_id',$id)
            ->leftJoin('dtb_screen_groups', function($join) {
              $join->on('dtb_apps.screen_group_id', '=', 'dtb_screen_groups.id');
            })
            ->orderBy('dtb_apps.ordering','ASC')->get(['dtb_apps.id','dtb_apps.app_name','dtb_apps.app_short_name','dtb_apps.target_sdk','dtb_apps.deployment_target','dtb_apps.deploy_url','dtb_apps.ide_version','dtb_apps.company_name','dtb_apps.repo','dtb_apps.screen_group_id','dtb_apps.ordering','dtb_apps.created_at','dtb_screen_groups.screen_group_name']);

               return view('settings.generalSettings.appsettings.index',compact('dtbapps','id','common_array'));
        }


        

        return view('settings.generalSettings.appsettings.edit',compact('appdata','id','screengrouplist','appid','common_array'));
    }



    public function update(Request $request, $id,$appid)
    {
          $data = request()->validate([
          'project_id'=>'required',
          'app_name'=> 'required',
          'app_short_name'=> '',
          'target_sdk'=> '',
          'repo'=> '',
          'deployment_target'=> '',
          'deploy_url'=> '',
          'company_name'=> '',
          'ide_version'=> '',
          'screen_group_id'=> '',
          'memo'=> '',
          'is_archive'=> '',
          ]);

          if (!empty($request->get('is_archive'))) {
            $archive = 1;
          }else{
            $archive = 0;
          }

          $singleapp = DtbApp::where('id',$appid)->first();

          $singleapp->project_id  = $request->get('project_id');
          $singleapp->app_name = $request->get('app_name');
          $singleapp->app_short_name = $request->get('app_short_name');
          $singleapp->target_sdk = $request->get('target_sdk');
          $singleapp->repo = $request->get('repo');
          $singleapp->deployment_target = $request->get('deployment_target');
          $singleapp->deploy_url = $request->get('deploy_url');
          $singleapp->company_name = $request->get('company_name');
          $singleapp->ide_version = $request->get('ide_version');
          $singleapp->screen_group_id = $request->get('screen_group_id');
          $singleapp->memo = $request->get('memo');
          $singleapp->is_archived = $archive;
          $singleapp->save();
          DtbActivityLog::updateActivityLogPro('updated', 'app', $id);


        $appdata = DtbApp::where('dtb_apps.id',$appid)
        ->leftJoin('dtb_screen_groups', function($join) {
          $join->on('dtb_apps.screen_group_id', '=', 'dtb_screen_groups.id');
        })
        ->orderBy('dtb_apps.ordering','ASC')->first(['dtb_apps.id','dtb_apps.app_name','dtb_apps.app_short_name','dtb_apps.target_sdk','dtb_apps.deployment_target','dtb_apps.deploy_url','dtb_apps.ide_version','dtb_apps.company_name','dtb_apps.memo','dtb_apps.repo','dtb_apps.screen_group_id','dtb_apps.ordering','dtb_apps.created_at','dtb_screen_groups.screen_group_name']);

        //  return redirect('project/'.$id.'/apps/'.$appid.'/edit')->with('message', 'Data has been updated!');
        return view('settings.generalSettings.appsettings.show',compact('appdata','id','appid'))->with('message', 'Data has been updated!');
        //return redirect('settings.generalSettings.appsettings.edit',compact('appdata'))->with('message', 'Data has been updated!');

    }






    public function updateMemo(Request $request, $appid)
    {
      
        //         $data = request()->validate([
        //             'project_id'=>'required',
        //             'app_name'=> 'required',
        //             'app_short_name'=> '',
        //             'target_sdk'=> '',
        //             'repo'=> '',
        //             'deployment_target'=> '',
        //             'deploy_url'=> '',
        //             'company_name'=> '',
        //             'ide_version'=> '',
        //             'memo'=> '',
        //         ]);
        //         return 'OK';
        $appdata = DtbApp::where('id',$appid)->first();
        $appdata->memo = $request->get('memo');
        $appdata->save();
        //DtbActivityLog::updateActivityLogPro('updated', 'app', $id);
        return "Successfully Updated";
        
    }

    public function destroy(Request $request,$id)
    {
        DtbApp::find($request->appid)->delete($request->appid);
        DtbActivityLog::updateActivityLogPro('deleted', 'app', $id);

      echo "Record has been deleted";
    }




    public function updateOrder(Request $request){

     $appall = DtbApp::all();

        foreach ($appall as $appdata) {

            $appdata->timestamps = false; // To disable update_at field updation
            $id = $appdata->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $appdata->update(['ordering' => $order['position']]);
                }
            }

        }

         return response('Update Successfully.', 200);

    }




    // tui editor content drag and drop or select file upload
    public function editorfiles(Request $request){

        $cloud_front_path = "";
        $userImageFile = "";

        $image = $request->file('file');

        //$imageName = time().$image->getClientOriginalName();
        //$upload_success = $image->move(public_path('uploads/appfiles'),$imageName);

        $cloud_front_path ='https://'.env('AWS_URL') . '/';
        $userImageFile = Storage::disk('s3')->put('appfiles', $request->file('file'));

        if ($userImageFile) {
            echo $cloud_front_path.$userImageFile;
           // echo $host = request()->getHost();
        }else{
            echo "File not uploaded,please try again";
        }

    }



}
