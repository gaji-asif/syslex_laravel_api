@extends('master')
@section('mainContent')

 <div class="page-content-wrapper">


        <!--Main Content-->
        <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="block-heading d-flex align-items-center title-pages">
                            <h5 class="text-truncate">New User</h5>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-block mb-4">
                            <form enctype="multipart/form-data" action="#" method="post">

                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <div class="block col-md-12" style="padding-bottom: 35px">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">First Name</label>
                                            <input type="text" value="" maxlength="80" placeholder="First Name" name="first-name" class="form-control" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" value="" maxlength="80" placeholder="Last Name" name="last-name" class="form-control" required="">
                                        </div>
                                    </div>

                                    <label class="control-label">User Type</label>
                                   <select class="form-control" name="user_type" required="">
                                       <option value="">Select User Type</option>
                                       @foreach($roles as $value)
                                       <option value="{{$value->id}}">{{$value->role_name}}</option>
                                       @endforeach
                                       
                                      
                                    </select>


                                   <label class="control-label">Plan Type</label>
                                   <select class="form-control" name="bodypart_id" required="">
                                       <option value="">Plan Type</option>
                                       @foreach($plans as $value)
                                       <option value="{{$value->id}}">{{$value->package_name}}</option>
                                       @endforeach
                                    </select>

                                   <label class="control-label">Ends On</label>
                                   <input type="text" value="" maxlength="80" placeholder="Ends On" name="ends-on" class="datepicker form-control" required="">

                                  <label class="control-label">Member Since</label>
                                   <input type="text" value="" maxlength="80" placeholder="Member Since" name="member-since" class="datepicker form-control" required="">

                                   <label class="control-label">Check In</label>
                                   <input type="text" value="" placeholder="Check In" name="check-in" class="form-control" required="">

                                    <!-- <label class="control-label">Status</label>
                                    <select class="form-control" name="status" required="">
                                        <option value="active" selected="">Active</option>
                                        <option value="active_and_user_id">Active, with profile</option>
                                        <option value="active_without_user_id">Active, without profile</option>                                                                                 <option value="active_with_account_manager">Active, with account manager</option>                                           <option value="active_without_account_manager">Active, without account manager</option>                                         <option value="active_with_unsigned_contract">Active, with unsigned contract</option>                                           <option value="with_membership">Active, with membership</option>                                            <option value="with_paused_membership">Active, membership paused</option>                                           <option value="ending_membership">Active, membership ending</option>                                            <option value="without_membership">Active, without membership</option>                                      <option value="with_tag">Active, with tag</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="inactive_with_tag">Inactive, with tag</option>
                                        <option value="all">All</option>
                                    </select> -->


                                <label class="control-label">Image</label>
                                <div class="new-image" id="image-preview">
                                  <label for="image-upload" id="image-label">Choose File</label>
                                  <input type="file" name="exercise_image" id="image-upload" required="" />
                                </div>

                                <span class="text-danger recomendedsize">Recommended size: <b>550 x 350</b> </span>
                                <br/>
                                <br/>

                               <div class="action-button">
                               <input type="submit" name="save" value="Submit" class="btn btn-embossed btn-primary">
                               <input type="reset" name="reset" value="Reset" class="btn btn-embossed btn-danger">
                               </div>

                            </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection