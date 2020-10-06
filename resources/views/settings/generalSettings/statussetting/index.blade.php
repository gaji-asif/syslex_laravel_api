@extends('master')
@section('mainContent')
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
    <div class="card overflow-hidden">
<div class="row no-gutters row-bordered row-border-light">

<div class="col-md-2 pt-0">
@include('settings.generalSettings.general_settings_sidebar')
</div>

<div class="col-md-10">
<div class="tab-content">
<div class="tab-pane fade show active" id="account-general">

<div class="card-body media align-items-center pb-2">
<div class="media-body">
<button type="button" class="btn btn-outline-primary btn-sm md-btn-flat" data-toggle="modal" data-target="#statusmodal"><i class="fa fa-plus" style="font-size:12px"></i> Add Status</button>
</div>
</div>

<hr class="border-light m-0">

<div class="card-body">

<table class="table table-bordered table-striped dtb_custom_tbl_common" id="statuslist">

<thead>
<tr>
<th style="width: 13.6px;"></th>
<th style="width: 300px;"> List of Status</th>
<th style="width: 180px;">Colors</th>
<th style="width: 130px;"></th>
<th style="width: 40.6px;">Action</th>
</tr>
</thead>

<tbody id="tablecontents">
@forelse ($DtbIssueStatus as $status)

<tr class="row1" data-id="{{ $status->id }}" id="{{$status->id}}">
<td class="sorted" data-value="">
<div style="display: flex;color: #00000063;"> <i class="fas fa-th-list d-block"></i></div>
</td>
<td data-value="{{ $status->color }}">{{ $status->status_name }}</td>
<td data-value="{{ $status->status_name }}"><button class="btn btn-sm" style="color:white;background: {{ $status->color }}">{{ $status->status_name }}</button></td>
<td class="text-center">
<?php if ($status->is_complete == '1')
    { ?>

<a href="javascript:void(0)" class="badge badge-outline-success iscomplete" style="display: inline-flex;padding: 3px 6px 3px 7px;">
<i class="fas fa-check-square d-block" style="font-size: 14px"></i>
<span class="pull-right" style="margin-top: 1px;">completed</span>
</a>

<?php }elseif ($status->is_feedback == '1')
    { ?>

<a href="javascript:void(0)" class="badge badge-outline-success iscomplete" style="display: inline-flex;padding: 3px 6px 3px 7px;">
<i class="fas fa-check-square d-block" style="font-size: 14px"></i>
<span class="pull-right" style="margin-top: 1px;">feedbacked</span>
</a>

<?php }else{ ?>
<a href="javascript:void(0)" class="badge badge-outline-info iscomplete" style="display: inline-flex;padding: 3px 25px 3px 22px;">
<i class="fas fa-angle-double-up d-block"></i>
Open</a>
<?php } ?>
</td>


<td data-value="{{ $status->id }}" style="display: flex;padding: 15px 32px;">
<a href="#"  data-toggle="modal" data-target="#statuseditmodal" class="mr-2 statuseditmodal" value="{{ $status->id }}" data-status="{{$status->status_name}}" data-issuecolor="{{$status->color}}" data-projectid='{{$id}}' data-completed="{{$status->is_complete}}" data-feedbacked="{{$status->is_feedback}}"><i class="far fa-edit d-block"></i></a>
<a href="#" data-toggle="modal" data-target="#statusdelconfrimmodal" class="statusdelconfrimmodal" value="{{ $status->id }}"><i class="far fa-trash-alt d-block"></i></a>
</td>
</tr>
@empty
<p>No data</p>
@endforelse
</tbody>
<!-- <tfoot>
<tr>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>
</tfoot> -->
</table>
<span style="display: flex;margin-left: -10px;">
<i style="color: #00000063;margin-top: 3px;margin-right: 4px" class="fas fa-th-list d-block"></i> Drag  to rearrange order.
</span>

</div>



</div>


</div>
</div>



<!-- Modal template -->
<div class="modal fade" id="statusmodal">
<div class="modal-dialog modal-lg">
<form method="POST" class="modal-content" id="statusform">

<div class="modal-header">
<h5 class="modal-title">
Add Status
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">✖</button>
</div>
<div class="modal-body">

<div class="errmsg alert alert-danger" style="display:none">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label class="form-label">Status Name</label>
<input required type="text" id="status_name" name="status_name" value="{{ old('status_name') }}" class="form-control required" placeholder="">
</div>

<div class="form-group col-md-6">
<br>
<div class="row">
<label class="custom-control custom-checkbox mt-3 ml-4">
<input type="checkbox" name="is_complete" value="1" class="custom-control-input">
<span class="custom-control-label">Is complete status?</span>
</label>
<label class="custom-control custom-checkbox mt-3 ml-4">
<input type="checkbox" name="is_feedback" value="1" class="custom-control-input">
<span class="custom-control-label">Is feedback status?</span>
</label>
</div>

</div>
</div>



<div class="form-row mt-4">
<div class="form-group col">
<label class="form-label">Select Background color for this status</label>
<div class="demo-inline-spacing issuebgcolorholder">

<label class="switcher switcher-square">
<input type="checkbox" name="color" value="#d73a4a" id="color" class="switcher-input required editcolor">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no red"></span>
</span>
<span class="switcher-label"></span>
</label>

<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor"  name="color" value="#b6DD05">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no green"></span>
</span>
<span class="switcher-label"></span>
</label>

<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor"  name="color" value="#0075ca">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no blue"></span>
</span>
<span class="switcher-label"></span>
</label>


<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor" name="color" value="#e4e669">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no yellow"></span>
</span>
<span class="switcher-label"></span>
</label>


<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor" name="color" value="#4caf93">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no color5"></span>
</span>
<span class="switcher-label"></span>
</label>

<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor" name="color" value="#f42858">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no color6"></span>
</span>
<span class="switcher-label"></span>
</label>


<label class="switcher switcher-square" style="padding-left: 0px">
<input type="text" placeholder="put cursor to pick color" value="" class="editcolor jscolor {required:false,hash:true,refine:false,width:243, zIndex:99999, height:150,borderColor:'#FFF', backgroundColor:'#666'} " style="border: 1px solid #80808075;border-radius: 3px;padding: 2px 5px;font-size: 13px;" value="#f3f3f3">
<input type="checkbox" id="inptcolorvalue"  name="color" style="display: none;">
</label>


</div>
</div>
</div>


<label class="form-label">Existing Items</label>
<div class="form-row mt-1">

<div class="form-group col" style="padding: 17px 8px 3px;background: #00000012;">
<div class="demo-inline-spacing">
@forelse ($DtbIssueStatus as $status)
<span class="btn btn-sm" style="color:white;background: {{ $status->color }}">{{ $status->status_name }}</span>
@empty
<p>No users</p>
@endforelse
</div>
</div>
</div>
<!--  hidden field to get project id -->
<input type="hidden" name="project_id" value="{{$id}}">



</div>
<div class="modal-footer">
<button id="statusclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
</div>
</div>



<!-- MODAL FOR EDIT -->

<!-- Modal template -->
<div class="modal fade" id="statuseditmodal">
<div class="modal-dialog modal-lg">
<form method="POST" class="modal-content" id="issuetypupdate">

<div class="modal-header">
<h5 class="modal-title">
Edit Status
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">✖</button>
</div>
<div class="modal-body">

<div class="errmsg alert alert-danger" style="display:none">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>

<div class="form-row">
<div class="form-group col mb-0">
<label class="form-label">Status Name</label>
<input required type="text" id="edit_status_name" name="status_name" value="" class="form-control required" placeholder="">

</div>

<div class="form-group col pl-4">
<br>
<div class="row">
<label class="custom-control custom-checkbox mt-3 ml-4">
<input type="checkbox" class="iscompleteornot custom-control-input" name="is_complete" value="" class="custom-control-input">
<span class="custom-control-label">Is complete status?</span>
</label>
<label class="custom-control custom-checkbox mt-3 ml-4">
<input type="checkbox" class="isfeedbackornot custom-control-input" name="is_feedback" value="1" class="custom-control-input">
<span class="custom-control-label">Is feedback status?</span>
</label>
</div>
</div>

</div>


<div class="from-row">
  <div class="form-group col pl-0">
  <label class="form-label">Background Color</label>
  <span class="oldcolrolabel"><input type="button" class="btn editcolors" name="oldercolor"><br>
</div>
</div>


<div class="form-row mt-0" style="margin-top: -15px !important">
<div class="form-group col">
<label class="form-label">Choose any color to change the background color of this status</label>
<div class="demo-inline-spacing issuebgcolorholder">

<label class="switcher switcher-square">
<input type="checkbox" name="color" value="#d73a4a" id="color" class="switcher-input required editcolor">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no red"></span>
</span>
<span class="switcher-label"></span>
</label>

<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor"  name="color" value="#b6DD05">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no green"></span>
</span>
<span class="switcher-label"></span>
</label>

<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor"  name="color" value="#0075ca">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no blue"></span>
</span>
<span class="switcher-label"></span>
</label>


<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor" name="color" value="#e4e669">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no yellow"></span>
</span>
<span class="switcher-label"></span>
</label>


<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor" name="color" value="#4caf93">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no color5"></span>
</span>
<span class="switcher-label"></span>
</label>




<label class="switcher switcher-square">
<input type="checkbox" class="switcher-input editcolor" name="color" value="#f42858">
<span class="switcher-indicator">
<span class="switcher-yes"></span>
<span class="switcher-no color6"></span>
</span>
<span class="switcher-label"></span>
</label>


<label class="switcher switcher-square" style="padding-left: 0px">
<input type="text" placeholder="put cursor to pick color" value="" class="editcolor jscolor {required:false,hash:true,refine:false,width:243, zIndex:99999, height:150,borderColor:'#FFF', backgroundColor:'#666'} " style="border: 1px solid #80808075;border-radius: 3px;padding: 2px 5px;font-size: 13px;" value="#f3f3f3">
<input type="checkbox" id="inptcolorvalue"  name="color" style="display: none;">
</label>


</div>
</div>
</div>


<label class="form-label">Existing Items</label>
<div class="form-row mt-1">

<div class="form-group col" style="padding: 17px 8px 3px;background: #00000012;">
<div class="demo-inline-spacing">
@forelse ($DtbIssueStatus as $status)
<span class="btn btn-sm" style="color:white;background: {{ $status->color }}">{{ $status->status_name }}</span>
@empty
<p>No users</p>
@endforelse
</div>
</div>
</div>
<!--  hidden field to get project id and older color -->
<input type="hidden" name="project_id" value="{{$id}}">
<input type="hidden" class="newlycolor" name="newlycolor" value="">


</div>
<div class="modal-footer">
<button id="statusclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary updatestatussavebtn">Save</button>
</div>
</form>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="statusdelconfrimmodal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: #f8d7da;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h6 class="modal-title">Are you sure to delete?</h6>
</div>
<!-- <div class="modal-body">
<p>Some text in the modal.</p>
</div> -->
<div class="modal-footer">
<button  value="{{ $status->id ?? '' }} type="button" class="btn btn-danger issuedelbtn" data-dismiss="modal">YES</button>
<button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
</div>
</div>

</div>
</div>

</div>
</div>
  </div>
  <div class="col-lg-2"></div>
</div>

<script src="{{asset('js/jscolor.js')}}"></script>
<style type="text/css">
.iscomplete i{
    padding-right: 4px;
    padding-bottom: 1px;
    float: left;
    margin-top: 1px;
}


  .btn-outline-primary {
    border: 1px solid #38587d;
    border-radius: 0px;
    color: #38587d;
}  

.btn-outline-primary:hover {
  background: #718AA8;
  color: white;
}

</style>

<script type="text/javascript">
$( document ).ready(function() {
                    // ##################################### CODE FOR STATUS START #####################################

                        $(".jscolor").on("change", function(){
                            var inputboxcolor = $(this).val();

                            if (inputboxcolor != "") {
                              $('#color-error').text('');
                              $('#inptcolorvalue').attr('checked', true);
                              $('#inptcolorvalue').val(inputboxcolor);
                            }else{
                              $('#inptcolorvalue').attr('checked', false);
                              $('#inptcolorvalue').val("");
                            }

                        });
                                        
                    

                    
                    // form required validation code
                    $("#statusform").validate({
                                              rules: {
                                              issue_type: {
                                              required: true
                                              },
                                              'color[]': {
                                              required: true
                                              }
                                              },
                                              messages: {
                                              issue_type: {
                                              required: "Status field is required",
                                              },
                                              color: {
                                              required: "Select any background color",
                                              },
                                              },
                                              });
                    
                    
                    //issue entry form submit process
                    $('body').on('submit','#statusform',function(e){
                                 
                                 $.ajaxSetup({
                                             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                             });
                                 e.preventDefault();
                                 
                                 
                                 var formdata = $(this).serialize();
                                 var status_name = $(this).attr('data-status');
                                 
                                 var url = '{{ url("status") }}';
                                 
                                 $.ajax({
                                        url: 'status',
                                        type: 'POST',
                                        data: formdata,
                                        
                                        success: function(data){
                                        // $.iaoAlert({msg: "Data has been saved",
                                        // type: "success",
                                        // mode: "dark",})
                                        // // showdata();
                                        alert(data);
                                        
                                        $('#statusmodal').modal('hide');
                                        document.getElementById("statusform").reset();
                                        
                                        $.iaoAlert({msg: "Data has been saved",
                                                   type: "success",
                                                   mode: "dark",});
                                        
                                        setTimeout(function(){// wait for 5 secs(2)
                                                   location.reload(); // then reload the page.(3)
                                                   }, 1000);
                                        
                                        
                                        },
                                        error: function (request, status, error) {
                                        $.iaoAlert({msg: "Please fill the field",
                                                   type: "warning",
                                                   mode: "dark",})
                                        
                                        
                                        
                                        json = $.parseJSON(request.responseText);
                                        $.each(json.errors, function(key, value){
                                               $('.errmsg').show();
                                               $('.alert-danger').append('<p>'+value+'</p>');
                                               setTimeout(function() {
                                                          $('.errmsg').hide();
                                                          $('.alert-danger').append('');
                                                          }, 2000);
                                               
                                               
                                               });
                                        $("#result").html('');
                                        }
                                        
                                        
                                        
                                        });
                                 
                                 
                                 });
                    
                    //issue modal closing input data reseting
                    $('#statusclosebtn').on('click',function(e){
                                            e.preventDefault();
                                            document.getElementById("statusform").reset();
                                            });
                    
                    
                    
                    $('#statuslist').DataTable( {
                                               "order": [],
                                               ordering:true,
                                               } );
                    
                    
                    
                    
                    $('body').on('click','.statuseditmodal',function(e){
                                 
                                 e.preventDefault();
                                 
                                 var statusid = $(this).attr('value');
                                 var projectid = $(this).attr('data-projectid');
                                 var status_name = $(this).attr('data-status');
                                 var oldcolor = $(this).attr('data-issuecolor');
                                 var iscompletes = $(this).attr('data-completed');
                                 var isfeedback = $(this).attr('data-feedbacked');
                                 
                                 $("#edit_status_name").val(status_name);
                                 
                                 //$(".iscompleteornot").val(iscompletes);
                                 
                                 
                                 if (iscompletes == 1) {
                                 $(".iscompleteornot").prop('checked', true);
                                 }else{
                                 $(".iscompleteornot").prop('checked', false);
                                 }
                                 
                                 if (isfeedback == 1) {
                                 $(".isfeedbackornot").prop('checked', true);
                                 }else{
                                 $(".isfeedbackornot").prop('checked', false);
                                 }
                                 
                                 $(".editcolors").val(status_name);
                                 $('.editcolors').css('background',oldcolor);
                                 
                                 
                                 $('body').on('click','.updatestatussavebtn',function(e){
                                              e.preventDefault();
                                              
                                              
                                              if($('.iscompleteornot').is(":checked")){
                                              var completedornot = '1';
                                              } else if($('.iscompleteornot').is(":not(:checked)")){
                                              var completedornot = '0';
                                              }
                                              
                                              if($('.isfeedbackornot').is(":checked")){
                                              var feedbackedornot = '1';
                                              } else if($('.isfeedbackornot').is(":not(:checked)")){
                                              var feedbackedornot = '0';
                                              }
                                              
                                              
                                              var statusvalue = $("#edit_status_name").val();
                                              
                                              $('input[name="color"]:checked').each(function() {
                                                                                    var colors = (this.value);
                                                                                    $(".newlycolor").val(colors);
                                                                                    });
                                              
                                              $.ajaxSetup({
                                                          headers: {
                                                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                          }
                                                          });
                                              
                                              var lastcolor = $(".newlycolor").val();
                                              
                                              $.ajax({
                                                     url: 'status/'+projectid,
                                                     type: 'POST',
                                                     data: {
                                                     statusid:statusid,
                                                     projectid: projectid,
                                                     status_name: statusvalue,
                                                     color: lastcolor,
                                                     oldcolor: oldcolor,
                                                     iscompletes:completedornot,
                                                     isfeedback:feedbackedornot
                                                     },
                                                     success: function(response){
                                                     
                                                     $('#statuseditmodal').modal('hide');
                                                     $("#msgcontainer").show();
                                                     if (response) {
                                                     $.iaoAlert({msg: "Data has been updated",
                                                                type: "success",
                                                                mode: "dark",})
                                                     // $("#successmsg").html(response);
                                                     // setTimeout(function() {
                                                     //         $("#msgcontainer").fadeOut("slow");
                                                     //     }, 2000 );
                                                     }
                                                     setTimeout(function(){// wait for 5 secs(2)
                                                                window.location.href=window.location.href;
                                                                
                                                                //               location.href('{{route('status.index',$id)}}');// then reload the page.(3)
                                                                }, 1500);
                                                     }
                                                     });
                                              });
                                 
                                 
                                 
                                 
                                 });
                    
                    
                    
                    
                    // issue delete
                    $('body').on('click','.statusdelconfrimmodal',function(e){
                                 var id = $(this).attr('value');
                                 e.preventDefault();
                                 
                                 //when confirm modal clicked
                                 $('body').on('click','.issuedelbtn',function(e){
                                              e.preventDefault();
                                              issuedelete();
                                              });
                                 
                                 
                                 function issuedelete() {
                                 
                                 $.ajaxSetup({
                                             headers: {
                                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                             }
                                             });
                                 
                                 
                                 $.ajax({
                                        url: 'status',
                                        type: 'DELETE',
                                        data: {
                                        "id": id
                                        },
                                        success: function(response){
                                        
                                        $.iaoAlert({msg: "Data has been deleted",
                                                   type: "success",
                                                   mode: "dark",});
                                        
                                        setTimeout(function(){// wait for 5 secs(2)
                                                   location.reload(); // then reload the page.(3)
                                                   }, 1000);
                                        }
                                        });
                                 
                                 }
                                 });
                    
                    // PROJECT LIST DRAG DROP SORTING
                    $( "#tablecontents" ).sortable({
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
                                      // alert(JSON.stringify(order, null, 4));exit();
                                      });
                    $.ajax({
                           url: 'status',
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
                    });
</script>



@endsection

