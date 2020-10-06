<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DtbTimezone;
use App\MtbTimezone;
use App\MtbLanguage;
use App\DtbDevelopGroup;
use Session;
use App\DtbActivityLog;

class DtbTimezoneController extends Controller
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
        
        $loggedindeveloper = Session::get('developer_id');

        $timezonelist = MtbTimezone::all();
        $languagelist = MtbLanguage::all();
        $dtbdevelopgroup = DtbDevelopGroup::where('id',$loggedindeveloper)->first();
        return view('settings.developerSettings.timezone.index',compact('timezonelist','languagelist','dtbdevelopgroup', 'common_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('settings.timezone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'default_lang'=>'required',
            'timezone_id'=> 'required',
        ]);

        // DtbTimezone::create($data);

        $devgroupid= $request->get('develop_group_id');
        $DtbDevelopGroup = DtbDevelopGroup::find($devgroupid);
        $DtbDevelopGroup->default_lang  = $request->get('default_lang');
        $DtbDevelopGroup->time_zone_id  = $request->get('timezone_id');
        $DtbDevelopGroup->save();
        
        // Updating the session timzone
        session()->forget('developertimezone');
        Session::put('developertimezone', $request->get('timezone_id'));

        DtbActivityLog::updateActivityLog('added', 'space');
        return redirect('timezone')->with('status', 'Time zone has been setted');

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
        // DB::table('magazine_details')->insert(
        // []
        // );

        // $devgroupid= $request->get('develop_group_id');
        // $DtbDevelopGroup = DtbDevelopGroup::find($devgroupid);
        // $DtbDevelopGroup->time_zone_id  = $request->get('id');
        // $DtbDevelopGroup->save();


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
