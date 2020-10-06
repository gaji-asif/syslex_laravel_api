@extends('master')
@section('mainContent')
<style>
<!--
img { max-width:100%;}
-->
</style>


<div class="row" style="margin-top: -21px;margin-bottom: 40px;">
  <div class="col-md-1"></div>
  <div class="col-md-10 px-4">
                @if(isset($div)&&$div=='myIssue')
                <a href="{{URL('/my_issues')}}" style="margin: 0 auto;">      
                   <div class="btn-success mt-0 btn-sm pull-right dtbbigbtn mr-2">Back to list</div>
                </a>
             @elseif(isset($div)&&$div=='managelist')
                <a href="{{route('manageproject')}}" style="margin: 0 auto;">     
                   <div class="btn-success mt-0 btn-sm pull-right dtbbigbtn mr-2">Back to list</div>
                </a>
             
             @else
                <a href="{{route('issue.index', $issueDetails->project_id)}}" style="margin: 0 auto;">      
                   <div class="btn-success mt-0 btn-sm pull-right dtbbigbtn mr-2">Back to list</div>
                </a>
             @endif
  </div>
  <div class="col-md-1"></div>
</div>

<div class="row mt-4">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <h4 style="margin-left: -25px; border-bottom: none;" class="card-header">
   @if($issueDetails->app_id)[ {{$issueDetails->app_name}} ] @endif  [ {{$issueDetails->issue_title}} ]<br>
   <small class="text-muted" style="font-size: 65%;">
      Created By 
      <strong>@if(isset($issueDetails->author_user_id)){{$issueDetails->issue_creator_author}}@endif</strong>

      <strong style="margin-left: 13px;">[ @if(isset($issueDetails->author_user_id))

       {{--  {{date('Y-m-d h:i', strtotime($issueDetails->created_at))}} --}}
    @php
     $developer_id = Session::get('developer_id'); 
    $devgrplang = \DB::table('dtb_develop_groups')
            ->where('id',$developer_id)
            ->first();
    @endphp
     <?php 
       if (isset($devgrplang)) {
          if ($devgrplang->default_lang == 1) { ?>
          {{ date('m-d-Y   h:i', strtotime($issueDetails->created_at)) }}
           <?php }elseif($devgrplang->default_lang == 15){ ?>
          {{ date('m-d-Y   h:i', strtotime($issueDetails->created_at)) }}
            <?php }elseif($devgrplang->default_lang == 53){?>
          {{ date('Y-m-d   h:i', strtotime($issueDetails->created_at)) }}
            <?php }else{ ?>
          {{ date('m-d-Y   h:i', strtotime($issueDetails->created_at)) }}
           <?php }

          }else{}
          ?>

      @endif ]</strong>
   </small>
   <strong>
      <a href="{{url('copy-issue/'.$issueDetails->id)}}">
         <div class="btn-primary btn-sm mt-1  pull-right dtb_custom_btn_default">Copy</div>
      </a>
   </strong>
   <strong>
      <a href="{{url('edit_issue/'. $issueDetails->id.'/'.$div)}}">
         <div class="btn-success mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default">Edit</div>
      </a>
   </strong>
</h4>

<!-- Project progress -->
<div class="card pb-3 mb-0 bg-transparent border-0 mt-4">

    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Type</a></li>
              <li><span class="appvalue badge badge-success" style="background: {{ $issueDetails->color }}">{{ $issueDetails->issue_type }}</span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">App</a></li>
              <li><span class="appvalue">{{ $issueDetails->app_name }}</span></li>
            </ul>
          </div>
    </div>  


    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Status</a></li>
              <li><span class="appvalue badge text-white" style="background: {{ $issueDetails->statcolor ?? '' }}">@if(isset($issueDetails->status)) {{$issueDetails->status_name}} @endif</span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Priority</a></li>
              <li><span class="appvalue">@if(isset($issueDetails->issue_priority_id))<div class="btn badge text-white" style="background: {{ $issueDetails->priorcolor ?? '' }}">{{$issueDetails->priority_name}}</div>
            @endif</span></li>
            </ul>
          </div>
    </div>  

    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Assign To</a></li>
              <li><span class="appvalue">
                @if(isset($issueDetails->assignee)) {{$issueDetails->assignee}}  @endif 
                @if($issueDetails->is_archived == 1)  <span style="font-size: 12px">(archived)</span>  @endif 
    
              </span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Category</a></li>
              <li><span class="appvalue">@if(isset($issueDetails->category_id)){{$issueDetails->category_name}}
            @endif</span></li>
            </ul>
          </div>
    </div> 


    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Version</a></li>
              <li><span class="appvalue">@if(isset($issueDetails->version_id)) {{$issueDetails->version_name}} @endif</span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Start Date</a></li>
              <li><span class="appvalue">@if(isset($issueDetails->start_date))

                {{-- {{date('d-M-Y', strtotime($issueDetails->start_date))}} --}}
            <?php 
             if (isset($devgrplang)) {
                if ($devgrplang->default_lang == 1) { ?>
                {{ date('m-d-Y ', strtotime($issueDetails->start_date)) }}
                 <?php }elseif($devgrplang->default_lang == 15){ ?>
                {{ date('m-d-Y ', strtotime($issueDetails->start_date)) }}
                  <?php }elseif($devgrplang->default_lang == 53){?>
                {{ date('Y-m-d ', strtotime($issueDetails->start_date)) }}
                  <?php }else{ ?>
                {{ date('m-d-Y ', strtotime($issueDetails->start_date)) }}
                 <?php }

                }else{}
            ?>

              @endif</span></li>
            </ul>
          </div>
    </div> 

    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">End Date</a></li>
              <li><span class="appvalue">@if(isset($issueDetails->deadline))

                {{-- {{date('d-M-Y', strtotime($issueDetails->deadline))}} --}}
            <?php 
             if (isset($devgrplang)) {
                if ($devgrplang->default_lang == 1) { ?>
                {{ date('m-d-Y ', strtotime($issueDetails->deadline)) }}
                 <?php }elseif($devgrplang->default_lang == 15){ ?>
                {{ date('m-d-Y ', strtotime($issueDetails->deadline)) }}
                  <?php }elseif($devgrplang->default_lang == 53){?>
                {{ date('Y-m-d ', strtotime($issueDetails->deadline)) }}
                  <?php }else{ ?>
                {{ date('m-d-Y ', strtotime($issueDetails->deadline)) }}
                 <?php }

                }else{}
            ?>

              @endif</span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Progress</a></li>
              <li>
                 @if(isset($issueDetails->progress))
                 <strong>
                    <div class="text-right text-muted small">{{$issueDetails->progress}}0%</div>
                    <div class="progress" style="height: 6px;">
                       <div class="progress-bar" style="width: {{$issueDetails->progress}}0%;"></div>
                    </div>
                 </strong>
                 @endif
              </li>
            </ul>
          </div>
    </div> 

    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Estimate 1</a></li>
              <li><span class="appvalue">
                  @if(Session::has('role'))
                  @if(Session::get('role') == '0')
                           <span>@if(isset($issueDetails->estimate_hour1)) {{$issueDetails->estimate_hour1}} hours @endif</span>
                  @endif
                  @endif
              </span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Actual Time</a></li>
              <li>
                 <span class="appvalue">
                   @if(isset($issueDetails->estimate_hour2)) {{$issueDetails->estimate_hour2}} hours @endif
                 </span>
              </li>
            </ul>
          </div>
    </div> 

    <div class="row px-0">
      <div class="col-md-6">
        <ul class="appinfobox">
          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Difficulty</a></li>
          <li><span class="appvalue">@if(isset($issueDetails->difficulty)) 
          <?php 
          if ($issueDetails->difficulty == 1) {echo "Easy";}
          elseif($issueDetails->difficulty == 2){ echo "Medium"; } 
          elseif($issueDetails->difficulty == 3){ echo "Hard"; } 
          elseif($issueDetails->difficulty == 0){ echo ""; } 
          ?> @endif</span></li>
        </ul>
      </div>     

      <div class="col-md-6">
        <ul class="appinfobox">
          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Issue</a></li>
          <li><span class="appvalue">@if(isset($issueDetails->next_issue_id)) {{$issueDetails->nextissuetitle}} @endif</span></li>
        </ul>
      </div>
    </div>     

    <div class="row px-0">
      <div class="col-md-6">
        <ul class="appinfobox">
          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Kick Status</a></li>
          <li><span class="appvalue">@if(isset($issueDetails->next_kick_status)) {{$issueDetails->nextkickstatus}} @endif</span></li>
        </ul>
      </div>
      <div class="col-md-6">
        <ul class="appinfobox">
          <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Next User</a></li>
          <li><span class="appvalue">@if(isset($issueDetails->next_user_id)) {{$issueDetails->nextuser}} @endif</span></li>
        </ul>
      </div>
    </div> 



</div>

<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />

@if(!empty($issueDetails->issue_text))
<div class="card mt-0 NoborderRadius" >
   <div class="card-body">
   
      <div class="tui-editor-contents">
         <?php 
         $parser = new \cebe\markdown\GithubMarkdown();
         $parser->html5 = true;
         $parser->enableNewlines = true;
         $parser->keepListStartNumber = true;         
         echo $parser->parse($issueDetails->issue_text);
         ?>
      </div>
   </div>

</div>
@endif

<div class="row mt-3">
   <div class="col-md-12">
      <div class="card mb-4 NoborderRadius bg-transparent no_border">
         <h6 class="card-header no_border px-1 pb-0">All Comments - <small>({{count($issue_comments)}})</small></h6>
         <div class="card-body px-0 pt-2">
            @if(count($issue_comments)>0)
            @foreach($issue_comments as $key=>$issue_comment_value)
            <div class="rounded ui-bordered p-3 mb-2 bg-white">
               <div class="media align-items-center mt-0 mb-0 py-1 px-0" style="border: none">
                  @if(!empty($issue_comment_value->icon_image_path))
                  <img src="{{asset($issue_comment_value->icon_image_path)}}" alt="" class="d-block ui-w-40 rounded-circle">
                  @else
                  <i class="far fa-user-circle d-block" style="font-size: 21px"></i>
                  @endif
                  <div class="media-body ml-2">{{$issue_comment_value->name}}</div>
                  <div class="text-muted small text-nowrap" id="updateTime_{{$issue_comment_value->id}}">
                     @php $commentedTime = App\DtbActivityLog::activityTime($issue_comment_value->updated_at); 
                     @endphp
                     @if(isset($commentedTime)) 
                     {{$commentedTime}}
                     @endif
                  </div>
                  <div style="padding-left: 10px" ><a href="#" onclick="popup('{{$issueDetails->id}}','{{$issue_comment_value->id}}')" data-toggle="modal" data-target="#issueCommentModel" class="mr-2 issueCommentModel">Edit</a></div>
               </div>

            <div class="tui-editor-contents" id="div_edit_{{$issue_comment_value->id}}">
                 <?php 
                 $parser = new \cebe\markdown\GithubMarkdown();
                 $parser->html5 = true;
                 $parser->enableNewlines = true;
                 $parser->keepListStartNumber = true;        
                 echo $parser->parse($issue_comment_value->issue_comment);
                 ?>
              </div>
            </div>
            @endforeach
            @else
            <div class="form-row align-items-center alert alert-warning text-center center-block" align="center">
               No Comments yet
            </div>
            @endif
         </div>

      </div>
   </div>



    <div class="col-md-1"></div>


</div>
</div>


<!-- Modal template -->
<div class="modal fade" id="issueCommentModel">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content" id="issueCommentForm">

      <div class="modal-header">
<!--         <h5 class="modal-title"> -->
<!--           Memo of App :<span id ="appNameSpanID"></span>  -->
<!--         </h5> -->
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

              <input type="hidden" name='comment_id' id ='comment_id' value=''>
              <input type="hidden" name='issue_id' id ='issue_id' value='{{$issueDetails->id}}'>
      
        <div class="form-group">
        <div id="editSection"></div>
        <textarea id="content2bSavedHolder" id ="comment_text" name="comment_text" style="display:none"></textarea>
        </div>
      
      <div class="modal-footer">
        <button id="feedbackclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updatMemobtn" data-dismiss="modal">Save</button>
      </div>
    </form>
  </div>
</div>

  </div>
  <div class="col-md-1"></div>
</div>

<style>
  span.appvalue.badge {
    font-size: 12px;
}
ul.appinfobox li {
    font-size: 14px;
}
</style>
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>
  <script type="text/javascript">
// <!--

function popup(issueId,commentId){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url : '/issue/' + issueId + '/commentShow/' + commentId,
        method: 'GET',
        async: false,
        cache : false,
        contentType : false,
        processData : false,
//         data :  '',
    success: function (response) {
          $('#comment_text').val(response);
          $('#comment_id').val(commentId);
          var text = response,
            target = document.getElementById('editSection'),
            converter = new showdown.Converter(),
            html = converter.makeHtml(text);
            target.innerHTML = html;
 
            var initcontent = [].join('\n');
          editor = new tui.Editor({
          el: document.querySelector('#editSection'),
          initialEditType: 'markdown',    
          height: '300px',
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
      },   
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert('Can not get comment!');
      }
    });

}
//-->
</script>



    <script type="text/javascript">
        
        var initcontent = ['***'].join('\n');
        var editor = new tui.Editor({
          el: document.querySelector('#editSection'),
          height: '400px',
          previewStyle: 'vertical',
          initialValue: initcontent,
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
          $("#issueCommentForm").submit(function(e){
            var content2bSaved = editor.getValue(); 
            //var content2bSaved = editor.getHtml();
            $('#content2bSavedHolder').html(content2bSaved);
          });

</script>


<script>

$('body').on('click','.updatMemobtn',function(e){
    e.preventDefault();
    
    
    
    $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
    var issue_id =  $('#issue_id').val();;
    var comment_id =  $('#comment_id').val();;
    var content2bSaved = editor.getValue(); 
    //var content2bSaved = editor.getHtml();
    $('#content2bSavedHolder').html(content2bSaved);

    $.ajax({
           url: '/issue/' + issue_id + '/commentUpdate/'+comment_id,
           type: 'POST',
           data: {
             issue_comment:$('#content2bSavedHolder').val()
           },
           success: function(response){
            alert('Comment. Update Successfully!');
            $('#div_edit_'+comment_id).html(response);
          $('#updateTime_'+comment_id).html(' just Now');
           },
           error: function (XMLHttpRequest, textStatus, errorThrown) {
               alert('Update Failed.');
           }
    });




});
</script>
@endsection
