@extends('master')
@section('mainContent')
<div class="" style="margin-top: -20px;">
   <div class="card-datatable" style="margin-top: 0px; padding: 0px;">
      <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
         <div class="row">
            <div class="col-sm-12 col-md-6">
              <a href="apps/create" class="btn btn-success btn-sm  dtb_custom_btn_default" style="margin-bottom: -55px;">Add App</a> 
            </div>
            <div class="col-sm-12 col-md-6">
                
            </div>
         </div><br><br><br>
         <div class="row">
            <div class="col-md-12">

          @if(session()->has('message'))
            <br>
            <div class="alert alert-success mb-10 background-success" role="alert">
              {{ session()->get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

                    
              <style>
              @media screen and (min-width: 767px) {
                  .isarchivedarea {
                      position: absolute;
                      top: -20px;
                      z-index: 999999;
                      right: 222px;
                    }
                }
                @media screen and (max-width: 767px) {
                  .isarchivedarea{
                    position: absolute;
                    top: -62px;
                    z-index: 999999;
                    left: 155px;
                  }
                }

              </style>

              <div class="isarchivedarea" style="">

                <div class="row px-0">
                <label class="custom-control custom-checkbox mt-4 ml-3 mb-0">
                <input type="checkbox" name="is_archived" value="1" class="custom-control-input" id="chckarchived" style="border-color: #000">
                <span class="custom-control-label" style="color: #000">Include archived apps</span>
                </label>
                <label class="custom-control custom-checkbox mt-4 ml-0 mb-0">
                <a class="btn-primary btn-sm mt-1 dtb_custom_btn_default" id="chckarchivedbtn" href="#" style="padding: 4px 12px;">Search</a>
                </label>
                </div>

              </div>


{{-- TBL ARCHIVED --}}
               <table id="tblarchived" class="datatables-demo table table-striped table-bordered dataTable no-footer dtb_custom_tbl_common
" role="grid" aria-describedby="tickets-list_info" style="width: 1206px;">
                  <thead>
                     <tr role="row">
                        <th ></th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th style="width: 72px">Target Sdk</th>
                       <!--  <th >Repo</th> -->
                        <th >Deployment Target</th>
                       <!--  <th >Deployment Url</th> -->
                        <th >Company Name</th>
                        <th >IDE version</th>
                        <!-- <th >Memo</th> -->
          
                        <th class="sorting_disabled" style="width: 150px">Screen Group</th>
                     </tr>
                  </thead>

                  <tbody id="apptrdragable">


                    @php $sl = 1; @endphp
                    @foreach($dtbapps as $dtbapp)

                         <tr role="row" class="odd row1" data-id="{{ $dtbapp->id }}" id="{{$dtbapp->id}}">
                            <td class="py-0 sorting_1 " ><div style="display: flex;color: #00000063;margin-left: 3px;margin-top: 4px"> <i class="fas fa-th-list d-block"></i></div></td>
                            <td class="py-0" style="width: 200px;"><a style="width:200px;" href="{{route('apps.show', [$id,$dtbapp->id])}}">{{$dtbapp->app_name}}  <span style="color: gray;font-size: 12px">@if ($dtbapp->is_archived == 1) (Archived)  @endif</span></a></td>
                            <td class="py-0" style="width: 170px;">
                              <a style="width:170px;" href="{{route('apps.show', [$id,$dtbapp->id])}}"><?php 
                                if (!empty($dtbapp->app_short_name)) {?>
                                  {{$dtbapp->app_short_name}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                            </td>
                            <td class="py-0">
                              <a href="{{route('apps.show', [$id,$dtbapp->id])}}"> <?php 
                                if (!empty($dtbapp->target_sdk)) {?>
                                  {{$dtbapp->target_sdk}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                              
                            </td>                       
   
                            <td class="py-0">
       
                               <a href="{{route('apps.show', [$id,$dtbapp->id])}}"><?php 
                                if (!empty($dtbapp->deployment_target)) {?>
                                  {{$dtbapp->deployment_target}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>

                            </td>                            

                            <td class="py-0">
                               <a href="{{route('apps.show', [$id,$dtbapp->id])}}"> <?php 
                                if (!empty($dtbapp->company_name)) {?>
                                  {{$dtbapp->company_name}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                              
                            </td>

                            <td class="py-0">
                               <div class="ticket-priority btn-group">
                                  <a href="{{route('apps.show', [$id,$dtbapp->id])}}"><?php 
                                if (!empty($dtbapp->ide_version)) {?>
                                  {{$dtbapp->ide_version}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                               </div>
                            </td>  

                            <!-- <td class="py-0">

                              <div class="memocontent" rows="10" cols="82" style="display: block;">
                                <a href="{{route('apps.show', [$id,$dtbapp->id])}}"><?php //if (!empty($dtbapp)) {echo $cleanStr = substr(preg_replace("/[^ \w]+/", "", $dtbapp->memo),0,10).".."; } ?></a>
                              </div>
                               <div class="ticket-priority btn-group appmemoshowhere">
                                </div>

                            </td> -->

                            <td class="py-0">
                                <!-- <a href="{{route('apps.edit', [$id,$dtbapp->id])}}" class="btn btn-default btn-xs icon-btn md-btn-flat product-tooltip" title="" data-original-title="Edit"><i class="ion ion-md-create"></i>
                                </a>&nbsp; -->
                                 {{--  <a href="#" data="{{ $dtbapp->id }}" class="btn btn-xs icon-btn md-btn-flat product-tooltip appdelbtn" title="Remove" style="margin-left: 15px;padding: 1px;margin-top: 9px;"><span class="glyphicon glyphicon-trash"></span>
                                </a> --}}

                                <div class="ticket-priority btn-group">

                                  <a href="{{route('screengroup.show', [$id,$dtbapp->screen_group_id])}}"><?php 
                                if (!empty($dtbapp->screen_group_name)) {?>
                                  {{$dtbapp->screen_group_name}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                               </div>
                                
                            </td>
                         </tr>

                    @endforeach


                  </tbody>
               </table>

{{-- TBL NOT ARCHIVED --}}

               <table id="tblnotarchived" class="datatables-demo table table-striped table-bordered dataTable no-footer dtb_custom_tbl_common
" role="grid" aria-describedby="tickets-list_info" style="width: 1206px;">
                  <thead>
                     <tr role="row">
                        <th ></th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th style="width: 72px">Target Sdk</th>
                       <!--  <th >Repo</th> -->
                        <th >Deployment Target</th>
                       <!--  <th >Deployment Url</th> -->
                        <th >Company Name</th>
                        <th >IDE version</th>
                        <!-- <th >Memo</th> -->
          
                        <th class="sorting_disabled" style="width: 150px">Screen Group</th>
                     </tr>
                  </thead>

                  <tbody id="apptrdragable2">


                <?php 
                      $archivedapp = DB::table('dtb_apps')
                      ->where('dtb_apps.project_id',$id)
                      ->where('dtb_apps.is_archived',0)
                      ->leftJoin('dtb_screen_groups', function($join) {
                        $join->on('dtb_apps.screen_group_id', '=', 'dtb_screen_groups.id');
                      })
                      ->orderBy('dtb_apps.ordering','ASC')->get(['dtb_apps.id','dtb_apps.app_name','dtb_apps.app_short_name','dtb_apps.target_sdk','dtb_apps.deployment_target','dtb_apps.deploy_url','dtb_apps.ide_version','dtb_apps.company_name','dtb_apps.repo','dtb_apps.screen_group_id','dtb_apps.ordering','dtb_apps.created_at','dtb_screen_groups.screen_group_name']);
                      ?>


                    @php $sl = 1; @endphp
                    @foreach($archivedapp as $archivedapps)

                         <tr role="row" class="odd row1" data-id="{{ $archivedapps->id }}" id="{{$archivedapps->id}}">
                            <td class="py-0 sorting_1 " ><div style="display: flex;color: #00000063;margin-left: 3px;margin-top: 4px"> <i class="fas fa-th-list d-block"></i></div></td>
                            <td class="py-0" style="width: 200px;"><a style="width:200px;" href="{{route('apps.show', [$id,$archivedapps->id])}}">{{$archivedapps->app_name}} </a></td>
                            <td class="py-0" style="width: 170px;">
                              <a style="width:170px;" href="{{route('apps.show', [$id,$archivedapps->id])}}"><?php 
                                if (!empty($archivedapps->app_short_name)) {?>
                                  {{$archivedapps->app_short_name}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                            </td>
                            <td class="py-0">
                              <a href="{{route('apps.show', [$id,$archivedapps->id])}}"> <?php 
                                if (!empty($archivedapps->target_sdk)) {?>
                                  {{$archivedapps->target_sdk}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                              
                            </td>                       
   
                            <td class="py-0">
       
                               <a href="{{route('apps.show', [$id,$archivedapps->id])}}"><?php 
                                if (!empty($archivedapps->deployment_target)) {?>
                                  {{$archivedapps->deployment_target}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>

                            </td>                            

                            <td class="py-0">
                               <a href="{{route('apps.show', [$id,$archivedapps->id])}}"> <?php 
                                if (!empty($archivedapps->company_name)) {?>
                                  {{$archivedapps->company_name}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                              
                            </td>

                            <td class="py-0">
                               <div class="ticket-priority btn-group">
                                  <a href="{{route('apps.show', [$id,$archivedapps->id])}}"><?php 
                                if (!empty($archivedapps->ide_version)) {?>
                                  {{$archivedapps->ide_version}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                               </div>
                            </td>  

                            <!-- <td class="py-0">

                              <div class="memocontent" rows="10" cols="82" style="display: block;">
                                <a href="{{route('apps.show', [$id,$archivedapps->id])}}"><?php //if (!empty($archivedapps)) {echo $cleanStr = substr(preg_replace("/[^ \w]+/", "", $archivedapps->memo),0,10).".."; } ?></a>
                              </div>
                               <div class="ticket-priority btn-group appmemoshowhere">
                                </div>

                            </td> -->

                            <td class="py-0">
                                <!-- <a href="{{route('apps.edit', [$id,$archivedapps->id])}}" class="btn btn-default btn-xs icon-btn md-btn-flat product-tooltip" title="" data-original-title="Edit"><i class="ion ion-md-create"></i>
                                </a>&nbsp; -->
                                 {{--  <a href="#" data="{{ $archivedapps->id }}" class="btn btn-xs icon-btn md-btn-flat product-tooltip appdelbtn" title="Remove" style="margin-left: 15px;padding: 1px;margin-top: 9px;"><span class="glyphicon glyphicon-trash"></span>
                                </a> --}}

                                <div class="ticket-priority btn-group">

                                  <a href="{{route('screengroup.show', [$id,$archivedapps->screen_group_id])}}"><?php 
                                if (!empty($archivedapps->screen_group_name)) {?>
                                  {{$archivedapps->screen_group_name}}
                                <?php }else{
                                  echo "";
                                }
                               ?></a>
                               </div>
                                
                            </td>
                         </tr>

                    @endforeach


                  </tbody>
               </table>


            </div>
         </div>
        
      </div>
   </div>
</div>


<style>
  table#tickets-list tr td a {
    float: left;
    display: block;
    padding: 9px 0px;
}  

table#tickets-list tr td  {
overflow-wrap: break-word;
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


///////////include archive section OPERATION ////////////////////

 $('#tblarchived').dataTable({
      "bLengthChange": false,
      "paging": false,
      "info": false,
      "order":[]
  });
 
  $('#tblnotarchived').dataTable({
      "bLengthChange": false,
      "paging": false,
      "info": false,
      "order":[]
  });


  $("#tblnotarchived").show();
  $("div#tblarchived_wrapper").css({"display": "none"});
  $("#tblarchived").hide();

  $(".witharchivecount").hide();
  $(".withoutarchivecount").show();

//uncheck after check ,this will be triggered
  $('#chckarchived').change(function() {
    if($("#chckarchived").is(":not(:checked)")){
      $("#tblnotarchived").show();
      $("div#tblnotarchived_wrapper").css({"display": "block"});
      $("#tblarchived").hide();
      $("div#tblarchived_wrapper").css({"display": "none"});

      $(".witharchivecount").hide();
      $(".withoutarchivecount").show();

    }  
  });


//after clicking search button this code will execute
        $('#chckarchivedbtn').click(function(e){
            e.preventDefault();

            if($("#chckarchived").is(":not(:checked)")){
              alert('check the box first!');
            }

            if($("#chckarchived").is(":checked")){


             $("#tblnotarchived").hide();
             $("div#tblnotarchived_wrapper").css({"display": "none"});
             $("#tblarchived").show();
             $("div#tblarchived_wrapper").css({"display": "block"});

             $(".witharchivecount").show();
             $(".withoutarchivecount").hide();


          }else if($("#chckarchived").is(":not(:checked)")){

            $("#tblnotarchived").show();
            $("div#tblnotarchived_wrapper").css({"display": "block"});
            $("#tblarchived").hide();
            $("div#tblarchived_wrapper").css({"display": "none"});

            $(".witharchivecount").hide();
            $(".withoutarchivecount").show();
  
          }

        });






///////////APP DELETE OPERATION ////////////////////
  $('body').on('click','.appdelbtn',function(e){
     e.preventDefault();

    var appid = $(this).attr('data');

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
             $.ajax({
                url: 'apps/'+appid,
                type: 'DELETE',
                data: {
                "appid": appid
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



   
///////// app LIST DRAG DROP SORTING 2nd ///////////////////////
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
          url: 'apps',
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
///////// app LIST DRAG DROP SORTING ///////////////////////
    $( "#apptrdragable2" ).sortable({
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
          url: 'apps',
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

// $(document).ready(function() {
//   $('#tickets-list').dataTable({
//      "bLengthChange": false
//     });
// });

$(document).ready(function() {
   $('#tickets-list').dataTable({
      "bLengthChange": false,
      "paging": false,
      "info": false,
      "order":[]
     });
 });


</script>
@endsection

