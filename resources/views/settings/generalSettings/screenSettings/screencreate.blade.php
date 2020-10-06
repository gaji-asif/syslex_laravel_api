@extends('master')
@section('mainContent')
<div class="" >

   <div class="card-datatable mt-5" style="">
      <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

{{-- <script src="{{asset('js/slim.min.js')}}"></script> --}}
<script src="{{asset('js/imoViewer.js')}}"></script>
<script>
 jQuery(function () {
    $('#file-input').imoViewer({
      'preview' : '#image-previewer',
    })
  });
</script>

         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="padding: 0px 12px !important">

                    <h4 class="px-0 ml-3" style="color: black">Add Screen</h4><br>
 
                    {!! Form::open(['route' => ['screenstore', $id,$screengroupid], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'screenaddform','class' => 'form-horizontal'])!!}

                          <div class="form-group row">
                            <div class="col-sm-12">
                              @if(session()->has('message'))
                              <br>
                              <div class="alert alert-success mb-10 background-success" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              @endif
                            </div>
                          </div>


                          <input type="hidden" name="project_id" value="<?php echo $id; ?>">
                          <input type="hidden" name="screen_group_id" value="<?php echo $screengroupid; ?>">


                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                               <label class="col-form-label text-sm-right">Function Group Name</label>
                               <div class="">
                                <input  name="function_group_name" type="text" class="form-control  {{ $errors->has('function_group_name') ? ' is-invalid' : '' }}"  value="{{ old('function_group_name') }}">
                                @if ($errors->has('function_group_name'))
                                <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>{{ $errors->first('function_group_name') }}</strong></span>
                                </span>
                                @endif
                              </div>

                              </div>
                            </div>                                

                            <div class="col-md-4">
                              <div class="form-group">
                               <label class="col-form-label text-sm-right">Screen Name</label>
                               <div class="">
                                <input  name="screen_name" type="text" class="form-control  {{ $errors->has('screen_name') ? ' is-invalid' : '' }}"  value="{{ old('screen_name') }}">
                                @if ($errors->has('screen_name'))
                                <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>{{ $errors->first('screen_name') }}</strong></span>
                                </span>
                                @endif
                              </div>

                              </div>
                            </div>                            

{{--                             <div class="col-md-4">
                              <div class="form-group">
                               <label class="col-form-label text-sm-right">App</label>
                               <div class="">
                                <select name="app_id" class="custom-select NoborderRadius" id="editappselect" style="height: 40px;">
                              <option value="">Select app</option>
                                @foreach($screengrouplist as $screengrouplists)
                                <option value="{{ $screengrouplists->id }}">{{ $screengrouplists->app_name }}</option>
                                @endforeach
                              </select>
                              </div>

                              </div>
                            </div> --}}



                          <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-form-label text-sm-right">Estimate</label>
                                <div class="">
                                 <input type="text" name="estimate" class="form-control  {{ $errors->has('estimate') ? ' is-invalid' : '' }}"  value="{{ old('estimate') }}">

                                 @if ($errors->has('estimate'))
                                 <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>{{ $errors->first('estimate') }}</strong></span>
                                </span>
                                @endif
                              </div>
                            </div>
                          </div>

                        </div>        

                        <div class="row">
                              <div class="col-md-12">

                                <div class="form-group mb-0">
                                  <label>Screen attachment</label>
                                  <label class="fileContainer" id="fileSelectBox" ondragover="dragOver(event)" ondragleave="leaveDrop(event)" ondrop="onDrop(event)">
                                    <span>Browse or drag and drop your file.</span>
                                  <div class="fileContainerFileName" ondrop="onDrop(event)" id="fileName">
                                  <input type="file" id="file-input" name="image_url" class="form-control" value="Select" placeholder="Select">
                                </div>
                                </div>
                                <div class="preview">
                                  <img src="" alt="" id="image-previewer" class="img-thumbnail">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                               <label class="col-form-label text-sm-right">Detail</label>
                               <div class="">
                                <div id="editSection"></div>
                                <textarea id="content2bSavedHolder" name="detail" class="form-control" style="display: none;"> </textarea>

                                @if ($errors->has('detail'))
                                <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>The Detail field is required</strong></span>
                                </span>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>



                    <div class="form-group row">
                      <div class="col-sm-12 ml-sm-auto text-center">
                        <button type="submit" class="btn btn-success dtb_custom_btn_default mt-4" style="padding: 5px 111px">Submit</button>
                      </div>
                    </div>

                  {!! Form::close() !!}

            </div>
            <div class="col-md-2">
            </div>
         </div><br>




        
      </div>
   </div>
</div>



<style>
/*.preview img {
    border: 3px solid #0000004f;
}*/
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
</style>




<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>


    <script type="text/javascript">

var droppedFiles = null;
  
  function fileContainerChangeFile(e) {
    document.getElementById('fileSelectBox').classList.remove( 'fileContainerDragOver' );
  }
  
  function onDrop(e) {
    document.getElementById('fileSelectBox').classList.remove( 'fileContainerDragOver' );
  }

  function dragOver(e) {
    document.getElementById('fileSelectBox').classList.add( 'fileContainerDragOver' );
    e.preventDefault();
    e.stopPropagation();
  }

  function leaveDrop(e) {
    document.getElementById('fileSelectBox').classList.remove( 'fileContainerDragOver' );
  }


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
                    maxHeight: 300
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
                            //var cllbackimg = document.location.origin +'/'+myupload;
                            var cllbackimg = myupload;
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
              url : '{{ url('/uploadscreenattchment') }}',
              type: 'post',
              async: false,
              cache : false,
              contentType : false,
              processData : false,
              data :  dataimg,
              
              success: function (response) {
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
        $("#screenaddform").submit(function(e){;
          var content2bSaved = editor.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);

        });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');

    </script>







@endsection