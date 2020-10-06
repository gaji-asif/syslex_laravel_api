<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbDevelopTeam;
use App\DtbDevelopTeamUser;
use DB;
use App\DtbUser;
use App\DtbActivityLog;

class DtbTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        $common_array = array(
            'content_heading' => 'All Settings'
        );

        $developer_id = Session::get('developer_id');
        $teams = DB::select(DB::raw("SELECT t.*,(SELECT COUNT(user_id) FROM dtb_develop_team_users WHERE team_id = t.id) total_members
            FROM `dtb_develop_teams` t 
            WHERE t.developer_id = $developer_id"));
        return view('settings/teams/index', compact('teams', 'common_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $common_array = array(
            'content_heading' => 'All Settings'
        );

       $allTeams = DtbDevelopTeamUser::query()
                ->from('dtb_develop_team_users as tu')
                ->leftjoin('dtb_develop_teams as t','tu.team_id', '=', 't.id')
                ->leftjoin('dtb_users as u','tu.user_id', '=', 'u.id')
                ->where('t.developer_id', Session::get('developer_id'))
                ->get([ 'tu.*', 'u.name', 'u.ud_id', 'u.email', 't.team_name', 'u.icon_image_path']);
        return view('settings/teams/create', compact('allTeams', 'common_array'));
    }

    //  public function team2()
    // {
    //     return view('settings/teams/index2');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'team_name'=>'required'
        ]);

        $results = DtbDevelopTeam::addTeam($request);
        DtbActivityLog::updateActivityLog('added', 'a new team');
        if($results) {
            return redirect('settings-teams')->with('message-success', 'New Team has been added');
        } else {
            return redirect('settings-teams')->with('message-danger', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $team_id)
    {
         return view('settings/teams/deleteTeamUsers', compact('id'));
    }

    public function deleteView($user_id, $team_id){
        return view('settings/teams/deleteTeamUsers', compact('user_id', 'team_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $common_array = array(
            'content_heading' => 'All Settings'
        );
        $developer_id = Session::get('developer_id');
        $editData = DtbDevelopTeam::find($id);
        // $allTeams = DtbDevelopTeamUser::query()
        //         ->from('dtb_develop_team_users as tu')
        //         ->leftjoin('dtb_develop_teams as t','tu.team_id', '=', 't.id')
        //         ->leftjoin('dtb_users as u','tu.user_id', '=', 'u.id')
        //         ->where('t.developer_id', Session::get('developer_id'))
        //         ->get([ 'tu.*', 'u.name', 'u.ud_id', 'u.email', 't.team_name', 'u.icon_image_path']);
        $teams = DB::select(DB::raw("SELECT t.*,(SELECT COUNT(user_id) FROM dtb_develop_team_users WHERE team_id = t.id) total_members
            FROM `dtb_develop_teams` t 
            WHERE t.developer_id = $developer_id"));
        return view('settings/teams/index', compact('editData', 'teams', 'common_array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'team_name'=>'required'
        ]);

        $results = DtbDevelopTeam::updateTeam($request, $id);
        DtbActivityLog::updateActivityLog('updated', 'team name');
        if($results) {
            return redirect('settings-teams')->with('message-success', 'Team has been updated');
        } else {
            return redirect('settings-teams')->with('message-danger', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $team_id = $request->team_id;
        $team_details = DtbDevelopTeam::find($team_id);
        $result = DtbDevelopTeamUser::where('user_id', $id)->delete();
        DtbActivityLog::updateActivityLog('deleted', 'a member from  team');
        if($result) {
            return redirect()->route('add-member', compact('team_details'))->with('message-success', 'User has been removed Successfully from team.');
            } else {
            return redirect('add-member')->with('message-danger', 'Something went wrong');
        }
    }

    public function addMember($team_id){
        $common_array = array(
            'content_heading' => 'All Settings'
        );

        $team_details = DtbDevelopTeam::find($team_id);
        $users = DtbUser::where('developer_id', Session::get('developer_id'))->get();
        $allTeamsMembers = DtbDevelopTeamUser::query()
                ->from('dtb_develop_team_users as tu')
                ->leftjoin('dtb_develop_teams as t','tu.team_id', '=', 't.id')
                ->leftjoin('dtb_users as u','tu.user_id', '=', 'u.id')
                ->leftjoin('mtb_roles as r','u.role', '=', 'r.id')
                ->where('t.developer_id', Session::get('developer_id'))
                ->where('tu.team_id', $team_id)
                ->get([ 'tu.*', 'u.name', 'u.ud_id', 'u.email', 't.team_name', 'u.icon_image_path', 'r.role_name']);
        return view('settings/teams/create', compact('team_id', 'team_details', 'users', 'allTeamsMembers', 'common_array'));
    }

    public function assignUserTeam(Request $request){
        request()->validate([
            'users'=>'required'
        ]);
        $common_array = array(
            'content_heading' => 'All Settings'
        );
       if(!empty($request->users)){
                for($x=0; $x<count($request->users); $x++){
                    $data = new DtbDevelopTeamUser;
                    $data->user_id = $request->users[$x];
                    $data->team_id = $request->team_id;
                    $checkExists = DtbDevelopTeamUser::where('user_id', $request->users[$x])->where('team_id', $request->team_id)->first();
                    if(empty($checkExists)){
                        $results = $data->save();
                    }
                }
                $team_details = DtbDevelopTeam::find($request->team_id);
                DtbActivityLog::updateActivityLog('added', 'a new member in team');
                return redirect()->route('add-member', compact('team_details', 'common_array'))->with('message-success', 'User has been added Successfully from this team.');
        }
    }

    public function deleteTeamView($team_id){
        return view('settings/teams/deleteTeam', compact('team_id'));
    }

    public function deleteTeam($team_id){
         DtbDevelopTeam::where('id', $team_id)->delete();
        $result = DtbDevelopTeamUser::where('team_id', $team_id)->delete();
        DtbActivityLog::updateActivityLog('deleted', 'a team');
        if($result) {
            return redirect('/settings-teams')->with('message-success', 'Team has been removed Successfully.');
            } else {
            return redirect('/settings-teams')->with('message-danger', 'Something went wrong');
        }
    }
    
}
