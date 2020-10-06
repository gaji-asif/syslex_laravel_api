<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbDevelopGroup;
use Session;
class DtbDevelopGroupController extends Controller
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
        //$dtbissue = DtbContact::Issueofloggeduser($loggedindeveloper)->findOrFail($issue);
        // $dtbdevelopgroup = DtbDevelopGroup::where('id',$loggedindeveloper)->first();
        $dtbdevelopgroup = DtbDevelopGroup::findOrFail($loggedindeveloper);
        return view('settings.developerSettings.contact.create',compact('dtbdevelopgroup', 'common_array'));
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
        //     $data = request()->validate([
        //     'developer_id'=>'',
        //     'space_name'=>'',
        //     'default_lang'=>'',
        //     'time_zone_id'=>'',
        //     'space_owner_user_id'=>'',
        //     'logo_image_path'=>'',
        //     'company_name'=>'required',
        //     'company_name_kana'=> 'required',
        //     'charge_person_name'=> 'required',
        //     'charge_person_email'=> 'required',
        //     'charge_person_dept'=> 'required',
        //     'charge_person_position'=> 'required',
        //     'tel'=> 'required',
        //     'zip_code'=> 'required',
        //     'state'=> 'required',
        //     'address'=> 'required',
        //     'url'=> 'required',
        // ]);

        // DtbDevelopGroup::create($data);
        // return redirect('contact')->with('status', 'Data has been submitted!');
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

            $data = request()->validate([
            'developer_id'=>'',
            // 'space_name'=>'',
            // 'default_lang'=>'',
            // 'time_zone_id'=>'',
            // 'space_owner_user_id'=>'',
            // 'logo_image_path'=>'',
            'company_name'=>'required',
            'company_name_kana'=> 'required',
            'charge_person_name'=> 'required',
            'charge_person_email'=> 'required|email',
            'charge_person_dept'=> 'required',
            'charge_person_position'=> 'required',
            'tel'=> 'required|min:11',
            'zip_code'=> 'required|min:4',
            'state'=> 'required',
            'address'=> 'required',
            'url'=> 'required|url',
        ]);

          $DtbDevelopGroup = DtbDevelopGroup::find($id);
          // $DtbDevelopGroup->space_name  = $request->get('space_name');
          // $DtbDevelopGroup->default_lang  = $request->get('default_lang');
          // $DtbDevelopGroup->time_zone_id  = $request->get('time_zone_id');
          // $DtbDevelopGroup->space_owner_user_id  = $request->get('space_owner_user_id');
          // $DtbDevelopGroup->logo_image_path  = $request->get('logo_image_path');
          $DtbDevelopGroup->company_name  = $request->get('company_name');
          $DtbDevelopGroup->company_name_kana  = $request->get('company_name_kana');
          $DtbDevelopGroup->charge_person_name  = $request->get('charge_person_name');
          $DtbDevelopGroup->charge_person_email  = $request->get('charge_person_email');
          $DtbDevelopGroup->charge_person_dept  = $request->get('charge_person_dept');
          $DtbDevelopGroup->charge_person_position  = $request->get('charge_person_position');
          $DtbDevelopGroup->tel  = $request->get('tel');
          $DtbDevelopGroup->zip_code  = $request->get('zip_code');
          $DtbDevelopGroup->state  = $request->get('state');
          $DtbDevelopGroup->address  = $request->get('address');
          $DtbDevelopGroup->url  = $request->get('url');
          $DtbDevelopGroup->save();
          ///echo "data has been updated";
          return redirect('/contact')->with('status', 'Contact informations successfully updated');
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
