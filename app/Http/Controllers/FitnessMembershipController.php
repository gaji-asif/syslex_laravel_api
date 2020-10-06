<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbUser;
use App\FitnessContensPlan;
use App\FitnessWorkoutCategory;
use App\FitnessContent;
use App\FitnessGoal;
use App\Mail\SendMailable;
use App\FitnessMemberPackage;
use DB;
// use App\Http\Requests\StoreImage;
use Illuminate\Support\Facades\Storage;
use App\FitnessFeature;
use App\FitnessMemberFeature;



class FitnessMembershipController extends Controller
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

        //$developer_id = Session::get('developer_id');
        $plans = FitnessMemberPackage::all();
        return view('membership.index', compact('plans','common_array'));
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
        $featuresLists = FitnessFeature::all();
        
        return view('membership.add', compact('common_array', 'featuresLists'));
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
            'package_name'=>'required',
           
        ]);

        $packages = new FitnessMemberPackage;
        $packages->package_name = $request->package_name;
        $packages->package_value = $request->package_value;
        $packages->timeframe = $request->timeframe;
        $packages->description = $request->description;
      
        $result = $packages->save();
        // $LastInsertId = $contents->id;

        $LastInsertId = $packages->id;

       

        if(!empty($request->feature_id)){
            for($x=0; $x<count($request->feature_id); $x++){
                $members_features = new FitnessMemberFeature;
                $members_features->member_id = $LastInsertId;
                $members_features->feature_id = $request->feature_id[$x];
                $results = $members_features->save();
            }
        }

        if($result) {
            return redirect()->route('memberships.index')->with('message-success', 'New Membership has been added Successfully.');
            } else {
            return redirect('memberships.index')->with('message-danger', 'Something went wrong');

        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $common_array = array(
    //         'content_heading' => 'All Settings'
    //     );
    //     $details = DtbUser::find($id);
    //     $userNotes = UsersNote::where('user_id', $id)->get();
    //     $userFiles = UsersFile::where('user_id', $id)->get();
    //     return view('customers.show', compact('details', 'common_array', 'userNotes', 'userFiles'));
    // }

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

        $editData = FitnessMemberPackage::find($id);
        $featuresLists = FitnessFeature::all();
        $membersFeaturelists = FitnessMemberFeature::where('member_id', $id)->get();
        
        return view('membership.add', compact('editData', 'featuresLists', 'common_array', 'membersFeaturelists'));
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
            'package_name'=>'required',
           
        ]);

        $packages = FitnessMemberPackage::find($id);
        $packages->package_name = $request->package_name;
        $packages->package_value = $request->package_value;
        $packages->timeframe = $request->timeframe;
        $packages->description = $request->description;
        $result = $packages->save();

        DB::table('fitness_member_features')->where('member_id', $id)->delete();
        if(!empty($request->feature_id)){
            for($x=0; $x<count($request->feature_id); $x++){
                $members_features = new FitnessMemberFeature;
                $members_features->member_id = $id;
                $members_features->feature_id = $request->feature_id[$x];
                $results = $members_features->save();
            }
        }

        if($result) {
            return redirect()->route('memberships.index')->with('message-success', 'Membership has been updated Successfully.');
            } else {
            return redirect('memberships.index')->with('message-danger', 'Something went wrong');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteMembershipView($id){
        return view('membership.deleteMembershipView', compact('id'));
    }


   public function destroy($id)
    {
        $result = FitnessMemberPackage::where('id',$id)->delete();
        // DtbActivityLog::updateActivityLog('deleted', 'a user');

        if($result) {
            return redirect()->route('memberships.index')->with('message-success', 'Membership has been removed Successfully.');
            } else {
            return redirect('memberships.index')->with('message-danger', 'Something went wrong');
        }
    }

    

    
    
}
