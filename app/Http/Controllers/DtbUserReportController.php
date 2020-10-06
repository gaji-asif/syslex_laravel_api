<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

use Storage;
use Illuminate\Support\Facades\Input;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;



class DtbUserReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'User Report'
        );


        $loggedindeveloper = Session::get('developer_id');
        return view('settings.developerSettings.userreport.index',compact('loggedindeveloper','common_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($reportid)
    {
        
        
        $reports = \DB::table('dtb_daily_report')
                     ->Where('id',$reportid)
                    // ->whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                    ->first();
         return view('settings.developerSettings.userreport.show',compact('reports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($reportid)
    {
        $reports = \DB::table('dtb_daily_report')
                     ->Where('id',$reportid)
                    // ->whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                    ->first();
        return view('settings.developerSettings.userreport.edit',compact('reports'));
    }




    public function update(Request $request,$reportid)
    {

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $developer_id = session()->get('developer_id');
        $user_id = session()->get('user_id');

        if ($developer_id !== "" && $user_id !== "") {

            $data = request()->validate([
                'date'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
                'working_time'=>'',
                'todays_work'=>'',
                'tomorrows_work'=>'',
                'notice'=>'',
            ]);


          $timefrom = substr_replace($request->get('start_time') ,"",-2);
          $timeto = substr_replace($request->get('end_time') ,"",-2);
          $start_time = $timefrom;
          $end_time = $timeto;
          $v =  strtotime($end_time) - strtotime($start_time);
          $toalworkingtime = date("h:i", $v);

            
        DB::table('dtb_daily_report')
        ->where('id',$reportid)
        ->update(['developer_group_id' => $developer_id, 'user_id' => $user_id, 'date' => $request->get('date'), 'working_start_time' => $request->get('start_time'), 'working_end_time' => $request->get('end_time'), 'working_time' => $toalworkingtime, 'todays' => $request->get('todays_work'), 'tomorrows' => $request->get('tomorrows_work'), 'notice' => $request->get('notice'), 'created_at' => NOW(), 'updated_at' => NOW()]
            );

            return back()->with('message', 'Report has been Updated!');

        }else{
            return back()->with('message', 'Something went wrong!');

        }



    }




    public function destroy(Request $request)
    {
        $reportid =  $request->get('reportid');
        DB::delete('delete from dtb_daily_report where id = ?',[$reportid]);
        echo "done";
    }




    public function getreportlist(Request $request){

        $selectedmonth =  $request->get('monthid');

        if($request->ajax()){


                if (!empty($selectedmonth)) {
                
                    $reportlists = \DB::table('dtb_daily_report as r')
                    ->Where('date', 'like', '%' . $selectedmonth . '%')
                    ->where('user_id',session()->get('user_id'))
                    ->get();
                    if ($reportlists->isEmpty()) {
                        $html='';
                        $html='<p class="notfoundmsg">Report not found in this month!</p>';
                        return $html;
                    }else{
                    $html='';
                    foreach ($reportlists as $reportlist) {
                        
                        $html.='<div class="ui-timeline-item">
                                <a href="'.route('report.show', [$reportlist->id]).'" class="text-body" style="color: #718AA8 !important">';
                        $html.='<div class="ui-timeline-info text-right small font-weight-semibold">'
                        . substr_replace($reportlist->date ,"",-8).'</div>';
                        $html.='<div class="ui-timeline-badge ui-w-40">
                                  <div class="ui-square bg-success rounded-circle text-white" style="background: #718AA8 !important">
                                    <div class="d-flex ui-square-content">
                                      <div class="ion ion-md-list-box m-auto"></div>
                                    </div>
                                  </div>
                                </div>';
                        $html.='<div class="card card-condenced">
                                  <div class="card-body py-2">
                                    <div class="text-big font-weight-bold mb-2">
                                      <span class="text-body" style="color: #718AA8 !important">Work Report</span>
                                    </div>
                                    <div class="text-muted">
                                      Click here to see details
                                    </div>
                                  </div>
                                </div>';
                        $html.=' </a></div>';

                    }
                    return $html;
                }
                }else{ 
                    
                }

        }else{



        }





    }

    public function reportcreate(){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        return view('settings.developerSettings.userreport.create');
    }

    public function reportstore( request $request){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $developer_id = session()->get('developer_id');
        $user_id = session()->get('user_id');

        if ($developer_id !== "" && $user_id !== "") {

            $data = request()->validate([
                'date'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
                'working_time'=>'',
                'todays_work'=>'',
                'tomorrows_work'=>'',
                'notice'=>'',
            ]);


          $timefrom = substr_replace($request->get('start_time') ,"",-2);
          $timeto = substr_replace($request->get('end_time') ,"",-2);

          $start_time = $timefrom;
          $end_time = $timeto;
          $v =  strtotime($end_time) - strtotime($start_time);
          $toalworkingtime = date("h:i", $v);


            DB::table('dtb_daily_report')->insert(
            ['developer_group_id' => $developer_id, 'user_id' => $user_id, 'date' => $request->get('date'), 'working_start_time' => $request->get('start_time'), 'working_end_time' => $request->get('end_time'), 'working_time' => $toalworkingtime, 'todays' => $request->get('todays_work'), 'tomorrows' => $request->get('tomorrows_work'), 'notice' => $request->get('notice'), 'created_at' => NOW(), 'updated_at' => NOW()]
            );

            return back()->with('message', 'Report has been created!');

        }else{
            return back()->with('message', 'Something went wrong!');

        }





    }



public function editorfiles(Request $request){

    $image = $request->file('file');

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';

    $userImageFile =Storage::disk('s3')->put('wikifiles', $request->file('file'));

    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
            // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }
} 

public function uploadtomorrowreportfile(Request $request){

    $image = $request->file('file');

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';

    $userImageFile =Storage::disk('s3')->put('wikifiles', $request->file('file'));

    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
            // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }
} 

public function uploadnoticefile(Request $request){

    $image = $request->file('file');

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';

    $userImageFile =Storage::disk('s3')->put('wikifiles', $request->file('file'));

    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
            // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }
} 

    

public function reportlists(){
  return view('settings.developerSettings.manageuserreport.index');
}


function managereportsrch(Request $request)
{

  $developer_id = session()->get('developer_id');
   if(request()->ajax())
   {

       // $developer_id = session()->get('developer_id');

       $developer_id = Session::get('developer_id');
       $query = '';

       

       if(isset($request->user)){
          $query .= "AND dr.user_id = '$request->user'";
       }else{
       }

       if(isset($request->team)){
          $query .= "AND t.team_id = '$request->team'";
       }else{
       }

       if(isset($request->monthlist)){
          $query .= "AND dr.date Like '%$request->monthlist%'";
 
       }else{
        //initial selected motnh
       $currentmonth = date('Y-m');
       $query .= "AND dr.date Like '%$currentmonth%'";
       }

   
     
      $data = DB::select(DB::raw("SELECT dr.*,u.name as username
            FROM dtb_daily_report as dr
            INNER JOIN dtb_develop_team_users as t ON dr.user_id = t.user_id
            LEFT JOIN dtb_users as u ON dr.user_id = u.id
            WHERE dr.developer_group_id = $developer_id $query GROUP BY dr.id"));


      // $data = DB::table('dtb_daily_report')
      //   ->where(function($query) use ($user, $monthlist) {
      //     if($monthlist)
      //     $query->where('date','LIKE',"%{$monthlist}%");
      //     if($user)
      //       $query->where('user_id', $user);    

      //     if($team)
      //       $query->where('user_id', $team);
      //   })
      //   ->get();


    return datatables()->of($data)->editColumn('date', function ($data){
    // return date('d/m/Y', strtotime($data->date) );


     if(Session()->get('language_id') == 1){
       return  date('m-d-Y', strtotime($data->date));
     }

     if(Session()->get('language_id') == 15){
       return  date('m-d-Y', strtotime($data->date));
     }

     if(Session()->get('language_id') == 53){
       return  date('Y-m-d', strtotime($data->date));
     }

    })->editColumn('updated_at', function ($data){
        //return date('d/m/y', strtotime($data->updated_at) );
      if(Session()->get('language_id') == 1){
       return  date('m-d-Y', strtotime($data->updated_at));
     }

     if(Session()->get('language_id') == 15){
       return  date('m-d-Y', strtotime($data->updated_at));
     }

     if(Session()->get('language_id') == 53){
       return  date('Y-m-d', strtotime($data->updated_at));
     }
    })->editColumn('todays', function ($data){

    // $parser = new \cebe\markdown\GithubMarkdown();
    // $parser->html5 = true;
    // $parser->enableNewlines = true;
    // $parser->keepListStartNumber = true;
    // return $parser->parse($data->todays);

        return substr($data->todays, 0,110 ). " ....";
    })->editColumn('tomorrows', function ($data){
        return substr($data->tomorrows, 0,110 ). " ....";
    })->editColumn('working_start_time', function ($data){
        return $data->working_start_time;
    })->editColumn('working_end_time', function ($data){
        return $data->working_end_time;
    })->editColumn('working_time', function ($data){
      
        if (!empty($data->working_time)) {
         return  $data->working_time;
        }else{
          return '00:00';
        }
        
        //return strtotime($data->working_time);
    })->editColumn('notice', function ($data){
        return substr($data->notice, 0,110 ). " ....";
    })->make(true);


  }


      $dailyreportlist = DB::select(DB::raw("SELECT dr.*,u.name as username
            FROM dtb_daily_report as dr
            LEFT JOIN dtb_users as u ON dr.user_id = u.id
            WHERE dr.developer_group_id = $developer_id"));


   return view('settings.developerSettings.manageuserreport.index', compact('dailyreportlist','totalworkinghrofmnth'));


}



function monthlyreporthour(Request $request)
{


    if(request()->ajax())
       {

           $developer_id = Session::get('developer_id');

           $query = '';

           if(isset($request->user)){
              $query .= "AND r.user_id = '$request->user'";
           }else{
           }

           if(isset($request->monthlist)){
              $query .= "AND r.date Like '%$request->monthlist%'";

            }


          // $total_time = \DB::table('dtb_daily_report as r')
          // //->Where('date', 'like', '%' . $request->monthlist . '%')
          // ->whereRaw("r.developer_group_id = $developer_id $query ");
          // ->sum(DB::raw("TIME_TO_SEC(r.working_time)"));
          $total_time = \DB::table('dtb_daily_report as r')->whereRaw("r.developer_group_id = $developer_id $query")->sum(DB::raw("TIME_TO_SEC(r.working_time)"));
          //return $hours = $total_time / 3600;
          return $hours = " <strong>".floor($total_time / 3600)."</strong> hr" . "   " . "<strong>". gmdate("i", $total_time % 3600)."</strong> mnts";


      $data = DB::select(DB::raw("SELECT dr.*,u.name as username
            FROM dtb_daily_report as dr
            WHERE dr.developer_group_id = $developer_id $query GROUP BY dr.id"));

    }else{}




}



public function csvprevent(){
  echo "silence is golden ";
}




}
