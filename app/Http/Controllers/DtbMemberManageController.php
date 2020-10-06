<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbUserInfo;
use App\DtbUser;
use App\DtbActivityLog;

class DtbMemberManageController extends Controller
{


    public function index()
    {

        $common_array = array(
            'content_heading' => 'Manage Members'
        );

       return view('settings/developerSettings/managemember/index',compact('common_array'));
    }

 
    public function create()
    {
        
    }


    public function store(Request $request)
    {


        $data = request()->validate([
            'user_id'=>'required',
            'sallary_month'=>'required',
            'sallary_per_hour'=>'required',
            'memo'=>'',
        ]);

        DtbUserInfo::create($data);
        DtbActivityLog::updateActivityLog('added', 'user info');
        //return redirect('settings/developerSettings/managemember/create')->with('status', 'Data has been added!');
        return back()->with('message', 'Data has been added!');
        // return back()->withInput();
    }



    public function show($memberid)
    {

        $common_array = array(
            'content_heading' => 'Manage Members'
        );
        
       return view('settings/developerSettings/managemember/show',compact('memberid','common_array'));
    }


    public function edit(Request $request,$id)
    {
        
    }


    public function update(Request $request, $id)
    {

        $data = request()->validate([
            'sallary_month'=>'required',
            'sallary_per_hour'=>'required',
            'memo'=>'',
        ]);

        $userxtrainfo = DtbUserInfo::where('user_id',$request->get('user_id'))->first();
        $userxtrainfo->sallary_month = $request->get('sallary_month');
        $userxtrainfo->sallary_per_hour = $request->get('sallary_per_hour');
        $userxtrainfo->memo = $request->get('memo');
        $userxtrainfo->save();
        //DtbActivityLog::updateActivityLogPro('updated', 'app', $id);
        return back()->with('message', 'Data has been Updated!');
    }


    public function destroy($id)
    {
        
    }



    public function adduserskill(Request $request){
        $data = request()->validate([
            'user_id2'=>'',
            'name'=>'',
            'technical'=>'',
            'sence'=>'',
            'comprehend'=>'',
            'communication'=>'',
            'quality'=>'',
            'total'=>'',
            'comment'=>'',
        ]);
        DtbUserSkill::create($data);
    }



    public function archiveuser(Request $request){
        $userid = $request->get('memberid');
        if (isset($userid)) {
            $dtbusers = DtbUser::where('id',$userid)->where('is_archived',0)->first();
            $dtbusers->is_archived = 1;
            $dtbusers->save();
            echo "The member have been archived";
        }else{
            echo "something went wrong";
        }
    }


    public function unarchiveuser(Request $request){
        $userid = $request->get('memberid');
        if (isset($userid)) {
            $dtbusers = DtbUser::where('id',$userid)->where('is_archived',1)->first();
            $dtbusers->is_archived = 0;
            $dtbusers->save();
            echo "The member have been unarchived";
        }else{
            echo "something went wrong";
        }
    }








}
