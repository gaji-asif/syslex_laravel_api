<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbNews;
use Session;
use DB;
use Illuminate\Support\Facades\Storage;

class DtbNewsController extends Controller
{
 
	public function index(){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'News List'
        );

		$loggedindeveloper = Session::get('developer_id');
		$newslist = DtbNews::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();

		return view('settings.developerSettings.news.index',compact('newslist','common_array'));


	}	


	public function allnews(){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'All Newses'
        );

		$loggedindeveloper = Session::get('developer_id');
		$newslist = DtbNews::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();

		return view('settings.developerSettings.news.allnews',compact('newslist','common_array'));

	}	




    public function show($newsid)
    {

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'News Details'
        );

        $loggedindeveloper = Session::get('developer_id');

        $newsdetails = DtbNews::where('id',$newsid)->first();
        return view('settings.developerSettings.news.show',compact('newsdetails','newsid','common_array'));


    }   



    public function create(Request $request)
    {


        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Create News'
        );


        return view('settings.developerSettings.news.create',compact('common_array'));


    }


    public function store(Request $request)
    {


        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        
        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'title'=>'required',
            'detail'=>'required',
        ]);

        DB::table('dtb_news')->insert(
        ['developer_id' => $developer_id, 'title' => $request->get('title'), 'detail' => $request->get('detail')]);
        return back()->with('message', 'Data has been added!');

       // return view('settings.developerSettings.news.create',compact('common_array'));


    }



    public function edit($newsid,Request $request){

    	if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Edit News'
        );

        $newsdetails = DtbNews::where('id',$newsid)->first();

        return view('settings.developerSettings.news.edit',compact('common_array','newsid','newsdetails'));
    }   


     public function update($newsid,Request $request){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }
        
        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'title'=>'required',
            'detail'=>'required',
        ]);

        DB::table('dtb_news')->where('id',$newsid)->update(
        ['developer_id' => $developer_id, 'title' => $request->get('title'), 'detail' => $request->get('detail')]);
        return back()->with('message', 'Data has been updated!');

    }





     public function updateOrder(Request $request){

	    $loggedindeveloper = Session::get('developer_id');
	    $newslist = DtbNews::where('developer_id',$loggedindeveloper)->get();

	        foreach ($newslist as $newsitem) {

	            $newsitem->timestamps = false; // To disable update_at field updation
	            $id = $newsitem->id;

	            foreach ($request->order as $order) {
	                if ($order['id'] == $id) {
	                    $newsitem->update(['ordering' => $order['position']]);
	                }
	            }

	        }

	    return response('Update Successfully.', 200);

	 }



    // Upload isseue 
public function newsfileupload(Request $request){

    $image = $request->file('file');

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';

    $userImageFile =Storage::disk('s3')->put('newsfiles', $request->file('file'));

    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
            // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }
}  






}
