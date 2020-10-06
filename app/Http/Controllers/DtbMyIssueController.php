<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbIssue;
use App\DtbDevelopGroup;
use App\DtbApp;
use App\DtbIssueCategory;
use App\DtbSearchKeyHistories;
use App\DtbVersion;
use App\DtbIssueStatus;
use App\DtbIssuePriority;
use App\DtbProject;
use DB;
use App\DtbGenIssueType;
use App\DtbUser;
use App\DtbApps;
use App\DtbActivityLog;
use Redirect;


class DtbMyIssueController extends Controller
{
    public function index(){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        
        $common_array = array(
            'content_heading' => 'My Issues'
        );

    	$developer_id = Session::get('developer_id');
        $user_id = Session::get('user_id');
        $formArry['selectProject']=null;
        $formArry['selectAssignee']=null;
        $formArry['is_complete']=null;
//        $formArry['is_feedback']=null;
        //pre search key
        $searchKeyHistories = DtbSearchKeyHistories::query()
        ->where('user_id',Session::get('user_id'))
//         ->where('project_id',$id)
        ->where('search_type','DtbMyIssueController')
        ->orderBy('created_at', 'desc')
        ->take(1)
        ->get();
        if(!empty($searchKeyHistories)&&count($searchKeyHistories)>0){
            foreach ($searchKeyHistories as $searchKeyHistoriy){
                if( !empty($searchKeyHistoriy->search_key)){
                    $keyList = array();
                    $keyList = explode(',', $searchKeyHistoriy->search_key);
                    foreach ($keyList as $keyfiled){
                        $keyfiledSplit = explode(':', $keyfiled);
                        if(!empty($keyfiledSplit[0])){
                            $formArry[$keyfiledSplit[0]] =$keyfiledSplit[1];
                        }
                    }
                }
            }
        }
        $query ="";
        if(isset($formArry['selectProject'])){
            $query .= "AND i.project_id = '".$formArry['selectProject']."'";
        }
        if(isset($formArry['is_complete'])){
            $query .= "AND i.is_closed  = '1'";
        }else{
            $query .= "AND i.is_closed  = '0'";
        }
        
//        if(isset($formArry['is_feedback'] )){
//            $query .= "AND  i.feedback_count > 0 ";
//        }else{
//            $query .= "AND i.feedback_count  = 0 ";
//            
//        }
        
        if(isset($formArry['selectAssignee'])){
            $query .= "AND i.user_id = '".$formArry['selectAssignee']."'";
        }
        
        if(Session::has('role')){
            if(Session::get('role') == '0'){

                $issueslist = DB::select(DB::raw("SELECT i.*, pr.project_name, a.app_name, v.version_name, s.status_name,s.color as statscolor, p.priority_name, p.color as priocolor,c.category_name, u.name as assignee, u.is_archived,u.icon_image_path as userimg,uu.name as issue_creator_author, u.language_id

                FROM dtb_issues i
                LEFT JOIN dtb_projects pr ON i.project_id = pr.id
                LEFT JOIN dtb_apps  a ON i.app_id = a.id
                LEFT JOIN dtb_versions  v ON i.version_id = v.id
                LEFT JOIN dtb_issue_statuses s ON i.status = s.id
                LEFT JOIN dtb_issue_priorities  p ON i.issue_priority_id = p.id
                LEFT JOIN dtb_issue_categories  c ON i.category_id = c.id
                LEFT JOIN dtb_users  u ON i.user_id = u.id
                LEFT JOIN dtb_users  uu ON i.author_user_id = uu.id
                WHERE i.developer_id = $developer_id $query"));
            }
            else{

                $issueslist = DB::select(DB::raw("SELECT i.*, pr.project_name, a.app_name, v.version_name, s.status_name,s.color as statscolor, p.priority_name, p.color as priocolor,c.category_name, u.name as assignee, u.is_archived,u.icon_image_path as userimg, uu.name as issue_creator_author, u.language_id

                FROM dtb_issues i
                LEFT JOIN dtb_projects pr ON i.project_id = pr.id
                LEFT JOIN dtb_apps  a ON i.app_id = a.id
                LEFT JOIN dtb_versions  v ON i.version_id = v.id
                LEFT JOIN dtb_issue_statuses s ON i.status = s.id
                LEFT JOIN dtb_issue_priorities  p ON i.issue_priority_id = p.id
                LEFT JOIN dtb_issue_categories  c ON i.category_id = c.id
                LEFT JOIN dtb_users  u ON i.user_id = u.id
                LEFT JOIN dtb_users  uu ON i.author_user_id = uu.id
                WHERE i.user_id = $user_id $query"));
            }
        }
        
//         if(Session::has('role')){
//             if(Session::get('role') == '0'){
//                 $issueslist = DtbIssue::query()
//                  ->from('dtb_issues as i')
//                  ->leftjoin('dtb_projects as pr','i.project_id', '=', 'pr.id')
//                  ->leftjoin('dtb_apps as a','i.app_id', '=', 'a.id')
//                  ->leftjoin('dtb_versions as v','i.version_id', '=', 'v.id')
//                  ->leftjoin('dtb_issue_statuses as s','i.status', '=', 's.id')
//                  ->leftjoin('dtb_issue_priorities as p','i.issue_priority_id', '=', 'p.id')
//                  ->leftjoin('dtb_issue_categories as c','i.category_id', '=', 'c.id')
//                  ->leftjoin('dtb_users as u','i.user_id', '=', 'u.id')
//                  ->leftjoin('dtb_users as uu','i.author_user_id', '=', 'uu.id')
//                  ->where('i.developer_id', $developer_id)
//                  ->get([ 'i.*', 'pr.project_name', 'a.app_name', 'v.version_name', 's.status_name', 'p.priority_name', 'c.category_name', 'u.name as assignee', 'uu.name as issue_creator_author']);
//             }
//             else{
//                 $issueslist = DtbIssue::query()
//                  ->from('dtb_issues as i')
//                  ->leftjoin('dtb_projects as pr','i.project_id', '=', 'pr.id')
//                  ->leftjoin('dtb_apps as a','i.app_id', '=', 'a.id')
//                  ->leftjoin('dtb_versions as v','i.version_id', '=', 'v.id')
//                  ->leftjoin('dtb_issue_statuses as s','i.status', '=', 's.id')
//                  ->leftjoin('dtb_issue_priorities as p','i.issue_priority_id', '=', 'p.id')
//                  ->leftjoin('dtb_issue_categories as c','i.category_id', '=', 'c.id')
//                  ->leftjoin('dtb_users as u','i.user_id', '=', 'u.id')
//                  ->leftjoin('dtb_users as uu','i.author_user_id', '=', 'uu.id')
//                  ->where('i.user_id', $user_id)
//                  ->get([ 'i.*', 'pr.project_name', 'a.app_name', 'v.version_name', 's.status_name', 'p.priority_name', 'c.category_name', 'u.name as assignee', 'uu.name as issue_creator_author']);
//             }
//         }
        
        $assignees = \DB::table('dtb_users as u')
         ->where('u.developer_id', $developer_id)
         ->where('u.is_archived', 0)
         ->get();
         $projects = DtbIssue::projects();
        return view('my_issues',compact('issueslist', 'assignees', 'projects','formArry','common_array'));
    	
    }

     public function getDropdownData(Request $request){
        $categoryIds = DtbIssueCategory::where('project_id', '=', $request->id)->get();
        $categories = [];
        foreach($categoryIds as $categoryId){
            $categories[] = DtbIssueCategory::find($categoryId->id);
        }

        $allPriorities = DtbIssuePriority::where('project_id', '=', $request->id)->get();
        $priorities = [];
        foreach($allPriorities as $allPrioritie){
            $priorities[] = DtbIssuePriority::find($allPrioritie->id);
        }

        $allStatuss = DtbIssueStatus::where('project_id', '=', $request->id)->get();
        $statuss = [];
        foreach($allStatuss as $allStatus){
            $statuss[] = DtbIssueStatus::find($allStatus->id);
        }
        return response()->json(array('categories'=>$categories,'priorities'=>$priorities, 'statuss'=>$statuss));
    }

    public function seacrhMyIssue(Request $request){
        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        
       $developer_id = Session::get('developer_id');
       $user_id = Session::get('user_id');
       $query = '';
       $formArry['selectProject']=null;
       $formArry['selectAssignee']=$user_id;
       $formArry['is_complete']=null;
       $formArry['is_feedback']=null;
       $search_key="";
       if(isset($request->selectProject)){
          $query .= "AND i.project_id = '$request->selectProject'";
          $formArry['selectProject'] = $request->selectProject;
          $search_key .= "selectProject:".$request->selectProject;
       }
       if(isset($request->is_complete)){
           $query .= "AND i.is_closed  = '1'";
           $formArry['is_complete'] = $request->is_complete;
           $search_key .= ",is_complete:".$request->is_complete;
       }else{
           $query .= "AND i.is_closed  = '0'";
       }
       
//       if(isset($request->is_feedback )){
//           $query .= "AND i.feedback_count >0 ";
//           $formArry['is_feedback'] = $request->is_feedback;
//           $search_key .= ",is_feedback:".$request->is_feedback;
//       }else{
////           $query .= "AND i.feedback_count  = 0  ";
//       }
       
       if(isset($request->selectAssignee)){
          $query .= "AND i.user_id = '$request->selectAssignee'";
          $formArry['selectAssignee'] = $request->selectAssignee;
          $search_key .= ",selectAssignee:".$request->selectAssignee;
       }
//        var_dump($formArry);
       if(Session::has('role')){
            if(Session::get('role') == '0'){
                $issueslist = DB::select(DB::raw("SELECT i.*, pr.project_name, a.app_name, v.version_name, s.status_name,s.color as statscolor, p.priority_name, p.color as priocolor,c.category_name, u.name as assignee,u.is_archived,u.icon_image_path as userimg, uu.name as issue_creator_author
                FROM dtb_issues i 
                LEFT JOIN dtb_projects pr ON i.project_id = pr.id
                LEFT JOIN dtb_apps  a ON i.app_id = a.id
                LEFT JOIN dtb_versions  v ON i.version_id = v.id
                LEFT JOIN dtb_issue_statuses s ON i.status = s.id
                LEFT JOIN dtb_issue_priorities  p ON i.issue_priority_id = p.id
                LEFT JOIN dtb_issue_categories  c ON i.category_id = c.id
                LEFT JOIN dtb_users  u ON i.user_id = u.id
                LEFT JOIN dtb_users  uu ON i.author_user_id = uu.id
                WHERE i.developer_id = $developer_id $query"));
            }
            else{
                $issueslist = DB::select(DB::raw("SELECT i.*, pr.project_name, a.app_name, v.version_name, s.status_name,s.color as statscolor, p.priority_name, p.color as priocolor,c.category_name, u.name as assignee,u.is_archived,u.icon_image_path as userimg , uu.name as issue_creator_author
                FROM dtb_issues i 
                LEFT JOIN dtb_projects pr ON i.project_id = pr.id
                LEFT JOIN dtb_apps  a ON i.app_id = a.id
                LEFT JOIN dtb_versions  v ON i.version_id = v.id
                LEFT JOIN dtb_issue_statuses s ON i.status = s.id
                LEFT JOIN dtb_issue_priorities  p ON i.issue_priority_id = p.id
                LEFT JOIN dtb_issue_categories  c ON i.category_id = c.id
                LEFT JOIN dtb_users  u ON i.user_id = u.id
                LEFT JOIN dtb_users  uu ON i.author_user_id = uu.id
                WHERE i.user_id = $user_id $query"));
            }
          }
          //search condition
          DtbSearchKeyHistories::create([
              'user_id'=> $user_id,
              'search_type' => "DtbMyIssueController",
              'project_id' => null,
              'search_key' => $search_key,
              'search_where' => $query,
              'searched_count' => COUNT($issueslist),
              'created_at' => strtotime(now()),
              'updated_at' => strtotime(now())
              
          ]);
          
            $assignees = \DB::table('dtb_users as u')
             ->where('u.developer_id', $developer_id)
             ->get();
            $projects = DtbIssue::projects();

          return view('my_issues',compact('issueslist', 'assignees', 'projects','formArry'));
            // return Redirect::route('seacrh_my_issue')->with( 
            //   array(
            //     'issueslist' => $issueslist, 
            //     'assignees' => $assignees, 
            //     'projects' => $projects, 
            //     'formArry' => $formArry
                
            //   )
            // );

    }


    public function chnageAtOnce(Request $request){
       
        $data = json_decode($request->getContent());
        if(end($data)){
            $project_id = end($data);
        }
        //echo $project_id;
        //exit;
        Session::put('issues_data', $data);
        Session::put('project_id', $project_id);
        Session::save();
        return redirect()->route('chnageAtOnceViewMyIssues');
    }

    public function chnageAtOnceView(){
        
       $project_id = Session::get('project_id');
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
        return view('issue.chnageAtOnceViewMyIssues',compact('userlists','developgroups','apps','categories','versions','statuses','users','priorities','project_id','issueTypes', 'id'));

       }

       public function updateChangeAtOnce(Request $request){

       $loggedindeveloper = Session::get('developer_id');
       if($data = Session::get('issues_data')) {
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
        
        if(empty($request->get('user_id'))){
            $user_id = $dtbissue->user_id;
        }
        else{
            $user_id = $request->get('user_id');
        }

        if(empty($request->get('status'))){
            $status = $dtbissue->status;
        }
        else{
            $status = $request->get('status');
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
            
            //$dtbissue->progress = $request->get('progress');
            $dtbissue->issue_priority_id = $issue_priority_id;
            $dtbissue->estimate_hour1 = $estimate_hour1;
            //$dtbissue->estimate_hour2 = $request->get('estimate_hour2');
            $dtbissue->start_date = $start_date;
            $dtbissue->deadline = $deadline;
            $dtbissue->issue_type = $issue_type;    
            //$dtbissue->issue_text = $request->get('issue_text');
            //$dtbissue->issue_title = $request->get('issue_title');
            $result = $dtbissue->update();
        }
           
    }
        DtbActivityLog::updateActivityLog('updated', 'issue');
        return redirect('/my_issues')->with('message-success', 'Issue updated');
        }
}
