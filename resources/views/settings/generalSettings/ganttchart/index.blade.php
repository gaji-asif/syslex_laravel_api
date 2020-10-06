@extends('master')
@section('mainContent')
<div class="" style="margin-top: -20px;">
   <div class="card-datatable" style="margin-top: 0px; padding: 0px;">
      <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
         <div class="row">
            <div class="col-md-12">

          @if(session()->has('message'))
            <br>
            <div class="alert alert-success mb-10 background-success" role="alert">
              {{ session()->get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

{{-- GANTT CHART CODE STARTS --}}
            <div class="ganntcontainer">
                <div class="controls" style="display: block;float: left;">
                {{-- <div class="form-group col-md-5 mt-0">
                      <input type="date" id="" data-date="" data-date-format="YYY,MMMM,DD" name="start_date" class="form-control" value="">
                </div> --}}

            {!! Form::open(['route' => ['ganttdatasend', $id], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'reportaddform','class' => 'form-horizontal'])!!}

                    <div class="input-group mb-3" style="float: left;width: 380px;margin-right: 7px;margin-top: -1px;">
                        <div class="input-group-append">
                        <span class="input-group-text" style="background: rgba(24, 28, 33, 0.12);color: #000000b5;">Show from</span>
                      </div>
                      <input type="text" required class="date-own form-control" name="yearofgantt" autocomplete="off" placeholder="Select Year" value="@if (isset($ganttyear)) {{ $ganttyear }} @endif" id="yearlist" style="padding: 19px 13px">
                                        <script>
                                          $( document ).ready(function() {
                                              @if (isset($ganttyear)) 
                                                $('.date-own').datepicker({
                                                  format:'dd/mm/yyyy',
                                                });
                                              @else
                                                $('.date-own').datepicker({
                                                    format:'dd/mm/yyyy',
                                                }).datepicker("setDate",'now');
                                              @endif
                                            });
                                      </script>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar-alt d-block"></i></span>
                      </div>
                    </div>

                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-default @if (isset($monthlimit) && $monthlimit == 1) active @endif">
                        <input class="monthlimit" style="margin-left: 15px" type="radio" @if (isset($monthlimit) && $monthlimit == 1) checked @endif id="1month" name="scale" value="1" > 1 month
                      </label>
                      <label class="btn btn-default @if (isset($monthlimit) && $monthlimit == 2) active @endif">
                        <input required class="monthlimit" @if (isset($monthlimit) && $monthlimit == 2) checked @endif style="margin-left: 15px" type="radio" id="2month" name="scale" value="2"> 2 months
                      </label>
                      <label class="btn btn-default @if (isset($monthlimit) && $monthlimit == 3) active @endif">
                        <input required class="monthlimit" @if (isset($monthlimit) && $monthlimit == 3) checked @endif style="margin-left: 15px" type="radio" id="3month" name="scale" value="3" > 3 months
                      </label>  

                      <label required class="btn btn-default @if (isset($monthlimit) && $monthlimit == 4) active @endif">
                        <input class="monthlimit" @if (isset($monthlimit) && $monthlimit == 4) checked @endif style="margin-left: 15px" type="radio" id="6month" name="scale" value="4"> 6 months
                      </label>                      

                      <label class="btn btn-default @if (isset($monthlimit) && $monthlimit == 5) active @endif">
                        <input required class="monthlimit" @if (isset($monthlimit) && $monthlimit == 5) checked @endif style="margin-left: 15px" type="radio" id="6month" name="scale" value="5"> 12 months
                      </label>

                  </div>
                <input type="submit" class="btn btn-secondary ml-3 mt-0" id="" value="search" style="padding: 7px 35px;">
                {{-- <a href="{{route('ganttchart', $id)}}" class="btn btn-default ml-3 mt-0">Clear All</a> --}}

            {!! Form::close() !!}

                </div><br>
{{-- 
                  <div class="" style="width: auto;float: right;margin-right: 2px;padding: 7px 4px;">
                        <input class="status" checked style="margin-left: 15px" type="radio"  name="status" value="1" > all
                        <input class="status" style="margin-left: 15px" type="radio" name="status" value="2" > not close
                  </div> --}}

                <div style="clear: both;"></div>
            <div id="gantt_here" style='width:100%;min-height: 450px'></div><br>





{{--################## CUSTOM LIGHT BOX CODE  --}}


            <div id="lightboxform">

              <h4 style="margin-left: -25px; border-bottom: none;" class="card-header">
                   <strong>
                      <a href="#" class="">
                         <div class=" lightboxviewbtn btn-primary btn-sm mt-1  pull-right dtb_custom_btn_default">viwe</div>
                      </a>
                   </strong>
                   <strong>
                      <a href="#">
                         <div class="btn-success lightboxeditbtn mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default">Edit</div>
                      </a>
                   </strong>
                </h4>

{{-- view portion starts --}}
                <div class="card pb-3 mb-0 bg-transparent border-0 mt-4 lightboxviwpart">

                    <div class="row px-0">
                          <div class="col-md-12">
                            <ul class="appinfobox">
                              <li><span class="issuetitle"></span></li>
                            </ul>
                          </div>
                    </div>                    

                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Issue Type</a></li>
                              <li><span class="issuetype badge badge-success p-1"></span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">App</a></li>
                              <li><span class="app">Laravel App</span></li>
                            </ul>
                          </div>
                    </div>  
                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Status</a></li>
                              <li><span class="status badge text-white p-1"> </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Priority</a></li>
                              <li><span class="priority badge  p-1">
                            </span></li>
                            </ul>
                          </div>
                    </div> 
                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Assign To</a></li>
                              <li><span class="assignee">
                                 
                              </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Category</a></li>
                              <li><span class="category"></span></li>
                            </ul>
                          </div>
                    </div> 
                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Version</a></li>
                              <li><span class="version badge p-1">  </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Start Date</a></li>
                              <li><span class="startdate">
                                
                              </span></li>
                            </ul>
                          </div>
                    </div> 

                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">End Date</a></li>
                              <li><span class="enddate">
                               
                              </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Progress</a></li>
                              <li>
                                  <strong>
                                    <div class="text-right text-muted small progressinfo"></div>
                                    <div class="progress" style="height: 6px;">
                                       <div class="progress-bar"></div>
                                    </div>
                                 </strong>
                              </li>
                            </ul>
                          </div>
                    </div> 

                    <div class="row px-0">
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Estimate 1</a></li>
                              <li><span class="estimate1">
                                   4.0 hours 
                                </span></li>
                            </ul>
                          </div>
                          <div class="col-md-6">
                            <ul class="appinfobox">
                              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Actual Time</a></li>
                              <li>
                                 <span class="estimate2">
                                 </span>
                              </li>
                            </ul>
                          </div>
                    </div> 

                    <div class="row px-0">
                      <div class="col-md-6">
                        <ul class="appinfobox">
                          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Difficulty</a></li>
                          <li><span class="difficulty"> 
                           </span></li>
                        </ul>
                      </div>     

                      <div class="col-md-6">
                        <ul class="appinfobox">
                          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Issue</a></li>
                          <li><span class="nextissue"></span></li>
                        </ul>
                      </div>
                    </div>     

                    <div class="row px-0">
                      <div class="col-md-6">
                        <ul class="appinfobox">
                          <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Next Kick Status</a></li>
                          <li><span class="nextissuestats"></span></li>
                        </ul>
                      </div>
                      <div class="col-md-6">
                        <ul class="appinfobox">
                          <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Next User</a></li>
                          <li><span class="nextuser"></span></li>
                        </ul>
                      </div>
                    </div>                     


                    <div class="row px-0">
                      <div class="col-md-12">
                        <a href="javascript:void(0)" class="text-body font-weight-semibold">Details</a>
                        <p></p>
                        <ul class="appinfobox bg-white p-2">
                          <li><span class="issuecomments"></span></li>
                        </ul>
                      </div>
                    </div> 
                    <div class="row px-0">
                      <div class="col-md-12">
                        <a href="javascript:void(0)" class="text-body font-weight-semibold">All Comments</a>
                        <p></p>
                        <ul class="appinfobox bg-white p-2">
                          <li><span class="issuecomments"></span></li>
                        </ul>
                      </div>
                    </div> 
                </div>
{{-- view portion ends --}}


{{-- edit form portion starts --}}

                <div class="lightboxeditpart">
                  <br><br>
                     
                       {!! Form::open(['route' => ['update_issue_data', $singleissue->id], 'method' => 'PUT','files' => true, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'edit_issue_and_comment'])!!}
                          <h4 style="padding: 10px 0px; border-bottom: none;" class="card-header">
                             {{--  <strong><a href="{{url('delete_issue_view/'.$singleissue->id)}}" class="modalLink" data-modal-size="modal-md"><div class="btn-danger btn-sm mt-1  pull-right dtb_custom_btn_default">Delete</div></a></strong>
                          <input type="hidden" name="fromPageDiv" value={{$div}}>
                            <strong><a href="{{url('issue/'. $singleissue->id.'/'.$div)}}"><div class="btn-success mt-1 btn-sm  mr-2 pull-right dtb_custom_btn_default">view</div></a></strong>  
                          <small> --}}
                           
                                        <input name="issue_title" type="text" class="col-10 col-md-8 controls form-control {{ $errors->has('issue_title') ? ' is-invalid' : '' }}" placeholder="Subject title" value="{{ old('issue_title',$singleissue->issue_title) }}" required style="font-size: 16px;float: left;">
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
                                          <option value="{{ $issueType->id }}" {{ old('issue_type') == $issueType->id || $singleissue->issue_type == $issueType->id ? 'selected':'' }}>{{ $issueType->issue_type }}</option>
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
                                          <option value="{{ $app->id }}" {{ old('app_id') == $app->id || $singleissue->app_id == $app->id ? 'selected':'' }}>{{ $app->app_name }}</option>
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
                                          <option value="{{ $statuse->id }}" {{ old('status') == $statuse->id || $singleissue->status == $statuse->id ? 'selected':'' }}>{{ $statuse->status_name }}</option>
                                          @endforeach
                                        </select>
                                        <input type="hidden" name="next_issue_id" value="{{ $singleissue->next_issue_id ?? '' }}">
                                        <input type="hidden" name="next_kick_status" value="{{ $singleissue->next_kick_status ?? '' }}">
                                        <input type="hidden" name="next_user_id" value="{{ $singleissue->next_user_id ?? '' }}">
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
                                          <option value="{{ $priority->id }}" {{ old('issue_priority_id') == $priority->id || $singleissue->issue_priority_id == $priority->id ? 'selected':'' }}>{{ $priority->priority_name }}</option>
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

                                            @if ($user->is_archived == 1 && $singleissue->user_id == $user->user_id)
                                              <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id || $singleissue->user_id == $user->user_id ? 'selected':'' }}>{{ $user->name }} (archived)</option>
                                            @elseif($user->is_archived == 0)
                                              <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id || $singleissue->user_id == $user->user_id ? 'selected':'' }}>{{ $user->name }}</option>
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
                                          <option value="{{ $category->id }}" {{ old('category_id') == $category->id || $singleissue->category_id == $category->id ? 'selected':'' }}>{{ $category->category_name }}</option>
                                          @endforeach
                                        </select>
                                        <input type="hidden" name="next_kick_status" value="{{ $singleissue->next_kick_status ?? '' }}">
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
                                            <input type="text" data-date="" data-date-format="YYY MMMM DD" name="start_date" id="start_date" class="form-control  {{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="Estimate One" value="{{ empty(old('start_date'))?date( 'Y-m-d',strtotime($singleissue->start_date)):date( 'Y-m-d',strtotime( old('start_date')))  }}">
                                          </div>
                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li><a href="javascript:void(0)" class="text-body font-weight-semibold">End Date</a></li>
                                        <li><span class="appvalue">

                                           <input name="deadline" id="deadline" type="text" data-date="" data-date-format="YYY MMMM DD" class="form-control  {{ $errors->has('deadline') ? ' is-invalid' : '' }}" placeholder="Estimate One" value="{{ empty(old('deadline'))?date( 'Y-m-d',strtotime($singleissue->deadline)):date( 'Y-m-d',strtotime(old('deadline')))  }}">

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
                                          <option value="{{ $version->id }}" {{ old('version_id') == $version->id || $singleissue->version_id == $version->id ? 'selected':'' }}>{{ $version->version_name }}</option>
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
                                          <option value="1"  {{ old('progress') == 1|| $singleissue->progress == 1 ? 'selected':'' }} >10%</option>
                                          <option value="2"  {{ old('progress') == 2|| $singleissue->progress == 2 ? 'selected':'' }}>20%</option>
                                          <option value="3"  {{ old('progress') == 3|| $singleissue->progress == 3 ? 'selected':'' }}>30%</option>
                                          <option value="4"  {{ old('progress') == 4|| $singleissue->progress == 4 ? 'selected':'' }}>40%</option>
                                          <option value="5"  {{ old('progress') == 5|| $singleissue->progress == 5 ? 'selected':'' }}>50%</option>
                                          <option value="6"  {{ old('progress') == 6|| $singleissue->progress == 6 ? 'selected':'' }}>60%</option>
                                          <option value="7"  {{ old('progress') == 7|| $singleissue->progress == 7 ? 'selected':'' }}>70%</option>
                                          <option value="8"  {{ old('progress') == 8|| $singleissue->progress == 8 ? 'selected':'' }}>80%</option>
                                          <option value="9"  {{ old('progress') == 9|| $singleissue->progress == 9 ? 'selected':'' }}>90%</option>
                                          <option value="10" {{ old('progress') == 10|| $singleissue->progress == 10 ? 'selected':'' }}>100%</option>
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
                                             <input type="text" name="estimate_hour1" class="form-control  {{ $errors->has('estimate_hour1') ? ' is-invalid' : '' }}" placeholder="Estimate Hour One" value="{{ empty(old('estimate_hour1'))?$singleissue->estimate_hour1:old('estimate_hour1')  }}">
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
                                              <input type="text" name="estimate_hour2" class="form-control  {{ $errors->has('estimate_hour2') ? ' is-invalid' : '' }}" value="{{ empty(old('estimate_hour2'))?$singleissue->estimate_hour2:old('estimate_hour2')  }}">
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
                                          <option value="0"  {{ old('difficulty') == 0|| $singleissue->difficulty == 0 ? 'selected':'' }} >Select Difficulty</option>
                                          <option value="1"  {{ old('difficulty') == 1|| $singleissue->difficulty == 1 ? 'selected':'' }} >Easy</option>
                                          <option value="2"  {{ old('difficulty') == 2|| $singleissue->difficulty == 2 ? 'selected':'' }}>Medium</option>
                                          <option value="3"  {{ old('difficulty') == 3|| $singleissue->difficulty == 3 ? 'selected':'' }}>Hard</option>
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
                                        <span>{{ $singleissue->nextissue ?? 'not set yet' }}</span>

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
                                          <span>{{ $singleissue->nxtstatus ?? 'not set yet' }}</span>
                                        </div>

                                        </span></li>
                                      </ul>
                                    </div>
                                    <div class="col-md-6">
                                      <ul class="appinfobox">
                                        <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Next User</a></li>
                                        <li><span class="appvalue">
                                         <div class="">
                                             <span>{{ $singleissue->nexuser ?? 'not set yet' }}</span>
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

                                              @if (isset($singleissue->nextissue))
                                                <h6 id="" style="color: white"><span style="color: aquamarine;margin-right: 3px;">Next issue : </span> {{ $singleissue->nextissue ?? '' }}</h6>
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
                           
                           
                          <textarea style="display: none;" id="wikidescsrc" rows="10" cols="82">{{$singleissue->issue_text}}</textarea>



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

                         {{--  <div class="row mb-4">
                            <div class="col-md-1"></div>
                              <div class="col-md-10 text-center">
                              <button type="button" class="btn btn-success dtbbigbtn" id='savebtnModel'  onclick='popup()' data-toggle="modal" data-target="#feedbackmodal" class="mr-2 feedbackmodal" >Save</button>
                            </div>
                            <div class="col-md-1"></div>
                          </div> --}}

                          {{ Form::close()}}



              <input type="button" name="save" value="Save" disabled="true" style='width:100px;'>
              <input type="button" name="close" value="Close"  style='width:100px;'>
              <input type="button" name="delete"  disabled="true" value="Delete"style='width:100px;' >
                </div>

{{-- edit form portion ends --}}



            </div>
{{-- CUSTOM LIGHT BOX CODE ENDS  --}}










{{-- GANTT CHART CODE ENDS --}}

     
            </div>
         </div>
        
      </div>
   </div>
</div>


{{-- @if (isset($monthlimit))
{{ $monthlimit }} <br>
{{ $ganttyear }}

@endif --}}


<script src="{{asset('js/ganttchart/ganttmain.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/ganttchart/ganttmain.css')}}">
<link rel="stylesheet" href="{{asset('css/ganttchart/ganttchartnewdesign.css')}}">
{{-- <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
<link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet"> --}}
{{-- <link href="https://docs.dhtmlx.com/gantt/codebase/skins/dhtmlxgantt_broadway.css?v=6.3.7" rel="stylesheet"> --}}

<script type="text/javascript">

  $( document ).ready(function() {


      <?php
       if (isset($issuedata)) { ?>
        

            var monthlimit = parseInt({{ $monthlimit }});
            var year = '<?php echo $ganttyear; ?>';
            var tasks = <?php echo $issuedata; ?>


            gantt.config.order_branch_free = true;
            var index = gantt.getColumnIndex("start_date");
            gantt.config.xml_date = "%Y-%m-%d";
            gantt.config.date_grid = "%d-%m-%Y";

            gantt.config.scales = [
              { unit: "month", step: 1, date: "%F, %Y" },
              { unit: "day", step: 1, date: "%d" }
            ];

            gantt.config.drag_progress = false;
            gantt.config.min_column_width = 30;
            
            var formatFunc = gantt.date.str_to_date("%d/%m/%Y");
            var userdate = formatFunc(year);

            var monthStart = userdate;
            var monthEnd = gantt.date.add(monthStart, monthlimit, "month");
            
            var dataRange = gantt.getSubtaskDates();

            var newStart = dataRange.start_date ? Math.min(+dataRange.start_date, +monthStart) : +monthStart;
            var newEnd = dataRange.end_date ? Math.max(+dataRange.end_date, +monthEnd) : +monthEnd;

            gantt.config.start_date = new Date(monthStart);
            gantt.config.end_date = new Date(monthEnd);
            gantt.config.show_errors = false;
            gantt.config.autosize = "y";
            // gantt.config.autosize_min_width = 800;






//############## code for custom lightbox for view and edit starts



    $('.lightboxviwpart').show();
    $('.lightboxeditpart').hide();

    $('.lightboxeditbtn').click(function(e){
      e.preventDefault();



        // $.ajaxSetup({
        // headers: {
        // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // }
        // });
        // $.ajax({
        // //url : '{{ url('project/<?php echo $id ;?>/ganttissueget') }}',
        // url: 'task/'+2,
        // method: 'PUT',
        // success: function (response) {
        // },
        // error: function (XMLHttpRequest, textStatus, errorThrown) {
        // alert('something wrong');
        // }
        // });


      $('.lightboxeditpart').show();
      $('.lightboxviwpart').hide();
    });    




// MODAL TASK VIEW AJAX STARTS
    $('.lightboxviewbtn').click(function(e){
      e.preventDefault();
      $('.lightboxeditpart').hide();
      $('.lightboxviwpart').show();

    });
// MODAL TASK VIEW AJAX ENDS



    (function(){

      var taskId = null;
      var newTask = 0;

      gantt.showLightbox = function(id) {

         taskId = id;
         var task = gantt.getTask(id);
          
         var form = getForm();
         // var title = form.querySelector("[name='description']");
         // title.focus();
         // title.value = task.text;
         var issuetitle =     $('.issuetitle').text(task.text);
         var issuetype =      $('.issuetype').text(task.typeofissue);
         var issuetypecolor = $('.issuetype').css("background-color", task.issuetypecolor);
         var app =            $('.app').text(task.appname);

         var status =         $('.status').text(task.statusname);
         var statuscolor =    $('.status').css("background-color", task.statuscolor);
         var priority =       $('.priority').text(task.priorname);
         var prioritycolor =  $('.priority').css("background-color", task.priorcolor);

         var category =       $('.category').text(task.categoryname);
         var assignee =       $('.assignee').text(task.assignee);
         var version =        $('.version').text(task.versionname);
         var versioncolor =   $('.version').css("background-color", task.versioncolor);

         var startdate =      $('.startdate').text(task.start_date);
         var enddate =        $('.enddate').text(task.deadline);
         var progressbar =    $('.progress-bar').css("width", task.progress+"%");
         var progress =       $('.progressinfo').text(task.progress+"%");

         if(task.estimate_hour1 ==null){ est1 = "not set" }else{ var est1 = task.estimate_hour1 + " hours" }
         var estimate1 =      $('.estimate1').text(est1);
         if(task.estimate_hour2 ==null){ est2 = "not set" }else{ var est2 = task.estimate_hour2 + " hours" }
         var estimate2 =      $('.estimate2').text(est2);

         var difficulty =     $('.difficulty').text(task.difficname);
         var nextissue =      $('.nextissue').text(task.nextissuetitle);
         var nextissuestats = $('.nextissuestats').text(task.nextissuestat);
         var nextstatcolor =  $('.nextissuestats').css("background",task.nextissuestatcolor);
         var nextuser =       $('.nextuser').text(task.nexissueassignee);
         var issuecomments =  $('.issuecomments').text(task.issue_comment);
//console.log(task);
         form.style.display = "block"; 
        
         form.querySelector("[name='save']").onclick = save;
         form.querySelector("[name='close']").onclick = cancel;
         form.querySelector("[name='delete']").onclick = remove;

      };

      
      gantt.hideLightbox = function(){
        getForm().style.display = ""; 
        taskId = null;
      }
       
      
function getForm() { 
return document.getElementById("lightboxform"); 
}; 
function save() {
var task = gantt.getTask(taskId);
//alert('new task');
var title  = task.text = getForm().querySelector("[name='start_date']").value;
if(newTask){
//alert('new task');die();
gantt.addTask(task,task.parent);
}else{
gantt.updateTask(task.id);
}
gantt.hideLightbox();
}
function cancel() {
var task = gantt.getTask(taskId);

if(newTask)
gantt.deleteTask(task.id);
gantt.hideLightbox();
}
function remove() {
gantt.deleteTask(taskId);
gantt.hideLightbox();
}

})();

//################# code for custom lightbox for view and edit ends



            gantt.init("gantt_here");
            //gantt.init("gantt_here",new Date(2019,10,28), new Date(2020,monthlimit,30));
            gantt.parse({
              data: tasks
            });


            var dp = new gantt.dataProcessor("ganttchart");
            dp.init(gantt);
            dp.setTransactionMode({
            }, true);

            gantt.config.columns = [
              // {name:"text",       label:textFilter, width:250, tree:true },
              {name:"text",       label:"Issue Title", width:180, tree:true },
              {name:"start_date", label:"Start at", width:80, align:"center" },
              {name:"duration",   label:"Day",   width:40, align:"center" },
              {name:"add",        label:"", width:40, align:"left" },
            ];


            gantt.templates.rightside_text = function(start, end, task){
                return "<b style='color:#05244b;padding: 3px 5px;background: #dcff50;font-weight: 500'>Assignee </b>" + "<span style='color:#f1f1f2;padding: 3px 8px;background: #38587d;font-weight: bold;text-transform:capitalize'>" + task.assignee + "</span>";
            };


            gantt.templates.tooltip_text = function(start,end,task){
                return " ";
            };

            dp.attachEvent("onAfterUpdate", function(id, action, tid, response){
                if(action == "error"){
                   //alert('something went wrong,try again !');
                }
            });


          gantt.templates.grid_header_class = function(columnName, column){
            if(columnName == 'duration' ||columnName == 'text')
              return "updColor";
          };
            gantt.templates.task_text=function(start, end, task){
                return task.issue_title;
            };


       <?php }else{ ?>

          // var currentyear = new Date().getFullYear();
          // ganttchartrunner(year=currentyear,monthlimit=12);

      <?php } ?>



        gantt.createDataProcessor(function(entity, action, data, id){
         
          switch (action) {


            case "update":

            //console.log(data);
                  var stat = $("#status").text();

                  $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                  });
                  //console.log(data);
                  $.ajax({
                  url: 'task/'+id,
                  type: 'PUT',
                  data:{taskid:data.id,user_id:data.user_id,issue_title:data.text,start_date:data.start_date,deadline:data.end_date,complete_date:data.complete_date,progress:data.progress,duration:data.duration,updated_at:data.updated_at,stat:stat},
                  success: function(data){
                    //alert(data);exit();
                    gantt.load("ganttdata");
                    gantt.render();
                    
                  $.iaoAlert({msg: "Issue has been Updated !",
                    type: "success",
                    mode: "dark",});

                  },
                  error: function (request, status, error) { 
                  }

                  });


            break;


            case "create":
                  //alert('creat');die();
                  $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                  });

                  $.ajax({
                  url: 'task',
                  type: 'POST',
                  data:{start_date:data.start_date,issue_title:data.text,duration:data.duration,end_date:data.end_date},
                  success: function(data){

                    gantt.load("ganttdata");
                    gantt.render();

                    $.iaoAlert({msg: "Issue has been Saved !",
                    type: "success",
                    mode: "dark",});

                    window.location.reload();
                    gantt.render();

                  //   setTimeout(function () {
                  //     window.location.reload();
                  // }, 2000);

                  },
                  error: function (request, status, error) { 
                    alert('error');
                  }

                  });


            break;


            case "delete":

                  $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                  });
                  $.ajax({
                  url: 'task/'+id,
                  type: 'DELETE',
                  data:{taskid:data.id},
                  success: function(data){

                    $.iaoAlert({msg: "Issue has been deleted !",
                    type: "success",
                    mode: "dark",});
                    gantt.load("ganttdata");
                    gantt.render();

                  },
                  error: function (request, status, error) { 
                  }

                  });

            break;

          }
        });



// GANTT CHART CODE ENDS ##############################





});


</script>

<style>
#lightboxform {
    position: absolute;
    top: 100px;
    left: 300px;
    width: 65%;
    z-index: 3;
    display: none;
    background-color: #F5F5F5;
    border: 1px solid gray;
    padding: 20px 20px 5px 20px;
    font-family: Tahoma;
    font-size: 10pt;
}
  
  #lightboxform input[type="button"]{
    margin: 10px;
  }





  .form-radio
{
     -webkit-appearance: none;
     -moz-appearance: none;
     appearance: none;
     display: inline-block;
     position: relative;
     background-color: #f1f1f1;
     color: #666;
     top: 10px;
     height: 30px;
     width: 30px;
     border: 0;
     border-radius: 50px;
     cursor: pointer;     
     margin-right: 7px;
     outline: none;
}
.form-radio:checked::before
{
     position: absolute;
     font: 13px/1 'Open Sans', sans-serif;
     left: 11px;
     top: 7px;
     content: '\02143';
     transform: rotate(40deg);
}
.form-radio:hover
{
     background-color: #f7f7f7;
}
.form-radio:checked
{
     background-color: #f1f1f1;
}
label
{
     font: 15px/1.7 'Open Sans', sans-serif;
     color: #333;
     -webkit-font-smoothing: antialiased;
     -moz-osx-font-smoothing: grayscale;
     cursor: pointer;
}

.gantt_tree_icon.gantt_blank {
    width: 0px !important;
}

.gantt_task_line .gantt_task_content {
    text-align: center;
    font-weight: 500;
}
.gantt_grid_data .gantt_row.gantt_selected, .gantt_grid_data .gantt_row.odd.gantt_selected {
    background-color: #4e51551f;
    border-top-color: #4e51551f;
}
.gantt_task_row.gantt_selected {
    background-color: #4e51551f;
}
.gantt_task_row.gantt_selected .gantt_task_cell {
    border-right-color: #4e51551f;
}

.gantt_cal_light {
    height: 292px !important;
    }

    ul.appinfobox li{
      font-size: 13px !important;
    }
ul.appinfobox li a {
    /* font-weight: 600 !important; */
    color: #000000 !important;
}

</style>
@endsection

