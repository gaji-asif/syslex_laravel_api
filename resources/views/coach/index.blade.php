@extends('master')
@section('mainContent')

 <div class="page-content-wrapper">
    <!--Main Content-->
        <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title align-items-center"> 
                            <h5>Coach List ({{count($allCoaches)}})</h5>
                            <a href="{{route('coach.create')}}" class="btn btn-primary mb-3">Create New</a>
                        </div>
                    </div>

                    <div class="col-12">
                        @if(session()->has('message-success'))
                        <div class="alert alert-success mb-10 background-success" role="alert">
                          {{ session()->get('message-success') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        @endif
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
                                                <th>Email</th>
                                                <th>Invited On</th>
                                               
                                                <th>Ends On</th>
                                                <th>Member Since</th>
                                               
                                               
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
                                                <th>Email</th>
                                                <th>Invited On</th>
                                               
                                                <th>Ends On</th>
                                                <th>Member Since</th>
                                               
                                               
                                                <th>Status</th>
                                               <!--  <th>Last Online</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            @php $sl = 1; @endphp
                                            @if(isset($allCoaches))
                                            @foreach($allCoaches as $value)
                                             <tr>
                                                <td>{{ $sl++}}</td>
                                                <td align="center">

                                                     @php $icon_image_path = ""; @endphp
            @if(!empty($value->icon_image_path))

           <img src="{{asset($value->icon_image_path)}}" alt="" class="d-block ui-w-80" id="profileDisplay" style="width: 40px; height: 40px; padding: 2px;">
            @else
            <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-80" id="profileDisplay" style="width: 40px; height: 40px; padding: 2px;">
            @endif

                                                </td>
                                                <td>{{$value->first_name}}</td>
                                                <td>{{$value->last_name}}</td>
                                                <td>{{$value->email}}</td>
                                                <td>
                                                    @if($value->invite_status == 1)
                                                    <span class="badge badge-pill bg-success">Send</span>
                                                    @else
                                                    <span class="badge badge-pill bg-danger">Not Sent</span>
                                                    @endif
                                                </td>
                                                
                                                
                                                <td>-<!-- {{ date('d-m-Y', strtotime($value->ends_on))}} --></td>
                                                <td>-<!-- {{date('d-m-Y', strtotime($value->members_since))}} --></td>
                                               
                                               
                                         
                                                <td class="status">
                                                    @if($value->is_archived == 0)
                                                    <span class="badge badge-pill bg-success">Active</span>
                                                    @else
                                                    <span class="badge badge-pill bg-danger">InActive</span>
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                  <!--  <span class="badge badge-pill bg-success">Edit</span> 
                                                   <span class="badge badge-pill bg-danger">Delete</span> -->

                                                   <a href="{{route('coach.show', $value->id )}}" class="btn btn-primary">View Detail</a>
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