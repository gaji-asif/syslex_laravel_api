@extends('master')
@section('mainContent')
<div class="" >

   <div class="card-datatable" style="margin-top: 0px; padding: 0px;">
      <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">


         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="padding: 0px 12px !important">
              <div class="screentgrpbtnholder">
                <a href="apps/create" class="btn btn-success btn-sm  dtb_custom_btn_default" style="float: left;" data-toggle="modal" data-target="#myModalNorm">Add New Screen Group</a> 
               <!--  <a href="apps/create" class="btn btn-success btn-sm  dtb_custom_btn_default" style="float: right;">Edit Screen Group</a>  -->
              </div>

                <div style="clear: both;"></div>
              <div class="errorholder">
                      @if(session()->has('message'))
                      <div class="alert alert-success mb-0 background-success p-2 mt-4" role="alert">
                      {{ session()->get('message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      @endif
              </div>

            </div>
            <div class="col-md-2">
            </div>
         </div><br>



<!-- adding screen group Modal starts -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" 
data-dismiss="modal">
<span aria-hidden="true">&times;</span>
<span class="sr-only">Close</span>
</button>
<h4 class="modal-title" id="myModalLabel">
Add Screen Group
</h4>
</div>

<!-- Modal Body -->
<div class="modal-body" style="padding: 15px 25px">
 {!! Form::open(['route' => ['screengroup.store', $id], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'screengroupaddform','class' => 'form-horizontal'])!!}
<div class="form-group">
<label for="groupname"><strong>Screen Group Name</strong></label>
<input type="text" name="screen_group_name" class="form-control" id="groupname" placeholder="Enter Group Name" required />
</div>



<div class="text-center mt-4 mb-2">
<button type="submit" class="btn btn-default dtb_custom_btn_default" style="width: 100px;margin: 0 auto">Submit</button>
</div>

 {!! Form::close() !!}
</div>
<!-- Modal Footer -->
<div class="modal-footer">
<button type="button" class="btn btn-default"
data-dismiss="modal">
Close
</button>
</div>
</div>
</div>
</div>

<!-- adding screen group Modal starts -->



         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="padding: 0px 15px !important;">

            <div class="table-responsive">
               <table id="tickets-list" class="datatables-demo table table-striped table-bordered dataTable no-footer dtb_custom_tbl_common" role="grid" aria-describedby="tickets-list_info" style="width: 1206px;">
                  <thead>
                     <tr role="row">
                        <th style="width: 15px"></th>
                        <th>Screen Group Name</th>
                        <th style="width: 72px">App Name</th>
                        <th >Updated At</th>
                        <th class="sorting_disabled" style="width: 15px">Actions</th>
                     </tr>
                  </thead>

                  <tbody id="apptrdragable">

                    @if(!empty($screengroup))
                        @foreach($screengroup as $screengroups)
                         <tr role="row" class="odd row1" data-id="{{ $screengroups->id ?? '' }}" id="{{ $screengroups->id ?? '' }}">

                            <td class="py-0 sorting_1 " style="width: 15px"><div style="display: flex;color: #00000063;margin-left: 3px;margin-top: 4px"> <i class="fas fa-th-list d-block"></i></div></td>
                            <td class="py-0" style="width: 200px;">
                              <a href="{{route('screengroup.show', [$screengroups->project_id,$screengroups->id])}}">{{ $screengroups->screen_group_name ?? '' }}</a>
                            </td> 
                            <td class="py-0" style="width: 200px;">

                            @if(isset($screengroups->id))
                                @php
                                  $screengrp = \DB::table('dtb_apps')
                                  ->where('project_id',$screengroups->project_id)
                                  ->where('screen_group_id',$screengroups->id)
                                  ->orderBy('ordering','ASC')
                                  ->get(['id','screen_group_id','app_name','ordering']);
                                @endphp

                                @if(!empty($screengrp))

                                  @foreach($screengrp as $screengrps)
                                    {{ $screengrps->app_name }}
                                    @if (!$loop->last),@endif {{-- remove last comma --}}
                                  @endforeach

                                @endif

                            @endif

                            </td>
                            <td class="py-0" style="width: 200px;"> <?php converttimezone($screengroups->updated_at); ?></td>
                            <td class="py-0"  style="width: 15px">
                              <a href="#" data="" class="btn btn-xs icon-btn md-btn-flat product-tooltip screengroupeditbtn" title="Remove"  value="{{ $screengroups->screen_group_name }}" data-id="{{$screengroups->id}}"  style="margin-left: 23px; padding: 2px;margin-top: 0px;" data-toggle="modal" data-target="#screengroupeditmodal"><span class="far fa-edit d-block"></span>
                              </a>
                            </td>
                         </tr>
                         @endforeach

                    @endif
                  </tbody>
               </table>
            </div>

            </div>
            <div class="col-md-2"></div>

         </div>
        
      </div>
   </div>
</div>




<!-- adding screen group Modal starts -->
<div class="modal fade" id="screengroupeditmodal" tabindex="-1" role="dialog" 
aria-labelledby="screengroupeditmodal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" 
data-dismiss="modal">
<span aria-hidden="true">&times;</span>
<span class="sr-only">Close</span>
</button>
<h4 class="modal-title" id="myModalLabel">
Edit Screen Group
</h4>
</div>

<!-- Modal Body -->
<div class="modal-body" style="padding: 15px 25px">
 {!! Form::open(['route' => ['screengroup.update', $id], 'method' => 'PUT','files' => true, 'enctype' => 'multipart/form-data','id' => 'screengroupaddform','class' => 'form-horizontal'])!!}
<div class="form-group">
<label for="groupname"><strong>Screen Group Name</strong></label>
<input type="text" name="screen_group_name" class="form-control" id="editgroupname" placeholder="Enter Group Name" required />
</div>


<input type="hidden" name="grpid" id="grpid" value="">
<div class="text-center mt-4 mb-2">
<button type="submit" class="btn btn-default dtb_custom_btn_default" style="width: 100px;margin: 0 auto">Submit</button>
</div>

 {!! Form::close() !!}
</div>
<!-- Modal Footer -->
<div class="modal-footer">
<button type="button" class="btn btn-default"
data-dismiss="modal">
Close
</button>
</div>
</div>
</div>
</div>

<!-- adding screen group Modal starts -->







<style>
  table#tickets-list tr td a {
    float: left;
    display: block;
    padding: 9px 0px;
}

div.dataTables_wrapper .dataTables_filter input{
  margin-right: -24px;
}
div#tickets-list_paginate {
    margin-right: -23px;
}

</style>

<!-- <script src="{{asset('assets_/vendor/libs/dropzone/dropzone.js')}}"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.0/showdown.min.js"></script> -->
<script src="{{asset('/assets/js/marked.min.js')}}"></script>
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>


<script type="text/javascript">

$( document ).ready(function() {



//set screen group edit form when click edit starts
$('body').on('click','.screengroupeditbtn',function(e){

  e.preventDefault();

  var screengrpname = $(this).attr('value');
  var grpappid = $(this).attr('data-app');
  var grpid = $(this).attr('data-id');

  $("#editgroupname").val(screengrpname);
  $("#editappselect").val(grpappid);
  $("#grpid").val(grpid);

});
//set screen group edit form when click edit ends 


   
///////// app LIST DRAG DROP SORTING ///////////////////////
    $( "#apptrdragable" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
        sendOrderToServer();
      }
    });

  function sendOrderToServer() {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var order = [];
      $('tr.row1').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
          //alert(JSON.stringify(order, null, 4));exit();
      });
      $.ajax({
          url: 'screengrouporder',
          type: 'PUT',
          data: {
              order:order,
             _token: '{{csrf_token()}}'
          },
          success: function(response){


            $("#msgcontainer").show();
            if (response) {
            $.iaoAlert({msg: "Ordering Successfull",
              type: "success",
              mode: "dark",})
            }
          },
          error: function() {
            alert('Error occurs!');
         }
      });
    }
 

////////// for showing marked content to memo field /////////////////////////
    var text = $('.memocontent').val();
    target = $('appmemoshowhere').appened(text);
    converter = new showdown.Converter({tables: true}),
    html = converter.makeHtml(text);
    target.innerHTML = text;



});


$(document).ready(function() {
   $('#tickets-list').dataTable({
      "bLengthChange": false,
      "paginate": true,
      "order":[]
     });
 });
</script>
@endsection

