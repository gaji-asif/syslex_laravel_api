@extends('master_main')
@section('mainContent')

<div class="container pt-5">
  <div class="row">

    <div class="col-lg-3">
     @include('settings.developerSettings.developer_settings_sidebar')
   </div>

   <div class="col-lg-9 settgs_right_content">
    <div class="card mb-4 no_border">
      <div class="card-body padding_left_right">
       <h6 class="card_body_header">Notice</h6>
       <div class="row noticeformholder">

          {!! Form::open(['route' => ['notice.update', $loggedindeveloper], 'enctype' => 'multipart/form-data', 'id' => 'wikieditform', 'class' => 'pl-3'])!!}
          {{ method_field('PATCH') }}

          @if(session()->has('message'))

          <div class="alert success_message mb-10 background-success" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          @endif
          <div class="form-group">
          
           @if ($errors->has('notice'))
           <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>{{ $errors->first('notice') }}</strong></span>
          </span>
          @endif

          <div id="editSection"></div>
          <!-- <button id="dummycontentaddbtn">Add Dummy Content</button> -->
          <textarea class="form-control {{ $errors->has('notice') ? ' is-invalid' : '' }}" id="content2bSavedHolder" name="notice" style="display:none"></textarea>

        </div>
       
          <div class="form-group row pt-5">
                  <div class="col-sm-12 ml-sm-auto">
                    <input type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle" value="Submit">
                  </div>
                </div>
       {{ Form::close()}}

      </div>

    </div>

  </div>
</div>
</div>
<style type="text/css">
  .noticeformholder form{
    width: 100%;
  }
  div#cke_noticeeditor {
    width: 100%;
  }
</style>
</div>
<textarea id="wikidescsrc" rows="10" cols="82" style="display: none;">
  <?php if (!empty($dtbdevelopgroup)) { echo $dtbdevelopgroup->notice;} ?>
</textarea>


<script src="{{asset('/assets/js/showdown.min.js')}}"></script>
<link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link>
<link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link>
<script src="https://uicdn.toast.com/tui-editor/latest/tui-editor-Editor-full.js"></script>


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
    //console.log(images);
    var myresult = "";
    var dataimg = new FormData();
    var form = dataimg.append('file', images);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url : '{{ url('noticeUpload') }}',
      method: 'POST',
      async: false,
      cache : false,
      contentType : false,
      processData : false,
      data :  dataimg,
      success: function (response) {
        //console.log(response);
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
        background: white;
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


