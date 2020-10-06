@extends('master')
@section('mainContent')
<style type="text/css">
.error_message{
  display: none;
}
.aestric{
  color: red;
}
</style>

<div class="page-content-wrapper">
  <!--Main Content-->
  <div class="sm-gutter">
    <div class="container-fluid padding-25 sm-padding-10">
      <div class="row">
        <div class="col-md-12 mb-4"><a href="{{route('customer.index')}}" class="btn btn-primary btn-sm">Go Back</a></div>

        <div class="col-12">
          <div class="block-heading d-flex align-items-center title-pages">
             @if(isset($editData))
             <h5 class="text-truncate">Edit Customer</h5>
              @else
               <h5 class="text-truncate">Add Customer</h5>
              @endif
            
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-block mb-4">
            <!-- <form enctype="multipart/form-data" action="#" method="post"> -->
              @if(isset($editData))
              {{ Form::open(['class' => '', 'files' => true, 'url' => 'customer/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
              @else
              {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'customer',
              'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
              @endif

              <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
              <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
              <input type="hidden" name="emailCheck_url" id="emailCheck_url" value="emailCheck">

              <div class="form-row">
                <div class="form-group col-md-12">
                  <div class="block col-md-12">

                     @if(isset($editData))
                     <label class="control-label">Image</label>
                    <div class="new-image img-responsive" id="image-preview">
                      <img src="{{asset($editData->icon_image_path)}}" style="object-fit:cover;">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="upload_document" id="image-upload"/>
                    </div>
                     @else
                     <label class="control-label">Image<font class="aestric"> (*)</font></label>
                    <div class="new-image" id="image-preview">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="upload_document" id="image-upload"/>
                    </div>
                     @endif

                    
                    <!-- <span class="text-danger recomendedsize">Recommended size: <b>550 x 350</b> </span> -->

                    <div class="row">
                                        <!-- <div class="col-md-4">
                                            <label class="control-label">Member ID:</label>
                                            <input type="text" class="form-control" disabled="disabled">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Own Member ID:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Custom export field:</label>
                                            <input type="text" class="form-control">
                                          </div> -->
                                          <div class="col-md-4">
                                            <label class="control-label">First Name<font class="aestric"> (*)</font></label>
                                            <input type="text" class="form-control" name="first_name" required="" value="@if(isset($editData)) {{$editData->first_name}} @endif">
                                          </div>
                                          <div class="col-md-4">
                                            <label class="control-label">Last Name<font class="aestric"> (*)</font></label>
                                            <input type="text" class="form-control" name="last_name" required="" value="@if(isset($editData)) {{$editData->last_name}} @endif">
                                          </div>
                                          <div class="col-md-4">
                                            <label class="control-label">Gender</label>
                                            <select class="form-control" name="gender">

                                              <option value="Male" 
                                              @if(isset($editData))
                                              @if($editData->gender == 'male') 
                                              selected  
                                              @endif
                                              @endif
                                              >Male</option>
                                              <option value="Female" 
                                              @if(isset($editData))
                                              @if($editData->gender == 'Female') 
                                              selected  
                                              @endif
                                              @endif
                                              >Female</option>
                                              <option value="Other" 
                                              @if(isset($editData))
                                              @if($editData->Other == 'male') 
                                              selected  
                                              @endif
                                              @endif
                                              >Other</option>
                                            </select>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="control-label">Birthday:</label>
                                            <div class="d-flex">
                                              <input type="text"  maxlength="80" placeholder="Birthday" name="date_of_birth" class="datepicker form-control" value="@if(isset($editData)) {{date('Y-m-d', strtotime($editData->date_of_birth))}} @endif">
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <label class="control-label">Email address:<font class="aestric"> (*)</font></label>
                                            <input type="email" class="form-control" required="" name="email" value="@if(isset($editData)) {{$editData->email}} @endif">
                                          </div>
                                          <div class="col-md-4">
                                            <label class="control-label">Mobile phone:<font class="aestric"> (*)</font></label>
                                            <input type="text" class="form-control" name="mobile" required="" value="@if(isset($editData)) {{$editData->mobile}} @endif">
                                          </div>
                                        <!-- <div class="col-md-4">
                                            <label class="control-label">Subscription reason:</label>
                                            <select class="form-control">
                                              <option>unknown</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Source:</label>
                                            <select class="form-control">
                                              <option>unknown</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Language:</label>
                                            <select class="form-control">
                                              <option value="en" selected="selected">English</option>
                                              <option value="nl">Dutch</option>
                                              <option value="de">German</option>
                                              <option value="es">Spanish</option>
                                              <option value="fr">French</option>
                                              <option value="pt">Portuguese</option>
                                              <option value="it">Italian</option>
                                              <option value="ru">Russian</option>
                                              <option value="tr">Turkish</option>
                                              <option value="pl">Polish</option>
                                              <option value="el">Greek</option>
                                              <option value="lt">Lithuanian</option>
                                              <option value="lv">Latvian</option>
                                              <option value="no">Norsk</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Invoice text:</label>
                                            <select class="form-control">
                                              <option>Default Invoice Text</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Business:</label>
                                            <div class="d-flex align-items-center mt-2 mr-3">
                                              <input type="radio" name="a">
                                              <span class="ml-1 mr-3">No</span>
                                              <input type="radio" name="a">
                                              <span class="ml-1 mr-3">Yes</span>
                                            </div>
                                          </div> -->

                                          <!-- address -->
                                          <div class="col-md-12 mt-5 mb-3 title"><h3>Address Details</h3></div>
                                          <div class="col-md-4">
                                            <label class="control-label">Street address:<font class="aestric"> (*)</font></label>
                                            <input type="text" name="current_address" class="form-control" required="" value="@if(isset($editData)) {{$editData->current_address}} @endif">
                                          </div>

                                          <div class="col-md-4">
                                            <label class="control-label">ZIP code:</label>
                                            <input type="text" class="form-control" name="zipcode" value="@if(isset($editData)) {{$editData->zipcode}} @endif">
                                          </div>
                                          <div class="col-md-4">
                                            <label class="control-label">City:</label>
                                            <input type="text" class="form-control" name="city" value="@if(isset($editData)) {{$editData->city}} @endif">
                                          </div>
                                          <div class="col-md-4">
                                            <label class="control-label">Country:</label>
                                            <select class="form-control" name="country">
                                              @if(isset($editData))
                                              <option value="{{$editData->country}}" selected>{{$editData->country}}</option>
                                              @include('layouts.country')
                                              @else
                                              @include('layouts.country')
                                              @endif
                                             
                                            </select>
                                          </div>

                                          <!-- address -->

                                          <div class="col-md-12 mt-2 mb-2">
                                            @if(isset($editData))

                                            @else
                                             <label class="d-flex align-items-center">
                                              <input type="checkbox" value="1" name="invitation">
                                              <span class="control-label ml-1">Send invitation</span>
                                            </label>

                                            @endif
                                           
                                          </div>
                                        </div>

                                        <div class="action-button mt-3">
                                          @if(isset($editData))
                                          <input type="submit" name="save" value="Update" class="btn btn-embossed btn-primary">
                                          @else
                                          <input type="submit" name="save" value="Create" class="btn btn-embossed btn-primary">
                                          @endif
                                         
                                         <input type="reset" name="reset" value="Reset" class="btn btn-embossed btn-danger">
                                       </div>

                                     </div>
                                   </div>
                                 </div>
                                 {{ Form::close()}}
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>


                     @endsection