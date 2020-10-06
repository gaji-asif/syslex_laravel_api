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
        <div class="col-md-12 mb-4"><a href="{{route('memberships.index')}}" class="btn btn-primary btn-sm">Go Back</a></div>

        <div class="col-12">
          <div class="block-heading d-flex align-items-center title-pages">
           @if(isset($editData))
           <h5 class="text-truncate">Edit Package</h5>
           @else
           <h5 class="text-truncate">Add Package</h5>
           @endif

         </div>
       </div>
       @if(isset($editData))
       {{ Form::open(['class' => '', 'files' => true, 'url' => 'memberships/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
       @else
       {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'memberships',
       'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
       @endif

       <div class="col-12 mb-3">
        <div class="block">
          <div class="row">
           <div class="col-md-6 mb-3">
            <label class="control-label">Plan Name</label>
            <input type="text"  class="form-control" name="package_name" required="" value="@if(isset($editData)) {{$editData->package_name}} @endif">
          </div>
          <div class="col-md-6 mb-3">
            <label class="control-label">Amount</label>
            <div class="d-flex">
              <input type="text" value="$" name="plan-name" class="form-control" disabled="disabled" style="width: 40px;">
              <input type="text"  name="package_value" class="form-control" required="" style="margin-left: -1px; margin-right: -1px;" value="@if(isset($editData)) {{$editData->package_value}} @endif">
              <select class="form-control" name="timeframe" required="required">
                <option value="day" 
                @if(isset($editData))  
                  @if($editData->timeframe == 'day')
                  selected
                  @endif
                @endif
                >/Per Day</option>
                <option value="week"
                @if(isset($editData))  
                  @if($editData->timeframe == 'week')
                  selected
                  @endif
                @endif
                >/Per Week</option>
                <option value="month"
                @if(isset($editData))  
                  @if($editData->timeframe == 'month')
                  selected
                  @endif
                @endif
                >/Per Month</option>
                <option value="year"
                @if(isset($editData))  
                  @if($editData->timeframe == 'year')
                  selected
                  @endif
                @endif
                >/Per Year</option>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
                      <label>Select Your Features list:</label>
                      <select  multiple="multiple" class="my-select form-control mt-2" name="feature_id[]">
                       
                        @if(isset($featuresLists))
                        @foreach($featuresLists as $value)
                        <option value="{{$value->id}}"
                          @if(isset($editData))
                          @foreach($membersFeaturelists as $membersFeaturelist)
                          @if($membersFeaturelist->feature_id == $value->id)
                          selected
                          @endif
                          @endforeach
                          @endif
                          >{{$value->feature_name}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
          <div class="col-md-12 mb-3 mt-2">
            <label class="control-label">Description</label>
            <textarea class="form-control" name="description">@if(isset($editData )) {{strip_tags($editData->description)}}@endif</textarea>
          </div>

          <div class="col-md-12 action-button">
            @if(isset($editData))
           <input type="submit" name="save" value="Update Membership" class="btn btn-embossed btn-primary">
           @else
            <input type="submit" name="save" value="Create Membership" class="btn btn-embossed btn-primary">
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


@endsection