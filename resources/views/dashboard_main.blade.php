@extends('master_main')
@section('mainContent')
<!-- <h4 class="font-weight-bold py-3 mb-4">
  <span class="text-muted font-weight-light"></span> Dashboard
</h4> -->
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<style type="text/css">
  .noticeboard_wrapper{
    margin: 0 auto;
    
  }
  .noticeboard_wrapper h1, h2, h3, h4, h5, h6, p{
    color: #FFFFFF !important;
    padding: 0px 35px;
    line-height: 20px;
  }
</style>
<div class="row pt-4">
  <div class="col-md-8 noticeboard_wrapper">
   <?php 
    if (!empty($dtbdevelopgroup->notice)) { ?>

      <div class="tui-editor-contents noticeboard mb-3 mt-3" id="noticeboard">
          <?php 
          $parser = new \cebe\markdown\GithubMarkdown();
          $parser->html5 = true;
          $parser->enableNewlines = true;
          echo $parser->parse($dtbdevelopgroup->notice);
          ?>
      </div>

    <?php }else { ?>

       <div class="noticeboard mb-3 mt-3 pb-2" id="noticeboard">
          <strong>No notice available</strong>
      </div>

    <?php } ?>


  </div>
</div>

<h4 class="media align-items-center font-weight-bold py-3 mb-4 text-center">
  <div class="media-body ml-3">

      @php $image_path = ""; @endphp
      @if(!empty($dtbdevelopgroup->logo_image_path))
      <img src="{{$dtbdevelopgroup->logo_image_path}}" alt="" class="ui-w-50 rounded-circle mr-2">
      @else
      <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="ui-w-50 rounded-circle mr-2" width="32px">
      @endif

      @if(!empty($dtbdevelopgroup->space_name))
      <font style="color: #000000;">{{ $dtbdevelopgroup->space_name }}</font> 
      @else
      <span>Space Name not available</span>
      @endif
@if(Session::has('role'))
    @if(Session::get('role') == '0')
      <a href="{{route('space.index')}}"><i class="fa fa-gear ml-1" style="font-size:15px; border:1px solid #000000; border-radius:15px; padding:6px;"></i></a>
	@endif
@endif
  </div>
</h4>
<div class="row">
  <div class="col-md-4">
    <div id="accordion2 mb-5">
      <div class="card mb-5 no_border">
        <div class="card-header card_header_new_style">
          <a class="d-flex justify-content-between text-body" data-toggle="collapse" aria-expanded="true" href="#all_projects" style="font-weight: bold;">
            All Projects
            <div class="collapse-icon"></div>
          </a>
        </div>
        <div id="all_projects" class="collapse show" data-parent="#accordion2" style="">
          @if(isset($projects))
          @if(count($projects)>0)
          <ul class="list-group list-group-flush">
            @foreach($projects as $project)
            <li class="list-group-item py-3 projectlists">
				
              <a href="{{route('issue.index', $project->id)}}" style="display: block;">
                <div class="font-weight-semibold black_font_color">{{$project->project_name}}</div>
				 <small class="text-muted">{{date('d-M-Y h:i a', strtotime($project->created_at))}}</small>
              </a>
              
            </li>
            @endforeach
            <a href="{{route('my_projects')}}" class="card-footer d-block text-center text-body small font-weight-semibold gray_button">VIEW ALL</a>
          </ul>
          @else
          <a href="" class="text-muted card-footer d-block text-center text-body small font-weight-semibold gray_button">There is no project assign for you.</a>
          @endif
          @endif
        </div>
      </div>
    </div>
{{--   <div id="accordion2">
      <div class="card mb-2 no_border">
        <div class="card-header card_header_new_style">
          <a class="d-flex justify-content-between text-body" data-toggle="collapse" aria-expanded="true" href="#all_issues" style="font-weight: bold;">
            All Issues
            <div class="collapse-icon"></div>
          </a>
        </div>

        <div id="all_issues" class="collapse show" data-parent="#accordion2" style="">
          <div class="table-responsive">
            @if(isset($issues))
            @if(count($issues)>0)
            <table class="table card-table dtb_custom_tbl_common table-striped">
              <thead>
                <tr>
                  <th>App Name</th>
                  <th>Version</th>
                  <th>Status</th>
                  <th>Proirity</th>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Assignee</th>
                </tr>
              </thead>
              <tbody>
               @foreach($issues as $issue)
                <tr style="cursor: pointer;" class="issuelists" onclick="window.location='{{url('issue/'.$issue->id.'/myIssue')}}';">
                  <td>{{(isset($issue->app_id)) ? $issue->app_name : ''}}</td>
                  <td>{{(isset($issue->version_id)) ? $issue->version_name : ''}}</td>
                  <td>
                   @if(isset($issue->status))
                   @if($issue->status_name == 'open')
                   <div class="btn badge badge-success float-right mr-3">{{$issue->status_name}}</div>
                   @endif
                   @endif
                 </td>
                 <td>
                   @if(isset($issue->issue_priority_id))
                     @if($issue->priority_name == 'Asap')
                     <div class="btn badge badge-danger float-right mr-3">{{$issue->priority_name}}</div>
                     @endif
                     @if($issue->priority_name == 'Not Sure')
                     <div class="btn badge badge-primary float-right mr-3">{{$issue->priority_name}}</div>
                     @endif
                     @if($issue->priority_name == 'Important')
                     <div class="btn badge badge-secondary float-right mr-3">{{$issue->priority_name}}</div>
                     @endif
                     @if($issue->priority_name == 'Top')
                     <div class="btn badge badge-info float-right mr-3">{{$issue->priority_name}}</div>
                     @endif
                     @if($issue->priority_name == 'Row')
                     <div class="btn badge badge-warning float-right mr-3">{{$issue->priority_name}}</div>
                     @endif
                   @endif
                 </td>
                 <td>{{(isset($issue->category_id)) ? $issue->category_name : ''}}</td>
                 <td>{{(isset($issue->issue_title)) ? $issue->issue_title : ''}}</td>
                 <td>{{(isset($issue->user_id)) ? $issue->name : ''}}</td>
               </tr>
               @endforeach
             </tbody>
           </table>

            @else
            <a class="text-muted card-footer d-block text-center text-body small font-weight-semibold">There is no issues assign for you.</a>
            @endif
            @endif
         </div>

       </div>
     </div>
   </div> --}}

 </div>


  <div class="col-md-4">
    <div id="accordion2 mb-5">
      <div class="card mb-5 no_border">
        <div class="card-header card_header_new_style">
          <a class="d-flex justify-content-between text-body" data-toggle="collapse" aria-expanded="true" href="#all_projects" style="font-weight: bold;">
            News
            <div class="collapse-icon"></div>
          </a>
        </div>
        <div id="all_projects" class="collapse show" data-parent="#accordion2" style="">

          @php 
            if (session()->has('developer_id')){
            $developerid = Session::get('developer_id');
            $newses = \App\DtbNews::where(['developer_id' => $developerid])->orderBy('ordering','ASC')->limit(20)->get();
          }
          @endphp


          @if(isset($newses))
          @if(count($newses)>0)

          <ul class="list-group list-group-flush">
            @foreach($newses as $news)
            <li class="list-group-item py-3 projectlists">
        
              <a href="{{route('news-single', $news->id)}}" style="display: block;">
                <div class="font-weight-semibold black_font_color">{{$news->title}}</div>
         <small class="text-muted">{{date('d-M-Y h:i a', strtotime($news->created_at))}}</small>
              </a>
              
            </li>
            @endforeach
            <a href="{{route('news-all')}}" class="card-footer d-block text-center text-body small font-weight-semibold gray_button">VIEW ALL</a>
          </ul>

          @else
          <a href="" class="text-muted card-footer d-block text-center text-body small font-weight-semibold gray_button">There is no news available.</a>
          @endif
          @endif
        </div>
      </div>
    </div>

 </div>


 <div class="col-md-4">
          <div class="card-header card_header_new_style">
          <a class="d-flex justify-content-between text-body" data-toggle="collapse" aria-expanded="true" href="#all_projects" style="font-weight: bold;">
            Activities
            <div class="collapse-icon"></div>
          </a>
        </div>
  @if(isset($activity_logs_dates))
  @if(count($activity_logs_dates)>0)
  @foreach($activity_logs_dates as $activity_logs_date)
  <div class="card mb-4 no_border">
    <strong style="color: #000000 !important;" class="card-header black_font_color">{{date('Y-M-d', strtotime($activity_logs_date->date))}}</strong>
    @php $activity_logs_details = App\DtbActivityLog::allActivityLogs(date('Y-m-d', strtotime($activity_logs_date->date))); @endphp
    <div class="card-body padding_zero">
      @if(isset($activity_logs_details))
      @foreach($activity_logs_details as $activity_logs_detail)
      <div class="media">

        @php $image_path = ""; @endphp
        @if(!empty($activity_logs_detail->icon_image_path))
        @php $image_path = url($activity_logs_detail->icon_image_path); @endphp
        <img src="//{{substr($image_path,env('AWS_BASE_URL'))}}" alt="" class="d-block ui-w-40 rounded-circle">
        @else
        <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-40 rounded-circle">
        @endif

        <div class="media-body ml-3">
          <a href="javascript:void(0)">{{$activity_logs_detail->user_name}}</a>
          <span class="text-muted">{{$activity_logs_detail->action}}</span>
          <a href="javascript:void(0)">{{$activity_logs_detail->function_name}}</a>
          <!-- <p class="my-1">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.</p> -->
          <div class="clearfix">

            <span class="float-left text-muted small">
               @php $activityTime = App\DtbActivityLog::activityTime($activity_logs_detail->created_at); 
               @endphp
               @if(isset($activityTime)) 
                  {{$activityTime}}
               @endif

             </span>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
  @endforeach
    @else
    <div class="card mb-4">
      <h6 class="card-header">Recent Activities</h6>
       <div class="card-body">
          <a href="" class="text-muted d-block text-center text-body small font-weight-semibold">there are no recent updates.</a>
      </div>
    </div>
    @endif
  @endif
</div>
</div>
<style type="text/css">
.noticeboard {
    text-align: center;
    width: 100%;
    background: #718AA8 !important;
    color: #FFFFFF !important;
    border-radius: 4px;
    margin: 0 auto;
    /* display: table; */
    padding: 11px 0px 1px;

 
  border-radius: 5px;
 

}
.sidenav-horizontal-next,.sidenav-horizontal-prev{
    display: none;
}


</style>
@endsection
