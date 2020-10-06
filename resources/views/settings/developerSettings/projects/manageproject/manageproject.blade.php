@extends('master_main')
@section('mainContent')

   <br><br>


@foreach ($allprojectofdev as $devsproject)

<div class="card">
 <div class="card-datatable table-responsive mb-0" style="padding: 14px 0px;">
    <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
      <div class="row">
        <div class="col-sm-12 col-lg-12" style="padding: 0px 0px !important;">

            <div class="nav-tabs-top nav-responsive-sm" style="padding:0px 14px 0px 14px;display: block;">
                  <div class="">
        
                      <div class="card-body" style="padding: 0px 4px;">
                        <div class="card-datatable table-responsive" style="padding-top: 0px;padding-bottom: 0px">
                            
                          <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <h4 class="card-title" style="padding-left: 0px;margin-left: -5px;font-weight: 600;margin-bottom: 13px;"><span style="font-size: 14px;font-weight: 500;float: left;margin-right: 6px;margin-top: 3px;color: #0000008a;">Project | </span> {{$devsproject->project_name}} 


                                  <div class="pull-right" style="margin-right: -4px;"> 
                                    <a data-modal-size="modal-lg" project_id="{{$devsproject->id}}" href="{{route('change_at_once_mng_pro')}}" data-original-title="Change At Once" class="change_at_once_mng_pro"><button type="submit" class="btn-success dtb_primary_btn"  style="margin-right: 5px;">Change At Once</button></a>

                                   {{--  <button class="btn-default" href="{{route('change_at_once_complete_status_mng_pro')}}" id="is_complete_status_mng_pro" style="margin-right: 5px;">is Complete</button>  --}}

                                    <button class="btn-default select_all" project_id="{{$devsproject->id}}" style="margin-right: 5px;">Select All</button>
                                    <button class="btn-danger clear_all dtb_secondary_btn" project_id="{{$devsproject->id}}">Clear All</button>
                                    <p id="demo"></p>
                                  </div>

                                </h4>
                            </div>
                          </div>



                            <table class="table table-striped table-bordered issueofapptbl dtb_custom_tbl_common" style="margin-bottom: 0px" id="">
                                <thead>
                                  <tr>
                                    <th width="50px">#SL</th>
                                    <th width="150px">App Name</th>
                                    <th width="550px">Issue Title</th>
                                    <th width="60px">Status</th>
                                    <th width="80px">Progress</th>
                                    <th width="70px">Esitmate</th>
                                    <th style="width: 80px;">Updated</th>
                                    <th style="width: 80px;">Deadline</th>
                                    <th width="65px">Assignee</th>
                                    <th width="20px" style="padding: 3px 24px;"></th>
                                  </tr>
                                </thead>
                                <tbody>


                          @php

                              $loggedindeveloper = Session::get('developer_id');
                              $projectIssueList = \App\DtbProject::query()
                              ->from('dtb_projects as pr')
                              ->leftjoin('dtb_issues as i','i.project_id', '=', 'pr.id')
                              ->join('dtb_issue_statuses as prs','prs.id','=','i.status')
                              ->leftjoin('dtb_apps as a','i.app_id', '=', 'a.id')
                              ->leftjoin('dtb_issue_statuses as s','i.status', '=', 's.id')
                              ->leftjoin('dtb_users as u','i.user_id', '=', 'u.id')
                              ->leftjoin('dtb_users as uu','i.author_user_id', '=', 'uu.id')
                              ->where('pr.developer_id', $loggedindeveloper)
                              ->where('i.project_id', $devsproject->id)
                              ->where('i.is_closed', 0)
                              ->where('prs.is_complete', '!=','1')
                              ->orderBy('a.app_name','DESC')
                              ->orderBy('i.deadline','DESC')
                              ->get([ 'i.id as issue_id', 'i.app_id','i.project_id','i.status','i.is_closed','pr.project_name', 'a.app_name', 'a.memo','a.updated_at as appupdatedate','i.issue_title', 's.status_name', 's.color', 'i.progress', 
                                  'i.estimate_hour1', 'i.estimate_hour2', 'i.updated_at','i.start_date','i.deadline','u.name as assignee', 
                                  'uu.name as issue_creator_author','status']);
                          @endphp

                          @foreach ($projectIssueList as $issues)
                                <tr>

                                <td style="    padding-left: 6px;padding-top: 5px;display: flex;padding-bottom: 4px;align-items: center;margin: 0 auto;">
                                  <span style="margin-right: 5px;">
                                    <input type="checkbox" class="checkbox_{{$issues->project_id}} checkbox" name="issue_id[]" value="{{$issues->issue_id}}"  style="height: 17px;width: 15px;margin-top: 4px;padding-top: 10px !important;">
                                  </span>
                                  <span>{{$issues->issue_id}}</span>
                                </td>

                                  <td>{{ $issues->app_name ?? ''}}</td>
                                  <td><a href="{{url('issue/'.$issues->issue_id.'/managelist')}}">{{ $issues->issue_title ?? ''}}</a></td>

                                  <td style="text-align: center;width: 50px !important"> 

                                    <a href="#" class="" style="background: {{ $issues->color ?? 'skyblue' }};display: block;color: white;border-radius: 14px;font-size: 11px;padding: 3px 4px;">{{ $issues->status_name }} 
                                    </a></td>

                                  <td>
                                    @if(isset($issues->progress))
                                     <strong>
                                        <div class="text-right text-muted small">{{$issues->progress}}0%</div>
                                        <div class="progress" style="height: 6px;">
                                           <div class="progress-bar" style="width: {{$issues->progress}}0%;"></div>
                                        </div>
                                     </strong>
                                     @endif
                                  </td>
                                  <td>{{ $issues->estimate_hour1 }} hr/ {{ $issues->estimate_hour2 }} hr</td>
                                  <td><?php converttimezone($issues->updated_at) ?></td>
                                  <td><?php converttimezone($issues->deadline) ?></td>
                                  <td>{{ $issues->assignee ?? '' }}</td>


                                  <?php 
                                    $startdate = strtotime($issues->start_date);
                                    $deadline = strtotime($issues->deadline);
                                    $today = time();
                                    if ( $today < $startdate || (($deadline > $startdate) && (($today - $startdate) / ( $deadline - $startdate)) < $issues->progress / 100) || (($deadline - $today) > ($deadline - $startdate)* 0.6)) {?>
                                        <td class="progresstd bg-success"></td>
                                    <?php }elseif(($deadline > $startdate) && (($deadline - $today) > ($deadline - $startdate)* 0.1)) { ?>
                                        <td class="progresstd bg-warning"></td>
                                    <?php }else{ ?>
                                        <td class="progresstd bg-danger"></td>
                                  <?php } ?>



                                </tr>
                            @endforeach
                              </tbody>
                          </table>

                        </div>
                      </div>
                      
                 
                  </div>
                </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
@endforeach

<!-- Modal template -->
{{-- <div class="modal fade" id="memoModal">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content" id="memoUpdate">

      <div class="modal-header">
        <h5 class="modal-title">
          Memo of App :<span id ="appNameSpanID"></span> 
        </h5>
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

              <input type="hidden" name='memo_app_id' id ='memo_app_id' value=''>
      
        <div class="form-group">
        <div id="editSection"></div>
        <textarea id="content2bSavedHolder" name="memo_text" style="display:none"></textarea>
        </div>
      
      <div class="modal-footer">
        <button id="feedbackclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updatMemobtn" data-dismiss="modal">Save</button>
      </div>
    </form>
  </div>
</div> --}}









<style>
  
.nav-tabs a.nav-link.active {
    background: #26b4ff0f !IMPORTANT;
    border-radius: 0px;
    border-bottom: 0px !important;
}
.nav-tabs a.nav-link {
border: 1px solid rgba(24, 28, 33, 0.06) !important;
    border-radius: 0px !important;
    margin-right: -1px !important;
    padding: 4px 8px;
    background: #a9a9a914;
}
.apptitle {
    font-size: 12px;
    padding: 1px 5px 0px 13px;
    text-align: center;
    color: white;
}
.memobtn {
    padding: 0;
    background: transparent;
    border: 0px;
    display: inline-flex;
    float: right;
    margin-left: 11px;
}

span.apptitle span {
/*    border: 1px solid #26b4ff66;*/
  /*  padding: 4px 26px;
    margin-left: -2px;
    text-align: left;*/
}
span.progresstd {
    background: green;
    padding: 3px 18px;
    height: 22px;
    /* width: 53px; */
    text-align: right;
    content: "";
    display: block;
    /* float: right; */
    text-align: center;
}
.appissueholder i{
      margin-top: -8px;
    margin-right: -1px;
}

  .customicons{
   /* background-image: url('{{ URL::asset('assets_/img/customicons.png')}}')*/
  }

.totalprojecticon{ background-image: url('{{ URL::asset('assets_/img/totalproject.png')}}');}

.totalappicon{background-image: url('{{ URL::asset('assets_/img/totalappicon.png')}}');}

.totalaprojectissues{background-image: url('{{ URL::asset('assets_/img/projectissues.png')}}');}

.totalengagedev{background-image: url('{{ URL::asset('assets_/img/engagedev.png')}}');}

.manageprojecticons {
    height: 61px;
    width: 48px;
    margin-top: -5px;
    background-repeat: no-repeat;
    background-size: contain;
}

.appsmallicon {
    height: 22px;

    background-image: url('{{ URL::asset('assets_/img/applogosmall.png')}}');
    width: 20px;
    display: block;
    background-repeat: no-repeat;
}
.memosmallicon {
    height: 22px;
     background-image: url('{{ URL::asset('assets_/img/memoiconsmall.png')}}');
    width: 20px;
    display: block;
    margin-top: 2px;
    background-repeat: no-repeat;
}

.dataTables_wrapper .dataTables_length {
    margin-left: -12px;
}


.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 25px;
}
.btn-circle.btn-xl {
  width: 120px;
  height: 30px;
  padding: 10px 16px;
  font-size: 10px;
  line-height: 1.33;
  border-radius: 35px;
}

.pull-right{
  font-size: 15px;

}
.dataTables_wrapper .dataTables_length {
    margin-left: -23px;
}
div.dataTables_wrapper .dataTables_filter {
    margin-right: -23px;
}
.dataTables_info {
    display: none !important;
}
.dataTables_paginate .pagination {
    margin-right: -23px !important;
}

.issueofapptbl{
  margin: 0 auto;
  width: 100%;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed; 
  word-wrap:break-word;
}
.dtb_custom_tbl_common tbody tr td {
    padding: 0px 4px 0px 6px;
    vertical-align: middle;
    font-size: 14px;
}
</style>
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>

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
{{--   <script type="text/javascript">
// 

function popup(memoAppId,memoNmae){
  document.getElementById("memo_app_id").value=memoAppId;
//  $("#appNameSpanID").innerText= memoNmae;
  document.getElementById("appNameSpanID").innerHTML=memoNmae;
//  alert(memoNmae);
  var text = document.getElementById("memo_"+memoAppId).value,
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


}
//
</script> --}}



{{--     <script type="text/javascript">
        
        var initcontent = [].join('\n');
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


</script> --}}


<script>

// $('body').on('click','.updatMemobtn',function(e){
//     e.preventDefault();
    
    
    
//     $.ajaxSetup({
//                 headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//                 });
//     var appid = $('#memo_app_id').val();
//     var content2bSaved = editor.getValue(); 
//     //var content2bSaved = editor.getHtml();
//     $('#content2bSavedHolder').html(content2bSaved);

//     $.ajax({
//            url: '/apps/updatememo/'+appid,
//            type: 'POST',
//            data: {
//              memo:$('#content2bSavedHolder').val()
//            },
//            success: function(response){
//             alert(response);
//             $('#memo_'+appid).html(content2bSaved);
//            },
//            error: function (XMLHttpRequest, textStatus, errorThrown) {
//                alert('error in uploading file');
//            }
//     });




// });


$(document).ready(function() {

    $('.issueofapptbl').DataTable( {
            "paging":   false,
            "ordering": false,
            "info":     false,
            "searching": false
    } );

    // $('.issueofapptbl').DataTable();
} );


  $('.select_all').on('click',function(){
    $('.checkbox').each(function(){
      this.checked = false;
    });

    var project_id = $(this).attr('project_id');
    $('.checkbox_'+project_id).each(function(){
      this.checked = true;
    });
  });

  $('.clear_all').on('click',function(){
     var project_id = $(this).attr('project_id');
     $('.checkbox_'+project_id).each(function(){
      this.checked = false;
    });
  });
</script>
@endsection
