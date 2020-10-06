<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbNotice;
use App\DtbDevelopGroup;
use App\DtbActivityLog;
use Storage;

class DtbNoticeController extends Controller
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
        return view('settings.developerSettings.notice.index',compact('loggedindeveloper','dtbdevelopgroup', 'common_array'));
    }



    public function create($id)
    {
       
    }


    public function store(Request $request)
    {

        // $data = request()->validate([
        //     'noticeeditor'=>'required',
        // ]);


        // DtbNotice::create($data);
        //  return redirect('notice/')->with('status', 'Data has been submitted!');
    }



    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        //
    }



    public function update(Request $request, $id)
    {

        $data = request()->validate([
            'notice'=>'',
        ]);

      //$loggedindeveloper = Session::get('developer_id');
      $dtbdevelopgroup = DtbDevelopGroup::where('id',$id)->first();
      $dtbdevelopgroup->notice = $request->get('notice');
      $dtbdevelopgroup->save();
      DtbActivityLog::updateActivityLog('updated', 'notice');
       return redirect('notice/')->with('message', 'Notice has been updated!');


    }

    public function noticeUpload(Request $request){
        $cloud_front_path = "";
        $userImageFile = "";
        
        $image = $request->file('file');
        $cloud_front_path = env('AWS_URL') . '/';
        $userImageFile = Storage::disk('s3')->put('notice', $request->file('file'));

        if ($userImageFile) {
            echo "//" . $cloud_front_path.$userImageFile;
           // echo $host = request()->getHost();
        }else{
            echo "File not uploaded,please try again";
        }
        
    }

    public function destroy($id)
    {
        //
    }
}
