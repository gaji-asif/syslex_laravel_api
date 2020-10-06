  @extends('master')
  @section('mainContent')

  <div class="row">

    <div class="editformheader">
      <a class="btn btn-danger btn-sm dtb_custom_btn_default" href="{{route('wiki.index', $id)}}">Back</a>
      <a href="#" class="btn btn-danger btn-sm pull-right wikidelbtn dtb_custom_btn_default" data="{{ $wikiid }}">Delete</a>

    </div>

      <div class="row">
          <div class="col-md-8 col-lg-12 col-xl-9">
                  <!-- Popular queries -->
                  <div class="card mb-4">
                    <div class="card-body">
                     
                {!! Form::open(['route' => ['project.wiki.update', $id, $wikiid],'id'=>'wikieditform'])!!}
                {{ method_field('PUT') }}

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
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') ??  $wikilist->title }}" placeholder="" name="title">
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
                          <!-- <button id="dummycontentaddbtn">Add Dummy Content</button> -->
                          <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" id="content2bSavedHolder" name="description" style="display:none"></textarea>

                        </div>
                         
                         <div class="text-center">
                           <input type="submit" class="btn btn-success dtbbigbtn">
                         </div>
                         
                  {{ Form::close()}}

                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-lg-12 col-xl-3">

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

      <!-- HOLDER OF DB DESC CONTENT,WHERE FROM CONTENT BEING SUPPLIED TO SHOWDOWN AND TUI EDITOR TO BE EDITED. -->
      <textarea id="wikidescsrc" rows="10" cols="82">
        <?php if (!empty($wikilist)) { echo $wikilist->description;} ?>
      </textarea>


  <script src="{{asset('/assets/js/showdown.min.js')}}"></script>
<!--   <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link> -->
<!--   <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link> -->
<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link> -->
<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link> -->
<!--   <script src="https://uicdn.toast.com/tui-editor/latest/tui-editor-Editor-full.js"></script> -->
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>


  <script type="text/javascript">

        var text = document.getElementById('wikidescsrc').value,
        target = document.getElementById('editSection'),
        converter = new showdown.Converter(),
        html = converter.makeHtml(text);
        target.innerHTML = html;

        var editor = new tui.Editor({
          el: document.querySelector('#editSection'),
          height: '400px',
          previewStyle: 'vertical',
          initialValue: text,
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



        //BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED
        $("#wikieditform").submit(function(e){
          var content2bSaved = editor.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);
        });


        //ADD DUMMY CONTENT TO EDITOR
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
        var el = document.querySelector('#dummycontentaddbtn');
        el.addEventListener('click', function(e){
           e.preventDefault();
          editor.setValue(dummycontent)
        });

  </script>


  <script type="text/javascript">
  //WIKI DELETE FUNCTIONALITY
    $( document ).ready(function() {

      // $(".CodeMirror-line span:first").html(function (i, html) {
      //     return html.replace(/ &nbsp; &nbsp; &nbsp; &nbsp;/g, ' ');
      // });

      // $(function () {
      //     $(".CodeMirror-line span").each(function () {
      //         var $this = $(this);
      //         $this.html($this.html().replace(/ &nbsp; &nbsp; &nbsp; &nbsp;/g, ''));
      //     });
      // });
      //$('.CodeMirror-line').html($('.CodeMirror-line').html().replace(' &nbsp; &nbsp; &nbsp; &nbsp;',' '));
      //$(".CodeMirror-line span:contains(' &nbsp; &nbsp; &nbsp; &nbsp;')").html("000000000000");

      //$('.CodeMirror-line').remove('&nbsp;');


    $('body').on('click','.wikidelbtn',function(e){
       e.preventDefault();
      var wikipageid = $(this).attr('data');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
     $.ajax({
        url: 'delete',
        type: 'DELETE',
        data: {
        "wikipageid": wikipageid
        },
        success: function(response){
        $.iaoAlert({msg: "Data has been deleted",
        type: "success",
        mode: "dark",});
          setTimeout(function(){// wait for 5 secs(2)
            window.location.href = "{{ route('wiki.index',$id)}}";
          }, 1500);
        }
    });



  });


  });
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
  .editformheader {
      width: 74%;
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
  </style>
  @endsection