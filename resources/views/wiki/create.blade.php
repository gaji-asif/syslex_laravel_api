@extends('master')
@section('mainContent')

<div class="col-lg-12 px-3">
  <a style="margin-bottom: 20px; margin-top: -15px;" class="dtb_custom_btn_default btn-sm" href="{{route('wiki.index', $id)}}">Back</a>
      <div class="row">
          <div class="col-md-8 col-lg-12 col-xl-9 pt-4">
                  <!-- Popular queries -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <h5>Create New Page</h5><br>
                     
                {!! Form::open(['route' => ['wiki.store', $id], 'enctype' => 'multipart/form-data','id'=>'wikiaddform'])!!}

                          @if(session()->has('message'))
                       
                          <div class="alert alert-success mb-10 background-success" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                      
                          @endif


                        <div class="form-group">
                                <label class="form-label">Page Name</label>
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" placeholder="" name="title">
                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('title') }}</strong></span>
                                </span>
                                @endif
                        </div>                     
                        <input type="hidden" name="project_id" value="<?php echo $id; ?>">

                        <div class="form-group">
                           <label class="form-label">Description</label>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <span class="messages"><strong>{{ $errors->first('description') }}</strong></span>
                            </span>
                            @endif
                             <div id="editSection"></div>
                           <!--  <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                             
                            <div id="drag_upload_file">
                              <p><input type="button" value="Select File" onclick="file_explorer();"></p>
                              <input type="file" id="selectfile">
                            </div>
                          </div> -->

                            <button id="dummycontentaddbtn">Add Dummy Content</button>
                            <textarea id="content2bSavedHolder" name="description" style="display:none"></textarea>
                    

                        </div>
                         
                          <div class="text-center">
                            <input type="submit" class="btn btn-success dtbbigbtn">
                          </div>
                          <br>

                  {{ Form::close()}}
                  <div id="content">
                  </div>
                </div>
              </div>
            </div>
                <div class="col-md-4 col-lg-12 col-xl-3 pt-4">
                  <!-- Stats -->
                  <div class="row">
                  <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">
                      <div class="card mb-4">
                        <div class="card-header border-0 mb-0">Formatting Rules (markdown)</div>
                        <div class="card-footer border-0 small pt-0">
                          <p>lorem ipsum dollor set ametlorem ipsum dollor set amet
                          lorem ipsum dollor set ametlorem ipsum dollor set amet
                        lorem ipsum dollor set amet</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">
                      <div class="card mb-4">
                        <div class="card-header border-0 mb-0">Tagging</div>
                          <div class="card-footer border-0 small pt-0">
                          <p>lorem ipsum dollor set ametlorem ipsum dollor set amet
                          lorem ipsum dollor set ametlorem ipsum dollor set amet
                        lorem ipsum dollor set amet</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">
            
                    </div>

                  </div>
                </div>
                </div>
      </div>


<style>
  
  #drop_file_zone {

   /* width: 290px; */
    /*height: 200px;*/
    padding: 5px;
    font-size: 12px;
}
#drag_upload_file {
 /* width:50%;*/
  
}
#drag_upload_file p {
  text-align: left;
}
#drag_upload_file #selectfile {
  display: none;
}
</style>


<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />

<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link> -->
<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link> -->
<!-- <script src="https://uicdn.toast.com/tui-editor/latest/tui-editor-Editor-full.js"></script> -->

<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>




<script type="text/javascript">
  // var fileobj;
  // function upload_file(e) {
  //   e.preventDefault();
  //   fileobj = e.dataTransfer.files[0];

  //   ajax_file_upload(fileobj);
  //}
 
  // function file_explorer() {
  //   document.getElementById('selectfile').click();
  //   document.getElementById('selectfile').onchange = function() {
  //       fileobj = document.getElementById('selectfile').files[0];
  //       //alert(fileobj);
  //     ajax_file_upload(fileobj);
  //   };
  // }
 
  // function ajax_file_upload(file_obj) {
    // if(file_obj != undefined) {
    //     var form_data = new FormData();                  
    //     var dataform = form_data.append('file', file_obj);
    //     console.log(form_data);
    //   $.ajaxSetup({
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    //   });

      // $.ajax({
      //   type: 'POST',
      //   url: '{{ url('/upload') }}',
      //   contentType: false,
      //   processData: false,
      //   data: form_data,
      //   success:function(response) {
      //   }
      // });
    //}
  // }
</script>

    <script type="text/javascript">

          //YOUTUBE VDO EMBED SETTINGS
          (function(root, factory) {
                if (typeof define === 'function' && define.amd) {
                  define(['tui-editor'], factory);
                } else if (typeof exports === 'object') {
                  factory(require('tui-editor'));
                } else {
                  factory(root['tui']['Editor']);
                }
              })(this, function(Editor) {
                // define youtube extension
                Editor.defineExtension('youtube', function() {
                  // runs while markdown-it transforms code block to HTML
                  Editor.codeBlockManager.setReplacer('youtube', function(youtubeId) {
                    // Indentify multiple code blocks
                    var wrapperId = 'yt' + Math.random().toString(36).substr(2, 10);
                    // avoid sanitizing iframe tag
                    setTimeout(renderYoutube.bind(null, wrapperId, youtubeId), 0);

                    return '<div id="' + wrapperId + '"></div>';
                  });
                });
                function renderYoutube(wrapperId, youtubeId) {
                  var el = document.querySelector('#' + wrapperId);
                  el.innerHTML = '<iframe width="420" height="315" src="https://www.youtube.com/embed/' + youtubeId + '"></iframe>';
                }
          });

          //CONTENT FOR YOUTUBE VIDEO EMBED
          var vdocontent = [
            '```youtube',
            'XGSy3_Czz8k',
            '```'
          ].join('\n');

          //initial content
          var content = ['--- ',' ',].join('\n');
          var placeholder = [' ',' ',].join('\n');

          //TOAST UI MAIN SETTINGS
          var editor = new tui.Editor({
              el: document.querySelector('#editSection'),
              initialEditType: 'markdown',
              placeholder:placeholder,
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
      url : '{{ url('/wiki/upload/wiki') }}',
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





        //DUMMY CONTENT OF MARKDOWN EDITOR
        var dummycontent = [
              '![image](http://tk2-402-42070.vs.sakura.ne.jp/storage/spaceimage/uER0mH4ojyZCUEg8vtpdQD9FBURYadQg4RXLf9GE.png)',
              '# Heading 1',
              '## Heading 2',
              '### Heading 3',
              '#### Heading 4',
              '##### Heading 5',
              '###### Heading 6',
              '    code block',
              '```js',
              'console.log("fenced code block");',
              '```',
              '<pre>**HTML block**</pre>',
              '* list',
              '    * list indented',
              '1. ordered',
              '2. list',
              '    1. ordered list',
              '    2. indented',
              '',
              '- [ ] task',
              '- [x] list completed',
              '',
              '[link](https://nhn.github.io/tui.editor/)',
              '> block quote',
              '---',
               '```youtube',
                'XGSy3_Czz8k',
                '```',
              'horizontal line',
              '***',
              '`code`, *italic*, **bold**, ~~strikethrough~~, <span style="color:#e11d21">Red color</span>',
              '|table|head|',
              '|---|---|',
              '|table|body|'
        ].join('\n');



        //ADD DUMMY CONTENT TO EDITOR
        var el = document.querySelector('#dummycontentaddbtn');
        el.addEventListener('click', function(e){
           e.preventDefault();
          editor.setValue(dummycontent)
        })


        //BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED
        $("#wikiaddform").submit(function(e){
          var content2bSaved = editor.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);
        });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      var markedcontent = document.getElementById('content').innerHTML =
        marked('<?php if (!empty($wikipage)) {echo $wikipage->description; } ?>');

    </script>


  <style type="text/css">
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
      button#dummycontentaddbtn {
          background: #ffd9501f;
              border: 1px solid #02bc7745;
              border-radius: 3px;
              font-size: 12px;
              font-weight: 500;
      }
  </style>

  @endsection