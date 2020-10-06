@extends('master')
@section('mainContent')

 <div class="page-content-wrapper">
    <!--Main Content-->
        <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title align-items-center"> 
                            <h5>Packages List</h5>
                            <a href="{{route('memberships.create')}}" class="btn btn-primary mb-3">Create New</a>
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
                        <div class="col-12 workout_section">
                        <div class="block">
                            <div class="row">

                                @foreach($plans as $value)
                                <div class="col-md-6 package_details">
                                    <div class="inside">
                                        <div class="title"><h4>{{$value->package_name}}</h4></div>
                                        <div class="price">${{$value->package_value}}<span>/{{$value->  timeframe}}</span></div>
                                        <div class="availiblity">
                                            @php
                        

        $allMemberShipFeatures = DB::select(DB::raw("SELECT fitness_features.* FROM fitness_member_features
        LEFT JOIN fitness_features ON  fitness_member_features.feature_id = fitness_features.id WHERE fitness_member_features.member_id = $value->id"));


                                @endphp
                                             <ul>
                                                @if(isset($allMemberShipFeatures))
                                                @foreach($allMemberShipFeatures as $valuess)
                                                <li>{{$valuess->feature_name}}</li>
                                                @endforeach
                                                @endif
                                            </ul>
                                  
                                        </div>
                                        <div class="buttons">
                                            <a href="{{route('memberships.edit', $value->id)}}" class="btn btn-success"><span class="dripicons-document-edit"></span></a>

                                           

                                             <a href="{{route('delete_membership_view', $value->id )}}" class="btn btn-danger modalLink" title="Are You Sure You want to Delete this ?" data-modal-size="modal-md"> <span class="dripicons-trash"></span></a>


                                        </div>
                                    </div>
                                </div>
                                @endforeach
                               
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection