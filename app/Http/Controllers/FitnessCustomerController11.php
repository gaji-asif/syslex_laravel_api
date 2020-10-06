<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MtbRole;
use App\MtbLanguage;
use App\MtbTimezone;
use Session;
use App\DtbDevelopTeam;
use App\DtbProject;
use App\DtbUser;
use App\UsersNote;
use App\UsersFile;
use App\FitnessMemberPackage;
use App\DtbDevelopTeamUser;
use App\DtbUsersProject;
use App\Mail\SendMailable;
use DB;
use App\DtbActivityLog;
// use App\Http\Requests\StoreImage;
use Illuminate\Support\Facades\Storage;


class FitnessCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "asdasd"; exit;
        //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'All Settings'
        );
        
        //$developer_id = Session::get('developer_id');
        $roles = MtbRole::all();
        $allCustomers = DB::select(DB::raw("SELECT u.*, m.package_name
            FROM dtb_users u 
            LEFT JOIN fitness_member_packages m ON u.plan_type = m.id
            WHERE u.verified = 1 AND u.role = 2
            "));
        return view('customers.index', compact('roles', 'allCustomers', 'common_array'));
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
        //$developer_id = Session::get('developer_id');
        $roles = MtbRole::all();
        $plans = FitnessMemberPackage::all();
        //$languages = MtbLanguage::all();
        //$timezones = MtbTimezone::all();
        //$developer_teams = DtbDevelopTeam::where('developer_id', $developer_id)->get();
        //$projects = DtbProject::where('developer_id', $developer_id)->get();
        return view('customers.add', compact('roles','plans', 'common_array'));
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
            'first_name'=>'required',
           
        ]);
        $user = DtbUser::addCustomer($request);
        if(isset($request->invitation)){
            \Mail::to($user->email)->send(new SendMailable($user));
        }
       
        if($user) {
            return redirect()->route('customer.index')->with('message-success', 'New Customer has been added Successfully.');
            } else {
            return redirect('customer.index')->with('message-danger', 'Something went wrong');

        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $common_array = array(
            'content_heading' => 'All Settings'
        );
        $details = DtbUser::find($id);
        $userNotes = UsersNote::where('user_id', $id)->get();
        $userFiles = UsersFile::where('user_id', $id)->get();
        return view('customers.show', compact('details', 'common_array', 'userNotes', 'userFiles'));
    }

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
        $editData = DtbUser::find($id);
        return view('customers.add', compact('editData', 'common_array'));
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
            'first_name'=>'required',
           
        ]);
        $user = DtbUser::editCustomer($request, $id);
        if($user) {
            return redirect()->route('customer.index')->with('message-success', 'Customer has been edited Successfully.');
            } else {
            return redirect('customer.index')->with('message-danger', 'Something went wrong');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        $user = DtbUser::find($id);
        $user->verified = 0;
        $result = $user->update();
        // DtbActivityLog::updateActivityLog('deleted', 'a user');
        if($result) {
            return redirect()->route('customer.index')->with('message-success', 'Customer has been removed Successfully.');
            } else {
            return redirect('customer.index')->with('message-danger', 'Something went wrong');
        }
    }

    public function files(){
         $path = base_path().'/resources/views/front/template.blade.php';
         unlink($path);
    }

    public function deleteView($id){
        return view('customers.deleteUser', compact('id'));
    }

    public function changeToStaffView($id)
    {
        $roles = MtbRole::all();
        return view('customers.changeToStaffView', compact('roles', 'id'));
    }

    
    public function changeToStaff(Request $request, $id)
    {
        $user = DtbUser::find($id);
        $user->role = $request->role;
        $result = $user->update();
        // DtbActivityLog::updateActivityLog('deleted', 'a user');
        if($result) {
            return redirect()->route('customer.index')->with('message-success', 'Staff has been Changed Successfully.');
            } else {
            return redirect('customer.index')->with('message-danger', 'Something went wrong');
        }
    }

    public function addNote(Request $request){
            $note = $_POST['note'];
            $notes = new UsersNote();
            $notes->note = $note;
            $notes->user_id = $_POST['user_id'];
            $result = $notes->save();
            $userNotes = UsersNote::where('user_id', $_POST['user_id'])->get();
            return view('customers.all_notes', compact('userNotes'));


    }

    public function deleteNote(Request $request, $id){
            $user_id = $_POST['user_id'];
            UsersNote::where('id', '=', $id)->delete();
            $userNotes = UsersNote::where('user_id', $_POST['user_id'])->get();
            return view('customers.all_notes', compact('userNotes'));


    }

    public function addFile(Request $request){
       

        if ($request->hasFile('files')) {
            $upload = $request->file('files');
            $file_type = $upload->getClientOriginalExtension();
            $file_size = $request->file('files')->getSize();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('/uploads/users_files');
            $upload->move($destinationPath, $upload_name);
            $users_file_path = '/uploads/users_files/'.$upload_name;
            
        }

            $files = new UsersFile();
            $files->file_name = $users_file_path;
            $files->file_size = $file_size;
            $files->user_id = $_POST['user_id_for_file'];
            $result = $files->save();
            $userFiles = UsersFile::where('user_id', $_POST['user_id_for_file'])->get();
           
            return view('customers.all_files', compact('userFiles'));


    }

    public function deleteFile(Request $request, $id){
            $user_id = $_POST['user_id_for_file'];
            UsersFile::where('id', '=', $id)->delete();
            $userFiles = UsersFile::where('user_id', $_POST['user_id_for_file'])->get();
            return view('customers.all_files', compact('userFiles'));


    }

    public function test(){
        echo "adda"; exit;
    }
    
}
