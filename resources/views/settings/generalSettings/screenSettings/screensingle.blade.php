@extends('master')
@section('mainContent')
<div class="mt-5" >

 <div class="card-datatable" style="margin-top: 0px; padding: 0px;">
  <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

    {{-- next {{ $next }}
    prve {{ $previous }} --}}


    <div class="errorholder">
      @if(session()->has('message'))
      <div class="alert alert-danger mb-0 background-success p-2 mt-4 mb-4" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="screentgrpbtnholder">
          <a href="{{route('screengroup.show', [$id,$screengroupid])}}" class="btn btn-success btn-sm  dtb_custom_btn_default" style="float: left;margin-left: -8px" >Back to list</a>  

          <span style="margin-left: 30px;float: left;margin-top: 1px">

            @if (isset($previous))
            <a class="btn btn-sm" href="{{route('screensinglerank', [$id,$screengroupid,$previous])}}" {{ $previous ? '' : 'disabled' }} style="border:1px solid #718aa8"> < Previous Screen</a>
            @else
            <a class="btn btn-sm ml-1" disable="true" style="border: 1px solid #718aa875;color: #00000085;cursor: not-allowed;"> < Previous Screen</a>
            @endif               

            @if (isset($next))
            <a class="btn btn-sm ml-1" href="{{route('screensinglerank', [$id,$screengroupid,$next])}}" {{ $next ? '' : 'disabled' }} style="border:1px solid #718aa8">Next Screen > </a>
            @else
            <a class="btn btn-sm ml-1" disable="true" style="border: 1px solid #718aa875;color: #00000085;cursor: not-allowed;">Next Screen > </a>
            @endif


          </span>
        </div>
      </div>
      <?php 
      if (!empty($screendetails)) { ?>
        <div class="col-md-8" style="padding: 0px 12px !important">
          <a href="#" class="btn btn-success btn-sm  dtb_custom_btn_default pull-right" data-toggle="modal" data-target="#screendelconfmodal" style="">Delete Screen</a>

<!-- Modal for archive confirmation -->
                      <div class="modal fade" id="screendelconfmodal" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color: #f8d7da;">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h6 class="modal-title">Are you sure to delete this screen?</h6>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger deletescreenbtn" data=""  id="deletescreen">YES</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
                            </div>
                          </div>
                        </div>
                      </div>


          <a href="{{route('screenedit', [$id,$screengroupid,$screenid])}}" class="btn btn-success btn-sm  dtb_custom_btn_default pull-right mr-2" style="" id="editscreen">Edit Screen</a>

        </div>
      <?php } ?>
    </div><br>



    <?php 
    if (empty($screendetails)) { ?>
      <h4 style="text-align: center;margin-top: 47px;">Sorry !! Data not available !</h4>
    <?php }else{ ?>


     <div class="row">
      <div class="col">

        <div class="screenmetainfo">
          <span>{{ $screendetails->screen_group_name ?? '' }}</span> &nbsp;|&nbsp; 
          <span>{{ $screendetails->function_group_name ?? '' }}</span> &nbsp;|&nbsp;
          <span>{{ $screendetails->screen_name ?? '' }}</span> 
        </div>


        <div class="card mb-4">

          <div class="card-body">
            <div class="ui-bordered">
             {{-- <img class="w-100 m-auto" src="{{ $screendetails->image_url ?? '' }}" alt="screen"> --}}
             <div class="imageholder" id="customscroll">



              <?php
              if(!empty($screendetails->image_url)){ ?>
                <img class="w-100 m-auto" src=" {{ $screendetails->image_url ?? '' }}" alt="screen">
              <?php }else{
                echo "";
              }

              ?>

            </div>

            <div class="p-2" style="overflow: hidden;">
              <br>
              <h5 class="pb-0">Description</h5>
              <hr>
              {{-- <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h5> --}}
              <div class="screeneditorattachment">
               @if(!empty($screendetails->detail))
               <?php 
               $parser = new \cebe\markdown\GithubMarkdown();
               $parser->html5 = true;
               $parser->enableNewlines = true;
               $parser->keepListStartNumber = true;
               echo $parser->parse($screendetails->detail);
               ?>

               @endif
             </div>

           </div>
         </div>
       </div>

     </div>
   </div>
   <div class="col">



    <!-- Side info -->
    <span style="    float: right;width: 100%;text-align: right;margin-bottom: 5px;margin-top: 10px;margin-right: 4px;"><span style="padding: 2px 6px;background: white">Created :  <?php echo date('d-m-Y', strtotime($screendetails->created_at ?? '' )); ?></span></span>
    <!-- Friends -->
    <div class="card mb-4">
      <div class="card-header with-elements">

        <span class="card-header-title">Actions &nbsp;
          <small class="text-muted"></small>
        </span>

        <div class="card-header-elements ml-md-auto">
          <a href="javascript:void(0)" class="btn btn-default md-btn-flat btn-xs addactionbtn" data-toggle="modal" data-target="#actionaddmodal">Add Action</a>
        </div>

        <!-- Modal for add action of screen-->
        <div class="modal fade" id="actionaddmodal" tabindex="-1" role="dialog" aria-labelledby="actionaddmodalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">


               {!! Form::open(['method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'addactionform','class' => 'form-horizontal'])!!}

               <div class="form-group">
                <label for="action_name"><strong>Action Name</strong></label>
                <input type="text" name="action_name" class="form-control" id="action_name" placeholder="Enter Name of action" required />
              </div> 

              <input type="hidden" id="screenid" name="screen_id" value="{{ $screenid ?? '' }}">


              <div class="form-group">
                <label for="action_type"><strong>Action Type</strong></label>
                <input type="text" name="action_type" class="form-control" id="action_type" placeholder="Enter Type of action" required />
              </div>

              <div class="form-group">
               <label class="col-form-label text-sm-right">Description</label>
               <div class="">
                <div id="editSection"></div>
                <textarea id="content2bSavedHolder" name="detail" class="form-control" style="display: none;"> </textarea>

                @if ($errors->has('detail'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>The Description field is required</strong></span>
                </span>
                @endif
              </div>
            </div>


          </div>
          <div class="modal-footer">
            <button type="sumbit" class="btn btn-primary" id="actionaddbtn">Add</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div> 










    <!-- Modal for edit action of screen-->
    <div class="modal fade" id="actioneditmodal" tabindex="-1" role="dialog" aria-labelledby="actioneditmodal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Action</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">


           {!! Form::open(['method' => 'PUT','files' => true, 'enctype' => 'multipart/form-data','id' => 'actioneditmodal','class' => 'form-horizontal'])!!}

           <div class="form-group">
            <label for="action_name"><strong>Action Name</strong></label>
            <input type="text" name="action_name" class="form-control" id="edit_action_name" placeholder="Enter Name of action" required />
          </div> 

          <input type="hidden" id="editscreenid" name="screen_id" value="{{ $screenid ?? '' }}">
          <input type="hidden" id="editactionid" name="action_id" value="">


          <div class="form-group">
            <label for="action_type"><strong>Action Type</strong></label>
            <input type="text" name="action_type" class="form-control" id="edit_action_type" placeholder="Enter Type of action" required />
          </div>


          <div class="">
            <label for="action_type"><strong>Description</strong></label>
            <div id="editSection2"></div>
            <textarea id="content2bSavedHolder2" name="detail" class="form-control" style="display: none;"> </textarea>

            @if ($errors->has('detail'))
            <span class="invalid-feedback" role="alert">
              <span class="messages"><strong>The Description field is required</strong></span>
            </span>
            @endif
          </div>

          <style type="text/css">
            .delete_bttn{
              color: red;
              border: red;
            }
            .delete_bttn:hover{
              color: #FFFFFF;
            }
          </style>

        </div>

        <div class="modal-footer footer_actions" style="display: unset !important;">
          <button style="float: left; color: red; border: 1px solid red;" class=" float-left delete_bttn delete_confirm">Delete</button>
          <button type="sumbit" class="btn btn-primary float-right" id="actioneditbtn">Done</button>
          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>

        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <!--  start Confirmation delete modal -->
 

  <!-- Modal -->
  <div id="delete_confirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #F7D7DA !important;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to delete?</h4>
        </div>
        <div class="modal-body">
          <button type="button" class="btn btn-default" id="actionDeletebtn">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        
      </div>

    </div>
  </div>

</div>



<div class=" no-gutters row-bordered row-border-light" style="padding:7px 7px">

  <table id="screenactiontbl" class=" table table-striped table-bordered no-footer dtb_custom_tbl_common" >
    <thead>
      <tr>
        <td style="width: 40px"></td>
        <td>Action Name</td>
        <td>Action Type</td>
        <td>Description</td>
        <td></td>
      </tr>
    </thead>

    <tbody id="results" class="ui-sortable orderinable">
     {{--  <div id="results"></div> --}}
   </tbody>
 </table>
</div>
</div>
<!-- / Friends -->
<!-- Photos -->
<div class="card mb-4">
  <div class="card-header">
    <span class="card-header-title">Items</span>

    <a style="float: right;" href="javascript:void(0)" class="btn btn-default md-btn-flat btn-xs" data-toggle="modal" data-target="#itemaddmodal">Add Items</a>

    <!-- Modal for add action of screen-->
    <div class="modal fade" id="itemaddmodal" tabindex="-1" role="dialog" aria-labelledby="itemaddmodalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">


           {!! Form::open(['method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'additemform','class' => 'form-horizontal'])!!}

           <div class="form-group">
            <label for="action_name"><strong>Item Name</strong></label>
            <input type="text" name="item_name" class="form-control" id="item_name" placeholder="Enter Name of item" required />
          </div> 

          <input type="hidden" id="screenids" name="screen_id" value="{{ $screenid ?? '' }}">

          <div class="form-group">
            <label for="action_type"><strong>Item Controll Name</strong></label>
            <input type="text" name="item_controll_name" class="form-control" id="item_controll_name" placeholder="Enter controll name" required />
          </div>  

          <div class="form-group">
            <label for="action_type"><strong>Display</strong></label>
            <input type="text" name="display" class="form-control" id="display" placeholder="Enter display" required />
          </div>


          <div class="form-group">
            <label for="action_type"><strong>Color</strong></label>
            <input type="text" name="color" class="form-control" id="color" placeholder="Enter color" required />
          </div>

          <div class="form-group">
            <label for="action_type"><strong>Action</strong></label>
            <input type="text" name="action" class="form-control" id="action" placeholder="Enter action" required />
          </div>


        </div>
        <div class="modal-footer">
          <button type="sumbit" class="btn btn-primary" id="itemaddbtn">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <!-- Modal for edit item of screen-->
  <div class="modal fade" id="itemeditmodal" tabindex="-1" role="dialog" aria-labelledby="itemeditmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


         {!! Form::open(['method' => 'PUT','files' => true, 'enctype' => 'multipart/form-data','id' => 'edititemform','class' => 'form-horizontal'])!!}

         <div class="form-group">
          <label for="action_name"><strong>Item Name</strong></label>
          <input type="text" name="item_name" value="" class="form-control" id="edit_item_name" placeholder="Enter Name of item" required />
        </div> 

        <input type="hidden" id="edit_itemids" name="item_id" value="">
        <input type="hidden" id="edit_screen_itemids" name="screen_id" value="">

        <div class="form-group">
          <label for="action_type"><strong>Item Controll Name</strong></label>
          <input type="text" name="item_controll_name" class="form-control" id="edit_item_controll_name" placeholder="Enter controll name" required />
        </div>  

        <div class="form-group">
          <label for="action_type"><strong>Display</strong></label>
          <input type="text" name="display" class="form-control" id="edit_display" placeholder="Enter display" required />
        </div>


        <div class="form-group">
          <label for="action_type"><strong>Color</strong></label>
          <input type="text" name="color" class="form-control" id="edit_color" placeholder="Enter color" required />
        </div>

        <div class="form-group">
          <label for="action_type"><strong>Action</strong></label>
          <input type="text" name="action" class="form-control" id="edit_action" placeholder="Enter action" required />
        </div>


      </div>
     <!--  <div class="modal-footer">
        <button type="sumbit" class="btn btn-primary" id="itemeditbtn">Add</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div> -->

      <div class="modal-footer footer_actions" style="display: unset !important;">
          <button style="float: left; color: red; border: 1px solid red;" class=" float-left delete_bttn delete_item_confirm">Delete</button>
          <button type="sumbit" class="btn btn-primary float-right" id="itemeditbtn">Done</button>
          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>

        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div>

  <div id="delete_items_confirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #F7D7DA !important;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to delete?</h4>
        </div>
        <div class="modal-body">
          <button type="button" class="btn btn-default" id="actionDeleteItembtn">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        
      </div>

    </div>
  </div>

<div style="width: 94%;margin: 0 auto;padding: 14px 0px;">

  <div id="results2"></div>

  <table id="screenitemtbl" class="datatables-demo table table-striped table-bordered dataTable no-footer dtb_custom_tbl_common" >
    <thead>
      <tr>
        <td></td>
        <td style="width: 80px">Item</td>
        <td>Controll Name</td>
        <td>Display</td>
        <td>Color</td>
        <td>Action</td>
        <td></td>
      </tr>
    </thead>

    <tbody id="" class="ui-sortable orderinableitemtbl">

      @if (isset($screenitems))
      @foreach ($screenitems as $screenitem)

      <tr role="row" class="row1 ui-sortable-handle odd" data-id="{{ $screenitem->id ?? '' }}" id="{{ $screenitem->id ?? '' }}">
        <td><div style="display: flex;color: #00000063;margin-left: 3px;margin-top: 4px"> <i class="fas fa-th-list d-block"></i></div></td>
        <td class="py-1 sorting_1" style="width: 55px">
         {{ $screenitem->item_name ?? '' }}
       </td>
       <td class="py-1">
        {{ $screenitem->item_controll_name ?? '' }}
      </td>
      <td class="py-1">
        {{ $screenitem->display ?? '' }}
      </td>
      <td class="py-1">
        {{ $screenitem->color ?? '' }}
      </td> 
      <td class="py-1">
        {{ $screenitem->action ?? '' }}
      </td>

      <td>
        <a href="#" data="" class="btn btn-xs icon-btn md-btn-flat itemeditmodal" title="Remove"  data-toggle="modal" data-target="#itemeditmodal" data-item="{{ $screenitem->item_name ?? '' }}" data-id="{{$screenitem->id ?? ''}}" data-screenid="{{$screenitem->screen_id ?? ''}}"  data-itemcontroll="{{$screenitem->item_controll_name ?? ''}}" data-display="{{$screenitem->display ?? ''}}" data-color="{{$screenitem->color ?? ''}}" data-action="{{$screenitem->action ?? ''}}"><span class="far fa-edit d-block"></span>
        </a>
      </td>

    </tr>

    @endforeach
    @endif

  </tbody>

</table>
</div>
</div>
<!-- / Photos -->
</div>
</div>


<?php } ?>


</div>
</div>
</div>









<style>

  div.dataTables_wrapper .dataTables_filter input{
    margin-right: -24px;
  }
  div#tickets-list_paginate {
    margin-right: -23px;
  }


  div#results div {
    float: left;
    padding: 15px 4px;
    text-align: center;
    border-right: 1px solid #00000008;
    box-shadow: 11px 0px 7px #d7d7d7;
    margin-bottom: 5px;
    /* background: #f0f8ff47; */
    width: 142px;
  }


  .screeneditorattachment p img {
    width: 100%;
    float: left;
    margin-right: 5px;
    border: 1px solid #00000087;
    margin-bottom: 5px;
  }

  .screeneditorattachment table {
    margin: 2px 0 14px;
    /* color: #555; */
    width: auto;
    border-collapse: collapse;
    box-sizing: border-box;
  }
  .screeneditorattachment table th {
    border: 1px solid #72777b;
    border-top: 0;
    background-color: #7b8184;
    font-weight: 300;
    color: #fff;
    padding-top: 6px;
  }
  .screeneditorattachment table td {
    border: 1px solid #eaeaea;
  }

  .screeneditorattachment table th, .tui-editor-contents table td {
    height: 32px;
    padding: 5px 14px 5px 12px;
  }

  .screeneditorattachment table tr td {
    padding: 6px !important;
  }

  .imageholder {
    text-align: center;
    margin-top: 10px;
    margin-bottom: 10px;
    padding-top: 15px;
    width: 100%;
    overflow: hidden;
    margin: 0 auto;
    /*   height: 460px;*/
    /*   overflow-y: scroll;*/
  }



  .imageholder img {
    width: auto !important;
    text-align: center;
    margin: 0 auto !important;
    border: 1px solid #0000000d;
    max-height: 50vh !important;

  }

  /* width */
  #customscroll::-webkit-scrollbar {
    width: 6px;
  }

  /* Track */
  #customscroll::-webkit-scrollbar-track {
   /* background: #f1f1f1; */
 }
 
 /* Handle */
 #customscroll::-webkit-scrollbar-thumb {
   background: #718aa8; 
 }

 /* Handle on hover */
 #customscroll::-webkit-scrollbar-thumb:hover {
  background: #555; 
}





button.tui-color.tui-toolbar-icons {
  display: none;
}
.screenmetainfo {
  padding: 5px 1px 5px 3px;
  color: #38587dcc; 
  font-weight: bold;
  font-size: 18px;
  text-transform: capitalize;
}
</style>

<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>

<!-- <script src="{{asset('assets_/vendor/libs/dropzone/dropzone.js')}}"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.0/showdown.min.js"></script> -->
<script src="{{asset('/assets/js/marked.min.js')}}"></script>
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>

{{-- EDIT DETIALS EDITOR --}}



<script type="text/javascript">

  $( document ).ready(function() {

    $('body').on('click','#editactionid',function(e){

      e.preventDefault();

      var actionid = $(this).attr('editdataactionid');
      var actionname = $(this).attr('editdataactionname');
      var actiontype = $(this).attr('editdataactiontype');
      var editactiondetails = $(this).attr('editactiondetails');
      var screenids = $("#editscreenid").val();


      $("#edit_action_name").val(actionname);
      $("#edit_action_type").val(actiontype);
      $("#editactionid").val(actionid);

        //var editactiondetails = document.getElementsByClassName('detailedit').value,
        target = document.getElementById('editSection2'),
        converter = new showdown.Converter(),
        html = converter.makeHtml(editactiondetails);
        target.innerHTML = html;

          //TOAST UI MAIN SETTINGS
          var editor2 = new tui.Editor({
            el: document.querySelector('#editSection2'),
            initialEditType: 'markdown',
              // initialEditType: 'wysiwyg',
              initialValue: editactiondetails,
              previewStyle: 'vertical',
              height: '300px',
              exts: [
              {
                name: 'chart',
                minWidth: 100,
                maxWidth: 600,
                minHeight: 100,
                maxHeight: 200
              },
              'scrollSync',
              'colorSyntax',
              'uml',
              'mark',
              'table'
              ],   
              hooks: {
                addImageBlobHook: function (blob, callback) {
                  var myupload = ImageUpload(blob);
                            //console.log(blob);
                            var cllbackimg = myupload;
                            //var cllbackimg = document.location.origin +'/developmentmanage/public/'+myupload;
                            callback(cllbackimg, 'alt text');
                          }
                        }
                      });

          function ImageUpload(images){
            var myresult = "";
            var dataimg = new FormData();
            var form = dataimg.append('file', images);
            
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
              url : '{{ url('/uploadactionattach') }}',
              method: 'POST',
              async: false,
              cache : false,
              contentType : false,
              processData : false,
              data :  dataimg,
              success: function (response) {
                  //alert(response);
                  //console.log(response);
                  myresult = response;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  alert('error in uploading file');
                }
              });

            return myresult;
          }


        //BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED
        $('body').on('click','#actioneditbtn',function(e){
          e.preventDefault();
          var content2bSaved2 = editor2.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder2').html(content2bSaved2);

        });




        $('body').on('click','#actioneditbtn',function(e){

          e.preventDefault();



          var newactionid =  $("#editactionid").val();
          var newactionname =  $("#edit_action_name").val();
          var newactiontype = $("#edit_action_type").val();
          var actioneditdetails = $("#content2bSavedHolder2").val();



          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            url : '{{ url('/screenactionedit') }}',
            method: 'PUT',
            data: {
              actionname:newactionname,
              actiontype:newactiontype,
              actionid:newactionid,
              actioneditdetails:actioneditdetails,
              screenids:screenids,

            },
            success: function(response){
              if (response) {


                $('#actioneditmodal').modal('hide');

                $("#editactionid").val('');
                $('#edit_action_type').val('');
                $('#edit_action_type').val('');

                $.iaoAlert({msg: "Action edited",
                  type: "success",
                  mode: "dark",})

                getaction();

                setTimeout(function () {
                  location.reload()
                }, 1000);

              }



            },
            error: function() {
              alert('Error occurs!');
            }
          });

        });



      });


$('body').on('click','#actionDeletebtn',function(e){

          e.preventDefault();
          var newactionid =  $("#editactionid").val();

          //alert(newactionid);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            url : '{{ url('/screenActiondelete') }}',
            method: 'DELETE',
            data: {
              actionid:newactionid,
            },
            success: function(response){
              if (response) {

                $('#delete_confirm').modal('hide');
                $('#actioneditmodal').modal('hide');
                $("#editactionid").val('');
                $('#edit_action_type').val('');
                $('#edit_action_type').val('');

                $.iaoAlert({msg: "Action Deleted",
                  type: "success",
                  mode: "dark",})

                getaction();

                setTimeout(function () {
                  location.reload()
                }, 1000);

              }
            },
            error: function() {
              alert('Error occurs!');
            }
          });

        });


// delete item from modal

$('body').on('click','#actionDeleteItembtn',function(e){

          e.preventDefault();
          //var newactionid =  $("#editactionid").val();
          var itemid = $("#edit_itemids").val();

          //alert(itemid);

          //alert(newactionid);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            url : '{{ url('/screenItemActiondelete') }}',
            method: 'DELETE',
            data: {
              itemid:itemid,
            },
            success: function(response){
              if (response) {

                $('#delete_item_confirm').modal('hide');
                $('#actioneditmodal').modal('hide');
                $("#itemid").val('');
                $('#edit_action_type').val('');
                $('#edit_action_type').val('');

                $.iaoAlert({msg: "Item Deleted",
                  type: "success",
                  mode: "dark",})

                getaction();

                setTimeout(function () {
                  location.reload()
                }, 1000);

              }
            },
            error: function() {
              alert('Error occurs!');
            }
          });

        });



$('body').on('click','#delid',function(e){
  e.preventDefault();

});



$('body').on('click','.itemeditmodal',function(e){
  e.preventDefault();

  var itemid = $(this).attr('data-id');
  var screenid = $(this).attr('data-screenid');
  var itemname = $(this).attr('data-item');
  var itemcontroll = $(this).attr('data-itemcontroll');
  var itemaction = $(this).attr('data-action');
  var itemdisplay = $(this).attr('data-display');
  var itemcolor = $(this).attr('data-color');

  $("#edit_item_name").val(itemname);
  $("#edit_itemids").val(itemid);
  $("#edit_item_controll_name").val(itemcontroll);
  $("#edit_display").val(itemdisplay);
  $("#edit_color").val(itemcolor);
  $("#edit_action").val(itemaction);
  $("#edit_screen_itemids").val(screenid);

});


$('body').on('click','#itemeditbtn',function(e){

  e.preventDefault();

  var item_name = $("#edit_item_name").val();
  var itemid = $("#edit_itemids").val();
  var item_controll_name = $("#edit_item_controll_name").val();
  var display = $("#edit_display").val();
  var color = $("#edit_color").val();
  var action = $("#edit_action").val();
  var screenid = $("#edit_screen_itemids").val();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url : '{{ url('/screenitemedit') }}',
    method: 'PUT',
    data: {
      item_name:item_name,
      itemid:itemid,
      item_controll_name:item_controll_name,
      display:display,
      color:color,
      action:action,
      screenid:screenid
    },
    success: function(response3){
      if (response3) {
          // getitems();
          $('#itemeditmodal').modal('toggle');
          $.iaoAlert({msg: "Item Edited",
            type: "success",
            mode: "dark",})
        }

        setTimeout(function () {
          location.reload()
        }, 1000);

      },
      error: function() {
        alert('Error occurs!');
      }
    });


});






// getitems();
// function getitems(){

//       $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });

//     $.ajax({
//       url : '{{ url('/screenitemget') }}',
//       method: 'GET',
//       data: {
//           screenid:{{ $screenid ?? '' }},
//       },
//       success: function(response){
//         if (response) {
//           $("#results2").html(response);

//         }
//       },
//       error: function() {
//         alert('Error occurs!');
//      }
//   });


// }


$('body').on('click','#itemaddbtn',function(e){

  e.preventDefault();

  var item_name = $("#item_name").val();
  var screenids = $("#screenids").val();
  var item_controll_name = $("#item_controll_name").val();
  var display = $("#display").val();
  var color = $("#color").val();
  var action = $("#action").val();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url : '{{ url('/screenitemadd') }}',
    method: 'POST',
    data: {
      item_name:item_name,
      screenids:screenids,
      item_controll_name:item_controll_name,
      display:display,
      color:color,
      action:action
    },
    success: function(response2){
      if (response2) {
          // getitems();
          $('#itemaddmodal').modal('toggle');
          $.iaoAlert({msg: "Item added",
            type: "success",
            mode: "dark",})
        }

        setTimeout(function () {
          location.reload()
        }, 1000);

      },
      error: function() {
        alert('Error occurs!');
      }
    });


});




$('body').on('click','#deletescreen',function(e){
  e.preventDefault();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



  $.ajax({
    url : '{{ url('/screendelete') }}',
    method: 'DELETE',
    data: {
      screenid:{{ $screenid ?? '' }},
    },
    success: function(response){
      if (response) {
         $('#screendelconfmodal').modal('hide');
        $.iaoAlert({msg: "Screen Deleted !",
          type: "success",
          mode: "dark",});

              setTimeout(function(){// wait for 5 secs(2)
                window.location.href = "{{ route('screengroup.show',[$id,$screengroupid])}}";
              }, 1000);

            }

          },
          error: function() {
            alert('Error occurs!');
          }
        });



});





getaction();
function getaction(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url : '{{ url('/screenactionget') }}',
    method: 'GET',
    data: {
      screenid:{{ $screenid ?? '' }},
    },
    success: function(response){
      if (response) {
        $("#results").html(response);

      }
    },
    error: function() {
        //alert('Error occurs!');
      }
    });


}


$('body').on('click','.addactionbtn',function(e){

  $('#action_name').val('');
  $('#action_type').val('');
});


$('body').on('click','#actionaddbtn',function(e){

  e.preventDefault();
  var action_name = $("#action_name").val();
  var action_type = $("#action_type").val();
  var screenid = $("#screenid").val();
  var actiondetails = $("#content2bSavedHolder").val();


  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url : '{{ url('/screenactionadd') }}',
    method: 'POST',
    data: {
      action_name:action_name,
      action_type:action_type,
      screenid:screenid,
      actiondetails:actiondetails,
      _token: '{{csrf_token()}}'
    },
    success: function(response){
      if (response) {

        $('#actionaddmodal').modal('toggle');

        $('#action_name').val('');
        $('#action_type').val('');
        $('#content2bSavedHolder').val('');

        $.iaoAlert({msg: "Action added",
          type: "success",
          mode: "dark",})
      }
      getaction();

      setTimeout(function () {
        location.reload()
      }, 1000);

    },
    error: function() {
        //alert('Error occurs!');
      }
    });


});


///////// action LIST DRAG DROP SORTING ///////////////////////

$( ".orderinable" ).sortable({
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
        // var screenid = $(this).attr('data-id');
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
         // alert(JSON.stringify(order, null, 4));exit();
       });
  $.ajax({
    url: 'actionorderupdate',
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


///////// ITEMS LIST DRAG DROP SORTING ///////////////////////

$( ".orderinableitemtbl" ).sortable({
  items: "tr",
  cursor: 'move',
  opacity: 0.6,
  update: function() {
    arrangeitemorder();
  }
});

function arrangeitemorder() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var order = [];
  $('tr.row1').each(function(index,element) {
        // var screenid = $(this).attr('data-id');
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
         // alert(JSON.stringify(order, null, 4));exit();
       });
  $.ajax({
    url: 'itemorderupdate',
    type: 'POST',
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
  "order":[]
});
});

$(document).ready(function() {
 $('#screenitemtbl').dataTable({
  "bLengthChange": false,
  "paginate": false,
  "order":[]
});
});
</script>






<script type="text/javascript">

          //initial content
          var content = [' * * *',' ',].join('\n');

          //TOAST UI MAIN SETTINGS
          var editor = new tui.Editor({
            el: document.querySelector('#editSection'),
            initialEditType: 'markdown',
              // initialEditType: 'wysiwyg',
              initialValue: content,
              previewStyle: 'vertical',
              height: '300px',
              exts: [
              {
                name: 'chart',
                minWidth: 100,
                maxWidth: 600,
                minHeight: 100,
                maxHeight: 200
              },
              'scrollSync',
              'colorSyntax',
              'uml',
              'mark',
              'table'
              ],   
              hooks: {
                addImageBlobHook: function (blob, callback) {
                  var myupload = ImageUpload(blob);
                            //console.log(blob);
                            var cllbackimg = myupload;
                            //var cllbackimg = document.location.origin +'/developmentmanage/public/'+myupload;
                            callback(cllbackimg, 'alt text');
                          }
                        }
                      });


          function ImageUpload(images){
            var myresult = "";
            var dataimg = new FormData();
            var form = dataimg.append('file', images);
            
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
              url : '{{ url('/uploadappfiles') }}',
              method: 'POST',
              async: false,
              cache : false,
              contentType : false,
              processData : false,
              data :  dataimg,
              success: function (response) {
                  //alert(response);
                  //console.log(response);
                  myresult = response;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  alert('error in uploading file');
                }
              });

            return myresult;
          }


        //BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED
        $('body').on('click','#actionaddbtn',function(e){
          var content2bSaved = editor.getValue(); 
            //var content2bSaved = editor.getHtml();
            $('#content2bSavedHolder').html(content2bSaved);
          });



      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');

      
      $('body').on('click','.delete_confirm',function(e){

  e.preventDefault();
  
  $('#delete_confirm').modal('show');


});

      $('body').on('click','.delete_item_confirm',function(e){

  e.preventDefault();
  
  $('#delete_items_confirm').modal('show');


});

    </script>
    @endsection

