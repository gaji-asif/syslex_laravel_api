<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\DtbUserSkill;

class DtbUserSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    public function create()
    {
        //
    }



    public function store(Request $request)
    {

        if (empty(Input::get('user_id2'))) {

            return back()->with('msg', 'Something went wrong!');

        }else{

            $data = request()->validate([
                'name'=>'required',
                'technical'=>'',
                'sence'=>'',
                'comprehend'=>'',
                'communication'=>'',
                'quality'=>'',
                'speed'=>'',
                'total'=>'',
                'comment'=>'',
            ]);

            $DtbUserSkill = new DtbUserSkill;
            $DtbUserSkill->user_id = Input::get('user_id2');
            $DtbUserSkill->name = Input::get('name');
            $DtbUserSkill->technical = Input::get('technical');
            $DtbUserSkill->sence = Input::get('sence');
            $DtbUserSkill->comprehend = Input::get('comprehend');
            $DtbUserSkill->communication = Input::get('communication');
            $DtbUserSkill->quality = Input::get('quality');
            $DtbUserSkill->speed = Input::get('speed');
            $DtbUserSkill->total = Input::get('total');
            $DtbUserSkill->comment = Input::get('comment');
            $DtbUserSkill->save();
            return back()->with('msg', 'Skill added successfully!');

        }

       
    }

   

    public function show($id)
    {
        //
    }

 

    public function edit($id)
    {
        return view('settings/developerSettings/managemember/edit',compact('id'));
    }

 

    public function update(Request $request, $id)
    {


            $memberid = Input::get('user_id2');

            $data = request()->validate([
                'name'=>'required',
                'technical'=>'',
                'sence'=>'',
                'comprehend'=>'',
                'communication'=>'',
                'quality'=>'',
                'speed'=>'',
                'total'=>'',
                'comment'=>'',
            ]);


            $DtbUserSkill = DtbUserSkill::where('id',$id)->first();
            
            $DtbUserSkill->name = Input::get('name');
            $DtbUserSkill->technical = Input::get('technical');
            $DtbUserSkill->sence = Input::get('sence');
            $DtbUserSkill->comprehend = Input::get('comprehend');
            $DtbUserSkill->communication = Input::get('communication');
            $DtbUserSkill->quality = Input::get('quality');
            $DtbUserSkill->speed = Input::get('speed');
            $DtbUserSkill->total = Input::get('total');
            $DtbUserSkill->comment = Input::get('comment');
            $DtbUserSkill->save();
            return redirect('/managemember/'.$memberid)->with('msg', 'Data has been updated!');

    }



    public function destroy(Request $request,$id)
    {

        DtbUserSkill::find($request->skillid)->delete($request->skillid);
        // return redirect('/managemember/'.$request->memberid)->with('msg', 'Data has been updated!');

    }
}
