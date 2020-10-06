<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbProject;
use Session;

class DtbMyProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  view page
     */
    public function index(){
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'All Projects'
        );
        
    	$developer_id = Session::get('developer_id');
//         $projects = DtbProject::where('developer_id',$developer_id)->orderBy('id', 'desc')->get();
    	$projects = DtbProject::getProjects();
    	return view('my_projects', compact('projects', 'common_array'));
    }
}
