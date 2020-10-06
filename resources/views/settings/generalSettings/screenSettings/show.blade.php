@extends('master')
@section('mainContent')
<div class="mt-4" >

   <div class="card-datatable" style="margin-top: 0px; padding: 0px;">
      <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">


         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="padding: 0px 12px !important">
              <div class="screentgrpbtnholder">
                <a href="{{route('screencreate', [$id,$screengroupid])}}" class="btn btn-success btn-sm  dtb_custom_btn_default" style="float: left;" >Add New Screen</a>  
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

         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

               <table id="tickets-list" class="datatables-demo table table-striped table-bordered dataTable no-footer dtb_custom_tbl_common" role="grid" aria-describedby="tickets-list_info" style="width: 1206px;">
                  <thead>
                     <tr role="row">
                      <th  style="width: 20px !important;padding: 0" width="20px"></th>
                        <th style="width: 60px !important;padding: 0" width="35px">Screen</th>
                        <th>FunctionGroupName</th>
                        <th>Screen Name</th>
                        {{-- <th class="sorting_disabled" style="width: 70px">Description</th> --}}
                     </tr>
                  </thead>

                 <tbody id="apptrdragable">

                        @foreach($screenlist as $screenslists)
                         <tr role="row" class="odd row1" data-id="{{ $screenslists->id ?? '' }}" id="{{ $screenslists->id ?? '' }}">

                        <td class="py-0 sorting_1 " style="width: 10px"><div style="display: flex;color: #00000063;margin-left: 3px;margin-top: 4px"> <i class="fas fa-th-list d-block"></i></div></td>
                        
                            <td class="py-0 sorting_1 p-1" style="width: 50px"> 
                              <div class="screenlistimg">
                                <a href="{{route('screensingle', [$id,$screengroupid,$screenslists->id])}}">
                                  <?php
                                    if(!empty($screenslists->image_url)){ ?>
                                   {{--  <img src=" {{ URL::to('/') }}/uploads/screenattachment/{{ $screenslists->image_url ?? '' }}" alt="screen">  --}} 
                                   <img src="{{ $screenslists->image_url ?? '' }}" alt="screen">
                                   <?php }else{
                                    echo "";
                                    }
                                   ?>
                                </a>
                              </div>
                            </td>

                            <td class="py-0" style="width: 200px;"><a style="color: black" href="{{route('screensingle', [$id,$screengroupid,$screenslists->id])}}">{{ $screenslists->function_group_name ?? '' }}</a></td>

                            <td class="py-0" style="width: 200px;"><a style="color: black" href="{{route('screensingle', [$id,$screengroupid,$screenslists->id])}}">{{ $screenslists->screen_name ?? '' }}</a></td>                                                

                            {{-- td class="py-0 detailtd"  style="width: 15px"> --}}
                                  {{-- @if(!empty($screenslists->detail)) --}}
                                    <?php 
                                    //$parser = new \cebe\markdown\GithubMarkdown();
                                   // $parser->html5 = true;
                                    //$parser->enableNewlines = true;
                                   // $parser->keepListStartNumber = true;
                                    //$persedcontent = $parser->parse($screenslists->detail);

                                        //$string = $persedcontent;
                                        //$words  = array_slice(explode(' ', $string), 0, 3);
                                        //echo $output = implode(' ', $words)."..";
                                    ?>
                           
                                  {{-- @endif --}}
                            {{-- </td> --}}

                         </tr>
                         @endforeach
                  </tbody>

            <div class="col-md-2"></div>
               </table>
            </div>
            <div class="col-md-2"></div>

         </div>
        
      </div>
   </div>
</div>









<style>


.fileContainer {
    overflow: hidden;
    /* position: relative; */
    border: 2px dashed #718aa8a1;
    /* float: left; */
    padding: 16px 11px 27px 11px;
    width: 100%;
}
label#fileSelectBox span {
    font-size: 13px;
    margin-bottom: 4px;
    /* float: left; */
}
.fileContainer [type=file] {
    background: lightgray;
    cursor: pointer;
    padding: 4px 5px;
    filter: alpha(opacity=0);
}
.fileContainerFileName {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.fileContainerButton {
padding: 0.5em;
border: 1px solid #a0a0a0;
float: right;
display: inline-block;
}
.fileContainerDragOver {
background-color: gold;
border: 2px solid #808080;
}

.alert-danger {
    border-color: #ead7d7;
    background-color: #0f0f0f14 !important;
    color: #645c5c;
}

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
a.btn.btn-default.btn-secondary.fileinput-upload.fileinput-upload-button {
    display: none;
}
button.kv-file-upload.btn.btn-kv.btn-default.btn-outline-secondary {
    display: none;
}
.file-preview{
  overflow: hidden;
}
.file-drop-zone{
  overflow: hidden;
}
div.dataTables_wrapper .dataTables_filter input{
  margin-right: -24px;
}
div#tickets-list_paginate {
    margin-right: -23px;
}

.screenlistimg {
    width: 60px;
    margin: 0 auto;
    overflow: hidden;
    text-align: center;
    max-height: 70px;
}
.screenlistimg img {
    width: auto;
    height: 100%;
}
div#results {
    width: 100%;
}
table#tickets-list tr td a {
    /* float: left; */
    display: block;
    height: 60px;
    padding: 2px 0px;
}
.detailtd h1, h2, h3, h4 {
    font-size: 14px;
}
.detailtd img {
    width: 44%;
    float: left;
    margin-right: 5px;
    margin-bottom: 5px;
}

.detailtd p {
    overflow: hidden;
    margin-bottom: 5px;
}
</style>

<!-- <script src="{{asset('assets_/vendor/libs/dropzone/dropzone.js')}}"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.0/showdown.min.js"></script> -->
<script src="{{asset('/assets/js/marked.min.js')}}"></script>
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>


<script type="text/javascript">

  $( document ).ready(function() {



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
          url: +<?php echo $screengroupid; ?>+'/screenorder',
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
      "paginate": false,
      "order":[]
     });
 });
</script>
@endsection

