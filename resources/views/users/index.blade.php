@extends('master')
@section('mainContent')

 <div class="page-content-wrapper">
    <!--Main Content-->
        <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title align-items-center"> 
                            <h5>Users List</h5>
                            <a href="{{route('users.create')}}" class="btn btn-success mb-3">Create New</a>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="block table-block mb-4" style="margin-top: 20px;">

                            <div class="row">
                                <div class="table-responsive">
                                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Image</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Plan Type</th>
                                                <th>Ends On</th>
                                                <th>Member Since</th>
                                                <th>Check In</th>
                                                <th>User Type</th>
                                                <th>Status</th>
                                               <!--  <th>Last Online</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Image</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Plan Type</th>
                                                <th>Ends On</th>
                                                <th>Member Since</th>
                                                <th>Check In</th>
                                                <th>User Type</th>
                                                <th>Status</th>
                                                <!-- <th>Last Online</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            @if(isset($allUsers))
                                            @foreach($allUsers as $value)
                                             <tr>
                                                <td>1</td>
                                                <td width="40px" align="center"><img src="{{asset('assets_new/images/workout_1519950433.jpg')}}" style="width: 40px; height: 40px; padding: 2px;"></td>
                                                <td>{{$value->first_name}}</td>
                                                <td>{{$value->last_name}}</td>
                                                <td>{{$value->package_name}}</td>
                                                <td>{{date('d-m-Y', strtotime($value->ends_on))}}</td>
                                                <td>{{date('d-m-Y', strtotime($value->members_since))}}</td>
                                                <td>27-03-2020</td>
                                                <td>{{$value->role_name}}</td>
                                         
                                                <td class="status">
                                                    <span class="badge badge-pill bg-success">Active</span>
                                                </td>
                                                <td>
                                                   <span class="badge badge-pill bg-success">Edit</span> 
                                                   <span class="badge badge-pill bg-danger">Delete</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection