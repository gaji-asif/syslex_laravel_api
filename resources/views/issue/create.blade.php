@extends('master')
@section('mainContent')


<div class="row mt-2">
  <div class="col-lg-10 issue_wrapper issuecopyholder" style="margin:0 auto">

    <div class="card mb-4 bg-transparent no_border">

      <div class="card-body px-0 pt-0">

<!--         {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'issue',
  'method' => 'POST', 'enctype' => 'multipart/form-data']) }} -->

  {!! Form::open(['route' => ['issue.store', $id], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'issueaddform','class' => 'form-horizontal'])!!}


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

  <input type="hidden" name="developer_id" value="<?php echo Session::get('developer_id');?>">
  <input type="hidden" name="author_user_id" value="<?php echo Session::get('user_id');?>">
  <!-- <input type="hidden" name="user_id" value="<?php // echo Session::get('user_id');?>"> -->




  <h4 style="padding: 10px 0px; border-bottom: none;" class="card-header mb-4">
    <small>
      <input name="issue_title" type="issue_title" class="col-10 col-md-8 controls form-control {{ $errors->has('issue_title') ? ' is-invalid' : '' }}" placeholder="Subject title" value="{{ old('issue_title',isset($copyFlag) && $copyFlag ?$dtbissue->issue_title:'') }}" style="float: left">
      <strong><a href="{{route('issue.index', $id)}}" class="btn-success mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default">All Issues</a></strong>
      @if ($errors->has('issue_title'))
      <span class="invalid-feedback" role="alert" style="float: left;">
        <span class="messages"><strong>{{ $errors->first('issue_title') }}</strong></span>
      </span><br>
      @endif

    </small>
    <!-- <strong><a href="" class="modalLink" data-modal-size="modal-md"><div class="btn-danger btn-sm mt-1  pull-right dtb_custom_btn_default">Delete</div></a></strong> -->
    

  </h4> 
<br>
  

  <div class="row px-0">
    <div class="col-md-6">
      <ul class="appinfobox">
        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Type</a></li>
        <li><span class="appvalue">
          <div class="">
            <select name="issue_type" class="custom-select {{ $errors->has('issue_type') ? ' is-invalid' : '' }}">
              <option value="">Select Issue Type</option>
              
              @foreach($issueTypes as $issueType)
              <option value="{{ $issueType->id }}" {{ isset($copyFlag) && $copyFlag && $dtbissue->issue_type == $issueType->id ? 'selected':''  }}>{{ $issueType->issue_type }}</option>
              @endforeach
              
            </select>
            
            @if ($errors->has('app_id'))
            <span class="invalid-feedback" role="alert">
              <span class="messages"><strong>The issue type is required</strong></span>
            </span>
            @endif
          </div>

        </span></li>
      </ul>
    </div>
    <div class="col-md-6">
      <ul class="appinfobox">
        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">App</a></li>
        <li><span class="appvalue">
          <div class="">
            <select name="app_id" class="custom-select {{ $errors->has('app_id') ? ' is-invalid' : '' }}">
              <option value="">Select App</option>
              
              @foreach($apps as $app)
              <option value="{{ $app->id }}" {{ old('app_id') == $app->id || (isset($copyFlag) && $copyFlag && $dtbissue->app_id == $app->id) ? 'selected':(count($apps)==1? 'selected':'') }} >{{ $app->app_name }}</option>
              @endforeach
              
            </select>
            
            @if ($errors->has('app_id'))
            <span class="invalid-feedback" role="alert">
              <span class="messages"><strong>app name is required</strong></span>
            </span>
            @endif
          </div>
        </span></li>
      </ul>
    </div>
  </div>  

  <input type="hidden" name="project_id" value="<?php echo $id; ?>">



  <div class="row px-0">
    <div class="col-md-6">
      <ul class="appinfobox">
        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Status</a></li>
        <li><span class="appvalue">
          <div class="">
            @foreach($statuses as $statuse)
            <label class="col-form-label col-md-9">{{ $statuse->status_name }}</label>
            <input type="hidden" value="{{ $statuse->id }}" name="status">
            <input type="hidden" value="#b6DD05" name="color">
            @endforeach
          </div>

        </span></li>
      </ul>
    </div>
    <div class="col-md-6">
      <ul class="appinfobox">
        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Priority</a></li>
        <li><span class="appvalue">
          <div class="">
           <select name="issue_priority_id" class="custom-select {{ $errors->has('issue_priority_id') ? ' is-invalid' : '' }}">
            <option value="">Select priority</option>
            
            @foreach($priorities as $priority)
            <option value="{{ $priority->id }}" {{ old('issue_priority_id') == $priority->id || (isset($copyFlag) && $copyFlag && $dtbissue->issue_priority_id == $priority->id) ? 'selected':($priority->priority_name=='Normal'?'selected':'') }}>{{ $priority->priority_name }}</option>
            @endforeach
            
            
          </select>
          @if ($errors->has('issue_priority_id'))
          <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>The Priority field is required</strong></span>
          </span>
          @endif
        </div>
      </span></li>
    </ul>
  </div>
</div>  



<div class="row px-0">
  <div class="col-md-6">
    <ul class="appinfobox">
      <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Assign To</a></li>
      <li><span class="appvalue">
        <div class="">
          <select name="user_id" class="custom-select {{ $errors->has('user_id') ? ' is-invalid' : '' }}">
            <option value="">Select to assign</option>
            
            @foreach($users as $user)
            <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id || (isset($copyFlag) && $copyFlag && $dtbissue->user_id == $user->user_id) ? 'selected':'' }}>{{ $user->name }}</option>
            @endforeach
            
          </select>
          
          @if ($errors->has('user_id'))
          <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>The Assign to field is required</strong></span>
          </span>
          @endif
        </div>

      </span></li>
    </ul>
  </div>
  <div class="col-md-6">
    <ul class="appinfobox">
      <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Category</a></li>
      <li><span class="appvalue">
        <div class="">
         <select name="category_id" class="custom-select {{ $errors->has('category_id') ? ' is-invalid' : '' }}">
          <option value="">Select Category</option>
          
          @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id || (isset($copyFlag) && $copyFlag && $dtbissue->category_id == $category->id) ? 'selected':'' }}>{{ $category->category_name }}</option>
          @endforeach
          
          
        </select>
        @if ($errors->has('category_id'))
        <span class="invalid-feedback" role="alert">
          <span class="messages"><strong>The Category field is required</strong></span>
        </span>
        @endif
      </div>
    </span></li>
  </ul>
</div>
</div>  


<div class="row px-0">
  <div class="col-md-6">
    <ul class="appinfobox">
      <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Version</a></li>
      <li><span class="appvalue">
        <div class="">
          <select name="version_id" class="custom-select {{ $errors->has('version_id') ? ' is-invalid' : '' }}">
            <option value="">Select Version</option>
            @foreach($versions as $index => $version)
            <option value="{{ $version->id }}" {{ old('version_id') == $version->id || (isset($copyFlag) && $copyFlag && $dtbissue->version_id == $version->id) ? 'selected':($index==count($versions)-1?'selected':'') }} >{{ $version->version_name }}</option>
            @endforeach
          </select>
          @if ($errors->has('version_id'))
          <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>The Version field is required</strong></span>
          </span>
          @endif
        </div>

      </span></li>
    </ul>
  </div>
  <div class="col-md-6">
    <ul class="appinfobox">
      <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Start Date</a></li>
      <li><span class="appvalue">
        <div class="">
          <input type="text" data-date="" data-date-format="YYY MMMM DD" name="start_date" id="start_date" class="controls input-append date form_datetime form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="start date" value="{{ old('start_date',isset($copyFlag) && $copyFlag?date( 'Y-m-d',strtotime($dtbissue->start_date)):date( 'Y/m/d',strtotime(now()))) }}">
          @if ($errors->has('start_date'))
          <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>{{ $errors->first('start_date') }}</strong></span>
          </span>
          @endif
        </div>
      </span></li>
    </ul>
  </div>
</div>  



<div class="row px-0">
  <div class="col-md-6">
    <ul class="appinfobox">
      <li><a href="javascript:void(0)" class="text-body font-weight-semibold">End Date</a></li>
      <li><span class="appvalue">
        <div class="">
          <input name="deadline" id="deadline" type="text" data-date="" data-date-format="YYY MMMM DD" class="form-control  {{ $errors->has('deadline') ? ' is-invalid' : '' }}" placeholder="deadline" value="{{ old('deadline',isset($copyFlag) && $copyFlag?date( 'Y-m-d',strtotime($dtbissue->deadline)):date( 'Y/m/d',strtotime('+3 days'))) }}">
          @if ($errors->has('deadline'))
          <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>{{ $errors->first('deadline') }}</strong></span>
          </span>
          @endif
        </div>

      </span></li>
    </ul>
  </div>
  <div class="col-md-6">
    <ul class="appinfobox">
      <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Progress</a></li>
      <li><span class="appvalue">
        <div class="">
          <select name="progress" class="custom-select {{ $errors->has('progress') ? ' is-invalid' : '' }}">
            <option value="">Select Progress</option>
            <option value="1" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 1) ? 'selected':'' }} >10%</option>
            <option value="2" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 2) ? 'selected':'' }} >20%</option>
            <option value="3" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 3) ? 'selected':'' }} >30%</option>
            <option value="4" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 4) ? 'selected':'' }} >40%</option>
            <option value="5" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 5) ? 'selected':'' }} >50%</option>
            <option value="6" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 6) ? 'selected':'' }} >60%</option>
            <option value="7" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 7) ? 'selected':'' }} >70%</option>
            <option value="8" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 8) ? 'selected':'' }} >80%</option>
            <option value="9" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 9) ? 'selected':'' }} >90%</option>
            <option value="10" {{ old('progress') == 1|| (isset($copyFlag) && $copyFlag &&$dtbissue->progress == 10) ? 'selected':'' }} >100%</option>
          </select>
          @if ($errors->has('progress'))
          <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>{{ $errors->first('progress') }}</strong></span>
          </span>
          @endif
        </div>
      </span></li>
    </ul>
  </div>
</div>  



<div class="row px-0">
  <div class="col-md-6">
    <ul class="appinfobox">
      <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Estimate 1</a></li>
      <li><span class="appvalue">
        <div class="">
          @if(Session::has('role'))
          @if(Session::get('role') == '0')
          <input type="text" name="estimate_hour1" class="form-control  {{ $errors->has('estimate_hour1') ? ' is-invalid' : '' }}" placeholder="Estimate Hour One" value="{{ old('estimate_hour1',isset($copyFlag) && $copyFlag?$dtbissue->estimate_hour1:'') }}">
          
          @if ($errors->has('estimate_hour1'))
          <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>{{ $errors->first('estimate_hour1') }}</strong></span>
          </span>
          @endif
          @endif
          @endif
        </div>

      </span></li>
    </ul>
  </div>
  <div class="col-md-6">
    <ul class="appinfobox">
      <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Actual Time</a></li>
      <li><span class="appvalue">
        <div class="">
          <input type="text" name="estimate_hour2" class="form-control  {{ $errors->has('estimate_hour2') ? ' is-invalid' : '' }}" placeholder="Estimate Hour Two" value="{{ old('estimate_hour2',isset($copyFlag) && $copyFlag?$dtbissue->estimate_hour2:'') }}">
          
          @if ($errors->has('estimate_hour2'))
          <span class="invalid-feedback" role="alert">
            <span class="messages"><strong>{{ $errors->first('estimate_hour2') }}</strong></span>
          </span>
          @endif
        </div>
      </span></li>
    </ul>
  </div>
</div>  




<div class="row px-0">
  <div class="col-md-6">
    <ul class="appinfobox">
      <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Difficulty</a></li>
      <li><span class="appvalue">
        <div class="">
          <select name="difficulty" class="custom-select">
            <option value="0">Select difficulty</option>
            <option value="1" {{ old('difficulty') == 1 || (isset($copyFlag) && $copyFlag &&$dtbissue->difficulty == 1) ? 'selected':'' }} >Easy</option>
            <option value="2" {{ old('difficulty') == 1 || (isset($copyFlag) && $copyFlag &&$dtbissue->difficulty == 2) ? 'selected':'' }} >Medium</option>
            <option value="3" {{ old('difficulty') == 1 || (isset($copyFlag) && $copyFlag &&$dtbissue->difficulty == 3) ? 'selected':'' }} >Hard</option>
          </select>
        </div>
      </span></li>
    </ul>
  </div>
  <div class="col-md-6">
    <ul class="appinfobox">
      <li> <a href="javascript:void(0)" class="text-body font-weight-semibold"></a></li>
      <li><span class="appvalue">
        <br><br>
      </span></li>
    </ul>
  </div>
</div>  



<div class="form-group row mt-3">
  <!--    <label class="col-form-label text-sm-left col-md-12">Issue Detail</label> -->
  <span class="col-form-label col-md-3">Issue Detail</span><br>
  
  <div class="col-md-12">
    <div id="editSection"></div>
    <button id="dummycontentaddbtn">Add Dummy Content</button>
    <textarea id="content2bSavedHolder" name="issue_text" style="display:none"></textarea>
    
    @if ($errors->has('issue_text'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('issue_text') }}</strong>
    </span>
    @endif
  </div>

</div>


<div class="form-group row mt-5">
  <div class="col-sm-12 text-center">
    <button type="submit" class="btn btn-success dtbbigbtn">Add</button>
  </div>
</div>
</form>
</div>
</div>
</div>
</div>

<style type="text/css">
  .issue_wrapper{
    margin:0 auto;
  }
  .gap{
    padding: 0px 50px 0px 50px;
  }
  .input-group-addon{padding:6px 12px;font-size:14px;font-weight:normal;line-height:1;text-align:center;background-color:#eee;border:1px solid #ccc;border-radius:4px}
  .issuecopyholder input, select {
    border-radius: 0px !important;
  }
  ul.appinfobox li:first-child {
    width: 90px !important;
  }
  ul.appinfobox {
    margin-bottom: 7px;
  }
  .issuecopyholder select, input {
    height: 35px !important;
    font-size: 14px;
    margin-top: -1px;
  }
  ul.appinfobox li:first-child a {
    /* float: left; */
    position: absolute;
    bottom: 14px;
  }
  .te-preview {
    background: #fff;
  }
</style>

<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />

<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link> -->
<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link> -->
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>



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
          var content = [].join('\n');
          @if (isset($copyFlag) && $copyFlag)
          content=[] ;
          @foreach(explode("\r\n", old("details", $dtbissue->issue_text)) as $arrRec)
          content.push('{{$arrRec}}');
          @endforeach
          content = content.join('\n');
          @endif
          
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
              url : '{{ url('/uploadissuefiles') }}',
              type: 'post',
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
        $("#issueaddform").submit(function(e){

          var content2bSaved = editor.getValue(); 

          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);
        });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');

    </script>
    <!-- <script src="{{asset('/js/jquery/jquery-1.8.3.min.js')}}"></script> -->
    <!-- <script src="{{asset('/js/bootstrap/js/bootstrap.min.js')}}"></script> -->
    <!-- <script src="{{asset('/js/bootstrap-datetimepicker.js')}}"></script> -->
    <!-- <script src="{{asset('/js/locales/bootstrap-datetimepicker.cs.js')}}"></script> -->
    <!--  <link rel="stylesheet" href="{{asset('/css/bootstrap/css/bootstrap.min.css')}}"> -->
    <!--     <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script type="text/javascript">
      $( function() {
        $( "#start_date" ).datepicker({
          format: 'yyyy/mm/dd',
          todayBtn: true,
          clearBtn: true,
          autoclose: true,
          todayHighlight: true
        });
      } );
      $( function() {
        $( "#deadline" ).datepicker({
          format: 'yyyy/mm/dd',
          todayBtn: true,
          clearBtn: true,
          autoclose: true,
          todayHighlight: true
        });
      } );

// $("#start_date").datepicker().on('changeDate', function(e) {
//    var endTimeStart =$("#deadline").val();
//    $('#deadline').datepicker('setStartDate', endTimeStart);
// });

// var picker1 =$('.form_startdate').datetimepicker({
//     format: 'yyyy/mm/dd',
//     weekStart: 1,
//     todayBtn:  1,
//  autoclose: 1,
//  todayHighlight: 1,
//  startView: 2,
//  minView: 2,
//  forceParse: 0
// });
// var picker2 = $('.form_deadline').datetimepicker({
// // language:  'cs',
// format: 'yyyy/mm/dd',
// weekStart: 1,
// todayBtn:  1,
// autoclose: 1,
// todayHighlight: 1,
// startView: 2,
// minView: 2,
// forceParse: 0
// });

// picker1.on('changeDate', function (e) { 

// $('.form_deadline').datetimepicker('setStartDate',e.date);

// });


// picker2.on('changeDate', function (e) { 

// $('.form_startdate').datetimepicker('setEndDate',e.date);

// }); 
</script>


@endsection


