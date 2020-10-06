<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;

class DtbVelocityController extends Controller
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
            'content_heading' => 'Valocity'
        );


        //$current_month = date('Ym');
        //$previous_month = date('Ym', strtotime("-1 month"));
        $developer_id = Session::get('developer_id');

        $date = Carbon::now();
        $current_month = $date->format('Ym'); 
        $previous_month = $date->submonth()->format('Ym');

        $velocityResult = DB::select(DB::raw("SELECT p.id, p.project_name,(SELECT SUM(estimate_hour1) FROM dtb_issues WHERE project_id = p.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$previous_month')) as previous_velocity,
            (SELECT SUM(estimate_hour1) FROM dtb_issues WHERE project_id = p.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$current_month')) as velocity
            FROM dtb_projects p 
            WHERE p.developer_id = $developer_id
            order by velocity DESC
            "));

         $Membersvelocity = DB::select(DB::raw("
            SELECT u.id, u.name,u.is_archived,(SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$previous_month')) as previous_velocity,
            (SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$current_month')) as velocity
            FROM dtb_users u 
            WHERE u.developer_id = $developer_id AND u.is_archived = 0 order by velocity DESC
            "));

         $current_date = date('M-Y');

       return view('velocity.index', compact('velocityResult', 'Membersvelocity', 'current_date', 'current_month','common_array'));
    }

    public function velocitySearch($date,$par){
        $developer_id = Session::get('developer_id');
        if($par == 'p'){
            $current_month = Carbon::parse($date)->submonth()->format('Y-m');
            $search_current_month = Carbon::parse($date)->subMonth()->format('Ym');
            $search_previous_month = Carbon::parse($date)->subMonth(2)->format('Ym');
        }
        else{
            $current_month = Carbon::parse($date)->addMonth()->format('Y-m');
            $search_current_month = Carbon::parse($date)->addMonth()->format('Ym');
            $search_previous_month = Carbon::parse($date)->format('Ym');
        }

        

         $velocityResult = DB::select(DB::raw("SELECT p.id, p.project_name,(SELECT SUM(estimate_hour1) FROM dtb_issues WHERE project_id = p.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$search_previous_month')) as previous_velocity,
            (SELECT SUM(estimate_hour1) FROM dtb_issues WHERE project_id = p.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$search_current_month')) as velocity
            FROM dtb_projects p 
            WHERE p.developer_id = $developer_id
            order by velocity DESC
            "));

         
         $Membersvelocity = DB::select(DB::raw("
            SELECT u.id, u.name,u.is_archived,(SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$search_previous_month')) as previous_velocity,
            (SELECT SUM(estimate_hour1) FROM dtb_issues WHERE user_id = u.id AND is_closed = 1 AND (DATE_FORMAT(complete_date, '%Y%m') = '$search_current_month')) as velocity
            FROM dtb_users u 
            WHERE u.developer_id = $developer_id AND u.is_archived = 0 order by velocity DESC
            "));

          //$current_date = date('M-Y');

       return view('velocity.index', compact('velocityResult', 'Membersvelocity', 'current_month'));

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
