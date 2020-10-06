<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MtbRole;
use App\MtbLanguage;
use App\MtbTimezone;
use Session;
use App\DtbDevelopTeam;
use App\DtbProject;
use App\DtbUser;
use App\FitnessMemberPackage;
use App\DtbDevelopTeamUser;
use App\DtbUsersProject;
use App\Mail\SendMailable;
use DB;
use App\DtbActivityLog;
// use App\Http\Requests\StoreImage;
use Illuminate\Support\Facades\Storage;


class DtbUserController extends Controller
{
    
    // private $image;
    // public function __construct(Image $image)
    // {
    //     $this->image = $image;
    // }

    /**
     * Display a listing of the resource
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
        
        //$developer_id = Session::get('developer_id');
        $roles = MtbRole::all();
        //$teams = DtbDevelopTeam::where('developer_id', $developer_id)->get();
        $allUsers = DB::select(DB::raw("SELECT u.*, r.role_name, m.package_name
            FROM dtb_users u 
            LEFT JOIN mtb_roles r ON u.role = r.id
            LEFT JOIN fitness_member_packages m ON u.plan_type = m.id
            WHERE u.verified = 1
            GROUP BY u.email"));
        return view('users.index', compact('roles', 'allUsers', 'common_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        $common_array = array(
            'content_heading' => 'All Settings'
        );
        //$developer_id = Session::get('developer_id');
        $roles = MtbRole::all();
        $plans = FitnessMemberPackage::all();
        //$languages = MtbLanguage::all();
        //$timezones = MtbTimezone::all();
        //$developer_teams = DtbDevelopTeam::where('developer_id', $developer_id)->get();
        //$projects = DtbProject::where('developer_id', $developer_id)->get();
        return view('users.add', compact('roles','plans', 'common_array'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'ud_id'=>'required',
            'name'=> 'required',
            'email'=> 'required',
            'role'=> 'required'
        ]);
        $user = DtbUser::addUser($request);
        if($user){
            \Mail::to($user->email)->send(new SendMailable($user));
            DtbActivityLog::updateActivityLog('added', 'a new user');
        }
        return redirect('/settings-users/create')->with('message-success', "New User Added Successfully.");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $editData = DtbUser::find($id);
        $userTeam = DtbDevelopTeamUser::select('team_id')->where('user_id', $id)->first();
        $userProjects = DtbUsersProject::select('project_id')->where('user_id', $id)->get();
        $developer_id = Session::get('developer_id');
        $roles = MtbRole::all();
        $languages = MtbLanguage::all();
        $timezones = MtbTimezone::all();
        $developer_teams = DtbDevelopTeam::where('developer_id', $developer_id)->get();
        $projects = DtbProject::where('developer_id', $developer_id)->get();
        return view('settings.users.edit', compact('editData', 'userTeam','userProjects', 'roles', 'timezones', 'languages', 'developer_teams', 'projects', 'common_array'));
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
       $request->validate([
        'ud_id'=>'required',
        'name'=> 'required',
        'email'=> 'required',
        'role'=> 'required'
    ]);
       $user = DtbUser::updateUser($request, $id);
       if($user){
           DtbActivityLog::updateActivityLog('updated', 'user info');
       }
       return redirect('/settings-users')->with('message-success', "User Data updated Successfully.");
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = DtbUser::find($id);
        $user->verified = 0;
        $result = $user->update();
        DtbActivityLog::updateActivityLog('deleted', 'a user');
        if($result) {
            return redirect()->route('settings-users.index')->with('message-success', 'User has been removed Successfully.');
            } else {
            return redirect('add-member')->with('message-danger', 'Something went wrong');
        }
    }

    public function user_edit(){
        return view('settings.users.edit');
    }
    public function user_view(){
        return view('settings.users.view');
    }
    public function emailCheck(Request $request){
        $emails = DtbUser::where('email', $_POST['email'])->first();
        if(!empty($emails)){
            echo "Y";
        }
    }

    public function searchUsers(Request $request){
       
       $developer_id = Session::get('developer_id');
       $query = '';
       if(isset($request->role)){
          $query .= "AND u.role = '$request->role'";
       }
       if(isset($request->team_id)){
          $query .= "AND t.team_id = '$request->team_id'";
       }
     
       $allUsers = DB::select(DB::raw("SELECT u.*, r.role_name, l.name language_name, tz.name timezone_name 
            FROM dtb_users u 
            LEFT JOIN dtb_develop_team_users t ON u.id= t.user_id
            LEFT JOIN mtb_roles r ON u.role = r.id
            LEFT JOIN mtb_languages l ON u.language_id = l.id
            LEFT JOIN mtb_timezones tz ON u.timezone_id = tz.id
            WHERE u.verified = 1 AND u.developer_id = $developer_id $query GROUP BY u.email"));
       
       return view('settings.users.allUsers', compact('allUsers'));
    }

    public function deleteUserView($user_id){
        return view('settings/users/deleteUser', compact('user_id'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLastAccessUrl(Request $request)
    {
//         return "User's Last access URL updated Successfully.";
        $request->validate([
            'id'=>'required',
        ]);
        $user = DtbUser::updateUserLastAccessUrl($request);
        return "User's Last access URL updated Successfully.";
    }
    
}
