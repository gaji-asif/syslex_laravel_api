<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Storage;
use Session;
use App\DtbDevelopGroup;
use App\DtbUser;
use App\DtbActivityLog;

class DtbSpaceController extends Controller
{



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
        $dtbdevelopgroup = DtbDevelopGroup::where('id',$loggedindeveloper)->firstOrFail();
        $dtbuser = DtbUser::where('developer_id',$loggedindeveloper)->firstOrFail();
        //$dtbdevelopgroup = DtbDevelopGroup::find($loggedindeveloper);
        return view('settings.developerSettings.space.index',compact('common_array','dtbdevelopgroup','dtbuser'));
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
    public function update(Request $request)
    {
        
       
        $data = request()->validate([
            'space_name'=>'required',
            'space_owner_user_id'=>'required',
            'logo_image_path'=>'',
        ]);


        $cloud_front_path = "";
        $userImageFile = "";
        //if no image chosen then imgpath will get hidden field name oldimg
        if (empty(request('logo_image_path'))) {

            $userImageFile = request('oldimg');
        }
        else
        {
            
            $cloud_front_path = 'https://'.env('AWS_URL') . '/';
            $userImageFile = Storage::disk('s3')->put('spaceimage', $request->logo_image_path);

        }



      $loggedindeveloper = Session::get('developer_id');
      $dtbdevelopgroup = DtbDevelopGroup::where('id',$loggedindeveloper)->first();
      $dtbdevelopgroup->space_name = $request->get('space_name');
      $dtbdevelopgroup->space_owner_user_id = $request->get('space_owner_user_id');
      $dtbdevelopgroup->logo_image_path = $cloud_front_path.$userImageFile;
      $dtbdevelopgroup->save();
      DtbActivityLog::updateActivityLog('updated', 'space');
      return redirect('space')->with('message', 'Issue has been updated!');



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
