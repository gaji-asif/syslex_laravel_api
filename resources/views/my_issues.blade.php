@extends('master_main')
@section('mainContent')

<!-- <h4 class="font-weight-bold py-2 mb-4">
 All Issues
</h4> -->

<div class="px-0 pt-1 mt-4">
<?php //echo Session::get('developertimezone');?>
  {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'seacrh_my_issue',
  'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
  <div class="form-row">
    <div class="col-md-2 mb-3">
     <label class="form-label">Project</label>
     <select class="custom-select NoborderRadius" name="selectProject" id="project_id">
      <option value="">Select</option>
      @foreach($projects as $project)
      <option value="{{ $project->id }}" {{ old('selectProject',$formArry['selectProject'])==$project->id?'selected':'' }} >{{ $project->project_name }}</option>
      @endforeach
    </select>
  </div>
  <style>
    div.dataTables_wrapper .dataTables_filter input{
    margin-right: -11px;
    }
  </style>
<div class="col-md-2 mb-3">
 <label class="form-label">Assignee</label>
 <select class="custom-select NoborderRadius" name="selectAssignee" id="selectAssignee">
  <option value="">Select</option>
  @foreach($assignees as $assignee)
  <option value="{{ $assignee->id }}" {{old('selectAssignee',$formArry['selectAssignee'])==$assignee->id?'selected':(!isset($formArry['selectAssignee'])&&Session::get('user_id')==$assignee->id?'selected':'') }}>{{ $assignee->name }}</option>
  @endforeach
</select>
</div>

<div class="col-md-3 mt-3">
    <div class="dtb_custom_inline_chckbox_holder">
      <ul>
        <li>
          <label class="form-label custom-control custom-checkbox mt-3 ml-0">
          <input type="checkbox" name="is_complete" value="1" class="custom-control-input dtb_custom_checkbox_input"  {{ isset($formArry['is_complete'])?'checked':''}}>
          <span class="custom-control-label dtb_custom_checkbox_lablel">Is complete status?</span>
          </label>
        </li>
      </ul>
    </div>
</div>

<div class="col-md-2 col-xl-2 mb-4">
 <label class="form-label d-none d-md-block">&nbsp;</label>
 <button type="submit" class="btn btn-success dtb_custom_btn_default">Search</button>
</div>

</div>
{{ Form::close() }}


</div>
<!-- / Filters -->
<!-- <div class="card"> -->
<div class="">
 <div class="card-datatable table-responsive" style="padding-top: 0px">
  <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
{{--    <div class="row">
    <div class="col-sm-12 col-md-6 "  style="padding-left: 0px !important;">
      <input type="hidden" value="1" id="tracker">
    <a data-modal-size="modal-lg" href="{{route('change_at_once_my_issues')}}" data-original-title="Change At Once" class="change_at_once_my_issues" ><button type="submit" class="btn-success dtb_primary_btn"  style="margin-right: 5px;">Change At Once</button></a>
    <button class="btn-default " id="select_all" style="margin-right: 5px;">Select All</button>
      <button class="btn-danger dtb_secondary_btn" id="clear_all">Clear All</button>
      <p id="demo"></p>
    </div>
    <div class="col-sm-12 col-md-6">
      
    </div>
  </div> --}}
  <div class="row mt-2">
    <div class="col-sm-12 col-lg-12">

      @if(session()->has('message'))
      <br>
      <div class="alert alert-success mb-10 background-success" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <table class="datatables-demo table table-striped table-bordered tbl_common dtb_custom_tbl_common" style="overflow: hidden !important;">
        <thead>
         <tr>
          <th width="4%">#SL</th>
          <th>App</th>
          <th>Issue Title</th>
          <th>Project</th>
          <th>Category</th>
          <th>Assignee</th>
         <!--  <th>AssignedBy</th> -->
          <th>Status</th>
          <th>Progress</th>
          <th>Priority</th>
          <!-- <th>Estimate</th> -->
          <th>Updated</th>
          <th>deadline</th>
         <!--  <th>Actions</th> -->
        </tr>
      </thead>

      <tbody style="overflow: hidden !important;">
        @php $sl = 1; @endphp
        @if(isset($issueslist))
        @foreach($issueslist as $issues)

        <tr role="row" class="odd">
          <td class="">
            <span style="margin-right: 7px;">
             {{--  <input type="checkbox" class="checkbox" name="issue_id[]" value="{{$issues->id}}" style=" height: 17px; width: 17px; margin-top: 10px; padding-top: 10px !important;"> --}}
            </span>
            <span>{{$issues->id}}</span>
          </td>
          <td>{{$issues->app_name}}
          </td>
          <td><a href="{{url('issue/'.$issues->id.'/myIssue')}}">{{$issues->issue_title}}</a></td>
          <td>{{$issues->project_name}}
          </td>
          
          <td>{{$issues->category_name}}
        </td>
        <td>
          @if(!empty($issues->userimg))
              @php $image_path = url($issues->userimg); @endphp
              <img src="//{{ $issues->userimg }}" alt="" align="left" class="d-block ui-w-30 rounded-circle">
              @else
              <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" align="left" class="d-block ui-w-30 rounded-circle">
          @endif
          <span style="margin-top: 11px;float: left;margin-left: 4px;">{{$issues->assignee}} 
            @if ($issues->is_archived == 1) <span style="font-size: 10px">(archived)</span> @endif
          </span>
        </td>

      <td style="text-align: center;">
       @if(isset($issues->status))

       <div class="btn badge badge-success dtb_custom_badge" style="background:{{$issues->statscolor ?? '#718AA8'}}">{{$issues->status_name}}</div>

       @endif
     </td>

     <td style="text-align: center;">
       <div class="ticket-priority btn-group">
       <!--  <button type="button" class="btn btn-xs md-btn-flat  btn-success dtb_custom_badge" data-toggle="dropdown">{{($issues->progress>0) ? $issues->progress.'%' : 'not set'}}</button> -->

        <div class="btn badge badge-success dtb_custom_badge dtb_secondary_bgcolor">{{($issues->progress>0) ? $issues->progress.'%' : 'not set'}}</div>

      </div>
    </td>  

    <td>

     @if(isset($issues->issue_priority_id))
     <div class="btn badge float-right mr-3">{{$issues->priority_name}}</div>

     @endif
   </td>


  <td>

    @if(Session()->get('language_id') == 1)
    {{ date('m-d-Y', strtotime($issues->updated_at)) }}
    @elseif(Session()->get('language_id') == 15)
    {{ date('m-d-Y', strtotime($issues->updated_at)) }}
    @elseif(Session()->get('language_id') == 53)
    {{ date('Y-m-d', strtotime($issues->updated_at)) }}

    @else

    @endif
    </td>
  <td>  @if(!empty($issues->deadline))
    @if(Session()->get('language_id') == 1)
    {{ date('m-d-Y', strtotime($issues->deadline)) }}
    @elseif(Session()->get('language_id') == 15)
    {{ date('m-d-Y', strtotime($issues->deadline)) }}
    @elseif(Session()->get('language_id') == 53)
    {{ date('Y-m-d', strtotime($issues->deadline)) }}

    @else

    @endif
    
  @endif</td>
<!--   <td style="padding: 5px">

    <a href="{{url('issue/'.$issues->id.'/myIssue')}}"><div class="btn badge badge-primary">view Details</div></a> -->


    <!-- <a href="issue/{{ $issues->id }}/edit" class="btn btn-default btn-xs icon-btn md-btn-flat product-tooltip" title="" data-original-title="Edit"><i class="ion ion-md-create"></i></a> -->

<!--     <a href="{{url('editIssue/'.$issues->id)}}" class="btn btn-warning btn-xs icon-btn md-btn-flat product-tooltip" title="" data-original-title="Edit"><i class="ion ion-md-create"></i></a> -->

<!-- </tr> -->

@endforeach
@endif

</tbody>

</table>
</div>
</div>

</div>
</div>
</div>
<style>
  .dataTables_wrapper .dataTables_length {
    margin-left: -12px;
}
</style>
<script type="text/javascript">

  $( document ).ready(function() {

    $('body').on('click','.issuedelbtn',function(e){
     e.preventDefault();

     var issueid = $(this).attr('data');

     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


     $.ajax({
      url: 'issue/'+issueid,
      type: 'DELETE',
      data: {
        "issueid": issueid
      },
      success: function(response){
        $.iaoAlert({msg: "Data has been deleted",
          type: "success",
          mode: "dark",});
              setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1500);
            }
          });
       });
  });

  $('#select_all').on('click',function(){
       $('.checkbox').each(function(){
            this.checked = true;
        });
    });

    $('#clear_all').on('click',function(){
       $('.checkbox').each(function(){
            this.checked = false;
        });
    });

</script>
@endsection
