@extends('master')
@section('mainContent')
<style type="text/css">
  .display_own{
    display: none;
  }
</style>

@php
 $developer_id = Session::get('developer_id'); 
$devgrplang = \DB::table('dtb_develop_groups')
        ->where('id',$developer_id)
        ->first();
@endphp

<!-- <h4 class="font-weight-bold py-2 mb-4">
   <span class="text-muted font-weight-light">Dashboard /</span> Issues
</h4> -->
@if(session()->has('message-success'))
  <div class="alert alert-success mb-10 background-success" role="alert">
    {{ session()->get('message-success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(session()->has('message-danger'))
  <div class="alert alert-danger mb-10 background-danger" role="alert">
    {{ session()->get('message-danger') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

  <div class="alert  mb-10  display_own" role="alert" style="background-color: #b6DD05;">
    Issues are updated in Complete Status
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<!-- Filters -->
<!-- @if(count($issueStatuss)>0)
<div class="bootstrap-tagsinput">
   <div style="position:absolute;width:0;height:0;z-index:-100;opacity:0;overflow:hidden;">
      <div class="bootstrap-tagsinput-input" style="position:absolute;z-01;top:-9999px;opacity:0;white-space:nowrap;"></div>
   </div>index:-1
   <span class="tag badge ">Status :</span>
   
      @foreach($issueStatuss as $issueStatus)
      <a class="project_status" project_value="{{$id}}" value="{{$issueStatus->id}}"><span style="cursor: pointer; background-color: {{$issueStatus->color}}; color: #FFFFFF;" class="tag badge">{{$issueStatus->status_name}}</span></a>
      @endforeach
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
              <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
</div>
 @endif
<br> -->
<div class="row mb-2">
  <div class="col-md-12">

  {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'project/'.$id.'/issueexport',
  'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'formforcsv']) }}
    <input type="hidden" value="" id="selectCategorys" name="selectCategorys">
    <input type="hidden" value="" id="selectCategorys" name="selectCategorys">
    <input type="hidden" value="" id="selectPrioritys" name="selectPrioritys">
   {{--  <input type="hidden" value="@php $formarr['selectPriority']; @endphp" id="selectPrioritys" name="selectPrioritys"> --}}
    <input type="hidden" value="" id="selectAppss" name="selectAppss">
    <input type="hidden" value="" id="selectAssignees" name="selectAssignees">
    <input type="hidden" value="" id="selectStatuss" name="selectStatuss">
      @php
      if (empty($issueslist)) { @endphp 
        <span class="btn-success mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default" style="background-color: #71a6a88a;color: white; cursor: no-drop;border-color: white !important;"> Export CSV </span>
      @php }else{ @endphp 
        <input type="submit" class="btn-success mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default" style="background-color: #71a6a8;color: white;border-color: white !important;" value="Export CSV">
      @php } @endphp


  </form>

  </div>
</div>



<div class="col-lg-12">
<div class="row">
  
<div class="col-lg-12 px-0 pt-2 mb-0 col-lg-new">
    
  {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'seacrh_project_issue',
  'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'form_search']) }}
  <input type="hidden" name="project_id" id="project_id" value="{{$id}}">
  <div class="form-row">

  <div class="col-md-2 mb-2">
   <label class="form-label">Category</label>
   <select class="custom-select NoborderRadius" name="selectCategory" id="selectCategory">
    <option value="">Select</option>
    @foreach($categories as $category)
    <option value="{{$category->id}}" {{ old('selectCategory',$formarr['selectCategory'])!=''  && old('selectCategory',$formarr['selectCategory']) == $category->id ? 'selected':''}}>{{$category->category_name}}</option>
    @endforeach
  </select>
</div>

<div class="col-md-2 mb-2">
 <label class="form-label">Priority</label>
 <select class="custom-select NoborderRadius" name="selectPriority" id="selectPriority">
  <option value="">Select</option>
    @foreach($priorities as $priority)
    <option value="{{$priority->id}}" {{ old('selectPriority',$formarr['selectPriority'])!=''  && old('selectPriority',$formarr['selectPriority']) == $priority->id ? 'selected':''}}>{{$priority->priority_name }}</option>
    @endforeach
</select>
</div>


<div class="col-md-2 mb-2">
 <label class="form-label">Apps</label>
 <!-- <select class="custom-select NoborderRadius" name="selectApps" id="selectApps"> -->
  <select class="user-edit-multiselect NoborderRadius" multiple="" name="selectApps[]" id="selectApps" > 
   @if(count($apps)>0)
    @foreach($apps as $app)

    <option value="{{$app->id}}" {{in_array($app->id,$formarr['selectApps'])?'selected':''}}>{{$app->app_name}}</option>

   @endforeach
   @endif
</select>
</div>


<div class="col-md-2 mb-2">
 <label class="form-label">Assignee</label>
 <select class="custom-select NoborderRadius" name="selectAssignee" id="selectAssignee">
  <option value="">Select</option>
  @foreach($assignees as $assignee)
  <option value="{{ $assignee->id }}" {{ old('selectAssignee',$formarr['selectAssignee'])!='' && old('selectAssignee',$formarr['selectAssignee']) == $assignee->id ? 'selected':''}} >{{ $assignee->name }}</option>
  @endforeach
</select>
</div>

<div class="col-md-4 mb-2">
  <label class="form-label">Search by Status</label>
          <select class="user-edit-multiselect NoborderRadius" multiple="" name="selectStatus[]" id="selectStatus" > 
        @if(count($issueStatuss)>0)
        @foreach($issueStatuss as $issueStatus)
          <option value="{{$issueStatus->id}}" {{in_array($issueStatus->id,$formarr['selectStatus'])?'selected':''}}>{{$issueStatus->status_name}}</option>
        @endforeach
        @endif
        @if(count($notInIssue)>0)
        @foreach($notInIssue as $notInIssueValue)
          <option value="not${{$notInIssueValue->id}}" {{in_array('not$'.$notInIssueValue->id , $formarr['selectStatus'])?'selected':''}} >{{$notInIssueValue->status_name}}</option>
        @endforeach
         @endif
        </select>
</div>

</div>
<div class="form-row search_iisue_btn">
  <div class="col-md-9 px-2 pt-2 col-sm-12" >
   
  </div>
  
  <div class="col-md-3 col-sm-12">
   <button style="color: #FFFFFF;" type="submit" class="mt-3 col-lg-8 col-sm-12 col-xs-12 pull-right btn btn-info dtb_secondary_bgcolor dtb_custom_btn_default">Search</button>
    <a href="#" onclick="formReset('form_search')" class="clear_btn col-lg-3 col-sm-12 col-xs-12 btn btn-default mt-3" style="padding: 5px 2px; border-radius: 17px;">Clear all</a>
  </div>

</div>
{{ Form::close() }}
</div>
</div>
<!-- / Filters -->
<div class="">
 <div class="card-datatable">
  <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
   <div class="row">
    <div class="col-sm-12 col-md-6">
    </div>
    <div class="col-sm-12 col-md-6">

    </div>
  </div>
  <div class="row issue_list_wrapper">
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
      <table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
        <thead>
         <tr>
          <th width="8%">#SL</th>
          <th>Issue Title</th>
          <th style="width: 70px">App Name</th>
          <th>Category</th>
          <th>Version</th>
          <th>Assignee</th>
          <th>Status</th>
          <th>Priority</th>
          <th style="width: 86px">Updated</th>
        </tr>
      </thead>

      <tbody style="overflow: hidden !important;">
        @php $sl = 1; @endphp
        @if(isset($issueslist))
        @foreach($issueslist as $issues)

      <tr role="row" class="odd">
            <td class="">
              <span style="margin-right: 7px;">
                <input type="checkbox" class="checkbox" name="issue_id[]" value="{{$issues->id}}" style=" height: 17px; width: 17px; margin-top: 10px; padding-top: 10px !important;">
              </span>
              <span>{{$issues->id}}</span>
            </td>
            <td><a href="{{url('issue/'.$issues->id.'/list')}}">{{$issues->issue_title}}</a></td>
            <td class="text-center">{{$issues->app_name}}</td>
            <td class="text-center">{{$issues->category_name}}</td>
            <td class="text-center">{{$issues->version_name}}</td>
            <td class="text-center">{{$issues->assignee}}
             <span style="font-size: 10px">@if ($issues->is_archived == 1) (archived) @endif</span></td>
            <td>
            @if(isset($issues->status))
            
            <div class="btn badge badge-success float-right mr-0 dtb_custom_badge" style="background: {{ $issues->color ?? '' }};width: 72px">{{$issues->status_name ?? '' }}</div>
            
            @endif
            </td>
            <td>
            @if(isset($issues->issue_priority_id))
            <div class="btn badge badge-success float-right mr-0 dtb_custom_badge" style="background: {{ $issues->priorcolor ?? '' }};width: 72px">{{$issues->priority_name}}</div>
            @endif

      </td>

		
   {{-- <td>{{ date('d-M-Y', strtotime($issues->updated_at)) }}</td> --}}
   <td><?php 
   if (isset($devgrplang)) {
      if ($devgrplang->default_lang == 1) { ?>
      {{ date('m-d-Y', strtotime($issues->updated_at)) }}
       <?php }elseif($devgrplang->default_lang == 15){ ?>
      {{ date('m-d-Y', strtotime($issues->updated_at)) }}
        <?php }elseif($devgrplang->default_lang == 53){?>
      {{ date('Y-m-d', strtotime($issues->updated_at)) }}
        <?php }else{ ?>
      {{ date('m-d-Y', strtotime($issues->updated_at)) }}
       <?php }

      }else{}
      ?>
        
      </td>

</tr>

@endforeach
@endif

</tbody>

</table>





<div class="changeatonce row"> 

  <div class="col-sm-3"></div>

  <div class="col-sm-12 col-lg-12 middle_thing">
  <input type="hidden" value="2" id="tracker">
  <a data-modal-size="modal-lg" href="{{route('change_at_once')}}" data-original-title="Change At Once" class="change_at_once"><button type="submit" class="btn-success dtb_primary_bgcolor"  style="margin-right: 5px;">Change At Once</button></a>
  <!-- <button class="btn-default" href="{{route('change_at_once_complete_status')}}" id="is_complete_status" style="margin-right: 5px;">is Complete</button> -->
  <button class="btn-default" id="select_all" style="margin-right: 5px;">Select All</button>
  <button class="btn-danger dtb_secondary_bgcolor" id="clear_all">Clear All</button>
  <p id="demo"></p>
  </div>

  <div class="col-sm-3"></div>
</div>

<style type="text/css">
  @media only screen and (max-width: 700px) {
  div.changeatonce{
    margin-top: 25px !important;
    }

    .middle_thing{
      text-align: center;
    }
    div.dataTables_wrapper{
      padding-left: 0px;
    }
  }

</style>

</div>
</div>
<div class="issue_list_wrapper_another"></div>

</div>
</div>
</div>

</div>
<style>
  div.dataTables_wrapper {
    padding: 0px 7px;
}
div#DataTables_Table_0_wrapper .col-sm-12.col-md-6 {
    /* padding-left: 0px; */
    padding: 0px !important;
}

.default-style div.dataTables_wrapper div.dataTables_info {
    color: #a3a4a6;
    display: none;
}
.changeatonce {
   float: left !important;
    margin-top: -26px;
    font-size: 13px;
    position: relative;
    margin-left: 7px;
   
}


div.dataTables_wrapper .dataTables_filter input {
    width: 192px !important;
}
.default-style .select2-container--default .select2-selection--multiple {
    border-radius: 0px;
}

table#DataTables_Table_0 tr td a {
    color: #38587d !important;
}
</style>


<script type="text/javascript">



    //export csv functionality
    $('#formforcsv').on('submit',function(e){
      //e.preventDefault();

      var selectCategory = $('#selectCategory option:selected').val();
      var selectPriority = $('#selectPriority option:selected').val();
      var selectApps = $('#selectApps option:selected').val();
      var selectAssignee = $('#selectAssignee option:selected').val();
      var selectStatus = $('#selectStatus option:selected').val();

      $('#selectCategorys').val();
      $('#selectPrioritys').val(selectPriority);
      $('#selectAppss').val(selectApps);
      $('#selectAssignees').val(selectAssignee);
      $('#selectStatuss').val(selectStatus);

      //alert(selectStatus);
      //exit();
      // $.ajaxSetup({
      //   headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      // });
      // $.ajax({
      //       type: "POST",
      //       url: 'project/'+{{$id}}+'/issueexport',
      //       data: {
      //           "project_id": {{$id}},
      //           "selectCategory": selectCategory,
      //           "selectPriority": selectPriority,
      //           "selectApps": selectApps,
      //           "selectAssignee": selectAssignee,
      //           "selectStatus": selectStatus
      //         },
      //       success: function (data) { 
      //         //alert(data);
      //         window.location.href = 'coupon_history.csv';
      //       }
      //     });

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
    
    // $('.checkbox').on('click',function(){
    //     if($('.checkbox:checked').length == $('.checkbox').length){
    //         $('#select_all').prop('checked',true);
    //     }else{
    //         $('#select_all').prop('checked',false);
    //     }
    // });

    $( document ).ready(function() {
    getallissues();
          function getallissues() {
            var projectid = <?php echo $id; ?>;
              $.ajax({
                      type: "GET",
                      url: 'issue/data',
                      success: function (data) { 
                      
                      var html='';
                      data.forEach(function(row){
                          html += '<tr>'
                          html += '<td></td>'
                          html += '<td>' + row.id + '</td>'
                          html += '<td>' + row.email + '</td>'
                          html += '<td>' + row.user_id + '</td>'
                          html += '<td>' + row.created_at + '</td>'
                         
                          html += '<td>'
                          html += '<a href="#" class="memberdelbtn" data="'+ row.id +'"><i class="far fa-trash-alt d-block"></i></a>'
                          html += '</td> </tr>';
                      })
                      $('#membertbl tbody').html(html)
                  
     
                      }
                  });
            }
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
  function formReset(frmId)
  {
    $("#selectCategory")
    .val("")
    .removeAttr("selected");
    $("#selectPriority")
    .val("")
    .removeAttr("selected");
    $("#selectAssignee")
    .val("")
    .removeAttr("selected");
    $("#selectApps")
    .val("")
    .removeAttr("selected");
    $("#selectStatus")
    .val("")
    .removeAttr("selected");
      
//    $(frmId).find(':input').each(
//        function(){
//          switch(this.type){
//            case 'passsword':
//            case 'select-multiple':
//            case 'select-one':
//            case 'text':
//            case 'textarea':
//              $(this).val('');
//              break;
//            case 'checkbox':
//            case 'radio':
//              this.checked = false;
//          }
//        } 
//      );
//       document.getElementById(frmId).reset();
      $('.select2-selection__rendered').find("li").remove();
  }

 
  
</script>
@endsection
