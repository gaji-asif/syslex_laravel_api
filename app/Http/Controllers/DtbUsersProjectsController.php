<?php

namespace App\Http\Controllers;

use App\DtbUsersProjects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DtbUsersProjectsController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DtbUsersProjects  $dtbUsersProjects
     * @return \Illuminate\Http\Response
     */
    public function show(DtbUsersProjects $dtbUsersProjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DtbUsersProjects  $dtbUsersProjects
     * @return \Illuminate\Http\Response
     */
    public function edit(DtbUsersProjects $dtbUsersProjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DtbUsersProjects  $dtbUsersProjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DtbUsersProjects $dtbUsersProjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DtbUsersProjects  $dtbUsersProjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(DtbUsersProjects $dtbUsersProjects)
    {
        //
    }
}
