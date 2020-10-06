  @extends('master_main')
  @section('mainContent')

  <div class="mt-5">

         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="padding: 0px 12px !important">

            <div class="row no-gutters align-items-center">
                <div class="col-12 col-md-12 px-0 pt-3">
                  <div class="center-block" style="border-bottom: 1px solid #0000002e;padding-bottom: 38px;margin-bottom: 10px;">
                  <h4 class="px-0 ml-0" style="color: black;float: left">Create Report</h4>
                  <span class="pull-right"><a href="{{route('report.index')}}" class="btn btn-primary btn-sm dtb_custom_btn_default" style="padding: 3px 28px;">List</a></span>
                </div>
              </div>
            </div>
 
                    {!! Form::open(['route' => ['reportstore'], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'reportaddform','class' => 'form-horizontal'])!!}

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



                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                               <label class="col-form-label text-sm-right">Date</label>
                                <div class="">

                                  <input type="text" data-date="" data-date-format="YYY MMMM DD" name="date" id="date" class="controls input-append date form_datetime form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="start date" value="{{  date( 'Y/m/d',strtotime(now())) }}">

                                  @if ($errors->has('date'))
                                  <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('date') }}</strong></span>
                                  </span>
                                  @endif
                                </div>

                              </div>
                            </div>   


                          <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-form-label text-sm-right">Start Time</label>
                                <div class="">
                                   <div class="input-group bootstrap-timepicker timepicker">
                                      <input id="startime" type="text" class="form-control input-small summable" name="start_time">
                                      {{-- <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span> --}}
                                    </div>
                                    <script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>
                                    {{-- <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" /> --}}
                                    <script type="text/javascript">
                                      $('#startime').timepicker({
                                        showInputs: false
                                      });
                                    </script>

                                 @if ($errors->has('start_time'))
                                 <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>{{ $errors->first('start_time') }}</strong></span>
                                </span>
                                @endif
                              </div>
                            </div>
                          </div>


                          <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-form-label text-sm-right">End Time</label>
                                <div class="">
                                   <div class="input-group bootstrap-timepicker timepicker">
                                      <input id="endtime" type="text" class="form-control input-small summable" name="end_time">
                                      {{-- <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span> --}}
                                    </div>
                                    <script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>
                                    {{-- <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" /> --}}
                                    <script type="text/javascript">
                                      $('#endtime').timepicker({
                                        showInputs: false
                                      });
                                    </script>

                                 @if ($errors->has('end_time'))
                                 <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>{{ $errors->first('end_time') }}</strong></span>
                                </span>
                                @endif
                              </div>
                            </div>
                          </div>

                        </div>        
{{--               
                                    @php
                                        $timefrom = substr_replace($reports->working_start_time ,"",-2);
                                        $timeto = substr_replace($reports->working_end_time ,"",-2);

                                        $time1 = strtotime($timefrom);
                                        $time2 = strtotime($timeto);
                                        $difference = round(abs($time2 - $time1) / 3600,2);
                                        $difference;
                                    @endphp --}}

                        <input type="hidden" name="working_time" id="totaltime" value="">

                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                               <label class="col-form-label text-sm-right">Today's Work(s)</label>
                               <div class="">
                                <div id="editSection"></div>
                                <textarea id="content2bSavedHolder" name="todays_work" class="form-control" style="display: none;"> </textarea>

                                @if ($errors->has('todays_work'))
                                <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>The Today work field is required</strong></span>
                                </span>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>                        


                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                               <label class="col-form-label text-sm-right">Tomorrow's Work(s)</label>
                               <div class="">
                                <div id="editSection2"></div>
                                <textarea id="content2bSavedHolder2" name="tomorrows_work" class="form-control" style="display: none;"> </textarea>

                                @if ($errors->has('tomorrows_work'))
                                <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>Tommorrow work field is required</strong></span>
                                </span>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>                        


                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                               <label class="col-form-label text-sm-right">Notice</label>
                               <div class="">
                                <div id="editSection3"></div>
                                <textarea id="content2bSavedHolder3" name="notice" class="form-control" style="display: none;"> </textarea>

                                @if ($errors->has('notice'))
                                <span class="invalid-feedback" role="alert">
                                  <span class="messages"><strong>Notice field is required</strong></span>
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



<style>
  .bootstrap-timepicker-widget table td a {
    background: #0707070a;
    padding: 8px 0;
    border: 1px solid #00000012;

}
</style>

<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>

  <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.0/showdown.min.js"></script>
  <script src="{{asset('/assets/js/marked.min.js')}}"></script>
  <script src="{{asset('/assets/js/showdown.min.js')}}"></script>

<script type="text/javascript">
$( document ).ready(function() {
//initial content
var content = [' * * *',' ',].join('\n');

//TOAST UI MAIN SETTINGS
var editor = new tui.Editor({
el: document.querySelector('#editSection'),
initialEditType: 'markdown',
previewStyle: 'vertical',
// initialValue: content,
height: '200px',
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
var myupload = ImageUpload1(blob);
//console.log(blob);
var cllbackimg = myupload;
//var cllbackimg = document.location.origin +'/developmanage/public/'+myupload;
callback(cllbackimg, 'alt text');
}
}
});

function ImageUpload1(images){

var myresult = "";
var dataimg = new FormData();
var form = dataimg.append('file', images);

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
url : '{{ url('/uploadreportfile') }}',
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
$("#reportaddform").submit(function(e){;
var content2bSaved = editor.getValue(); 
//var content2bSaved = editor.getHtml();
$('#content2bSavedHolder').html(content2bSaved);

});

});
</script>

{{-- TOMMORROWS WORKS EDITOR --}}
<script type="text/javascript">
$( document ).ready(function() {
//initial content
var content2 = [' * * *',' ',].join('\n');

//TOAST UI MAIN SETTINGS
var editor2 = new tui.Editor({
el: document.querySelector('#editSection2'),
initialEditType: 'markdown',
previewStyle: 'vertical',
// initialValue: content,
height: '200px',
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
var myupload = tworkfileup(blob);
//console.log(blob);
var cllbackimg = myupload;
//var cllbackimg = document.location.origin +'/developmanage/public/'+myupload;
callback(cllbackimg, 'alt text');
}
}
});

function tworkfileup(images){
var myresult = "";
var dataimg = new FormData();
var form = dataimg.append('file', images);

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
url : '{{ url('/uploadtomorrowreportfile') }}',
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
$("#reportaddform").submit(function(e){;
var content2bSaved2 = editor2.getValue(); 
//var content2bSaved2 = editor.getHtml();
$('#content2bSavedHolder2').html(content2bSaved2);

});

});
</script>

{{-- NOTICE EDITOR --}}
<script type="text/javascript">
$( document ).ready(function() {
//initial content
var content3 = [' * * *',' ',].join('\n');

//TOAST UI MAIN SETTINGS
var editor3 = new tui.Editor({
el: document.querySelector('#editSection3'),
initialEditType: 'markdown',
// initialEditType: 'wysiwyg',
// initialValue: content,
previewStyle: 'vertical',
height: '150px',
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
var myupload = noticeattachment(blob);
//console.log(blob);
var cllbackimg = myupload;
//var cllbackimg = document.location.origin +'/developmanage/public/'+myupload;
callback(cllbackimg, 'alt text');
}
}
});


function noticeattachment(images){
var myresult = "";
var dataimg = new FormData();
var form = dataimg.append('file', images);

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
url : '{{ url('/uploadnoticefile') }}',
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
$("#reportaddform").submit(function(e){;
var content2bSaved3 = editor3.getValue(); 
//var content2bSaved2 = editor.getHtml();
$('#content2bSavedHolder3').html(content2bSaved3);

});

});
</script>





<link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}"> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
$( function() {
$( "#date" ).datepicker({
format: 'yyyy/mm/dd',
todayBtn: true,
clearBtn: true,
autoclose: true,
todayHighlight: true
});
} );

</script>



<script>
$(document).ready(function(){

//iterate through each textboxes and add keyup
//handler to trigger sum event
$(".summable").each(function() {

$(this).keyup(function(){
calculateSum();
});
});

});

function calculateSum() {

var sum = 0;
//iterate through each textboxes and add the values
$(".summable").each(function() {

//add only if the value is number
if(!isNaN(this.value) && this.value.length!=0) {
sum += parseFloat(this.value);
}

});
//.toFixed() method will roundoff the final sum to 2 decimal places
$("#totaltime").val(sum.toFixed(2));
}


</script>







  @endsection

