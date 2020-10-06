@extends('master')
@section('mainContent')
<style type="text/css">
  .md-editor{
    width: 100%;
  }
  .comment-md{
    background-color: #FFFFFF !important;
  }
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


  .pickedissuearea h6 {
    padding: 7px 8px;
    margin-bottom: 4px;
    color: seagreen;
    background: beige;
    border: 1px solid #00000024;
}
.pickedissuearea {
    overflow: hidden;
}
.droptdownarea {
    background: #38587d;
    padding: 10px 12px 1px;
    border-radius: 3px;
}
.issuestblarea {
    background: #fff;
    border: 1px solid #c2dfd1;
}
.newassineearea {
    background: #38587d;
    padding: 16px 14px 7px;
}
.newassigneemsgbox::placeholder{color:black}
.modal-backdrop.show {
    opacity: 0.8 !important;
}
.selected{
  background: gray;
}
.selected {
    background: #8080804a;
    color: #000000;
    font-weight: 500;
/*    border-left: 4px solid #02bc77 !important;
    border-right: 4px solid #02bc77 !important;*/
    border: 1px solid #80808000;
}
#autoassignsrchrslt.dataTable thead th:first-child {
    display: none;
}
#autoassignsrchrslt.dataTable tbody tr td:first-child {
    display: none;
}

/*#autoassignsrchrslt.dataTable thead th:last-child {
    display: none;
}*/
#autoassignsrchrslt.dataTable tbody tr td:last-child {
    display: none;
}
#newassignmsgsuccess {
    background: darkkhaki;
    padding: 1px 6px;
    width: 76.5%;
    margin-bottom: 7px;
    font-size: 13px;
    color: black;
    font-weight: 500;
}
.tui-editor .te-preview-style-vertical .te-preview {

    background: white;
}
  div#newassignmsg {
    background: aquamarine;
    color: black;
    max-width: 76.4%;
    padding: 0px 6px;
    font-size: 14px;
}
.issueeditholder input, select {
    border-radius: 0px !important;
}
ul.appinfobox li:first-child {
    width: 90px !important;
}
ul.appinfobox {
    margin-bottom: 7px;
}
.issueeditholder select, input {
    height: 35px !important;
    font-size: 14px;
    margin-top: -1px;
}
ul.appinfobox li:first-child a {
    /* float: left; */
    position: absolute;
    bottom: 14px;
}
span#autoassinexistmsg {
    color: powderblue;
    float: left;
    margin-top: -16px;
    margin-bottom: 6px;
    font-size: 12px;
}
</style>


<link rel="stylesheet" href="{{asset('css/imageuploadify.min.css')}}">
<!-- Project progress -->


<div class="col-lg-10 mt-4 issueeditholder" style="margin:0 auto">
  {!! Form::open(['route' => ['update_issue_data', $dtbissue->id], 'method' => 'PUT','files' => true, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'edit_issue_and_comment'])!!}
<h4 style="padding: 10px 0px; border-bottom: none;" class="card-header">
    <strong><a href="{{url('delete_issue_view/'.$dtbissue->id)}}" class="modalLink" data-modal-size="modal-md"><div class="btn-danger btn-sm mt-1  pull-right dtb_custom_btn_default">Delete</div></a></strong>
<input type="hidden" name="fromPageDiv" value={{$div}}>
  <strong><a href="{{url('issue/'. $dtbissue->id.'/'.$div)}}"><div class="btn-success mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default">view</div></a></strong>  
<small>
 
              <input name="issue_title" type="text" class="col-10 col-md-8 controls form-control {{ $errors->has('issue_title') ? ' is-invalid' : '' }}" placeholder="Subject title" value="{{ old('issue_title',$dtbissue->issue_title) }}" required style="font-size: 16px;float: left;">
              <br>
              @if ($errors->has('issue_title'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('issue_title') }}</strong></span>
              </span>
              @endif


</small>

</h4> 

<div class="card pb-4 mb-2 mt-4 bg-transparent no_border">

    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Type</a></li>
              <li><span class="appvalue">

              <select name="issue_type" class="custom-select {{ $errors->has('issue_type') ? ' is-invalid' : '' }}">
                <option value="">Select Issue Type</option>
                @foreach($issueTypes as $issueType)
                <option value="{{ $issueType->id }}" {{ old('issue_type') == $issueType->id || $dtbissue->issue_type == $issueType->id ? 'selected':'' }}>{{ $issueType->issue_type }}</option>
                @endforeach
              </select>

              </span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">App</a></li>
              <li><span class="appvalue">
                <select name="app_id" class="custom-select {{ $errors->has('app_id') ? ' is-invalid' : '' }}">
                <option value="">Select App</option>
                @foreach($apps as $app)
                <option value="{{ $app->id }}" {{ old('app_id') == $app->id || $dtbissue->app_id == $app->id ? 'selected':'' }}>{{ $app->app_name }}</option>
                @endforeach
              </select>
              </span></li>
            </ul>
          </div>
    </div>  





    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Status</a></li>
              <li><span class="appvalue">

                 <script type="text/javascript">
                    var feedbackList = new Array();
                    </script>
             <div class="">
              <select name="status" id="status" class="custom-select {{ $errors->has('status') ? ' is-invalid' : '' }}">
                <option value="">Select to status</option>
                @foreach($statuses as $statuse)
                  @if($statuse->is_feedback == 1)
                      <script type="text/javascript">
                      feedbackList.push({{$statuse->id}});
                      </script>
                    @endif
                <option value="{{ $statuse->id }}" {{ old('status') == $statuse->id || $dtbissue->status == $statuse->id ? 'selected':'' }}>{{ $statuse->status_name }}</option>
                @endforeach
              </select>
              <input type="hidden" name="next_issue_id" value="{{ $dtbissue->next_issue_id ?? '' }}">
              <input type="hidden" name="next_kick_status" value="{{ $dtbissue->next_kick_status ?? '' }}">
              <input type="hidden" name="next_user_id" value="{{ $dtbissue->next_user_id ?? '' }}">
            </div>

              </span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Priority</a></li>
              <li><span class="appvalue">
              <select name="issue_priority_id" class="custom-select {{ $errors->has('issue_priority_id') ? ' is-invalid' : '' }}">
                <option value="">Select priority</option>
                @foreach($priorities as $priority)
                <option value="{{ $priority->id }}" {{ old('issue_priority_id') == $priority->id || $dtbissue->issue_priority_id == $priority->id ? 'selected':'' }}>{{ $priority->priority_name }}</option>
                @endforeach
              </select>
              </span></li>
            </ul>
          </div>
    </div>


    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Assign To</a></li>
              <li><span class="appvalue">

                <select name="user_id" class="custom-select {{ $errors->has('user_id') ? ' is-invalid' : '' }}">
                  <option value="">Select to assign</option>
                  @foreach($users as $user)

           {{-- code for: if the assigned user is already archived, the person is selectable unless someone changed the assignee to other user who has not been archived yet --}}

                  @if ($user->is_archived == 1 && $dtbissue->user_id == $user->user_id)
                    <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id || $dtbissue->user_id == $user->user_id ? 'selected':'' }}>{{ $user->name }} (archived)</option>
                  @elseif($user->is_archived == 0)
                    <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id || $dtbissue->user_id == $user->user_id ? 'selected':'' }}>{{ $user->name }}</option>
                  @endif


                  @endforeach
                </select>

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
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id || $dtbissue->category_id == $category->id ? 'selected':'' }}>{{ $category->category_name }}</option>
                @endforeach
              </select>
              <input type="hidden" name="next_kick_status" value="{{ $dtbissue->next_kick_status ?? '' }}">
            </div>
              </span></li>
            </ul>
          </div>
    </div>





    <div class="row px-0">

          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Start Date</a></li>
              <li><span class="appvalue">
                <div class="">
                  <input type="text" data-date="" data-date-format="YYY MMMM DD" name="start_date" id="start_date" class="form-control  {{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="Estimate One" value="{{ empty(old('start_date'))?date( 'Y-m-d',strtotime($dtbissue->start_date)):date( 'Y-m-d',strtotime( old('start_date')))  }}">
                </div>
              </span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">End Date</a></li>
              <li><span class="appvalue">

                 <input name="deadline" id="deadline" type="text" data-date="" data-date-format="YYY MMMM DD" class="form-control  {{ $errors->has('deadline') ? ' is-invalid' : '' }}" placeholder="Estimate One" value="{{ empty(old('deadline'))?date( 'Y-m-d',strtotime($dtbissue->deadline)):date( 'Y-m-d',strtotime(old('deadline')))  }}">

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
                @foreach($versions as $version)
                <option value="{{ $version->id }}" {{ old('version_id') == $version->id || $dtbissue->version_id == $version->id ? 'selected':'' }}>{{ $version->version_name }}</option>
                @endforeach
              </select>

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
                <option value="1"  {{ old('progress') == 1|| $dtbissue->progress == 1 ? 'selected':'' }} >10%</option>
                <option value="2"  {{ old('progress') == 2|| $dtbissue->progress == 2 ? 'selected':'' }}>20%</option>
                <option value="3"  {{ old('progress') == 3|| $dtbissue->progress == 3 ? 'selected':'' }}>30%</option>
                <option value="4"  {{ old('progress') == 4|| $dtbissue->progress == 4 ? 'selected':'' }}>40%</option>
                <option value="5"  {{ old('progress') == 5|| $dtbissue->progress == 5 ? 'selected':'' }}>50%</option>
                <option value="6"  {{ old('progress') == 6|| $dtbissue->progress == 6 ? 'selected':'' }}>60%</option>
                <option value="7"  {{ old('progress') == 7|| $dtbissue->progress == 7 ? 'selected':'' }}>70%</option>
                <option value="8"  {{ old('progress') == 8|| $dtbissue->progress == 8 ? 'selected':'' }}>80%</option>
                <option value="9"  {{ old('progress') == 9|| $dtbissue->progress == 9 ? 'selected':'' }}>90%</option>
                <option value="10" {{ old('progress') == 10|| $dtbissue->progress == 10 ? 'selected':'' }}>100%</option>
              </select>
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
                   <input type="text" name="estimate_hour1" class="form-control  {{ $errors->has('estimate_hour1') ? ' is-invalid' : '' }}" placeholder="Estimate Hour One" value="{{ empty(old('estimate_hour1'))?$dtbissue->estimate_hour1:old('estimate_hour1')  }}">
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
                    <input type="text" name="estimate_hour2" class="form-control  {{ $errors->has('estimate_hour2') ? ' is-invalid' : '' }}" value="{{ empty(old('estimate_hour2'))?$dtbissue->estimate_hour2:old('estimate_hour2')  }}">
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
               <select name="difficulty" class="custom-select {{ $errors->has('difficulty') ? ' is-invalid' : '' }}">
                <option value="0"  {{ old('difficulty') == 0|| $dtbissue->difficulty == 0 ? 'selected':'' }} >Select Difficulty</option>
                <option value="1"  {{ old('difficulty') == 1|| $dtbissue->difficulty == 1 ? 'selected':'' }} >Easy</option>
                <option value="2"  {{ old('difficulty') == 2|| $dtbissue->difficulty == 2 ? 'selected':'' }}>Medium</option>
                <option value="3"  {{ old('difficulty') == 3|| $dtbissue->difficulty == 3 ? 'selected':'' }}>Hard</option>
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



    <div class="row px-0">
          <div class="col-md-12">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Issue</a></li>
              <li><span class="appvalue">

              <div class="">
              <span>{{ $dtbissue->nextissue ?? 'not set yet' }}</span>

              </div>

              </span></li>
            </ul>
          </div>
    </div>



    <div class="row px-0">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Kick Status</a></li>
              <li><span class="appvalue">

              <div class="">
                <span>{{ $dtbissue->nxtstatus ?? 'not set yet' }}</span>
              </div>

              </span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Next User</a></li>
              <li><span class="appvalue">
               <div class="">
                   <span>{{ $dtbissue->nexuser ?? 'not set yet' }}</span>
                </div>
              </span></li>
            </ul>
          </div>
    </div>

       


<div class="row no-gutters align-items-center mt-2">


<div class="col-lg-12" style="padding: 7px 0px;">
 <a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Detail</a>


<!-- ##################### AUTO ASSIGN MODAL START  ###########################-->

      <button type="button" id="autoassignmodalbtn" class="btn btn-info btn-sm pull-right dtb_custom_btn_default dtb_secondary_bgcolor text-white" data-toggle="modal" data-target="#myModal">Auto assign</button>

      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header py-2 px-1">
              <button type="button" class="close" data-dismiss="modal" style="margin-right: -20px;">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="droptdownarea">
                    <div class="input-group">



<!-- SEARCH PORTION STARTS -->

                      <?php 
                          $loggedindeveloper = Session::get('developer_id');
                          if ($loggedindeveloper !== "" ) {
                            $projectlist = DB::table('dtb_projects')
                              ->select('id','project_name','developer_id','ordering')
                              ->where('developer_id', $loggedindeveloper)
                              ->orderBy('ordering','DESC')
                              ->get();
                          }
                      ?>

                      <select class="custom-select flex-grow-1 mr-3 mb-2" name="project" id="project" style="width: 180px">
                        <option>Select Project</option>
                        <?php if (isset($projectlist)) {?>
                            @foreach($projectlist as $devsproject)
                              <option value="{{ $devsproject->id ?? '' }}">{{ $devsproject->project_name ?? '' }}</option>
                            @endforeach
                        <?php } ?>
                      </select>


                      <select class="custom-select flex-grow-1 mr-3 mb-2" name="app" id="app" style="width: 180px">
                        <!-- data will take place here from ajax response -->
                      </select>


                      <select class="custom-select flex-grow-1  mr-3 mb-2" name="assignee" id="assignee" style="width: 180px">
                        <!-- data will take place here from ajax response -->
                      </select>


                      <span class="" id="assignee mb-2">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
                        <button type="button" name="reset" id="reset" class="btn btn-default" style="color: white;border-color: white">Reset</button>
                      </span>


<!-- SEARCH PORTION ENDS -->



                    </div>
                  </div>
                </div>
              </div> 

              <br>             

              <div class="row">
                <div class="col-md-12">
                  <div class="issuestblarea py-3 px-3" style="min-height: 200px;">
                       <div class="table-responsive">
                        <table id="autoassignsrchrslt" class="table table-bordered display">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th>Issue Title</th>
                                  <th>Category</th>
                                  <th>Project</th>
                                  <th>Next Issue title</th>
                                  <th>Next Issue Assignee</th>
                                  <th style="display: none"></th>
                                  <th style="display: none"></th>
                                  <th style="display: none"></th>
                              </tr>
                          </thead>
                        </table>
                     </div>
                  </div>
                </div>
              </div>              

              <br><br>

              <div class="row">
                <div class="col-md-12">
                  <div class="pickedissuearea">
                    <h6>Selected Issue</h6>
                      
                      <!-- selection holder table ends -->
                      <table class="table table-bordered table-striped display table-hover dataTable no-footer" style="background: #fff">
                        <thead>
                        <tr>
                            <th>Issue Title</th>
                            <th>Category</th>
                            <th>Project</th>
                            <th>Next Issue Title</th>
                            <th>Next Assignee</th>
                        </tr>
                        </thead>
                        <tbody id="selecetedrowholder">
                          {{-- <td id="appholder"></td> --}}
                          <td id="issueholer"></td>
                          <td id="catholder"></td>
                          <td id="projectholder"></td>
                          
                          <td id="nextissueholder"></td>
                          <td id="nextuser"></td>

             {{--              issueholer
                          projectholder
                          catholder
                          nextissueholder
                          nextuser --}}
                        </tbody>
                      </table>
                      <!-- selection holder table ends -->

                  </div>
                </div>
              </div>

              <br>

              <div class="row">
                <div class="col-md-12">
                  <div class="newassineearea">

                    @if (isset($dtbissue->nextissue))
                      <h6 id="" style="color: white"><span style="color: aquamarine;margin-right: 3px;">Next issue : </span> {{ $dtbissue->nextissue ?? '' }}</h6>
                    @endif
                    
                    <span id="autoassinexistmsg"></span>
                    <div id="event"></div>
                    <div id="newassignmsgsuccess"></div>
                    <div class="input-group">
                      
                      <input type="hidden" name="newassignissueid" id="newassignissueid" value="">
                      <input type="hidden" name="newprojectid" id="newprojectid" value="">

                

                      <select class="custom-select flex-grow-1  mr-3 mb-2" name="newassignee" id="newassignee" style="width: 180px">
                        <!-- data will take place here from ajax response -->
                      </select>

                      <select class="custom-select flex-grow-1 mr-3 mb-2" name="newstatus" id="newstatus" style="width: 180px">
                      </select>

                      <sapn class="flex-grow-1  mr-3 mb-2">
                      </sapn>
                    </div>
                    <div id="newassignmsg"></div>                    
                    <div class="input-group mt-2">
                      <sapn class="flex-grow-1  mr-3 mb-2">
                        <textarea id="autoassignmsg" name="autoassignmsg" class="form-control newassigneemsgbox" rows="4" style="color:black" placeholder="Write message"></textarea>
                      </sapn>
                    </div>                    
                    <div class="input-group mt-2">
                      <sapn class="flex-grow-2  mr-3 mb-2">
                        <input type="button" class="btn btn-outline primary btn-md py-2" value="Done" id="btnassignnew" style="background: white">
                      </sapn>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>

<!-- ########################## AUTO ASSIGN MODAL ENDS ##############################-->


</div>







 <div id="editSection" class="mt-2" style="width: 100%"></div>

 <textarea id="issuedesctobesaved" rows="10" cols="82" name="issue_text" style="display: none;"></textarea> 
 
 
<textarea style="display: none;" id="wikidescsrc" rows="10" cols="82">{{$dtbissue->issue_text}}</textarea>



 <textarea id="commentholder" rows="10" cols="82" name="" style="display: none;">
  <?php if (!empty($commentcontent)) {
      foreach($commentcontent as $rec){
          echo $rec->issue_comment;
      }
    } ?>
</textarea>

<input type="hidden" name="feedback_type" id ="feedback_type"></input>
</div>


</div>

<div class="container-fluid flex-grow-1 container-p-y px-0 pt-2">
<div class="form-group">
   <label class="form-label mt-3 mb-2"><h4>Write a Comment</h4></label>
   @if ($errors->has('description'))
   <span class="invalid-feedback" role="alert">
    <span class="messages"><strong>{{ $errors->first('description') }}</strong></span>
  </span>
  @endif
  <div id="editSection1"></div>
  <textarea id="content2bSavedHolder" name="issue_comment" style="display:none"></textarea>
</div>
</div>
</div>




  
<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>


  <script type="text/javascript">
<!--
function popup(){
  var statusId= $("#status").children('option:selected').val();
  for (var i = 0; i < feedbackList.length; i++) {
    if(feedbackList[i]==statusId){
      return true;
    }
  }
  $('#savebtnModel').removeAttr('data-toggle');
  $('#savebtnModel').removeAttr('data-target');
    $('#feedback_type').val('');
  $("#edit_issue_and_comment").submit();
}
//-->
</script>

<div class="row mb-4">
  <div class="col-md-1"></div>
    <div class="col-md-10 text-center">
    <button type="button" class="btn btn-success dtbbigbtn" id='savebtnModel'  onclick='popup()' data-toggle="modal" data-target="#feedbackmodal" class="mr-2 feedbackmodal" >Save</button>
  </div>
  <div class="col-md-1"></div>
</div>

{{ Form::close()}}
<br>
<script type="text/javascript">
  var text = document.getElementById('wikidescsrc').value,
  target = document.getElementById('editSection'),
  converter = new showdown.Converter(),
  html = converter.makeHtml(text);
  target.innerHTML = html;
  var initcontent = [].join('\n');
  if (text.length>0)
    initcontent = [];
  
  var editor = new tui.Editor({
    el: document.querySelector('#editSection'),
    height: '400px',
    previewStyle: 'vertical',
    initialValue: initcontent+text,
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
      url : '{{ url('/uploadissuefiles') }}',
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
//for comment portion
 var initeditorcontent = [].join('\n');
  var editor_comment = new tui.Editor({
    el: document.querySelector('#editSection1'),
    height: '400px',
    previewStyle: 'vertical',
    initialValue: initeditorcontent,
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
                var myupload = commentimgup(blob);
                //console.log(blob);
                var cllbackimg = myupload;
                //var cllbackimg = document.location.origin +'/developmentmanage/public/'+myupload;
                callback(cllbackimg, 'alt text');
            }
        }
  });
  function commentimgup(images){
    var myresult = "";
    var dataimg = new FormData();
    var form = dataimg.append('file', images);
  
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url : '{{ url('/uploadissuecommentfiles') }}',
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
        $("#edit_issue_and_comment").submit(function(e){
         //e.preventDefault();
          var content2bSaved = editor_comment.getValue(); 
          var issue_details = editor.getValue();
          //var content2bSaved = editor.getHtml();
          $('#issuedesctobesaved').html(issue_details);
          $('#content2bSavedHolder').html(content2bSaved);
        });
    
      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      var markedcontent = document.getElementById('content').innerHTML =
        marked('<?php if (!empty($wikipage)) {echo $wikipage->description; } ?>');
       
</script>

<!-- MODAL FOR EDIT -->

<!-- Modal template -->
<div class="modal fade" id="feedbackmodal">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content" id="issuetypupdate">

      <div class="modal-header">
        <h5 class="modal-title">
          Feedback Type
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

        <div class="form-row">
          <div class="form-group col mb-0">
            <select name="feedback_id" id="feedback_id" class="custom-select {{ $errors->has('version_id') ? ' is-invalid' : '' }}">
              <option value="">Select Feedback Type</option>
              @foreach($feedbacks as $feedback)
              <option value="{{ $feedback->id }}" >{{ $feedback->name }}</option>
              @endforeach
            </select>
          </div>

   

      </div>
      <div class="modal-footer">
        <button id="feedbackclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updatewithfeedbackbtn" disabled="disabled">Save</button>
      </div>
    </form>
  </div>
</div>




<script type="text/javascript">

$(document).ready(function(){  

　　　　$('#feedback_id').change(function(){  
        if ($(this).children('option:selected').val() != ''){
          $('.updatewithfeedbackbtn').removeAttr("disabled");
        }else{
          $('.updatewithfeedbackbtn').attr("disabled","disabled");
        }
        $('#feedback_type').val($(this).children('option:selected').val());
　　　　})  
});

$('body').on('click','.updatewithfeedbackbtn',function(e){
  e.preventDefault();
//   $("#edit_issue_and_comment").append( '#feedback_id', name );
  $("#edit_issue_and_comment").submit();
});

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



// ######################   auto assign poriton starts ##############

  $("#project").change(function(e){
    e.preventDefault();

          let selectedproject = $(this).find(":selected").val();

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            if (selectedproject !== "") {

                $.ajax({
                  url : '{{ url('/getprojectapp') }}',
                  method: 'POST',
                  data: {
                    "selectedprojectid": selectedproject
                  },
                    success: function (response) {

                    $("#app").empty();
                    $("#app").append('<option> Select App </option>');

                    if(response)
                    {
                      $.each(response,function(key,value){
                          $('#app').append($("<option/>", {
                             value: key,
                             text: value
                          }));
                          console.log(key);
                      });
                    }

                    getprojectuser(selectedproject);

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                      alert('something went wrong');
                    }
                });

            }else{
              $("#app").empty();
            }


  });

// ######################   auto assign get user starts ##############

            function getprojectuser(selectedproject){

              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $.ajax({
                  url : '{{ url('/getprojectaddeduser') }}',
                  method: 'POST',
                  data: {
                    "selectedprojectid": selectedproject
                  },
                  success: function (data) {

                    $("#assignee").empty();
                    $("#assignee").append('<option> Select User </option>');

                        if(data)
                        {
                          $.each(data,function(key,value){
                            console.log(key);
                              $('#assignee').append($("<option/>", {
                                 value: key,
                                 text: value
                              }));
                          });
                      }

                  },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                      alert('something went wrong');
                    }
                });
            }


        </script>

        <script>
          
        // #####################  serch issue for auto assign functionality ########################

        $(document).ready(function(){ 


            // $("#autoassigntitle").text('Set Next Assignee');
            // $("#autoassinexistmsg").text('');

            $("#newassignmsgsuccess").hide();

            fill_datatable();
            
            function fill_datatable(project = '', app = '' ,assignee = '')
            {
                var dataTable = $('#autoassignsrchrslt').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url: "{{ route('customsearch') }}",
                        data:{project:project, app:app,assignee:assignee,issue_id:<?php echo $dtbissue->id ?>}
                    },
                    columns: [
                        {
                            data:'id',
                            name:'id'
                        },
                        {
                            data:'issue_title',
                            name:'issue_title'
                        },
                        {
                            data:'category_name',
                            name:'category_name'
                        },
                        {
                            data:'project_name',
                            name:'project_name'
                        },
                        {
                            data:'nxtissuetitles',
                            name:'nxtissuetitles'
                        },
                        {
                            data:'nextissueassignee',
                            name:'nextissueassignee'
                        },
                        {
                            data:'project_id',
                            name:'project_id',
                            
                        },
                        {
                            data:'nextkcikstatusid',
                            name:'nextkcikstatusid',
                            visible : false
                        },
                        {
                            data:'nextissueassigneeid',
                            name:'nextissueassigneeid',
                            visible : false
                        }
                    ]
                });

                  // var nextassignee = dataTable.column( 'nextissueassigneeid:name' ).data();
                  // if(nextassignee == null && nextassignee == null){
                  //     $("#autoassigntitle").text(' Set Next Assignee');
                  //     $("#autoassinexistmsg").text('');
                  //   } 
                  //   else{
                  //     $("#autoassigntitle").text('Edit Next Assignee');
                  //     $("#autoassinexistmsg").text('Next assignee already asigned for this issue,you can edit.');
                  // }

            }



          // CHECK NEXT ASSIGNEE IF EXITST WHEN CLICK MODAL BUTTON
          // $("#autoassignmodalbtn").click(function(e){
          //   var autoassinee = $("#autoassignsrchrslt tr td:eq(5)").text();
          //   if(autoassinee == ''){
          //     $("#autoassigntitle").text(' Set Next Assignee');
          //     $("#autoassinexistmsg").text('');
          //   }else{
          //     $("#autoassigntitle").text('Edit Next Assignee');
          //     $("#autoassinexistmsg").text('Next assignee already asigned for this issue,you can edit.');
          //   }
          // })



            $('#filter').click(function(){


                // $("#autoassigntitle").text(' Set Next Assignee');
                // $("#autoassinexistmsg").text('');

                var project = $('#project').val();
                var app = $('#app').val();
                var assignee = $('#assignee').val();

                if(project != '' &&  project != '' && assignee != '' )
                {

                    $('#autoassignsrchrslt').DataTable().destroy();
                    fill_datatable(project, app, assignee);
                }
                else
                {
                    alert('Select Both filter option');
                }

                $("#newassignee").empty();
                $("#newstatus").empty();

                $("#newassignissueid").val('');
                $("#newassignee").val('');
                $("#newstatus").val('');
                $("#autoassignmsg").val('');

                // $('#appholder').text('');
                $('#issueholer').text('');
                $('#typeholder').text('');
                $('#projectholder').text('');
                $('#catholder').text('');
                $('#nextissueholder').text('');
                $('#nextuser').text('');

                //generate drop down after clicking filter and project id taking form serch project selection from dropdwon
                selectedissueprojectassignee({{ $dtbissue->project_id ?? '' }});
                selectedissueprojectstatus({{ $dtbissue->project_id ?? '' }});


            });

            $('#reset').click(function(){
                $('#project').val('');
                $('#app').val('');
                $('#assignee').val('');
                $('#autoassignsrchrslt').DataTable().destroy();
                fill_datatable();

                $("#newassignee").empty();
                $("#newstatus").empty();

                $("#newassignissueid").val('');
                $("#newassignee").val('');
                $("#newstatus").val('');
                $("#autoassignmsg").val('');

                // $('#appholder').text('');
                $('#issueholer').text('');
                $('#typeholder').text('');
                $('#projectholder').text('');
                $('#catholder').text('');
                $('#nextissueholder').text('');
                $('#nextuser').text('');

                selectedissueprojectassignee({{ $dtbissue->project_id ?? '' }});
                selectedissueprojectstatus({{ $dtbissue->project_id ?? '' }});

            });


            // select one issue
            $('#autoassignsrchrslt tbody').on( 'click', 'tr', function () {
              var table = $('#autoassignsrchrslt').DataTable();
               if ( $(this).hasClass('selected') ) {

                  $(this).removeClass('selected');

               } else {
                   table.$('tr.selected').removeClass('selected');
                   $(this).addClass('selected');
                   
                   var selecteedrowdata = $('#autoassignsrchrslt').DataTable().row('.selected').data();

                   var issueid = selecteedrowdata.id;
                   var projectidnew = selecteedrowdata.project_id;
                   //var appname = selecteedrowdata.app_name;
                   var projectname = selecteedrowdata.project_name;
                   var issuetitle = selecteedrowdata.issue_title;
                   var issuetype = selecteedrowdata.issue_type;
                   var catname = selecteedrowdata.category_name;
                   var issuestatus = selecteedrowdata.status_name;
                   var nextkickstatusname = selecteedrowdata.nextkickstatusname;
                   var nextissueassignee = selecteedrowdata.nextissueassignee;
                   var nextkcikstatusid = selecteedrowdata.nextkcikstatusid;
                   var nextissueassigneeid = selecteedrowdata.nextissueassigneeid;
                   var nextissuetitle = selecteedrowdata.nxtissuetitles;

                    // if(nextkcikstatusid == null && nextissueassigneeid == null){
                    //   $("#autoassigntitle").text(' Set Next Assignee');
                    //   $("#autoassinexistmsg").text('');
                    // } 
                    // else{
                    //   $("#autoassigntitle").text('Edit Next Assignee');
                    //   $("#autoassinexistmsg").text('Next assignee already asigned for this issue,you can edit.');
                    // }

                   //showing in selected table
                   //$('#appholder').text(appname);
                   $('#issueholer').text(issuetitle);
                   //$('#typeholder').text(issuetype);
                   $('#projectholder').text(projectname);
                   $('#catholder').text(catname);
                   $('#nextissueholder').text(nextissuetitle);
                   $('#nextuser').text(nextissueassignee);

                   //set issue and project id at hidden field to process new assign insertion
                   $('#newassignissueid').val(issueid);
                   $('#newprojectid').val(projectidnew);
                    
                    $("#newassignmsg").hide();

                    //show after clicking on table row
                    selectedissueprojectassignee({{ $dtbissue->project_id ?? '' }},issueid,nextissueassigneeid,nextkcikstatusid);
                    selectedissueprojectstatus({{ $dtbissue->project_id ?? '' }});
                    
                  
               }
           });


          //user show initially
          selectedissueprojectassignee({{ $dtbissue->project_id ?? '' }});
          selectedissueprojectstatus({{ $dtbissue->project_id ?? '' }});

          // ############### generate assinee for auto assin portion ############
          function selectedissueprojectassignee(projectidnew,issueid,issuestatus,nextissueassigneeid,nextkcikstatusid){

                      $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });

                      $.ajax({
                          url : '{{ url('/getprojectnewassignee') }}',
                          method: 'POST',
                          data: {
                            "projectidnew": projectidnew
                          },
                          success: function (data) {

                            $("#newassignee").empty();
                            $("#newassignee").append('<option value=""> Select Next Assignee </option>');

                                if(data)
                                {
                                  $.each(data,function(key,value){
                                      $('#newassignee').append($("<option />", {
                                         value: key,
                                         text: value
                                      }));
                                  });


                                <?php
                                  if(isset($dtbissue->next_user_id) && $dtbissue->next_user_id !== null ){?>

                                    $element = $('#newassignee');
                                    $options = $element.find('option');
                                    $wanted_element = $options.filter(function () {
                                      return $(this).val() == <?php echo $dtbissue->next_user_id; ?> || $(this).text() == <?php echo $dtbissue->next_user_id; ?>
                                    });
                                    $wanted_element.prop('selected', true);

                                <?php }else{ ?>
                                  
                                <?php } ?>

                              }

                          },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                              alert('something went wrong');
                            }
                        });


                    }
          // ############### generate assinee for auto assin portion ends ############  


          // ############### generate new status for auto assin portion ############

          function selectedissueprojectstatus(projectidnew){

                      $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });

                      $.ajax({
                          url : '{{ url('/getprojectnewstatus') }}',
                          method: 'POST',
                          data: {
                            "projectidnew": projectidnew
                          },
                          success: function (data) {

                            $("#newstatus").empty();
                            $("#newstatus").append('<option value=""> Select Kick Status </option>');

                                if(data)
                                {
                                  $.each(data,function(key,value){
                                    // console.log(key);
                                      $('#newstatus').append($("<option/>", {
                                         value: key,
                                         text: value
                                      }));
                                  });


                                // to be dropdown selected with mathing the data
                                <?php
                                  if(isset($dtbissue->next_kick_status) && !empty($dtbissue->next_kick_status)){?>
                                    $element = $('#newstatus');
                                    $options = $element.find('option');
                                    $wanted_element = $options.filter(function () {
                                      return $(this).val() == <?php echo $dtbissue->next_kick_status; ?> || $(this).text() == <?php echo $dtbissue->next_kick_status; ?>
                                    });
                                    $wanted_element.prop('selected', true);
                                <?php }else{ ?>
                                <?php } ?>




                              }

                          },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                              alert('something went wrong');
                            }
                        });
                    }
          // ############### generate assinee for auto assin portion ends ############




          $("#btnassignnew").click(function(e){

                    e.preventDefault();

                    var newassignissueid = $("#newassignissueid").val();
                    var newassignee = $("#newassignee").val();
                    var newstatus = $("#newstatus").val();
                    var autoassignmsg = $("#autoassignmsg").val();


                    if (newassignissueid === "" || newassignissueid === null) {
                      $("#newassignmsg").show();
                      $("#newassignmsg").text('Select a issue first !');
                    }else if(newassignee === "" || newassignee === null){
                      $("#newassignmsg").show();
                      $("#newassignmsg").text('Select assignee please !');
                    }else if(newstatus === "" || newstatus === null){
                      $("#newassignmsg").show();
                      $("#newassignmsg").text('Select status please !');
                    }else{

                        $("#newassignmsg").hide();

                        $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                        });

                        $.ajax({
                          url : '{{ url('/newlyassignto') }}',
                          method: 'POST',
                          data: {
                            "newassignissueid": newassignissueid,
                            "mainissueid":<?php echo $dtbissue->id ?>,
                            "newassignee": newassignee,
                            "newstatus": newstatus,
                            "autoassignmsg": autoassignmsg,
                          },
                            success: function (response) {

                            $("#newassignmsgsuccess").show();
                            $("#newassignmsgsuccess").text('Auto assign Success !');
                            $('#newassignmsgsuccess').delay(2000).fadeOut();

                            $("#newassignee").empty();
                            $("#newstatus").empty();

                            $("#newassignissueid").val('');
                            $("#newassignee").val('');
                            $("#newstatus").val('');
                            $("#autoassignmsg").val('');

                            // $('#appholder').text('');
                            $('#issueholer').text('');
                            $('#typeholder').text('');
                            $('#projectholder').text('');
                            $('#catholder').text('');

                            setTimeout(function(){
                               location.reload();
                            }, 2000);
                            
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                              alert('something went wrong');
                            }
                        });
                    }

          });



        });
        // #####################  serch issue for auto assign functionality ends ########################
        </script>


     @endsection