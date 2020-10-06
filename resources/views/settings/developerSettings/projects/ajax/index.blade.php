                <div class="">
                  @if(isset($activity_logs_dates))
                  @if(count($activity_logs_dates)>0)
                  @foreach($activity_logs_dates as $activity_logs_date)
                  <div class="card mb-4">
   
                    <h6 class="card-header">{{date('Y-M-d', strtotime($activity_logs_date->date))}}</h6>

                    @php $activity_logs_details = App\DtbActivityLog::allActivityLogs(date('Y-m-d', strtotime($activity_logs_date->date))); @endphp
                    
                    <div class="card-body">
                      @if(isset($activity_logs_details))
                      @foreach($activity_logs_details as $activity_logs_detail)
                      <div class="media pb-1 mb-3">
                        @if(!empty($activity_logs_detail->icon_image_path))
                         <img src="{{asset($activity_logs_detail->icon_image_path)}}" alt="" class="d-block ui-w-40 rounded-circle">
                         @else
                         <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-40 rounded-circle">
                         @endif
                        <div class="media-body ml-3">
                          <a href="javascript:void(0)">{{$activity_logs_detail->user_name}}</a>
                          <span class="text-muted">{{$activity_logs_detail->action}}</span>
                          <a href="javascript:void(0)">{{$activity_logs_detail->function_name}}</a>

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