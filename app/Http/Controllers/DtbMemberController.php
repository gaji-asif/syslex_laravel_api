<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbUser;
use App\DtbUsersProject;
use App\DtbIssuePriority;
use App\DtbDevelopTeamUser;
use App\DtbDevelopTeam;
use DB;
use toSql;
use App\DtbActivityLog;
use App\DtbProject;


class DtbMemberController extends Controller
{


    public function index(Request $request,$id)
    {
        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Project Settings'
        );

        $DtbProject = DtbProject::find($id);
            if (empty($DtbProject)) {
               return redirect('projects');
            }




        $loggedindeveloper = Session::get('developer_id');
        $dtbusers = DtbUser::where('developer_id',$loggedindeveloper)->get();
        $DtbUsersProjects = DtbUsersProject::where('project_id',$id)->get();
        $dtbteamsusers = DtbDevelopTeamUser::all();
        $userproject = DtbUsersProject::all();



        $data = DB::table('dtb_develop_teams')
       ->join('dtb_develop_team_users', 'dtb_develop_team_users.team_id', '=', 'dtb_develop_teams.id')
       ->select('dtb_develop_teams.*','dtb_develop_team_users.*')
       ->where('dtb_develop_teams.developer_id','=',$loggedindeveloper)
       ->get();



        return view('settings.generalSettings.membersettings.index',compact('dtbusers','DtbUsersProjects','dtbteamsusers','userproject','id','loggedindeveloper', 'common_array'));

    }





    public function getdata($id){

       return $data = DB::table('dtb_users_projects')
       ->join('dtb_users', 'dtb_users.id', '=', 'dtb_users_projects.user_id')
       ->select('dtb_users.name','dtb_users.email', 'dtb_users.role','dtb_users.created_at','dtb_users.is_archived', 'dtb_users_projects.id')
       ->where('dtb_users_projects.project_id','=',$id)
       //->where('dtb_users.is_archived','=',0)
       ->get();


       // return $data = DB::table('dtb_develop_teams')
       // ->join('dtb_develop_team_users', 'dtb_develop_team_users.team_id', '=', 'dtb_develop_teams.id')
       // ->join('dtb_users', 'dtb_users.id', '=', 'dtb_develop_team_users.user_id')
       // ->select('dtb_develop_teams.*','dtb_develop_team_users.*','dtb_users.id','dtb_users.name')
       // ->where('dtb_develop_teams.developer_id','=',$loggedindeveloper)
       // ->get();

    }   




     public function getteam($project_id){

        $loggedindeveloper = Session::get('developer_id');

       // $id = "";
        // return $data = DB::table("dtb_develop_team_users")->select('*')
        // ->join('dtb_develop_teams', 'dtb_develop_teams.id', '=', 'dtb_develop_team_users.team_id')
        // ->select('dtb_develop_team_users.*','dtb_develop_teams.*')
        // ->whereNOTIn('user_id',function($query){
        //      $query->select('user_id')->from('dtb_users_projects');
        // })->get();

        //$projectuser = DB::table('dtb_users_projects')->select('user_id as projectuser')->where('project_id','=',$id)->get();
       return $data = DB::table('dtb_develop_team_users')
                              ->join('dtb_develop_teams', 'dtb_develop_teams.id', '=', 'dtb_develop_team_users.team_id')
                              ->leftjoin('dtb_users','dtb_develop_team_users.user_id', '=', 'dtb_users.id')
                              ->where('dtb_develop_teams.developer_id',$loggedindeveloper)
                              ->where('dtb_users.is_archived',0)
                                ->select('dtb_develop_team_users.user_id',DB::raw('count(*) as total'), 'dtb_develop_team_users.team_id','dtb_develop_teams.id as teamtblid','dtb_develop_teams.team_name')
                                ->groupBy('dtb_develop_team_users.team_id')
                                ->whereNOTIn('user_id',function($query) use ($project_id){
                                          $query->select('user_id')->from('dtb_users_projects')
                                          ->where('project_id',$project_id);
                                        })->get();
                              


    }






    public function getdevslist($project_id){
        //return $data = DtbUsersProject::all();
        $loggedindeveloper = Session::get('developer_id');
        //return $dtbusers = DtbUser::where('developer_id',$loggedindeveloper)->get();
       //echo json_encode(array('show'=>$data));

        return $dtbusers = DB::table("dtb_users")->select('*')
                ->where('developer_id',$loggedindeveloper)
                ->where('is_archived',0)
                ->whereNOTIn('id',function($query) use ($project_id){
                     $query->select('user_id')->from('dtb_users_projects')->where('project_id',$project_id);
                })->get();

    }


    public function create()
    {
        
    }



    public function store(Request $request,$id)
    {
        // $request->validate([
        //     'projectdevs'=>'required',
        // ]);

        foreach ($request->selectedmember as $selectmember) {
            DtbUsersProject::create(['user_id' => $selectmember,'project_id' => $id]);
        }
         DtbActivityLog::updateActivityLogPro('added', 'member', $id);
        //echo "data submitted";

    }



    public function teamsuserstore(Request $request,$id)
    {


        $userofteam = DB::table("dtb_develop_team_users")
                          ->leftjoin('dtb_users','dtb_develop_team_users.user_id', '=', 'dtb_users.id')
                          ->select('user_id','is_archived')
                          ->where('team_id',$request->selectedteam)
                          ->where('is_archived',0)
                          ->whereNOTIn('user_id',function($query) use ($id){
                                    $query->select('user_id')->from('dtb_users_projects')->where('project_id',$id);
                                  })
                          ->get();

        foreach ($userofteam as $userofteamdev)
        {
            $projectid = $request->projectid;
            DtbUsersProject::create(['user_id' => $userofteamdev->user_id,'project_id' => $projectid]);
        }             
         DtbActivityLog::updateActivityLogPro('added', 'member team', $id);


    }




    public function show($id)
    {
        
    }

  

    public function edit($id)
    {
        
    }



    public function update(Request $request, $id)
    {
        
    }




    public function destroy(Request $request, $id)
    {

        DtbUsersProject::find($request->memberlsitid)->delete($request->memberlsitid);
        // return response()->json([
        //     'success' => 'Record deleted successfully!'
        // ]);
         DtbActivityLog::updateActivityLogPro('deleted', 'member', $id);
        echo "Record has been deleted";

    }




}
