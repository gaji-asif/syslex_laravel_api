  @extends('master')
  @section('mainContent')
  <style type="text/css">
    
    .project_margin_btm{
      border-bottom: 1px solid #e8e8e9 !important;
      padding: 0px;
      border-radius: 0px;
    }
    div.media{
      border-bottom: none;
      border-radius: 0px;
      padding: 8px;
    }
    .black_font_color{
      font-size: 15px;
    }
    /*.list-group-item {
      padding: 4px 8px;
    }*/
  </style>
  <div class="">
    <div class="row pt-0 pl-2">
          <div class="col-md-7 col-lg-12 col-xl-9">

                  <div class="card mb-4 no_border">
                    <h6 style="color: #000000 !important;" class="card-header card_header_new_style black_font_color">Leader</h6>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item project_margin_btm">
                        <div class="media align-items-center">
                          <img src="//{{ $projectinfo->icon_image_path }}" class="d-block ui-w-30" alt="">
                          <div class="media-body px-2">
                            <a href="javascript:void(0)" class="text-body">{{$projectinfo->name ?? ''}}</a>
                          </div>
                          <!-- <a href="javascript:void(0)" class="d-block text-light text-large font-weight-light">×</a> -->
                        </div>
                      </li>
                    </ul>
                  </div>

                  <div class="card mb-4 no_border">
                    <h6 style="color: #000000 !important;" class="card-header card_header_new_style black_font_color with-elements">Participants
                      <div class="card-header-elements ml-auto pull-right">
                        <a href="{{route('project.member', [$id])}}" class="btn btn-xs btn-outline-primary">Add <span class="ion ion-md-add"></span></a>
                      </div>
                    </h6>

                    
                    <!-- <h6 class="card-header with-elements">
                      <span class="card-header-title">Participants</span>
                      <div class="card-header-elements ml-auto">
                        <a href="{{route('project.member', [$id])}}" class="btn btn-xs btn-outline-primary">Add <span class="ion ion-md-add"></span></a>
                      </div>
                    </h6> -->
                    <ul class="list-group list-group-flush"> 

                        @php 
                           $projectparticipants = \App\DtbUsersProject::where('project_id',$id)
                           ->join('dtb_users', 'dtb_users_projects.user_id', '=', 'dtb_users.id')
                           ->select('dtb_users_projects.id as prouserid','dtb_users.name','dtb_users.icon_image_path')
                           ->get();
                        @endphp

                        @foreach($projectparticipants as $participant)

                      <li class="list-group-item">
                        <div class="media align-items-center">
                          <img src="//{{ $participant->icon_image_path }}" class="d-block ui-w-30" alt="">
                          <div class="media-body px-2">
                            <a href="javascript:void(0)" class="text-body">{{$participant->name}}</a>
                          </div>
                          <a href="#" class="d-block text-light text-large font-weight-light memberdelbtn" data="{{$participant->prouserid}}">×</a>
                        </div>
                      </li>
                      @endforeach
                   
                    </ul>
                  </div>
          <!-- <section class="posts endless-pagination holder" data-next-page="{{ $activity_logs_dates->nextPageUrl() }}">
          {{--{!! $activity_logs_dates->render() !!}--}}
          </section> -->

      <div class="logholder">
        <h6 style="color: #000000 !important;" class="card-header card_header_new_style black_font_color with-elements">Activities</h6>
       
          <ul id="results"><!-- results appear here --></ul>
          <div class="ajax-loading"><img src="<?php echo asset("assets_/img/loader3.gif")?>" /></div>
      </div>
  <!-- <img id="loader2" class="text-center" style="margin: 0 auto;width: 104px;text-align: center;display: block;" src="<?php //echo asset("assets_/img/loader3.gif")?>"></img> -->
                </div>
                <div class="col-md-4 col-lg-12 col-xl-3">

                  <!-- Stats -->
                  <div class="row">
                     <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">

                      <div class="card mb-4 no_border">
                        <h6 style="color: #000000 !important;" class="card-header card_header_new_style black_font_color">Status</h6>
                        

                        <div class="card-footer border-0 small p-0">
                         <div class="card-body demo-paragraph-spacing" style="padding: 16px 20px 14px;">
                      <p>

                        @php 
                          $projectstatus = DB::table('dtb_issues')
                                ->join('dtb_issue_statuses', 'dtb_issues.status', '=', 'dtb_issue_statuses.id')->where('dtb_issues.project_id',$id)
                                ->select( DB::raw('count(*) as total'),'dtb_issue_statuses.status_name','dtb_issue_statuses.color')
                                ->groupBy('dtb_issue_statuses.id')->get();
                        @endphp

                        @foreach($projectstatus as $projectstatuses)
                        <button type="button" class="btn btn-sm mt-0 mb-2" style="background: {{$projectstatuses->color}};color: white">{{$projectstatuses->status_name}}
                          <span class="custom-btn-badge badge">{{$projectstatuses->total}}</span>
                        </button>
                        @endforeach

                      </p>
                    </div>
                    
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">

                      <div class="card mb-4 no_border">

                        <h6 style="color: #000000 !important;" class="card-header card_header_new_style black_font_color with-elements">Milestone
                      <div class="card-header-elements ml-auto pull-right">
                        <a href="{{route('version', [$id])}}" class="btn btn-xs btn-outline-primary">Add <span class="ion ion-md-add"></span></a>
                      </div>
                    </h6>
                     @php 

                           $DtbVersion = DB::table('dtb_issues')
                                ->join('dtb_versions', 'dtb_issues.version_id', '=', 'dtb_versions.id')->where('dtb_issues.project_id',$id)
                                ->select( DB::raw('count(*) as total'),'dtb_versions.version_name')
                                ->groupBy('dtb_versions.id')->get();
                        @endphp

                        @foreach($DtbVersion as $versions)
                          <div class="list-group-item border-top-0">
                            {{$versions->version_name}}
                            <div class="float-right">&nbsp;&nbsp; 
                             <span class="text-muted">0</span>/ {{$versions->total}}
                            </div>
                            <div class="progress mt-2 mb-1" style="height:4px;">
                              <div class="progress-bar" style="width: 29.77%;"></div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">
                      <div class="card mb-4 no_border">
                        <div class="card-footer border-0 small p-0">
                          <h6 style="color: #000000 !important;" class="card-header card_header_new_style black_font_color with-elements">Categories
                      <div class="card-header-elements ml-auto pull-right">
                        <a href="{{route('category', [$id])}}" class="btn btn-xs btn-outline-primary">Add <span class="ion ion-md-add"></span></a>
                      </div>
                    </h6>
                    <div class="card-body demo-paragraph-spacing" style="padding: 16px 20px 14px;">
                      <p>

                        @php 
                          $category = DB::table('dtb_issues')
                                ->join('dtb_issue_categories', 'dtb_issues.category_id', '=', 'dtb_issue_categories.id')->where('dtb_issues.project_id',$id)
                                ->select( DB::raw('count(*) as total'),'dtb_issue_categories.category_name')
                                ->groupBy('dtb_issue_categories.id')->get();
                        @endphp

                        @foreach($category as $categoryes)
                        <button type="button" class="btn btn-sm btn-success mt-0 mb-2" style="color: white">{{$categoryes->category_name}}
                          <span class="custom-btn-badge badge">{{$categoryes->total}}</span>
                        </button>
                        @endforeach

                      </p>
                    </div>
                    
                        </div>
                      </div>

                    </div>
                    <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">
                  <div class="card mb-4 no_border">
                    <h6 style="color: #000000 !important;" class="card-header card_header_new_style black_font_color with-elements">Project details
                      
                    </h6>
                    <ul class="list-group list-group-flush">

                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">Project key</div>
                        <div><strong>{{$projectinfo->project_key ?? ''}}</strong></div>
                      </li>  


                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">Charge Person</div>
                        <div><strong>{{$projectinfo->name ?? ''}}</strong></div>
                      </li>             

                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">Company Name</div>
                        <div><strong>{{$projectinfo->company_name ?? ''}}</strong></div>
                      </li>

                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">Web</div>
                        <div><a href="javascript:void(0)">{{$projectinfo->url ?? ''}}</a></div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">Project Created at</div>
                        <div><?php echo date('d-m-Y', strtotime($projectinfo->created_at ?? '' )); ?></div>
                        <!-- {{$projectinfo->created_at ?? ''}} -->
                      </li>
                     
                    </ul>
                  </div>

                    </div>

                  </div>


                </div>


                </div>
      </div>


    <div id='toTop'>Take me top</div>
<style>
  .projectlogholder li img {
    float: left;
    margin-top: -11px;
    margin-right: 8px;
}
</style>
      <script>

      // $(window).scroll(function() { //detect page scroll
      //     if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
      //     }
      // });

      var page = 1; //track user scroll as page number, right now page number is 1
      load_more(page); //initial content load

      $(window).scroll(function(){
          if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
              page++; //page number increment
              load_more(page); //load content
          }else{
             
          }
      });

      function load_more(page){
        $.ajax(
              {
                  url: '?page=' + page,
                  type: "get",
                  datatype: "html",
                  beforeSend: function()
                  {
                      $('.ajax-loading').show();
                  }
              })
              .done(function(data)
              {
                  if(data.length == 0){
                  console.log(data.length);
                     
                      //notify user if nothing to load
                      $('.ajax-loading').html("No more records!");
                      return;
                  }
                  $('.ajax-loading').hide(); //hide loading animation once data is received
                  $("#results").append(data); //append data into #results element          
              })
              .fail(function(jqXHR, ajaxOptions, thrownError)
              {
                    //alert('No response from server');
              });
       }
</script>

<script>
   
  $(document).ready(function() {
   
  
   $('#loader2').hide();
      $(window).scroll(fetchPosts);
   
      function fetchPosts() {
   
          var page = $('.endless-pagination').data('next-page');
   
          if(page !== null) {
   
              clearTimeout( $.data( this, "scrollCheck" ) );
   
              $.data( this, "scrollCheck", setTimeout(function() {
                  var scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 100;
   
                  if(scroll_position_for_posts_load >= $(document).height()) {
                      $.get(page, function(data){
                          
                          $('#loader2').show();
                          $('.holder').append(data.activity_logs_dates);
                          $('.endless-pagination').data('next-page', data.next_page);

                      });
                  }
              }, 350))
   
          }
      }
   
   
  });
   
  </script>


  <script type="text/javascript">
     $( document ).ready(function() {

        $('body').on('click','.memberdelbtn',function(e){
          e.preventDefault();
          $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
          });

          var memberlsitid = $(this).attr('data');

           $.ajax({
            url: <?php echo $id; ?>+'/delparticipants',
            type: 'DELETE',
            data:{"memberlsitid":memberlsitid},

            success: function(data){

                $.iaoAlert({msg: "Member Removed",
                  type: "success",
                  mode: "dark",});

                  setTimeout(function () {
                      location.reload()
                  }, 1000);

            },
            error: function (request, status, error) {
                $.iaoAlert({msg: "Error",
                type: "warning",
                mode: "dark",})
            }



        });

    });
      


  //go to top button functionality
  $(window).scroll(function() {
      if ($(this).scrollTop()) {
          $('#toTop').fadeIn();
      } else {
          $('#toTop').fadeOut();
      }
  });

  $("#toTop").click(function () {
     $("html, body").animate({scrollTop: 0}, 1000);
  });





  });
  </script>



  @endsection