<style type="text/css">
  .md-editor{
    width: 100%;
  }
  .comment-md{
    background-color: #FFFFFF !important;
  }
  .wikipagelinkholder  li.list-group-item.d-flex.justify-content-between.align-items-center {
    padding: 8px 16px 8px 17px;
  }
  .wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center:hover {
    background: #02bc7736;
  }
  .wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center:before {
    content: '';
    position: absolute;
    left: 13px;
    font-size: 10px;
    background: #00000045;
    width: 4px;
    height: 6px;
  }
  .wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center a {
    padding-left: 7px;
  }
  .editformheader {
    width: 74%;
    background: white;
    padding: 7px;
    margin: 1px 2px 4px;
  }
  button#dummycontentaddbtn {
    background: #ffd9501f;
    border: 1px solid #02bc7745;
    border-radius: 3px;
    font-size: 12px;
    font-weight: 500;
  }
 
#showDetaildModal{
     
  }
  .pace-done modal-open{
    z-index: 1 !important;
  }
  .datepicker{
    z-index: 999999 !important;
  }
  .modal-content{
    z-index: 1 !important;
  }
  .datepicker-dropdown{
    z-index: 999999 !important;
  }

.dropdown-menu{
    z-index: 999999 !important;
  }
.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
    z-index: 999999 !important;
}
.modal {
    z-index: 1043 !important;
}
.modal-backdrop {
    z-index: 1039;
}
</style>

<link rel="stylesheet" href="{{asset('css/imageuploadify.min.css')}}">
<!-- Project progress -->
{!! Form::open(['route' => ['update_change_at_once_mng_pro'], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'edit_issue_and_comment'])!!}

<div class="card pb-4 mb-2">
    <div class="row no-gutters align-items-center">
      <div class="col-12 col-md-2 px-4 pt-4">
        <a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Type</a><br>
        <!-- <small class="text-muted">Create the new product design</small> -->
      </div>
      <div class="col-4 col-md-4 text-muted small px-4 pt-4">
       <select name="issue_type" class="custom-select {{ $errors->has('issue_type') ? ' is-invalid' : '' }}">
        <option value="" selected>No Change</option>
        <option value="">Select Issue Type</option>
        @foreach($issueTypes as $issueType)
        <option value="{{ $issueType->id }}">{{ $issueType->issue_type }}</option>
        @endforeach
      </select>
    </div>
    
      <div class="col-12 col-md-2 px-4 pt-4">
        <a href="javascript:void(0)" class="text-body font-weight-semibold">Apps</a><br>
        <!-- <small class="text-muted">Create the new product design</small> -->
      </div>
      <div class="col-4 col-md-4 text-muted small px-4 pt-4">
       <select name="app_id" class="custom-select {{ $errors->has('app_id') ? ' is-invalid' : '' }}">
        <option value="">No Change</option>
        @foreach($apps as $app)
        <option value="{{ $app->id }}">{{ $app->app_name }}</option>
        @endforeach
      </select>
    </div>

  </div>


<div class="row no-gutters align-items-center">

    <div class="col-12 col-md-2 px-4 pt-2 mb-2">
      <a href="javascript:void(0)" class="text-body font-weight-semibold">Status</a><br>
      <!-- <small class="text-muted">Create the new product design</small> -->
    </div>
    <script type="text/javascript">
    var feedbackList = new Array();
    </script>
    <div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
     <select name="status" id="status" class="custom-select {{ $errors->has('status') ? ' is-invalid' : '' }}">
      <option value="">Select to status</option>
      @foreach($statuses as $statuse)
        @if($statuse->is_feedback == 1)
            <script type="text/javascript">
            feedbackList.push({{$statuse->id}});
            </script>
          @endif
      <option value="{{ $statuse->id }}-{{ $statuse->status_name }}">{{ $statuse->status_name }}</option>
      @endforeach
    </select>
  </div>

<div class="col-12 col-md-2 px-4 pt-2  mb-2">
  <a href="javascript:void(0)" class="text-body font-weight-semibold">Priority</a><br>
  <!-- <small class="text-muted">Create the new product design</small> -->
</div>


<div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
  <select name="issue_priority_id" class="custom-select {{ $errors->has('issue_priority_id') ? ' is-invalid' : '' }}">
    <option value="">Select priority</option>
    @foreach($priorities as $priority)
    <option value="{{ $priority->id }}">{{ $priority->priority_name }}</option>
    @endforeach
  </select>
</div>

</div>



<div class="row no-gutters align-items-center">
  <div class="col-12 col-md-2 px-4 pt-2 mb-2">
    <a href="javascript:void(0)" class="text-body font-weight-semibold">Assign TO</a><br>
    <!-- <small class="text-muted">Create the new product design</small> -->
  </div>
  <div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
    <select name="user_id" class="custom-select {{ $errors->has('user_id') ? ' is-invalid' : '' }}">
      <option value="">Select to assign</option>
      
      @foreach($users as $user)
      <option value="{{ $user->user_id }}">{{ $user->name }}</option>
      @endforeach
      
    </select>
  </div>
  <div class="col-12 col-md-2 px-4 pt-2 mb-2">
    <a href="javascript:void(0)" class="text-body font-weight-semibold">Category</a><br>
    <!-- <small class="text-muted">Create the new product design</small> -->
  </div>
  <div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
    <select name="category_id" class="custom-select {{ $errors->has('category_id') ? ' is-invalid' : '' }}">
      <option value="">Select Category</option>

      @foreach($categories as $category)
      <option value="{{ $category->id }}">{{ $category->category_name }}</option>
      @endforeach


    </select>
  </div>
</div>
<div class="row no-gutters align-items-center">
  <div class="col-12 col-md-2 px-4 pt-2 mb-2">
    <a href="javascript:void(0)" class="text-body font-weight-semibold">Version</a><br>
    <!-- <small class="text-muted">Create the new product design</small> -->
  </div>
  <div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
    <select name="version_id" class="custom-select {{ $errors->has('version_id') ? ' is-invalid' : '' }}">
      <option value="">No change</option>
      @foreach($versions as $version)
      <option value="{{ $version->id }}">{{ $version->version_name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-12 col-md-2 px-4 pt-2 mb-2">
    <a href="javascript:void(0)" class="text-body font-weight-semibold">Start Date</a><br>
    <!-- <small class="text-muted">Create the new product design</small> -->
  </div>
  <div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2 start_date_wrapper">
    <input type="text" data-date="" data-date-format="YYY MMMM DD" name="start_date" id="start_date" class="form-control datepicker {{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="Start Date">
  </div>
</div>
<div class="row no-gutters align-items-center">
  <div class="col-12 col-md-2 px-4 pt-2 mb-2">
    <a href="javascript:void(0)" class="text-body font-weight-semibold">End Date</a><br>
    <!-- <small class="text-muted">Create the new product design</small> -->
  </div>
  <div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
   <input name="deadline" id="deadline" name="deadline" type="text" data-date="" data-date-format="YYY MMMM DD" class="form-control datepicker {{ $errors->has('deadline') ? ' is-invalid' : '' }}" placeholder="End Date">
 </div>
 <div class="col-12 col-md-2 px-4 pt-2 mb-2">
  <a href="javascript:void(0)" class="text-body font-weight-semibold">Progress</a><br>
  <!-- <small class="text-muted">Create the new product design</small> -->
</div>
<div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
 <select name="progress" class="custom-select {{ $errors->has('progress') ? ' is-invalid' : '' }}">

  <option value="">No Change</option>
    <option value="1">10%</option>
    <option value="2">20%</option>
    <option value="3">30%</option>
    <option value="4">40%</option>
    <option value="5">50%</option>
    <option value="6">60%</option>
    <option value="7">70%</option>
    <option value="8">80%</option>
    <option value="9">90%</option>
    <option value="10">100%</option>
  
</select>
</div>
</div>
<div class="row no-gutters align-items-center">
  <div class="col-12 col-md-2 px-4 pt-2 mb-2">
    <a href="javascript:void(0)" class="text-body font-weight-semibold">Estimate 1</a><br>
    <!-- <small class="text-muted">Create the new product design</small> -->
  </div>
  <div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
@if(Session::has('role'))
@if(Session::get('role') == '0')
   <input type="text" name="estimate_hour1" class="form-control  {{ $errors->has('estimate_hour1') ? ' is-invalid' : '' }}" placeholder="Estimate Hour One" value="">
@endif
@endif

 </div>
 <div class="col-12 col-md-2 px-4 pt-2 mb-2">
  <a href="javascript:void(0)" class="text-body font-weight-semibold">Actual time</a><br>
  <!-- <small class="text-muted">Create statuse new product design</small> -->
</div>
<div class="col-4 col-md-4 text-muted small px-4 pt-2 mb-2">
  <input type="text" name="estimate_hour2" class="form-control  {{ $errors->has('estimate_hour2') ? ' is-invalid' : '' }}" value="">
</div>
</div>

<div class="form-group row pt-3">
    <div class="col-sm-12 ml-sm-auto">
      <button type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle">Update</button>
    </div>
  </div>

{{ Form::close()}}
<script type="text/javascript">
  $( function() {
    $( ".datepicker" ).datepicker({
      format: 'yyyy/mm/dd',
      todayBtn: true,
        clearBtn: true,
        autoclose: true,
        todayHighlight: true
    });
  } );
</script>
<!-- MODAL FOR EDIT -->

<!-- Modal template -->

