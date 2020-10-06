<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DtbApps;
use App\DtbGenIssueType;
use App\DtbIssue;
use App\DtbIssueComments;
use App\DtbIssueFeedback;
use App\DtbSearchKeyHistories;
use App\DtbUser;
use App\DtbDevelopGroup;
use App\DtbIssueCategory;
use App\DtbVersion;
use App\DtbIssueStatus;
use App\DtbProject;
use App\DtbIssuePriority;
use App\MtbFeedback;
use Session;
use App\DtbActivityLog;
use App\DtbIssuesCommentImage;
use App\DtbUsersProject;
use URL;
use Response;

class DtbIssueController extends Controller
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
    
    public function index($id)
    {
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $developer_id = Session::get('developer_id');
        $check_same_developer_group=DtbActivityLog::isSameDeveloperGroup($id, 'project');
        if($check_same_developer_group == 'mismatch'){
            return redirect('login');
        }
        $common_array = array(
            'content_heading' => 'Issue List'
        );
        
        
        //$issueslist = DtbIssue::where('developer_id',$developer_id)->get();
        $query = "";
        $formarr['selectCategory'] =null;
        $formarr['selectPriority'] =null;
        $formarr['selectAssignee'] =null;
        $formarr['selectApps'] =array();
        $formarr['selectStatus'] =array();
        //pre search key
        $searchKeyHistories = DtbSearchKeyHistories::query()
        ->where('user_id',Session::get('user_id'))
        ->where('project_id',$id)
        ->where('search_type','DtbIssueController')
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
                        if($keyfiledSplit[0] == 'selectStatus'){
                            $formarr['selectStatus'] = explode('/', $keyfiledSplit[1]);
                            
                        }
                        elseif($keyfiledSplit[0] == 'selectApps'){
                            $formarr['selectApps'] = explode('/', $keyfiledSplit[1]);
                            // dd($formarr['selectApps']);

                        }
                        elseif(!empty($keyfiledSplit[0])){
                            $formarr[$keyfiledSplit[0]] =$keyfiledSplit[1];
                        }

                        
                    }
                }
            }
        }
        $search_key= '';
        
        if(isset($formarr['selectCategory'])){
            $query .= "AND i.category_id = '".$formarr['selectCategory']."'";
        }
        if(isset($formarr['selectPriority'])){
            $query .= "AND i.issue_priority_id = '".$formarr['selectPriority']."'";
        }
        
        if(isset($formarr['selectAssignee'])){
            $query .= "AND i.user_id = '".$formarr['selectAssignee']."'";
        }

        // if(isset($formarr['selectApps'])){
        //     $query .= "AND i.app_id = '".$formarr['selectApps']."'";
        // }

         if(count($formarr['selectApps'])>0){


            $selectApps = array();
            $apps_array = implode(",", $formarr['selectApps']);
           
            
            $status_search_key="";
            if(!empty($apps_array)){
                $status_search_key .= " AND i.app_id IN (".$apps_array.")";
            }
           
            $query .= $status_search_key;
        }
        
        //Status
        if(count($formarr['selectStatus'])>0){
            $status_in = array();
            $status_notin = array();
            foreach ($formarr['selectStatus'] as $oneOption){
                $oneRecArr =  explode("$", $oneOption);
                if($oneRecArr[0] == "not"){
                    array_push($status_notin,$oneRecArr[1]);
                }else{
                    array_push($status_in,$oneRecArr[0]);
                }
            }
            
            $status_arrayIn = implode(",", $status_in);
            $status_arrayNotIn = implode(",", $status_notin);
            
            $status_search_key="";
            if(!empty($status_arrayIn)){
                $status_search_key .= " AND i.status IN (".$status_arrayIn.")";
            }
            if(!empty($status_arrayNotIn)){
                $status_search_key .= " AND i.status NOT IN (".$status_arrayNotIn.")";
            }
            $query .= $status_search_key;
        }
        
        $issueslist = DB::select(DB::raw("SELECT i.*, pr.project_name, a.app_name, v.version_name, s.status_name,s.color, p.priority_name,p.color as priorcolor, c.category_name, u.name as assignee,u.is_archived, uu.name as issue_creator_author
            FROM dtb_issues i
            LEFT JOIN dtb_projects pr ON i.project_id = pr.id
            LEFT JOIN dtb_apps  a ON i.app_id = a.id
            LEFT JOIN dtb_versions  v ON i.version_id = v.id
            LEFT JOIN dtb_issue_statuses s ON i.status = s.id
            LEFT JOIN dtb_issue_priorities  p ON i.issue_priority_id = p.id
            LEFT JOIN dtb_issue_categories  c ON i.category_id = c.id
            LEFT JOIN dtb_users  u ON i.user_id = u.id
            LEFT JOIN dtb_users  uu ON i.author_user_id = uu.id
            WHERE i.developer_id = $developer_id AND i.project_id = $id $query"));


        
        $categories = DtbIssueCategory::where('project_id',$id)->get();
        $priorities = DtbIssuePriority::where('project_id',$id)->get();
        $apps = DtbApps::getProjectApps($id);
        $assignees = DtbUsersProject::query()
        ->from('dtb_users_projects as up')
        ->leftjoin('dtb_users as u','up.user_id', '=', 'u.id')
        ->where('up.project_id', $id)
        ->where('u.is_archived', 0)
        ->get(['u.id', 'u.name']);

        $issueStatuss = DtbIssueStatus::getIssueStatus($id);

        $notInIssue = DtbIssueStatus::getNotIssueStatus($id);



        $assignees = DtbUsersProject::query()
        ->from('dtb_users_projects as up')
        ->leftjoin('dtb_users as u','up.user_id', '=', 'u.id')
        ->where('up.project_id', $id)
        ->where('u.is_archived', 0)
        ->get(['u.id', 'u.name']);

        return view('issue.index',compact('id', 'issueslist','categories','priorities', 'assignees', 'issueStatuss', 'notInIssue','apps','assignees','formarr','common_array'));

    }


    public function create(Request $request,$id)
    {
       if (!Session()->has('user_id')) {
           return redirect('login');
       }

        //Table::select('name','surname')->where('id', 1)->get();
    //IssueTYpe
       $issueTypes = DtbGenIssueType::getProjectIssueType($id);

       $loggedindeveloper = Session::get('developer_id');
       $userlists = DtbUser::select('id','developer_id','name','english_name')->get();
       $developgroups = DtbDevelopGroup::select('id','company_name')->get();
//     $apps = DtbApp::where('project_id',$id)->get();
       $apps = DtbApps::getProjectApps($id);

       $categories = DtbIssueCategory::where('project_id',$id)->get();
       $versions = DtbVersion::where('project_id',$id)->get();
       $statuses = DtbIssueStatus::whereRaw("project_id ='".$id."' AND (status_name='New' or status_name='new' or status_name='新規')" )->take(1)->get();
       if (count($statuses)== 0 ){
        DtbIssueStatus::create([
            'project_id' => $id,
            'status_name' => 'New',
            'is_complete' => 0,
            'created_at' => strtotime(now()),
            'updated_at' => strtotime(now())
            
        ]);
        $statuses = DtbIssueStatus::whereRaw("project_id ='".$id."' AND (status_name='New' or status_name='new' or status_name='新規')" )->take(1)->get();
    }
    $users = \DB::table('dtb_users')
    ->join('dtb_users_projects','dtb_users.id','=','dtb_users_projects.user_id')
    ->where('dtb_users_projects.project_id', $id)
    ->where('dtb_users.is_archived', 0)
    ->get();
    $projects = DtbProject::where('developer_id',$loggedindeveloper)->get();
    $priorities = DtbIssuePriority::where('project_id',$id)->get();
    $project = DtbProject::where('id',$id)->first();
    return view('issue.create',compact('userlists','developgroups','apps','categories','versions','statuses','users','projects','priorities','id','issueTypes'));

}


public function store(Request $request,$id)
{
    if (!Session()->has('user_id')) {
        return redirect('login');
    }

    $request->issue_title;

    $data = request()->validate([
        'developer_id'=>'required',
        'author_user_id'=>'required',
        'user_id'=>'',
        'issue_title'=>'required',
        'project_id'=>'required',
        'app_id'=> '',
        'category_id'=> '',
        'version_id'=> '',
        'status'=> '',
        'difficulty' => '',
        'progress'=> '',
        'issue_priority_id'=> '',
        'estimate_hour1'=> '',
        'estimate_hour2'=> '',
        'start_date'=> '',
        'deadline'=> '',
        'issue_text'=> '',
        'details'=>'',
        'issue_type'=> '',
    ]);
    $dtbIssueRec = DtbIssue::create($data);
    DtbActivityLog::updateActivityLogPro('added', 'issue', $id);
    
    
    
    return redirect('/issue/'.$dtbIssueRec->id.'/list')->with('message', 'Issue has been added!');

}


public function showNoDiv($issue_id) {
    self::show($issue_id, 'list');
}

public function show($issue_id,$div)
{
    if (!Session()->has('user_id')) {
        return redirect('login');
    }
    
    $common_array = array(
        'content_heading' => 'Issue Details'
    );

    $check_same_developer_group=DtbActivityLog::isSameDeveloperGroup($issue_id, 'issue');
    if($check_same_developer_group == 'mismatch'){
        return redirect('login');
    }
    
 //$id = $issue_id;
    $issueDetails = DtbIssue::query()
    ->from('dtb_issues as i')
    ->leftjoin('dtb_projects as pr','i.project_id', '=', 'pr.id')

    ->leftjoin('dtb_gen_issue_types as g','g.id', '=', 'i.issue_type')
    ->leftjoin('dtb_apps as a','i.app_id', '=', 'a.id')
    ->leftjoin('dtb_versions as v','i.version_id', '=', 'v.id')
    ->leftjoin('dtb_issue_statuses as s','i.status', '=', 's.id')
    ->leftjoin('dtb_issue_priorities as p','i.issue_priority_id', '=', 'p.id')
    ->leftjoin('dtb_issue_categories as c','i.category_id', '=', 'c.id')
    ->leftjoin('dtb_users as u','i.user_id', '=', 'u.id')
    ->leftjoin('dtb_users as uu','i.author_user_id', '=', 'uu.id')
    ->leftjoin('dtb_issues as ii','i.next_issue_id', '=', 'ii.id')
    ->leftjoin('dtb_users as uuu','i.next_user_id', '=', 'uuu.id')
    ->leftjoin('dtb_issue_statuses as ss','i.next_kick_status', '=', 'ss.id')
    ->where('i.id', $issue_id)
    ->get([ 'i.*', 'pr.project_name','g.issue_type','g.color', 'a.app_name', 'v.version_name', 's.status_name','s.color as statcolor', 'p.priority_name','p.color as priorcolor', 'c.category_name', 'u.name as assignee','u.is_archived', 'uu.name as issue_creator_author','uuu.name as nextuser','ss.status_name as nextkickstatus','ii.issue_title as nextissuetitle'])
    ->first();
    $id = $issueDetails->project_id;
    //$issue_comments = DtbIssueComments::where('issue_id',$id)->get();
    $issue_comments = DtbIssueComments::query()
    ->from('dtb_issue_comments as c')
    ->leftjoin('dtb_users as u','c.user_id', '=', 'u.id')
    ->where('c.issue_id', $issue_id)
    ->orderBy('created_at','ASC')
    ->get([ 'c.*', 'u.name', 'u.icon_image_path']);


    return view('issue.show', compact('id', 'issueDetails', 'issue_comments','div','common_array'));
}

public function addComment(Request $request){
    if (!Session()->has('user_id')) {
        return redirect('login');
    }
    
    $comment = $_POST['comment'];
    $comment_images = $request->file('comment_images');
    if(!empty($request->comment)){
        $data = new DtbIssueComments;
        $data->issue_id = $request->issue_id;
        $data->issue_comment = $request->comment;
        $data->user_id = Session::get('user_id');
        $results = $data->save();
        $LastInsertId = $data->id;
    }
    if($request->hasFile('comment_images'))
    {
        foreach ($comment_images as $file) {

            $userImageFile = "";
            if ($request->hasFile('comment_images')) {
                $image = $request->file('comment_images');
                $image_name = uniqid().$file->getClientOriginalName();
                $destinationPath = public_path('/uploads/comments_image');
                $imagePath = $destinationPath. "/".  $image_name;
                $file->move($destinationPath, $image_name);
                $userImageFile = '/uploads/comments_image/'.$image_name;
            }
            
            $data = new DtbIssuesCommentImage;
            $data->issue_id = $request->issue_id;
            $data->comment_id = $LastInsertId;
            $data->image_path = $userImageFile;
            $results = $data->save();
        }
    }

    //return redirect('/issue/'.$request->issue_id)->with('message-success', "Your Comments have Successfully.");
}





public function deleteIssueView($issue_id){
    if (!Session()->has('user_id')) {
        return redirect('login');
    }
    
    return view('issue/deleteIssue', compact('issue_id'));
}


public function destroy(Request $request,$id)
{

    // Mabrur san done this for issue delete By Ajax toaster
    //DtbIssue::find($request->issueid)->delete($request->issueid);
    //DtbActivityLog::updateActivityLog('deleted', 'issue');
    //echo "Record has been deleted";
}

public function deleteIssue($issue_id){
    if (!Session()->has('user_id')) {
        return redirect('login');
    }
    
    $data = DtbIssue::find($issue_id);
    $id = $data->project_id;

    if($data){
        DB::table('dtb_issues')->where('id', $issue_id)->delete();
        DtbActivityLog::updateActivityLog('deleted', 'issue');
        return redirect('/project/'.$id.'/issue')->with('message-danger', 'Issue has been successfully deleted');
    }

}






public function seacrhProjectIssue(Request $request){

    if (!Session()->has('user_id')) {
        return redirect('login');
    }

if ($request->isMethod('post')) {

    if (!Session()->has('user_id')) {
        return redirect('login');
    }
    
    $developer_id = Session::get('developer_id');
    $user_id = Session::get('user_id');
    $id = $request->project_id;
    $query = '';
    $formarr['selectCategory'] =null;
    $formarr['selectPriority'] =null;
    $formarr['selectAssignee'] =null;
    //$formarr['selectApps'] =null;
    $formarr['selectApps'] = array();
    $formarr['selectStatus'] =array();

    $search_key= '';

    if(isset($request->selectCategory)){
      $query .= "AND i.category_id = '$request->selectCategory'";
      $formarr['selectCategory'] = $request->selectCategory;
      $search_key .= "selectCategory:".$request->selectCategory;
  }
  if(isset($request->selectPriority)){
      $query .= "AND i.issue_priority_id = '$request->selectPriority'";
      $formarr['selectPriority'] = $request->selectPriority;
      $search_key .= ",selectPriority:".$request->selectPriority;
  }

  if(isset($request->selectAssignee)){
      $query .= "AND i.user_id = '$request->selectAssignee'";
      $formarr['selectAssignee'] = $request->selectAssignee;
      $search_key .= ",selectAssignee:".$request->selectAssignee;
  }

// $apps_array = implode(",", $request->selectApps);
//      echo "<pre>";
//      print_r($apps_array);exit;



  if(isset($request->selectApps)){
    // $query .= "AND i.app_id = '$request->selectApps'";
     $apps_array = implode(",", $request->selectApps);
     $query .= " AND i.app_id IN (".$apps_array.")";
     $formarr['selectApps'] = $request->selectApps;
     $search_key .= ",selectApps:".implode("/", $request->selectApps);
 }

 if(isset($request->selectStatus)){
     $formarr['selectStatus'] = $request->selectStatus;
     $search_key .= ",selectStatus:".implode("/",$request->selectStatus);

 }

        //Status
 if(isset($request->selectStatus)){
     $status_array = $request->selectStatus;
     $status_in = array();
     $status_notin = array();
     foreach ($status_array as $oneOption){
         $oneRecArr =  explode("$", $oneOption);
         if($oneRecArr[0] == "not"){
             array_push($status_notin,$oneRecArr[1]);
         }else{
             array_push($status_in,$oneRecArr[0]);
         }
     }

     $status_arrayIn = implode(",", $status_in);
     $status_arrayNotIn = implode(",", $status_notin);

     $status_search_key="";
     if(!empty($status_arrayIn)){
         $status_search_key .= " AND i.status IN (".$status_arrayIn.")";
     }
     if(!empty($status_arrayNotIn)){
         $status_search_key .= " AND i.status NOT IN (".$status_arrayNotIn.")";
     }
     $query .= $status_search_key;
 }
 $issueslist = DB::select(DB::raw("SELECT i.*, pr.project_name, a.app_name, v.version_name, s.status_name, s.color, p.priority_name, p.color as priorcolor, c.category_name, u.name as assignee,u.is_archived, uu.name as issue_creator_author
    FROM dtb_issues i 
    LEFT JOIN dtb_projects pr ON i.project_id = pr.id
    LEFT JOIN dtb_apps  a ON i.app_id = a.id
    LEFT JOIN dtb_versions  v ON i.version_id = v.id
    LEFT JOIN dtb_issue_statuses s ON i.status = s.id
    LEFT JOIN dtb_issue_priorities  p ON i.issue_priority_id = p.id
    LEFT JOIN dtb_issue_categories  c ON i.category_id = c.id
    LEFT JOIN dtb_users  u ON i.user_id = u.id
    LEFT JOIN dtb_users  uu ON i.author_user_id = uu.id
    WHERE i.developer_id = $developer_id AND i.project_id = $id $query"));


        //search condition
 DtbSearchKeyHistories::create([
    'user_id'=> $user_id,
    'search_type' => "DtbIssueController",
    'project_id' => $id,
    'search_key' => $search_key,
    'search_where' => $query,
    'searched_count' => COUNT($issueslist),
    'created_at' => strtotime(now()),
    'updated_at' => strtotime(now())

]);


 $categories = DtbIssueCategory::where('project_id',$id)->get();
 $priorities = DtbIssuePriority::where('project_id',$id)->get();
 $apps = DtbApps::getProjectApps($id);


 $issueStatuss = DtbIssueStatus::getIssueStatus($id);


 $notInIssue = DtbIssueStatus::getNotIssueStatus($id);


 $assignees = DtbUsersProject::query()
 ->from('dtb_users_projects as up')
 ->leftjoin('dtb_users as u','up.user_id', '=', 'u.id')
 ->where('up.project_id', $id)
 ->where('u.is_archived', 0)
 ->get(['u.id', 'u.name']);//

         $common_array = array(
            'content_heading' => 'Issue'
        );

         return view('issue.index',compact('id','notInIssue', 'issueslist', 'assignees', 'categories', 'priorities', 'issueStatuss','apps','formarr','common_array'));

    }else{
       
        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        return redirect('/home');

    }

}



     public function copyIssue($appid)
     {
        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        
        $dtbissue = DtbIssue::find($appid);
        $project_id = $dtbissue->project_id;
        $id = $project_id;
        //Table::select('name','surname')->where('id', 1)->get();
        $loggedindeveloper = Session::get('developer_id');
        $userlists = DtbUser::select('id','developer_id','name','english_name')->get();
        $developgroups = DtbDevelopGroup::select('id','company_name')->get();
        $apps = DtbApps::getProjectApps($dtbissue->project_id);
        $categories = DtbIssueCategory::where('project_id',$dtbissue->project_id)->get();
        $versions = DtbVersion::where('project_id',$dtbissue->project_id)->get();
        $statuses = DtbIssueStatus::whereRaw("project_id ='".$id."' AND (status_name='New' or status_name='new' or status_name='新規')" )->take(1)->get();
        if (count($statuses)== 0 ){
            DtbIssueStatus::create([
                'project_id' => $id,
                'status_name' => 'New',
                'is_complete' => 0,
                'created_at' => date('y-m-d H:i:s',strtotime()),
                'updated_at' => date('y-m-d H:i:s',strtotime())

            ]);
            $statuses = DtbIssueStatus::whereRaw("project_id ='".$id."' AND (status_name='New' or status_name='new' or status_name='新規')" )->take(1)->get();
        }

        $users = \DB::table('dtb_users')
        ->join('dtb_users_projects','dtb_users.id','=','dtb_users_projects.user_id')
        ->where('dtb_users_projects.project_id', $dtbissue->project_id)
        ->where('dtb_users.is_archived', 0)
        ->get();
        $projects = DtbProject::where('developer_id',$loggedindeveloper)->get();
        $priorities = DtbIssuePriority::where('project_id',$dtbissue->project_id)->get();

    //IssueTYpe
        $issueTypes = DtbGenIssueType::getProjectIssueType($id);
    //copy
        $copyFlag = true;

        $common_array = array(
            'content_heading' => 'Issue'
        );

        return view('issue.create',compact('dtbissue','userlists','developgroups','apps','categories','versions','statuses','users','projects','priorities','id', 'appid','issueTypes','copyFlag','common_array'));

    }



    public function editIssueNew($issue_id,$div){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        //$dtbissue = DtbIssue::find($issue_id);

        $dtbissue = DtbIssue::query()
        ->from('dtb_issues as i')
        ->leftjoin('dtb_issues as ii','i.next_issue_id', '=', 'ii.id')
        ->leftjoin('dtb_users as u','i.next_user_id', '=', 'u.id')
        ->leftjoin('dtb_issue_statuses as s','i.next_kick_status', '=', 's.id')
        ->where('i.id', $issue_id)
        ->get([ 'i.*','ii.issue_title as nextissue','u.name as nexuser','s.status_name as nxtstatus'])
        ->first();

        $project_id = $dtbissue->project_id;
        $id = $project_id;

        $developer_id = Session::get('developer_id');
        $userlists = DtbUser::select('id','developer_id','name','english_name')->get();
        $developgroups = DtbDevelopGroup::select('id','company_name')->get();
//     $apps = DtbApp::where('project_id',$dtbissue->project_id)->get();

        $apps = DtbApps::getProjectApps($dtbissue->project_id);

        $categories = DtbIssueCategory::where('project_id',$dtbissue->project_id)->get();
        $versions = DtbVersion::where('project_id',$dtbissue->project_id)->get();
        $statuses = DtbIssueStatus::where('project_id',$dtbissue->project_id)->where('is_true',1)->orderBy('ordering','ASC')->get();
        $users = \DB::table('dtb_users')
        ->join('dtb_users_projects','dtb_users.id','=','dtb_users_projects.user_id')
        ->where('dtb_users_projects.project_id', $dtbissue->project_id)
        //->where('dtb_users.is_archived', 0)
        ->get();
        $projects = DtbProject::where('developer_id',$developer_id)->get();
        $priorities = DtbIssuePriority::where('project_id',$dtbissue->project_id)->get();
        $feedbacks = MtbFeedback::all();
    //IssueTYpe
        $issueTypes = DtbGenIssueType::getProjectIssueType($id);
        $commentcontent = DtbIssueComments::getComments($issue_id);
        return view('issue.editIssueNew',compact('div','dtbissue','userlists','developgroups','apps','categories','versions','statuses','users','projects','priorities','id','issueTypes','commentcontent','feedbacks'));
    }

    public function issueDetailsImageUpload(Request $request){
      if (!Session()->has('user_id')) {
          return redirect('login');
      }
      
      $dtbissue = new DtbIssue;
      $dtbissue->developer_id = 1;
      $dtbissue->save(); 
  }

  public function updateIssueData(Request $request, $issue_id){

      if (!Session()->has('user_id')) {
          return redirect('login');
      }
      
      request()->validate([
        'developer_id'=>'',
        'author_user_id'=>'',
        'user_id'=>'',
        'issue_title'=>'required',
        'project_id'=>'',
        'app_id'=> '',
        'category_id'=> '',
        'version_id'=> '',
        'status'=> '',
        'difficulty' => '',
        'progress'=> '',
        'issue_priority_id'=> '',
        'estimate_hour1'=> '',
        'estimate_hour2'=> '',
        'start_date'=> '',
        'deadline'=> '',
        'details'=> '',
        'issue_type'=> '',
        'issue_text'=> '',
    ]);
      $loggedindeveloper = Session::get('developer_id');
      $dtbissue = DtbIssue::find($issue_id);
      
    //$dtbissue->author_user_id = 1;
      $dtbissue->user_id = $request->get('user_id');
      $dtbissue->app_id = $request->get('app_id');
      $dtbissue->category_id = $request->get('category_id');
      $dtbissue->version_id = $request->get('version_id');
      $user_id = $dtbissue->user_id = $request->get('user_id');

      if (isset($request->next_kick_status)) {

        if ($request->get('status') === $request->get('next_kick_status') ){


            $dtbissue->status = $request->get('status');
            $dtbissue->next_kick_status = $request->get('status');
            //$dtbissue->user_id = $request->get('next_user_id');
            //echo $request->get('next_user_id');die();
            
            $autoassignedissue = DtbIssue::find($request->get('next_issue_id'));
            //dd($autoassignedissue);
            $autoassignedissue->user_id = $request->get('next_user_id');
            $autoassignedissue->update();



        }else{

            $dtbissue->status = $request->get('status');

        }
    }else{

        $dtbissue->status = $request->get('status');

    }
    

    $dtbissue->difficulty = $request->get('difficulty');
    $dtbissue->progress = $request->get('progress');
    $dtbissue->issue_priority_id = $request->get('issue_priority_id');
    $dtbissue->estimate_hour1 = $request->get('estimate_hour1');
    $dtbissue->estimate_hour2 = $request->get('estimate_hour2');
    $dtbissue->start_date = $request->get('start_date');
    $dtbissue->deadline = $request->get('deadline');
    $dtbissue->issue_type = $request->get('issue_type');    
    $dtbissue->issue_text = $request->get('issue_text');
    $dtbissue->issue_title = $request->get('issue_title');
    
    $statuses = DtbIssueStatus::find($request->get('status'));
    //is close
    if (empty($statuses) || $statuses->is_complete ==1){
        $dtbissue->is_closed = 1;
        //$dtbissue->complete_date =now();
          $complete_date = $dtbissue->complete_date;
          if(empty($complete_date)){
            $dtbissue->complete_date =now();
          }
          else{
            $dtbissue->complete_date = $complete_date;
          }
        
    }else{
        $dtbissue->is_closed = 0;
        $dtbissue->complete_date =null;
        
    }


    
    //feedback
    $feedback_type= $request->get('feedback_type');
    if (empty($statuses) || $statuses->is_feedback !=1){
        $feedback_type = null;
    }
    
    if (!empty($feedback_type)){
        $dtbissue->feedback_count = $dtbissue->feedback_count +1 ;
    }
    $result = $dtbissue->update();
    DtbActivityLog::updateActivityLog('updated', 'issue');

    if($result){
        if(!empty($request->issue_comment)){
            $data = new DtbIssueComments;
            $data->issue_id = $issue_id;
            $data->issue_comment = $request->issue_comment;
            $data->user_id = Session::get('user_id');
            $results = $data->save();
        }
        if (!empty($feedback_type)){
            $dtbIssueFeedback = DtbIssueFeedback::getExistsFeedBack($request,$issue_id);
//            if(empty($dtbIssueFeedback)||count($dtbIssueFeedback)==0){
                DtbIssueFeedback::addFeedBack($request,$user_id);
//            }
        }
    }

        //
    return redirect('issue/'.$issue_id.'/'.$request->get('fromPageDiv'))->with('message', 'Data has been updated!');
}


//Clear ALL
public function clearIssueStatus($project_id){
   return redirect('/project/'.$project_id.'/issue');
}



    // Upload isseue 
public function editorfilesup(Request $request){

    $image = $request->file('file');

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';

    $userImageFile =Storage::disk('s3')->put('issue', $request->file('file'));

    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
            // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }
}    


    // tui editor content drag and drop or select file upload for issue edit comment
public function editcommentfileup(Request $request){

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';
    $userImageFile = Storage::disk('s3')->put('issueComment', $request->file('file'));

    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
        // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }

}

public function getComment($issueID,$commentID) {
    $issue_comments = DtbIssueComments::query()
    ->where('id',$commentID)->first();

    return $issue_comments->issue_comment;

}

public function editComment(Request $request,$issueID,$commentID) {

    $issue_comments = DtbIssueComments::find($commentID);
    $issue_comments->issue_comment =$request->issue_comment;
    $issue_comments->updated_at = strtotime(now());
    $issue_comments->created_at = $issue_comments->created_at;
    $issue_comments->update();
    $parser = new \cebe\markdown\GithubMarkdown();
    $parser->html5 = true;
    $parser->enableNewlines = true;
    $parser->keepListStartNumber = true;
        //     echo
    return $parser->parse($request->issue_comment);
}

public function chnageAtOnce(Request $request){

    $data = json_decode($request->getContent());
    if(end($data)){
        $project_id = end($data);
    }
    Session::put('issues_data', $data);
    Session::put('project_id', $project_id);
    Session::save();
    return redirect()->route('chnageAtOnceView');
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
 ->where('dtb_users.is_archived', 0)
 ->get();
 $categories = DtbIssueCategory::where('project_id',$project_id)->get();
 $versions = DtbVersion::where('project_id',$project_id)->get();
 $statuses = DtbIssueStatus::where('project_id',$project_id)->where('is_true',1)->orderBy('ordering','ASC')->get();

 $priorities = DtbIssuePriority::where('project_id',$project_id)->get();
 return view('issue.chnageAtOnceView',compact('userlists','developgroups','apps','categories','versions','statuses','users','priorities','project_id','issueTypes', 'id'));

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
            $start_date = date('Y-m-d', strtotime($request->get('start_date')));
        }

        if(empty($request->get('deadline'))){
            $deadline = $dtbissue->deadline;
        }
        else{
            $deadline = date('Y-m-d', strtotime($request->get('deadline')));
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
return redirect('/project/'.$project_id.'/issue')->with('message-success', 'Issue updated');
}


public function chnageAtOnceCompleteStatus(Request $request){
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

    echo URL::to('/project/'.$project_id.'/issue');

 }

}

 //get app of selected project
  public function getprojectapp(Request $request){

    $selectedprojectid = $request->selectedprojectid;

    if (!empty($selectedprojectid)) {

        $appsofproject = DB::table("dtb_apps")
        ->where("project_id",$selectedprojectid)
        ->orderBy('ordering','ASC')
        ->pluck("app_name","id","ordering")
        ->toArray();
        return response()->json($appsofproject); 


    }else{ }


}        




    //get users of selected project
public function getprojectaddeduser(Request $request){

    $selectedprojectid = $request->selectedprojectid;

    if (!empty($selectedprojectid)) {

        $usersofproject = DB::table("dtb_users_projects")
        ->join('dtb_users','dtb_users_projects.user_id','=','dtb_users.id')
        ->where("project_id",$selectedprojectid)
        ->where("dtb_users.is_archived",0)
        ->pluck("dtb_users.name","dtb_users_projects.user_id")
        ->toArray();

        return response()->json($usersofproject); 

    }else{ }


}    

        //get users of project for new assign
public function getprojectnewassignee(Request $request){

    $projectidnew = $request->projectidnew;

    if (!empty($projectidnew)) {

        $usersofproject = DB::table("dtb_users_projects")
        ->join('dtb_users','dtb_users_projects.user_id','=','dtb_users.id')
        ->where("project_id",$projectidnew)
        ->where("dtb_users.is_archived",0)
        ->pluck("dtb_users.name","dtb_users_projects.user_id")
        ->toArray();

        return response()->json($usersofproject); 

    }else{ }


}        


        //get users of project for new assign
public function getprojectnewstatus(Request $request){

    $projectidnew = $request->projectidnew;

    if (!empty($projectidnew)) {

        $statusofproject = DB::table("dtb_issue_statuses")
        ->where("project_id",$projectidnew)
        ->pluck("status_name","id")
        ->toArray();

        return response()->json($statusofproject); 

    }else{ }

}




function autoassignsrch(Request $request)
{

   if(request()->ajax())
   {
      if(!empty($request->project))
      {
         $data = DB::table('dtb_issues')
         ->select('dtb_issues.id','dtb_issues.issue_title', 'dtb_gen_issue_types.issue_type', 'dtb_apps.app_name','dtb_issue_statuses.status_name as nextkickstatusname','dtb_issue_statuses.id as nextkcikstatusid', 'dtb_issue_categories.category_name', 'dtb_issues.project_id','dtb_projects.project_name', 'dtb_issues.start_date', 'dtb_users.name as nextissueassignee', 'dtb_users.id as nextissueassigneeid','nxtissuetbl.issue_title as nxtissuetitles')

         ->leftJoin('dtb_apps','dtb_issues.app_id','=','dtb_apps.id')
         ->leftJoin('dtb_issue_statuses','dtb_issues.next_kick_status','=','dtb_issue_statuses.id')
         ->leftJoin('dtb_gen_issue_types','dtb_issues.issue_type','=','dtb_gen_issue_types.id')
         ->leftJoin('dtb_projects','dtb_issues.project_id','=','dtb_projects.id')
         ->leftJoin('dtb_issue_categories','dtb_issues.category_id','=','dtb_issue_categories.id')
         ->leftJoin('dtb_users','dtb_issues.next_user_id','=','dtb_users.id')
         ->leftJoin('dtb_issues as nxtissuetbl','dtb_issues.next_issue_id','=','nxtissuetbl.id')

         ->where('dtb_issues.project_id', $request->project)
         ->where('dtb_issues.app_id', $request->app)
         ->where('dtb_issues.user_id', $request->assignee)
         ->where('dtb_issues.is_closed', 0)
         ->where('dtb_issues.feedback_count', 0)
         ->get();
     }
     else
     {
         $data = DB::table('dtb_issues')
         ->select('dtb_issues.id','dtb_issues.issue_title', 'dtb_gen_issue_types.issue_type','dtb_issue_statuses.status_name as nextkickstatusname','dtb_issue_statuses.id as nextkcikstatusid','dtb_apps.app_name', 'dtb_issue_categories.category_name', 'dtb_issues.project_id','dtb_projects.project_name', 'dtb_issues.start_date', 'dtb_users.name as nextissueassignee', 'dtb_users.id as nextissueassigneeid','nxtissuetbl.issue_title as nxtissuetitles')

         ->leftJoin('dtb_apps','dtb_issues.app_id','=','dtb_apps.id')
         ->leftJoin('dtb_issue_statuses','dtb_issues.next_kick_status','=','dtb_issue_statuses.id')
         ->leftJoin('dtb_gen_issue_types','dtb_issues.issue_type','=','dtb_gen_issue_types.id')
         ->leftJoin('dtb_projects','dtb_issues.project_id','=','dtb_projects.id')
         ->leftJoin('dtb_users','dtb_issues.next_user_id','=','dtb_users.id')
         ->leftJoin('dtb_issue_categories','dtb_issues.category_id','=','dtb_issue_categories.id')
         ->leftJoin('dtb_issues as nxtissuetbl','dtb_issues.next_issue_id','=','nxtissuetbl.id')
         
         ->where("dtb_issues.id",$request->issue_id)
         ->get();
     }
     return datatables()->of($data)->make(true);
 }
 $issueslists = DB::table('dtb_issues')
 ->select('dtb_issues.issue_title')
 ->groupBy('dtb_issues.project_id')
 ->orderBy('dtb_issues.project_id', 'ASC')
 ->get();
 return view('issue.editIssueNew', compact('issueslists'));
}


public function newlyassignto(Request $request){

    $dtbissue = DtbIssue::find($request->get('mainissueid'));
    $dtbissue->next_issue_id = $request->get('newassignissueid');
    $dtbissue->next_user_id = $request->get('newassignee');
    $dtbissue->next_kick_status = $request->get('newstatus');
    $dtbissue->message = $request->get('autoassignmsg');
    $dtbissue = $dtbissue->update();
    echo "Auto Asssign success !";

}
// AUTO ASSIGNEE METHODS ENDS HERE




public function exportcsv($porjectid,Request $request){

    if (!Session()->has('user_id')) {
        return redirect('login');
    }

    $developer_id = Session::get('developer_id');
    $user_id = Session::get('user_id');
    $projectid = $request->get('project_id');


   $searchKeyHistories = DtbSearchKeyHistories::query()
    ->select(['search_where'])
    ->where('user_id',Session::get('user_id'))
    ->where('project_id',$porjectid)
    ->where('search_type','DtbIssueController')
    ->orderBy('id', 'desc')
    ->orderBy('created_at', 'desc')
    ->first();

    $query = '';

    if(!empty($searchKeyHistories)){
        $wherecondition = $searchKeyHistories->search_where;
        if (!empty($wherecondition)) {
            $query .= $wherecondition;
        }
    }

    
//     $request->get('selectCategorys');
//     $request->get('selectPrioritys');
//     $request->get('selectAppss');
//     $request->get('selectAssignees');
//     $request->get('selectStatuss');
//     $search_key= '';
// if(isset($request->selectCategorys)){
//       $query .= "AND i.category_id = '$request->selectCategorys'";
//   }
//   if(isset($request->selectPrioritys)){
//       $query .= "AND i.issue_priority_id = '$request->selectPrioritys'";
//   }
//   if(isset($request->selectAppss)){
//       $query .= "AND i.app_id = '$request->selectAppss'";
//   }
//   if(isset($request->selectAssignees)){
//     $query .= "AND i.user_id = '$request->selectAssignees'";
//      // $apps_array = implode(",", $request->selectApps);
//      // $query .= " AND i.app_id IN (".$apps_array.")";
//  }

//  if(isset($request->selectStatuss)){
//     $query .= "AND i.status = '$request->selectStatuss'";
//      //$formarr['selectStatus'] = $request->selectStatuss;
//      //$search_key .= ",selectStatus:".implode("/",$request->selectStatuss);

//  }
 //  if(isset($request->selectStatus)){
 //     $status_array = $request->selectStatus;
 //     $status_in = array();
 //     $status_notin = array();
 //     foreach ($status_array as $oneOption){
 //         $oneRecArr =  explode("$", $oneOption);
 //         if($oneRecArr[0] == "not"){
 //             array_push($status_notin,$oneRecArr[1]);
 //         }else{
 //             array_push($status_in,$oneRecArr[0]);
 //         }
 //     }
 //     $status_arrayIn = implode(",", $status_in);
 //     $status_arrayNotIn = implode(",", $status_notin);

 //     $status_search_key="";
 //     if(!empty($status_arrayIn)){
 //         $status_search_key .= " AND i.status IN (".$status_arrayIn.")";
 //     }
 //     if(!empty($status_arrayNotIn)){
 //         $status_search_key .= " AND i.status NOT IN (".$status_arrayNotIn.")";
 //     }
 //     $query .= $status_search_key;
 // }


  $issueslist = DB::select(DB::raw("SELECT i.*, pr.project_name, a.app_name, v.version_name, s.status_name, s.color, p.priority_name, p.color as priorcolor, c.category_name, u.name as assignee, uu.name as issue_creator_author, uuu.name as cratedby, it.issue_type as issuetypename, df.name as difficultyname, ni.issue_title as nextissue, ns.status_name as nxtstatsname, nu.name as nxtuser
    FROM dtb_issues i  
    LEFT JOIN dtb_projects pr ON i.project_id = pr.id 
    LEFT JOIN dtb_apps a ON i.app_id = a.id 
    LEFT JOIN dtb_versions v ON i.version_id = v.id 
    LEFT JOIN dtb_issue_statuses s ON i.status = s.id 
    LEFT JOIN dtb_issue_priorities p ON i.issue_priority_id = p.id 
    LEFT JOIN dtb_issue_categories c ON i.category_id = c.id 
    LEFT JOIN dtb_users u ON i.user_id = u.id 
    LEFT JOIN dtb_users uu ON i.author_user_id = uu.id
    LEFT JOIN dtb_users uuu ON i.author_user_id = uuu.id
    LEFT JOIN dtb_gen_issue_types it ON i.issue_type = it.id
    LEFT JOIN dtb_difficulties df ON i.difficulty = df.id
    LEFT JOIN dtb_issues ni ON i.next_issue_id = ni.id
    LEFT JOIN dtb_issue_statuses ns ON i.next_kick_status = ns.id
    LEFT JOIN dtb_users nu ON i.next_user_id = nu.id
    WHERE i.developer_id = $developer_id AND i.project_id = $porjectid $query"));


    //CSV DOWNLOAD PORTION STARTS

    $filename = 'issuelist.csv';
    $execute = fopen($filename, 'w+');
   // chmod($filename,0600);
   // $execute = fopen($filename, 'r+');
    
    fprintf($execute, chr(0xEF).chr(0xBB).chr(0xBF));
    fputcsv($execute, ['Project Name', 'Issue Title', 'Create Date', 'Created By', 'Issue Type', 'App', 'Status', 'Priority', 'Assign To', 'Category', 'Version', 'Start Date', 'End Date', 'Progress', 'Estimate 1', 'Actual Time', 'Difficulty', 'Next Issue', 'Next Kick Status', 'Next User', 'Issue Detail']);

    fputs($execute, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));


    foreach ($issueslist as $row) {
        fputcsv($execute, [
            $row->project_name,
            $row->issue_title,
            date('d-m-y', strtotime($row->created_at)),
            $row->cratedby,
            $row->issuetypename,
            $row->app_name,
            $row->status_name,
            $row->priority_name,
            $row->assignee,
            $row->category_name,
            $row->version_name,
            date('d-m-Y', strtotime($row->start_date)),
            date('d-m-Y', strtotime($row->deadline)),
            $row->progress.'0',
            $row->estimate_hour1,
            $row->estimate_hour2,
            $row->difficultyname,
            $row->nextissue,
            $row->nxtstatsname,
            $row->nxtuser,
            str_replace( array( '\'', '#', '##', '###', '####', '#####' , '######', '<', '>', '****', '**', '#', '~~~~', '* * *', '*', '* [ ]', '|  |', '| --- |', '![alt text]()', '![alt text]', '[ ]()', '``', '``` ```', '/[\r\n]*/', '|', '(//', '|:--|', ':--', '\n', '\r'), ' ', $row->issue_text),
        ]);
    }

    fclose($execute);
    $header = [
        'Content-Type' => 'text/csv',
    ];
    $nameoffile = "DMS-".date("Ymd-His").".csv";

    return Response::download($filename, $nameoffile, $header)->deleteFileAfterSend(true);

}




}


