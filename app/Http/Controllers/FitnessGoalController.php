<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbUser;
use App\FitnessGoal;
use App\Mail\SendMailable;
use DB;
// use App\Http\Requests\StoreImage;
use Illuminate\Support\Facades\Storage;


class FitnessGoalController extends Controller
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
        $goals = FitnessGoal::all();
        return view('goal.index', compact('goals','common_array'));
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
        
        return view('goal.add', compact('common_array'));
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
            'goal_name'=>'required',
           
        ]);

        if ($request->hasFile('upload_document')) {
            $upload = $request->file('upload_document');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('/uploads/goals');
            $upload->move($destinationPath, $upload_name);
            $goal_image = '/uploads/goals/'.$upload_name;
            
        }
        else{
            $goal_image = '';
        }

    
        $goals = new FitnessGoal;
        $goals->goal_name = $request->goal_name;
        $goals->goal_image = $goal_image;
        $result = $goals->save();
       
       
        if($result) {
            return redirect()->route('goal.index')->with('message-success', 'New Goal has been added Successfully.');
            } else {
            return redirect('goal.index')->with('message-danger', 'Something went wrong');

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
    // public function edit($id)
    // {
    //     $common_array = array(
    //         'content_heading' => 'All Settings'
    //     );
    //     $editData = DtbUser::find($id);
    //     return view('customers.add', compact('editData', 'common_array'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'first_name'=>'required',
           
    //     ]);
    //     $user = DtbUser::editCustomer($request, $id);
    //     if($user) {
    //         return redirect()->route('customer.index')->with('message-success', 'Customer has been edited Successfully.');
    //         } else {
    //         return redirect('customer.index')->with('message-danger', 'Something went wrong');

    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteGoalView($id){
        return view('goal.deleteGoalView', compact('id'));
    }


   public function destroy($id)
    {
        $result = FitnessGoal::where('id',$id)->delete();
        // DtbActivityLog::updateActivityLog('deleted', 'a user');

        if($result) {
            return redirect()->route('goal.index')->with('message-success', 'Goal has been removed Successfully.');
            } else {
            return redirect('goal.index')->with('message-danger', 'Something went wrong');
        }
    }

    

    
    
}
