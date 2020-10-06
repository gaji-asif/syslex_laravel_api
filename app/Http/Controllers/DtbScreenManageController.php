<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\DtbScreenGroup;
use App\DtbScreenManage;
use App\DtbScreenAction;
use App\DtbScreenItem;
use App\DtbScreen;
use Illuminate\Support\Facades\Storage;
use URL;

use Illuminate\Support\Facades\Input;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


class DtbScreenManageController extends Controller
{



    public function index($id)
    {

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Screen Groups List'
        );

        $developer_id = Session::get('developer_id');

        $screengroup = \DB::table('dtb_screen_groups as s')
        ->leftjoin('dtb_apps as a','s.id', '=', 'a.screen_group_id')
        ->where('s.developer_id',$developer_id)
        ->where('s.project_id',$id)
        ->groupBy('s.id')
        ->orderBy('s.rank','ASC')
        ->get(['s.id','s.project_id','s.screen_group_name','s.updated_at','a.app_name','s.id']);
       //dd($screengroup);


        // $applist = \DB::table('dtb_apps as a')
        // // ->join('dtb_screen_groups as s','a.screen_group_id', '=', 's.id', 'left outer') // to say that it is the left outer join
        // ->join('dtb_screen_groups as s','a.screen_group_id', '=', 's.id')
        // ->where('a.project_id',$id)
        // ->groupBy('a.screen_group_id')
        // ->orderBy('a.ordering','ASC')
        // ->get(['a.*','s.screen_group_name']);

        return view('settings.generalSettings.screenSettings.index',compact('id','common_array','screengroup'));
    }



    public function create()
    {
        //
    }


    public function store($id,Request $request)
    {

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'screen_group_name'=>'required',
        ]);

        DB::table('dtb_screen_groups')->insert(
            ['developer_id' => $developer_id, 'project_id' => $id, 'screen_group_name' => $request->get('screen_group_name')]
        );
        return back()->with('message', 'Data has been added!');



    }


    public function show($id,$screengroupid)
    {

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Screen List'
        );
        $developer_id = Session::get('developer_id');

        $screenlist = \DB::table('dtb_screens as s')
        ->leftjoin('dtb_screen_groups as sg','s.screengroup_id', '=', 'sg.id')
        ->where('s.screengroup_id',$screengroupid)
        ->where('s.developer_id',$developer_id)
        ->where('s.project_id',$id)
        ->orderBy('s.rank','ASC')
        ->get(['s.*','sg.screen_group_name']);
        return view('settings.generalSettings.screenSettings.show',compact('screenlist','id','screengroupid','common_array'))->with('message', 'Data has been updated!');

    }



    public function edit($id)
    {
        //
    }



    public function update(Request $request, $id)
    {

        $screengrp = \DB::table('dtb_screen_groups')
        ->where('id',$request->grpid)
        ->update(['screen_group_name'=> $request->get('screen_group_name')]);
        return back()->with('message', 'Data has been Updated!');
    }



    public function destroy($id)
    {

    }




public function editorfiles(Request $request){

    $image = $request->file('file');

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';

    $userImageFile =Storage::disk('s3')->put('screenattachment', $request->file('file'));

    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
            // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }
}



    public function updateOrder(Request $request){

    $developer_id = Session::get('developer_id');
    // $screengroup = \DB::table('dtb_screen_groups')
    //     ->where('developer_id',$developer_id)
    //     ->get();

    $screengroup = DtbScreenGroup::all();

        foreach ($screengroup as $screengroups) {

            $screengroups->timestamps = false; // To disable update_at field updation
            $id = $screengroups->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $screengroups->update(['rank' => $order['position']]);
                }
            }

        }

         return response('Update Successfully.', 200);

    }



    public function screenorder(Request $request){

    $developer_id = Session::get('developer_id');
    // $screengroup = \DB::table('dtb_screen_groups')
    //     ->where('developer_id',$developer_id)
    //     ->get();

    $screenall = DtbScreen::all();

        foreach ($screenall as $screens) {

            $screens->timestamps = false; // To disable update_at field updation
            $id = $screens->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $screens->update(['rank' => $order['position']]);
                }
            }

        }

         return response('Update Successfully.', 200);

    }


    public function screensingle($id,$screengroupid,$screenid){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Screen Details'
        );

        $developer_id = Session::get('developer_id');


        $screenlistitem = \DB::table('dtb_screens as s')
        ->where('s.function_group_name',$screengroupid)
        ->get(['s.id']);

        $screendetails = \DB::table('dtb_screens as s')
        ->leftjoin('dtb_screen_groups as sg','s.screengroup_id', '=', 'sg.id')
        ->leftjoin('dtb_projects as p','s.project_id', '=', 'p.id')
        ->where('s.id',$screenid)
        ->where('s.screengroup_id',$screengroupid)
        ->where('s.developer_id',$developer_id)
        ->where('s.project_id',$id)
        ->select('s.*','sg.screen_group_name','p.project_name')
        ->first();

        if (empty($screendetails)) {
           return back();
        }else{

            $screenitems = \DB::table('dtb_screen_items as i')
            // ->leftjoin('dtb_screen_groups as sg','s.function_group_name', '=', 'sg.id')
            ->where('screen_id',$screenid)
            ->orderBy('ordering','asc')
            ->get();

            $screenactions = \DB::table('dtb_screen_actions as a')
            // ->leftjoin('dtb_screen_groups as sg','s.function_group_name', '=', 'sg.id')
            ->where('screen_id',$screenid)
            ->get();


            $rank = DtbScreen::where('id', $screenid)->where('screengroup_id',$screengroupid)->first();

            $previous = DtbScreen::where('rank', '<', $rank->rank)->where('screengroup_id',$screengroupid)->max('rank');
            $next = DtbScreen::where('rank', '>', $rank->rank)->where('screengroup_id',$screengroupid)->min('rank');


            return view('settings.generalSettings.screenSettings.screensingle',compact('id','screengroupid','screenid','screendetails','screenitems','screenactions','screenlistitem','rank'))->with('previous', $previous)->with('next', $next);

        }
    }


    public function screenranked($id,$screengroupid,$rank){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Screen Details'
        );

        $developer_id = Session::get('developer_id');


        $screenlistitem = \DB::table('dtb_screens as s')
        ->where('s.function_group_name',$screengroupid)
        ->get(['s.id']);




        $screendetails = \DB::table('dtb_screens as s')
        ->leftjoin('dtb_screen_groups as sg','s.screengroup_id', '=', 'sg.id')
        ->leftjoin('dtb_projects as p','s.project_id', '=', 'p.id')
        ->where('s.rank',$rank)
        ->where('s.screengroup_id',$screengroupid)
        ->where('s.developer_id',$developer_id)
        ->where('s.project_id',$id)
        ->select('s.*','sg.screen_group_name','p.project_name')
        ->first();

        if (empty($screendetails)) {
           return back()->with('message', 'oops! wrong value provided');
        }else{

            $screenid = $screendetails->id;

            $screenitems = \DB::table('dtb_screen_items as i')
            // ->leftjoin('dtb_screen_groups as sg','s.function_group_name', '=', 'sg.id')
            ->where('screen_id',$screenid)
            ->orderBy('ordering','asc')
            ->get();

            $screenactions = \DB::table('dtb_screen_actions as a')
            // ->leftjoin('dtb_screen_groups as sg','s.function_group_name', '=', 'sg.id')
            ->where('screen_id',$screenid)
            ->get();

            $previous = DtbScreen::where('rank', '<', $rank)->where('screengroup_id',$screengroupid)->where('developer_id',$developer_id)->max('rank');
            $next = DtbScreen::where('rank', '>', $rank)->where('screengroup_id',$screengroupid)->where('developer_id',$developer_id)->min('rank');

            return view('settings.generalSettings.screenSettings.screensingle',compact('id','screengroupid','screenid','screendetails','screenitems','screenactions','screenlistitem','rank'))->with('previous', $previous)->with('next', $next);
        }

    }



    public function screencreate($id,$screengroupid){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $developer_id = Session::get('developer_id');

        // $screengrouplist = \DB::table('dtb_screen_groups')
        // ->where('project_id',$id)
        // ->where('developer_id',$developer_id)
        // ->get();

        return view('settings.generalSettings.screenSettings.screencreate',compact('id','screengroupid'));
    }


    public function screenstore ($id,$screengroupid,Request $request){

        $screenlist = \DB::table('dtb_screens as s')
        ->leftjoin('dtb_screen_groups as sg','s.function_group_name', '=', 'sg.id')
        ->where('s.function_group_name',$screengroupid)
        ->orderBy('s.rank','ASC')
        ->get(['s.*','sg.screen_group_name']);

        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'project_id'=>'',
            'screen_group_id'=>'',
            'screengroup_id'=>'',
            'function_group_name'=>'required',
            'screen_name'=>'required',
            'estimate'=>'',
            'content2bSavedHolder'=>'',
        ]);


        $imageName='';

        if (!empty($request->file('image_url'))) {

            // $image = $request->file('image_url');
            // $imageName = time().$image->getClientOriginalName();
            // $upload_success = $image->move(public_path('uploads/screenattachment'),$imageName);
            // $cloud_front_path = "";
            // $screenimgfile = "";

            $cloud_front_path = 'https://'.env('AWS_URL') . '/';
            $userImageFile = Storage::disk('s3')->put('screenattachment', $request->file('image_url'));
            $lastrank = '';

            if ($userImageFile) {

            $lastrank = DtbScreen::where('screengroup_id',$screengroupid)->where('developer_id',$developer_id)->max('rank');

            DB::table('dtb_screens')->insert(
            ['developer_id' => $developer_id, 'project_id' => $id, 'screengroup_id' => $request->get('screen_group_id'), 'function_group_name' => $request->get('function_group_name'), 'screen_name' => $request->get('screen_name'), 'detail' => $request->get('screen_group_name'), 'detail' => $request->get('detail'), 'image_url' => $cloud_front_path.$userImageFile, 'estimate' => $request->get('estimate'), 'rank' => $lastrank+1,'detail' => $request->get('detail')]
            );

            //return redirect('settings.generalSettings.screenSettings.show',compact('screenlist','id','screengroupid','common_array'))->with('message', 'Data has been Saveds!');
            return redirect('/project/'.$id.'/screengroup/'.$request->get('screen_group_id'))->with('message', 'Data has been submitted!',['screenlist' => $screenlist,'id' => $id,'screengroupid' => $screengroupid]);
            //return back()->with('message', 'Data has been Submitted!');
            }

        }else{

        $lastrank = DtbScreen::where('screengroup_id',$screengroupid)->where('developer_id',$developer_id)->max('rank');

         DB::table('dtb_screens')->insert(
            ['developer_id' => $developer_id, 'project_id' => $id, 'screengroup_id' => $request->get('screen_group_id'), 'function_group_name' => $request->get('function_group_name'), 'screen_name' => $request->get('screen_name'), 'detail' => $request->get('screen_group_name'), 'detail' => $request->get('detail'), 'image_url' => $imageName, 'estimate' => $request->get('estimate'), 'rank' => $lastrank+1, 'detail' => $request->get('detail')]
            );

            return redirect('/project/'.$id.'/screengroup/'.$request->get('screen_group_id'))->with('message', 'Data has been submitted!',['screenlist' => $screenlist,'id' => $id,'screengroupid' => $screengroupid]);

        }

        // foreach ($image as $img) {
            // echo $img;
        // }




    }


    public function addscreenaction(Request $request){

        $data = request()->validate([
            'action_name'=>'',
            'action_type'=>'',
            'actiondetails'=>'',
            'screenid'=>''
        ]);

        DB::table('dtb_screen_actions')->insert(
            ['screen_id' => $request->get('screenid'), 'action_name' => $request->get('action_name'), 'action_type' => $request->get('action_type'), 'details' => $request->get('actiondetails')]
        );
        return back()->with('message', 'Data has been Added!');

    }


    public function editscreenaction(Request $request){


        $data = request()->validate([
            'actionname'=>'',
            'actiontype'=>'',
            'actionid'=>'',
            'actioneditdetails'=>'',
            'screenids'=>''
        ]);


        DB::table('dtb_screen_actions')
        ->where('id',$request->get('actionid'))
        ->update(
            ['screen_id' => $request->get('screenids'),'action_name' => $request->get('actionname'), 'action_type' => $request->get('actiontype'), 'details' => $request->get('actioneditdetails')]
        );
        echo "done";


    }



    public function getscreenactions(Request $request){

        if (!empty($request->get('screenid'))) {

        $screenactions = \DB::table('dtb_screen_actions as a')
        ->where('screen_id',$request->get('screenid'))
        ->orderBy('ordering','asc')
        ->get();
         $html='';
        foreach ($screenactions as $prolog) {
             $html.='<textarea class="detailedit" rows="10" cols="82" style="display:none;">'.$prolog->details.'</textarea>';
            $html.='<tr class="row1" data-id="'. $prolog->id .'" id="'.$prolog->id.'"> ';
            $html.='<td class="py-0 sorting_1 " ><div style="display: flex;color: #00000063;margin-left: 3px;margin-top: 4px"> <i class="fas fa-th-list d-block"></i></div></td>';
            $html.='<td>'.$prolog->action_name.'</td>';
            $html.='<td>'.$prolog->action_type.'</td>';
            $html.='<td style="word-break:break-all">'.$prolog->details.'</td>';


            $html.='<td style="display:flex">'.'<a href="#" editdataactionid="'.$prolog->id.'"  editdataactionname="'.$prolog->action_name.'" editdataactiontype="'.$prolog->action_type.'" editactiondetails="'.$prolog->details.'" id="editactionid"  data-toggle="modal" data-target="#actioneditmodal"> <span class="far fa-edit d-block"></span></a> '.'</td>';
            $html.='</tr>';
        }
        return $html;

        }else{

        }


    }



    public function screenActiondelete(Request $request)
    {
        //DB::table('dtb_issues')->where('id', $issue_id)->delete();
        DB::delete('delete from dtb_screen_actions where id = ?',[$request->get('actionid')]);
        echo "done";
    }

    public function screenItemActiondelete(Request $request)
    {
        //DB::table('dtb_issues')->where('id', $issue_id)->delete();
        DB::delete('delete from dtb_screen_items where id = ?',[$request->get('itemid')]);
        echo "done";
    }

     public function screendelete(Request $request)
    {
        //DB::table('dtb_issues')->where('id', $issue_id)->delete();
        DB::delete('delete from dtb_screens where id = ?',[$request->get('screenid')]);
        echo "done";
    }



    public function screenitemadd(Request $request){

        $data = request()->validate([
            'item_name'=>'',
            'screenids'=>'',
            'item_controll_name'=>'',
            'display'=>'',
            'color'=>'',
            'action'=>''
        ]);

        DB::table('dtb_screen_items')->insert(
            ['item_name' => $request->get('item_name'), 'screen_id' => $request->get('screenids'), 'item_controll_name' => $request->get('item_controll_name'), 'display' => $request->get('display'), 'color' => $request->get('color'), 'action' => $request->get('action')]
        );
        return 'success';


    }


    public function screenitemedit(Request $request){
        $data = request()->validate([
            'item_name'=>'',
            'itemid'=>'required',
            'item_controll_name'=>'',
            'display'=>'',
            'color'=>'',
            'action'=>'',
            'screenid'=>''
        ]);

        DB::table('dtb_screen_items')
        ->where('id',$request->get('itemid'))
        ->update(
            ['item_name' => $request->get('item_name'), 'screen_id' => $request->get('screenid'), 'item_controll_name' => $request->get('item_controll_name'), 'display' => $request->get('display'), 'color' => $request->get('color'), 'action' => $request->get('action')]
        );
        echo "done";
        //return back()->with('message', 'Data has been Updated!');
        // return redirect('/project/'.$id.'/screengroup/'.$request->get('screen_group_id'))->with('message', 'Data has been updated!',['screenlist' => $screenlist,'id' => $id,'screengroupid' => $screengroupid]);

    }




    public function getscreenitems(Request $request){

        if (!empty($request->get('screenid'))) {

        $screenitem = \DB::table('dtb_screen_items as i')
        ->where('screen_id',$request->get('screenid'))
        ->get();
         $html='';
        foreach ($screenitem as $items) {
            $html.='<div class="text-center small">'.$items->item_name.'</div>';
        }
        return $html;

        }else{
        }


    }


    public function screensingleedit($id,$screengroupid,$screenid){

        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Screen Details'
        );


        $developer_id = Session::get('developer_id');


         $screendetails = \DB::table('dtb_screens as s')
        ->leftjoin('dtb_screen_groups as sg','s.screengroup_id', '=', 'sg.id')
        ->where('s.id',$screenid)
        ->where('s.developer_id',$developer_id)
        ->where('s.project_id',$id)
        ->select('s.*','sg.screen_group_name')
        ->first();



        return view('settings.generalSettings.screenSettings.screenedit',compact('id','screengroupid','screenid','screendetails'));

    }






    public function screensingleupdate($id,$screengroupid,$screenid,Request $request){

        $screenlist = \DB::table('dtb_screens as s')
                ->leftjoin('dtb_screen_groups as sg','s.function_group_name', '=', 'sg.id')
                ->where('s.function_group_name',$screengroupid)
                ->orderBy('s.rank','ASC')
                ->get(['s.*','sg.screen_group_name']);

        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'project_id'=>'',
            'screen_group_id'=>'',
            'screengroup_id'=>'',
            'function_group_name'=>'required',
            'screen_name'=>'required',
            'estimate'=>'',
            'content2bSavedHolder'=>'',
        ]);



        $imageName='';


        $cloud_front_path = "";
        $userImageFile = "";

        if (!empty($request->file('image_url'))) {

            // $image = $request->file('image_url');
            // $imageName = time().$image->getClientOriginalName();
            // $upload_success = $image->move(public_path('uploads/screenattachment'),$imageName);


            $cloud_front_path = 'https://'.env('AWS_URL') . '/';
            $userImageFile = Storage::disk('s3')->put('screenattachment', $request->file('image_url'));


            if ($userImageFile) {


            DB::table('dtb_screens')
            ->where('id',$screenid)
            ->update(
            ['developer_id' => $developer_id, 'project_id' => $id, 'screengroup_id' => $request->get('screen_group_id'), 'function_group_name' => $request->get('function_group_name'), 'screen_name' => $request->get('screen_name'), 'detail' => $request->get('screen_group_name'), 'detail' => $request->get('detail'), 'image_url' =>$cloud_front_path.$userImageFile, 'estimate' => $request->get('estimate'), 'detail' => $request->get('detail')]
            );


            //return redirect('settings.generalSettings.screenSettings.show',compact('screenlist','id','screengroupid','common_array'))->with('message', 'Data has been Saveds!');
            return redirect('/project/'.$id.'/screengroup/'.$request->get('screen_group_id'))->with('message', 'Data has been updated!',['screenlist' => $screenlist,'id' => $id,'screengroupid' => $screengroupid]);
            //return back()->with('message', 'Data has been Submitted!');
            }

        }else{

            DB::table('dtb_screens')
            ->where('id',$screenid)
            ->update(
            ['developer_id' => $developer_id, 'project_id' => $id, 'screengroup_id' => $request->get('screen_group_id'), 'function_group_name' => $request->get('function_group_name'), 'screen_name' => $request->get('screen_name'), 'detail' => $request->get('screen_group_name'), 'detail' => $request->get('detail'), 'image_url' => $request->get('oldattachment'), 'estimate' => $request->get('estimate'), 'detail' => $request->get('detail')]
            );

            return redirect('/project/'.$id.'/screengroup/'.$request->get('screen_group_id'))->with('message', 'Data has been updated!',['screenlist' => $screenlist,'id' => $id,'screengroupid' => $screengroupid]);

        }




    }





    public function actionorderupdate(Request $request){

     // $actions = \DB::table('dtb_screen_actions')
     //    // ->where('screen_id',$request->get('screenid'))
     //    ->get();
        $actions = DtbScreenAction::all();

        foreach ($actions as $actionupdate) {

            $actionupdate->timestamps = false; // To disable update_at field updation
            $id = $actionupdate->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $actionupdate->update(['ordering' => $order['position']]);
                    // DB::table('dtb_screen_actions')->update([
                    //     'ordering' => $order['position'],
                    // ]);
                }
            }

        }

         return response('Update Successfully.', 200);

    }


    public function itemorderupdate(Request $request){

        $items = DtbScreenItem::all();
        foreach ($items as $itemupdate) {
            $itemupdate->timestamps = false; // To disable update_at field updation
            $id = $itemupdate->id;
            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $itemupdate->update(['ordering' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);

    }



        // tui editor content drag and drop or select file upload
    public function actioneditorfiles(Request $request){

        $cloud_front_path = "";
        $userImageFile = "";

        $image = $request->file('file');

        //$imageName = time().$image->getClientOriginalName();
        //$upload_success = $image->move(public_path('uploads/appfiles'),$imageName);

        $cloud_front_path ='https://'.env('AWS_URL') . '/';
        $userImageFile = Storage::disk('s3')->put('screenattachment', $request->file('file'));

        if ($userImageFile) {
            echo $cloud_front_path.$userImageFile;
           // echo $host = request()->getHost();
        }else{
            echo "File not uploaded,please try again";
        }

    }






}
