<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\DtbUser;
use App\DtbProject;
use App\DtbUsersProject;
use App\DtbHome;
use App\DtbIssue;
use App\DtbActivityLog;
use App\DtbDevelopGroup;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware(['CheckAuthenticateUserMiddleware'])->except('basicSett');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        $user_id = Session::get('user_id');
        //$developer_id = Session::get('developer_id');
        $usersData = DtbUser::find($user_id);
        Session::put('users_name', $usersData->name);
        Session::put('users_image', $usersData->icon_image_path);
        
//         if(Session::has('role')){
//             if(Session::get('role') == '0'){
//                 $projects = DtbProject::query()
//                 ->where('dtb_projects.developer_id', $developer_id)
//                 ->take(4)
//                 ->get([ 'dtb_projects.*' ]);
//                 $issues = DtbIssue::allIssues();
                
//             }
//             else{
//                 $projects = DtbUsersProject::query()
//                 ->from('dtb_users_projects as up')
//                 ->leftjoin('dtb_projects as p','up.project_id', '=', 'p.id')
//                 ->where('up.user_id', $user_id)
//                 ->take(4)
//                 ->get([ 'p.*' ]);
//                 $issues = DtbIssue::allIssues();
//             }
//         }

        //ˆ—‚ð“Z‚ß‚é
        //$projects = DtbProject::getProjects();
        //$issues = DtbIssue::allIssues();

        // $activity_logs_dates = DtbActivityLog::
        // select(DB::raw('DATE(created_at) as date'))
        // ->where('developer_id', $developer_id)
        // ->orderBy('created_at', 'desc')
        // ->groupBy('date')
        // ->take(3)
        // ->get();

        //$dtbdevelopgroup = DtbDevelopGroup::where('id',$developer_id)->firstOrFail();
         //return view('dashboard_main');
         return view('dashboard');

    }

   // home of project settings
    public function home()
    {
        //return view('dashboard');
    }   

     public function settings(Request $request)
    {
        return view('dashboard');
    }

    public function test(){
        echo "hello world";
    }

    public function forms()
    {
        return view('admin.forms');
    }

    public function basicSett(){
        return view('settings.basicSett');
    }
}
