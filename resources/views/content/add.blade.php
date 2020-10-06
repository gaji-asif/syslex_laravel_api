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
        <div class="col-md-12 mb-4"><a href="{{route('content.index')}}" class="btn btn-primary btn-sm">Go Back</a></div>

        <div class="col-12">
          <div class="block-heading d-flex align-items-center title-pages">
           @if(isset($editData))
           <h5 class="text-truncate">Edit Content</h5>
           @else
           <h5 class="text-truncate">Add Content</h5>
           @endif

         </div>
       </div>

       <div class="col-md-12">
        <div class="form-block mb-4">
          <!-- <form enctype="multipart/form-data" action="#" method="post"> -->
            @if(isset($editData))
            {{ Form::open(['class' => '', 'files' => true, 'url' => 'content/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
            @else
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'content',
            'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            @endif


            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">


            <div class="form-row">
              <div class="form-group col-md-12">
                <div class="block col-md-12">



                  <div class="row" style="padding-left: 14px; padding-right: 14px;">

                    <div class="col-md-4">
                      <label class="control-label">Content Name<font class="aestric"> (*)</font></label>
                      <input type="text" class="form-control" name="content_name" required="" value="@if(isset($editData)) {{$editData->content_name}} @endif">
                    </div>

                    <div class="col-md-4">
                      <label class="control-label">Goal</label>
                      <select class="form-control" name="goal">
                        <option value="">Select</option>
                        @foreach($goals as $value)
                        <option value="{{$value->id}}" 
                          @if(isset($editData))
                          @if($editData->goal_id == $value->id) 
                          selected  
                          @endif
                          @endif
                          >{{$value->goal_name}}</option>

                          @endforeach

                        </select>
                      </div>
                      <div class="col-md-4">
                        <label class="control-label">Category</label>
                        <select class="form-control" name="category">
                          <option value="">Select</option>
                          @foreach($workout_category as $value)
                          <option value="{{$value->id}}" 
                            @if(isset($editData))
                            @if($editData->cat_id == $value->id) 
                            selected  
                            @endif
                            @endif
                            >{{$value->cat_name}}</option>

                            @endforeach

                          </select>
                        </div>
                      </div>
                      <div class="col-lg-12">
                       <label class="control-label">Description</label>
                       <textarea type="text" placeholder="Description" maxlength="100%" rows="4" id="description" class="form-control" name="workout_description" required="">
                        @if(isset($editData )) {{strip_tags($editData->description)}}@endif
                       </textarea>
                     </div>

                     <div class="col-lg-12">
                       <label class="control-label">Notes</label>
                       <textarea type="text" value="" placeholder="Description" maxlength="100%" rows="4" id="workout_notes" class="form-control" name="workout_notes" required="">
                         @if(isset($editData )) 
                        {{strip_tags($editData->notes)}}
                        @endif</textarea>
                     </div>

                     <div class="col-lg-12">
                       <label class="control-label">Vimeo Video URL</label>
                       <input type="text" value="@if(isset($editData)) {{$editData->video_link}} @endif" placeholder="Provide the Link of Video"  id="" class="form-control" name="video_link">
                         
                     </div>

                     <div class="col-lg-12">
                      <label>Select Your Membership Plan:</label>
                      <select  multiple="multiple" class="my-select form-control mt-2" placeholder="Select a  plan" name="plan_id[]">
                       
                        @if(isset($membeshipPackages))
                        @foreach($membeshipPackages as $value)
                        <option value="{{$value->id}}"
                          @if(isset($editData))
                          @foreach($contentsPlans as $contentsPlan)
                          @if($contentsPlan->plan_id == $value->id)
                          selected
                          @endif
                          @endforeach
                          @endif
                          >{{$value->package_name}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                     

                       <!-- <div class="col-md-12">
                      <label class="control-label">Upload Video</label>
                      <input type="file" class="form-control" name="upload_document"  value="@if(isset($editData)) {{$editData->content_name}} @endif">
                    </div> -->

                     <div class="action-button mt-3 col-lg-12">
                      @if(isset($editData))
                      <input type="submit" name="save" value="Update" class="btn btn-embossed btn-primary">
                      @else
                      <input type="submit" name="save" value="Create" class="btn btn-embossed btn-primary">
                      <input type="reset" name="reset" value="Reset" class="btn btn-embossed btn-danger">
                      @endif

                      
                    </div>

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