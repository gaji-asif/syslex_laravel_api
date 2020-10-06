<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DtbProject;
use DB;
use Session;
use App\DtbActivityLog;
use App\DtbIssue;
use App\DtbUsersProject;
use App\DtbGenIssueType;
use App\DtbUser;
use App\DtbDevelopGroup;
use App\DtbApps;
use App\DtbIssueCategory;
use App\DtbVersion;
use App\DtbIssueStatus;
use App\DtbIssuePriority;
use URL;

class DtbProjectsController extends Controller
{
  
    protected $posts_per_page = 1;

    public function index()
    {    
        
        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'All Settings'
        );
        
        $loggedindeveloper = Session::get('developer_id');
        // $projectlist = DtbProject::loggeduserproject($loggedindeveloper)->get();
        $projectlist = DtbProject::loggeduserproject($loggedindeveloper);
        return view('settings.developerSettings.projects.index',compact('projectlist', 'common_array'));
    }



    public function create()
    {
         if (!Session()->has('user_id')) {
            return redirect('login');
         }

         $common_array = array(
            'content_heading' => 'All Settings'
         );
         return view('settings.developerSettings.projects.create', compact('common_array'));
    }


    public function store(Request $request)
    {

        $data = request()->validate([
            'project_name'=>'required',
            'project_key'=> 'required',
            'project_detail'=> 'required',
            'developer_id'=> 'required',
        ]);

        if ($data) {
            DtbProject::create($data);
            DtbActivityLog::updateActivityLog('added', 'a new project');
            return redirect('projects/create')->with('status', 'Data has been submitted!');
        }else{
            return redirect('projects/create')->with('status', 'Something went wrong,try again please');
        }

       
    }


    public function show(Request $request,$id)
    {

        $common_array = array(
            'content_heading' => 'Projects/Project Detail'
        );

        $projectinfo = DB::table('dtb_projects')
            ->join('dtb_develop_groups', 'dtb_projects.developer_id', '=', 'dtb_develop_groups.id')
            ->join('dtb_users', 'dtb_projects.developer_id', '=', 'dtb_users.developer_id')
            ->select('dtb_projects.*', 'dtb_develop_groups.*','dtb_users.name','dtb_users.icon_image_path')
            ->where('dtb_projects.id','=',$id)
            ->first();


        $activity_logs_dates = DtbActivityLog::
        select(DB::raw('DATE(created_at) as date'))
        ->where('project_id', $id)
        ->orderBy('created_at', 'desc')
        ->groupBy('created_at')
        ->paginate($this->posts_per_page);


        // to load activity log project wise when scrolling
        $projectlog =  DB::table('dtb_activity_logs')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
        ->where('project_id', $id)
        ->orderBy('date', 'desc')
        ->groupBy('date')
        ->get()
        ->paginate(1);

        $html='';
        // $html.='<div class="card px-2 py-2 mb-1"> Activities </div>';
        foreach ($projectlog as $prolog) {
            $html.='<div class="card px-3 pb-3 mb-3 no_border">';
            $html.='<div class="logodate">'.$prolog->date.'</div class="logodate">';
            $activitylogdetail = DtbActivityLog::where('project_id', $id)->whereDate('created_at', $prolog->date)->orderBy('created_at', 'desc')->get();

            foreach($activitylogdetail as $activitydtail){
                $html.='<div class="projectlogholder">';
                $html.='<br>';
                $html.='<li><img src="//'.$activitydtail->icon_image_path.'" alt="" class="d-block ui-w-40 rounded-circle"> <a href="#">'.$activitydtail->user_name.'</a>  <span class="text-muted">'.$activitydtail->action .'</span>  <a href="#">'.$activitydtail->function_name.'</a></li>';

                $logtime = DtbActivityLog::activityTime($activitydtail->created_at);
                $html.='<li class="logtime"><span class="text-muted">'.$logtime .'</span></li>';
                $html.='</div>';
            }
            $html.='</div>';
        }
        if ($request->ajax()) {
            return $html;
        }


        return view('settings.developerSettings.projects.show',compact('id','projectinfo','activity_logs_dates','projectlog', 'common_array'));

    }




    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {

      $request->validate([
            'project_name'=> 'required',
            'project_key'=> 'required',
            'project_detail'=> 'required'
            
        ]);

      $dtbproject = DtbProject::find($id);
      $dtbproject->project_name = $request->get('project_name');
      $dtbproject->project_key = $request->get('project_key');
      $dtbproject->project_detail = $request->get('project_detail');
      $dtbproject->save();
      DtbActivityLog::updateActivityLog('updated', 'project');
      //$dtbproject->saveOrFail(); // same as save(), but uses transaction
      echo "data has been updated";
      //return redirect('/projects')->with('success', 'data successfully update');
    }


    public function destroy(Request $request, $id)
    {
        $dtbproject = DtbProject::find($id);
        $dtbproject->delete();
        DtbActivityLog::updateActivityLog('deleted', 'project');
        echo "Data has been deleted";
    }


    public function deleteparticipant(Request $request, $id)
    {

        ///DtbUsersProject::find($request->memberlsitid)->delete($request->memberlsitid);
        DB::delete('delete from dtb_users_projects where id = ?',[$request->memberlsitid]);
    }


    public function manageproject()
    {
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Manage Projects'
        );

        ///DtbUsersProject::find($request->memberlsitid)->delete($request->memberlsitid);
        //DB::delete('delete from dtb_users_projects where id = ?',[$request->memberlsitid]);

        // $totalOpen = DB::table('dtb_apps')->where('project_id', '=', '1')->count();

        $loggedindeveloper = Session::get('developer_id');
        // echo $projectsid = \DB::table('dtb_projects')
        //     ->select('id')
        //     ->where('developer_id', '=', $loggedindeveloper)
        //     ->get()->toArray();

       $allprojectofdev = DtbProject::where('developer_id', '=', $loggedindeveloper)
       ->where('is_archived', '=', 0)
       ->orderBy('ordering','ASC')
       ->get();

       $projectsid = DtbProject::where('developer_id', '=', $loggedindeveloper)->get()->toArray();

            foreach ($projectsid as $proid) {
               $applist = \DB::table('dtb_apps')
                ->select('id','project_id','app_name')
                ->where('project_id', '=', $proid)
                ->get();
            }

            // $projectIssueList = DtbProject::query()
            // ->from('dtb_projects as pr')
            // ->leftjoin('dtb_issues as i','i.project_id', '=', 'pr.id')
            // ->join('dtb_issue_statuses as prs','prs.id','=','i.status')
            // ->leftjoin('dtb_apps as a','i.app_id', '=', 'a.id')
            // ->leftjoin('dtb_issue_statuses as s','i.status', '=', 's.id')
            // ->leftjoin('dtb_users as u','i.user_id', '=', 'u.id')
            // ->leftjoin('dtb_users as uu','i.author_user_id', '=', 'uu.id')
            // ->where('pr.developer_id', $loggedindeveloper)
            // ->where('i.is_closed', 0)
            // ->where('prs.is_complete', '!=','1')
            // ->orderBy('a.app_name','DESC')
            // ->orderBy('i.deadline','DESC')
            // ->get([ 'i.id as issue_id', 'i.app_id','i.project_id','i.status','i.is_closed','pr.project_name', 'a.app_name', 'a.memo','a.updated_at as appupdatedate','i.issue_title', 's.status_name', 's.color', 'i.progress', 
            //     'i.estimate_hour1', 'i.estimate_hour2', 'i.updated_at','i.start_date','i.deadline','u.name as assignee', 
            //     'uu.name as issue_creator_author','status']);
            
            
            
            return view('settings.developerSettings.projects.manageproject.manageproject',compact('projectsid','common_array','allprojectofdev'));

    }


//ordering functionality
    public function updateOrder(Request $request){

     $projectall = DtbProject::all();

        foreach ($projectall as $projectlist) {

            $projectlist->timestamps = false; // To disable update_at field updation
            $id = $projectlist->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $projectlist->update(['ordering' => $order['position']]);
                }
            }

        }

         return response('Update Successfully.', 200);

    }

public function chnageAtOnceMngPro(Request $request){
        $data = json_decode($request->getContent());
        if(end($data)){
            $project_id = end($data);
        }
        Session::put('issues_data_pro', $data);
        Session::put('mng_project_id', $project_id);
        Session::save();
        return redirect()->route('chnageAtOnceViewMngPro');
}

public function chnageAtOnceViewMngPro(){
        
       $project_id = Session::get('mng_project_id');
       $id = $project_id;
       $issueTypes = DtbGenIssueType::getProjectIssueType($project_id);

       $loggedindeveloper = Session::get('developer_id');
       $userlists = DtbUser::select('id','developer_id','name','english_name')->get();
       $developgroups = DtbDevelopGroup::select('id','company_name')->get();
       $apps = DtbApps::getProjectApps($project_id);
       $users = \DB::table('dtb_users')
        ->join('dtb_users_projects','dtb_users.id','=','dtb_users_projects.user_id')
        ->where('dtb_users_projects.project_id', $project_id)
        ->get();
       $categories = DtbIssueCategory::where('project_id',$project_id)->get();
       $versions = DtbVersion::where('project_id',$project_id)->get();
       $statuses = DtbIssueStatus::where('project_id',$project_id)->where('is_true',1)->orderBy('ordering','ASC')->get();

       $priorities = DtbIssuePriority::where('project_id',$project_id)->get();
        return view('settings.developerSettings.projects.manageproject.chnageAtOnceViewMngPro',compact('userlists','developgroups','apps','categories','versions','statuses','users','priorities','project_id','issueTypes', 'id'));

       }

       public function updateChangeAtOnceMngPro(Request $request){
        $loggedindeveloper = Session::get('developer_id');
       if($data = Session::get('issues_data_pro')) {
       // Deleting last array item
       $project_id = array_pop($data);

       foreach($data as $value){
        $dtbissue = DtbIssue::find($value);

        if(empty($request->get('issue_type'))){
            $issue_type = $dtbissue->issue_type;
        }
        else{
            $issue_type = $request->get('issue_type');
        }


        if(empty($request->get('app_id'))){
            $issueapp = $dtbissue->app_id;
        }
        else{
            $issueapp = $request->get('app_id');
        }       

        if(empty($request->get('version_id'))){
            $issueversion = $dtbissue->version_id;
        }
        else{
            $issueversion = $request->get('version_id');
        }

        if(empty($request->get('progress'))){
            $issueprogress = $dtbissue->progress;
        }
        else{
            $issueprogress = $request->get('progress');
        }
        
        
        if(empty($request->get('user_id'))){
            $user_id = $dtbissue->user_id;
        }
        else{
            $user_id = $request->get('user_id');
        }

        if(empty($request->get('status'))){
            $status = $dtbissue->status;
            $is_closed = $dtbissue->is_closed;
        }
        else{
             $status = $request->get('status');
             $status_value = explode('-',$request->get('status'));
             
             $status_id= $status_value[0];
             $status_name= $status_value[1];

             // $is_closed='';
             $status_array = array('close', 'Close', 'CLOSE', 'closed', 'CLOSED');
             if(in_array($status_name, $status_array)){
                $is_closed = 1;
             }
             else{
                $is_closed = $dtbissue->is_closed;
             }
        }

        if(empty($request->get('category_id'))){
            $category_id = $dtbissue->category_id;
        }
        else{
            $category_id = $request->get('category_id');
        }

        if(empty($request->get('issue_priority_id'))){
            $issue_priority_id = $dtbissue->issue_priority_id;
        }
        else{
            $issue_priority_id = $request->get('issue_priority_id');
        }

        if(empty($request->get('estimate_hour1'))){
            $estimate_hour1 = $dtbissue->estimate_hour1;
        }
        else{
            $estimate_hour1 = $request->get('estimate_hour1');
        }
        if(empty($request->get('start_date'))){
            $start_date = $dtbissue->start_date;
        }
        else{
            $start_date = $request->get('start_date');
        }

        if(empty($request->get('deadline'))){
            $deadline = $dtbissue->deadline;
        }
        else{
            $deadline = $request->get('deadline');
        }

        

            $dtbissue->user_id = $user_id;
            //$dtbissue->app_id = $request->get('app_id');
            $dtbissue->category_id = $category_id;
            //$dtbissue->version_id = $request->get('version_id');
            $dtbissue->status = $status;
            $dtbissue->is_closed = $is_closed;
            //$dtbissue->progress = $request->get('progress');
            $dtbissue->issue_priority_id = $issue_priority_id;
            $dtbissue->estimate_hour1 = $estimate_hour1;
            //$dtbissue->estimate_hour2 = $request->get('estimate_hour2');
            $dtbissue->start_date = $start_date;
            $dtbissue->deadline = $deadline;
            $dtbissue->issue_type = $issue_type;   
            $dtbissue->app_id = $issueapp;
            $dtbissue->version_id = $issueversion;
            $dtbissue->progress = $issueprogress; 
            //$dtbissue->issue_text = $request->get('issue_text');
            //$dtbissue->issue_title = $request->get('issue_title');
            $result = $dtbissue->update();
        }
           
    }
        DtbActivityLog::updateActivityLog('updated', 'issue');
        return redirect('/manageproject')->with('message-success', 'Issue updated');
       }

       public function chnageAtOnceCompleteStatusMngPro(Request $request){
        $data = json_decode($request->getContent());
        if(end($data)){
            $project_id = end($data);
        }

        if(!empty($data)){
            $project_id = array_pop($data);

            foreach($data as $value){

                $dtbissue = DtbIssue::find($value);
                $dtbissue->is_closed = 1;
                $result = $dtbissue->save();

                
            }

            echo URL::to('manageproject');

        }
    }

}
