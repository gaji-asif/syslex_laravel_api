<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbWiki;
use App\DtbWikiAttachment;
use App\DtbActivityLog;
use DB;
use Session;
use Storage;
use Illuminate\Support\Facades\Input;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


class DtbWikiController extends Controller
{


    public function index($id)
    {
                //session existance checking
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Wiki'
        );
        
        $loggedindeveloper = Session::get('developer_id');
        // $wikilist = DtbWiki::first();

        return view('wiki.index',compact('id','loggedindeveloper','common_array'));

    }


    public function create($id)
    {
        
        $common_array = array(
            'content_heading' => 'Wiki Create'
        );

        $loggedindeveloper = Session::get('developer_id');
        return view('wiki.create',compact('id','loggedindeveloper','common_array'));
    }


    public function store(Request $request,$id)
    {
     
        $data = request()->validate([
            'title'=>'required',
            'description'=> 'required',
            'project_id'=> '',
        ]);

        if ($data) {
            DtbWiki::create($data);
            DtbActivityLog::updateActivityLogPro('added', 'wiki', $id);
            //return redirect('project/'.$id.'/wiki/create')->with('message', 'Data has been submitted!');
            // $wikilist = DtbWiki::latest()->where('id',$wikiid)->first();
            return redirect('project/'.$id.'/wiki');
        }else{
            return redirect('wiki.index')->with('message', 'Something went wrong,try again please');
        }



    }


    public function show($id,$wikiid)
    {

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Wiki'
        );

        $loggedindeveloper = Session::get('developer_id');
        $wikilist = DtbWiki::where('id',$wikiid)->first();
        return view('wiki.show',compact('id','loggedindeveloper','wikilist','wikiid','common_array'));
    }

    public function download(){

        $bucket = Config::get('filesystems.disks.s3.bucket');
        $s3 = Storage::disk('s3');
        $s3->getDriver()->getAdapter()->getClient()->getObjectUrl($bucket, $key);  

      $fileName = 'fileName';
      $downloadUrl = $s3->getObjectUrl('developmanage', '3Ejc4bngnR6Y93f10x51vxzbl6SgmZzyx0EorYts.jpeg', '+5 minutes', array(
    'ResponseContentDisposition' => 'attachment; filename="' . $fileName . '"',
    ));
    }


public function edit($id,$wikiid)
{

        if (!Session()->has('user_id')) {
            return redirect('login');
        }


    $common_array = array(
        'content_heading' => 'Wiki Edit'
    );

    $wikilist = DtbWiki::where('id',$wikiid)->first();
    return view('wiki.edit',compact('id','wikiid','wikilist','common_array'));
}


public function update(Request $request, $id,$wikiid)
{
    $data = request()->validate([
        'project_id'=>'required',
        'title'=> 'required',
        'description'=> '',
    ]);

    $wikisingledata = DtbWiki::where('id',$wikiid)->first();
        // $appdata->project_id  = $request->get('project_id');
    $wikisingledata->title = $request->get('title');
    $wikisingledata->description = $request->get('description');
    $wikisingledata->save();
    DtbActivityLog::updateActivityLogPro('updated', 'wiki', $id);

    $loggedindeveloper = Session::get('developer_id');
    $wikilist = DtbWiki::where('id',$wikiid)->first();

        //return view('wiki.show',compact('id','loggedindeveloper','wikilist','wikiid'));
    return redirect('project/'.$id.'/wiki/'.$wikiid)->with('message', 'Data has been submitted!');
}



public function destroy(Request $request,$id)
{
    DtbWiki::find($request->wikipageid)->delete($request->wikipageid);
    DtbActivityLog::updateActivityLogPro('deleted', 'wiki', $id);
    echo "Record has been deleted";
}  


public function deletewikiattachment(Request $request)
{
    DtbWikiAttachment::find($request->wikiid)->delete($request->wikiid);
    DtbActivityLog::updateActivityLog('deleted', 'wiki attachment');
    echo "Record has been deleted";
}



public function filestore(Request $request,$id,$wikiid)
{
    $cloud_front_path = "";
    $userImageFile = "";

    $image = $request->file('file');
    // $imageName = time().$image->getClientOriginalName();
    $imageName = $image->getClientOriginalName();

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';
    $userImageFile = Storage::disk('s3')->put('wikifiles', $request->file('file'));
    
    if ($userImageFile) {

        $insertdata = DB::insert('insert into dtb_wiki_attachments (wiki_id,file_name,file_path) values (?, ?,?)', [$wikiid, $imageName, $cloud_front_path.$userImageFile]);

        if ($insertdata) {
             //return redirect('project/'.$id.'/wiki/35')->with('message', 'Data has been submitted!');
             //return response()->json($upload_success, 200);
            //echo "success";
        }
        
    }
    else
    {
        return response()->json('error', 400);
    }
}




public function search(Request $request,$id)
{

    if (!Session()->has('user_id')) {
        return redirect('login');
    }

    $common_array = array(
        'content_heading' => 'Wiki Search result'
    );


    $q = Input::get ( 'q' );
            //$wikilist = DtbWiki::where('id',$wikiid)->first();
            //$searchedwiki = DtbWiki::where('project_id',$id)->where( 'title', 'LIKE', '%' . $q . '%' )->orWhere( 'description', 'LIKE', '%' . $q . '%' )->get ();
    $searchedwiki = DtbWiki::where( 'title', 'LIKE', '%' . $q . '%' )->where('project_id',$id)->orWhere( 'description', 'LIKE', '%' . $q . '%' )->where('project_id',$id)->get ();
    if (count ( $searchedwiki ) > 0)
        return view ( 'wiki.result',compact('id','common_array') )->withDetails ( $searchedwiki )->withQuery ( $q );
    else
        return view ( 'wiki.result',compact('id','common_array'))->withMessage ( 'No Details found. Try to search again !' );
}



    // tui editor content drag and drop or select file upload
public function upload(Request $request,$div){

    $image = $request->file('file');
    
    $cloud_front_path = 'https://'.env('AWS_URL') . '/';
    if ($div='wiki'){
        $userImageFile = Storage::disk('s3')->put('wiki', $request->file('file'));
    }else{
        $userImageFile = Storage::disk('s3')->put('wikifiles', $request->file('file'));
    }
   
    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
            // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }
}

}
