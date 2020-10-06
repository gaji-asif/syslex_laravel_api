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
use DB;


// use App\Http\Requests\StoreImage;
use Illuminate\Support\Facades\Storage;
use App\FitnessMemberPackage;


class FitnessContentController extends Controller
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
        $allContents = FitnessContent::all();
        return view('content.index', compact('allContents','common_array'));
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
        $goals = FitnessGoal::all();
        $membeshipPackages = FitnessMemberPackage::all();
        $workout_category = FitnessWorkoutCategory::all();
        return view('content.add', compact('goals','workout_category','membeshipPackages', 'common_array'));
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
            'content_name'=>'required',
           
        ]);

        // if ($request->hasFile('upload_document')) {
        //     $upload = $request->file('upload_document');
        //     $file_type = $upload->getClientOriginalExtension();
        //     $upload_name =  time() . $upload->getClientOriginalName();
        //     $destinationPath = public_path('/uploads/contents');
        //     $upload->move($destinationPath, $upload_name);
        //     $goal_image = '/uploads/contents/'.$upload_name;
            
        // }
        // else{
        //     $goal_image = '';
        // }

    
        $contents = new FitnessContent;
        $contents->content_name = $request->content_name;
        $contents->goal_id = $request->goal;
        $contents->cat_id = $request->category;
        $contents->description = $request->workout_description;
        $contents->notes = $request->workout_notes;
        $contents->video_link = $request->video_link;
        $result = $contents->save();
        $LastInsertId = $contents->id;

       

        if(!empty($request->plan_id)){
            for($x=0; $x<count($request->plan_id); $x++){
                $assignPlans = new FitnessContensPlan;
                $assignPlans->content_id = $LastInsertId;
                $assignPlans->plan_id = $request->plan_id[$x];
                $results = $assignPlans->save();
            }
        }
       
       
        if($result) {
            return redirect()->route('content.index')->with('message-success', 'New Content has been added Successfully.');
            } else {
            return redirect('content.index')->with('message-danger', 'Something went wrong');

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
        $editData = FitnessContent::find($id);
        $goals = FitnessGoal::all();
        $workout_category = FitnessWorkoutCategory::all();
        $membeshipPackages = FitnessMemberPackage::all();
        
        $contentsPlans = FitnessContensPlan::where('content_id', $id)->get();
        return view('content.add', compact('editData','membeshipPackages','contentsPlans', 'goals','workout_category', 'common_array'));
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
            'content_name'=>'required',
           
        ]);
        if ($request->hasFile('upload_document')) {
            $upload = $request->file('upload_document');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('/uploads/contents');
            $upload->move($destinationPath, $upload_name);
            $goal_image = '/uploads/contents/'.$upload_name;
            
        }
        else{
            $contentsVideo = FitnessContent::find($id);
            $goal_image = $contentsVideo->video_link;
        }

    
        $contents = FitnessContent::find($id);
        $contents->content_name = $request->content_name;
        $contents->goal_id = $request->goal;
        $contents->cat_id = $request->category;
        $contents->description = $request->workout_description;
        $contents->notes = $request->workout_notes;
        // $contents->video_link = $goal_image;
        $contents->video_link = $request->video_link;
        $result = $contents->save();

        DB::table('fitness_contens_plans')->where('content_id', $id)->delete();
        if(!empty($request->plan_id)){
            for($x=0; $x<count($request->plan_id); $x++){
                $assignPlans = new FitnessContensPlan;
                $assignPlans->content_id = $id;
                $assignPlans->plan_id = $request->plan_id[$x];
                $results = $assignPlans->save();
            }
        }
       
       
        if($result) {
            return redirect()->route('content.index')->with('message-success', 'New Content has been updated Successfully.');
            } else {
            return redirect('content.index')->with('message-danger', 'Something went wrong');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteCategoryView($id){
        return view('category.deleteCategoryView', compact('id'));
    }


   public function destroy($id)
    {
        $result = FitnessWorkoutCategory::where('id',$id)->delete();
        // DtbActivityLog::updateActivityLog('deleted', 'a user');

        if($result) {
            return redirect()->route('workout_category.index')->with('message-success', 'Category has been removed Successfully.');
            } else {
            return redirect('workout_category.index')->with('message-danger', 'Something went wrong');
        }
    }

    

    
    
}
