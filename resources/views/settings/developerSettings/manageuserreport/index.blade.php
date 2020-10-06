  @extends('master_main')
  @section('mainContent')

  <div class="mt-5">

     <div class="card-datatable" style="margin-top: 0px; padding: 0px;">
        <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">


           <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10" style="padding: 0px 0px !important; border-bottom: 1px solid #babbbc6b;padding-bottom: 15px !important;">

                <div class="screentgrpbtnholder">
                  
                  <div class="" style="">

              <div class="droptdownarea">
                    <div class="input-group">

<!-- SEARCH PORTION STARTS -->


                      <select name="reportmonth" id="monthlist" class="custom-select flex-grow-1 mr-3 mb-2">
                        {{-- <option value="">Select Month</option> --}}
                        <?php   
                          for ($i = 0; $i <= 12; $i++) { ?>
                          <option 
                            <?php if($months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")) == date('Y-m') ){ echo "selected";} ?> 
                            value="<?php  echo $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>"> 
                            <?php  echo $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                          </option>

                        <?php } ?>
                      </select>


                      <?php 
                          $loggedindeveloper = Session::get('developer_id');
                          if ($loggedindeveloper !== "" ) {
                            $userlist = DB::table('dtb_users')
                              ->select('id','name','developer_id')
                              ->where('developer_id', $loggedindeveloper)
                              ->get();
                          }
                      ?>
                      <select class="custom-select flex-grow-1 mr-3 mb-2" name="user" id="user" style="width: 180px">
                        <option value="">Select User</option>
                        <?php if (isset($userlist)) {?>
                            @foreach($userlist as $userdata)
                              <option value="{{ $userdata->id ?? '' }}">{{ $userdata->name ?? '' }}</option>
                            @endforeach
                        <?php } ?>
                      </select>


                      <?php 
                          $loggedindeveloper = Session::get('developer_id');
                          if ($loggedindeveloper !== "" ) {
                            $devteams = DB::table('dtb_develop_teams')
                              ->select('id','team_name','developer_id')
                              ->where('developer_id', $loggedindeveloper)
                              ->get();
                          }
                      ?>
                      <select class="custom-select flex-grow-1 mr-3 mb-2" name="team" id="team" style="width: 180px">
                        <option value="">Select Team</option>
                        <?php if (isset($devteams)) {?>
                            @foreach($devteams as $devteam)
                              <option value="{{ $devteam->id ?? '' }}">{{ $devteam->team_name ?? '' }}</option>
                            @endforeach
                        <?php } ?>
                      </select>


                      <span class="" id="assignee mb-2">
                        <button type="button" name="filter" id="filter" class="btn btn-info" style="background: #38587d;">Filter</button>
                        {{-- <button type="button" name="reset" id="reset" class="btn btn-default" style="color: white;border-color: white">Reset</button> --}}
                      </span>

<!-- SEARCH PORTION ENDS -->

                    </div>
                  </div>



                  </div>
@php
//  $total_time = \DB::table('dtb_daily_report as r')->where('user_id',session()->get('user_id'))->sum(DB::raw("TIME_TO_SEC(r.working_time)"));
// echo $hours = floor($total_time / 3600);
@endphp
                 
     

                </div>

                <div style="clear: both;"></div>

                <div class="errorholder">
                        @if(session()->has('message'))
                        <div class="alert alert-success mb-0 background-success p-2 mt-4" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @endif
                </div>

              </div>

              <div class="col-md-1">
              </div>
           </div>
          

          <div class="row mt-4">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding: 0 !important">


                  <div id="mnthlyhourshow">
                  <span>
                    Total working hour(s) of selected month is : 
                    @php
                        $total_time = \DB::table('dtb_daily_report as r')->whereRaw("r.developer_group_id = 0 AND r.date Like '%2020-02%'")->sum(DB::raw("TIME_TO_SEC(r.working_time)"));
                        echo  $hours = " <strong>".floor($total_time / 3600)."</strong> hr" . "   " . "<strong>". gmdate("i", $total_time % 3600)."</strong> mnts";
                    @endphp
                  </span>

                  </div><br>


                  <div class="issuestblarea" style="min-height: 200px;">
                       <div class="table-responsive">
                        <table id="reportmanagetbl" class="table table-bordered display">
                          <thead>
                              <tr>
                                  {{-- <th></th> --}}
                                  <th>Date </th>
                                  <th>Today's work</th>
                                  <th style="width: 33px">Work Start Time</th>
                                  <th>Work End Time</th>
                                  <th>Total Work Time</th>
                                  <th>Tomorrow's work</th>
                                  <th>Notice </th>
                                  <th>User</th>
                                  <th>Updated at</th>
                              </tr>
                          </thead>
                        </table>
                     </div>
                  </div>


<script src="https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js"></script>
<style>
  table#reportmanagetbl {
    border: 1px solid #8080801a;
}#reportmanagetbl th:first-child {
  width: 2% !important;
}
#reportmanagetbl th:nth-child(2) {
  width: 20% !important;
}
#reportmanagetbl thead th:nth-child(3) {
  width: 20% !important;
}#reportmanagetbl thead th:nth-child(4) {
  width: 20% !important;
}#reportmanagetbl thead th:nth-child(5) {
  width: 20% !important;
}#reportmanagetbl thead th:nth-child(6) {
  width: 20% !important;
}


div#mnthlyhourshow span {
    border-left: 4px solid #718aa8;
    float: left;
    padding: 4px 7px;
    margin-bottom: 25px;
    margin-top: -10px;
    /* color: black; */
    /* color: white; */
    background: #38587d12;
    border-radius: 0px;
    font-size: 15px;
}
</style>
<script>
         $(document).ready(function(){ 



            $('#filter').click(function(){

                var monthlist = $('#monthlist').val();
                var user = $('#user').val();
                var team = $('#team').val();

                if(monthlist != '' ||  user != '' || team != '' )
                {
                  $('#reportmanagetbl').DataTable().destroy();
                    fill_datatable(monthlist,user,team);
                }
                else
                {
                    alert('Select filter option');
                }



//get total hour of month start

           $.ajax({
                url: '{{ route('monthlyreporthour') }}',
                type: 'GET',
                data: {
                  monthlist:monthlist, user:user
                },
                success: function(response){
                   if (response) {
                      $("#mnthlyhourshow").html("<span>Total working hour(s) of selected month is :" + response+"</span>");
                    }
                },
                error: function() {
                  alert('Error occurs!');
               }
            });

//get total hour of month ends



            });




            fill_datatable();
            
            function fill_datatable(monthlist = '', user = '' ,team = '')
            {



                var dataTable = $('#reportmanagetbl').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url: "{{ route('reportsearch') }}",
                        data:{monthlist:monthlist, user:user,team:team},
                        "dataSrc": function ( json ) {
                            return json.data;
                          } 
                    },
                            columnDefs: [
                              {
                                  targets: [ 0, 1, 2 ],
                                  className: 'mdl-data-table__cell--non-numeric'
                              }
                          ],
                    columns: [
                     // { data: 'id', name: 'id', render:function(data, type, row){
                     //        return "<a href='"+ row.id +"'>" + row.id + "</a>"
                     //    }},
                    { data: 'date', name: 'date', render:function(data, type, row){
                            return "<a href='report/"+ row.id +"'>" + row.date + "</a>"
                        }},
                        {
                            data:'todays',
                            name:'todays', render:function(data, type, row){
                            return "<a id='todaysinfo' href='report/"+ row.id +"'>" +   
                            row.todays   
                                        // <?php 
                                        //     $parser = new \cebe\markdown\GithubMarkdown();
                                        //     $parser->html5 = true;
                                        //     $parser->enableNewlines = true;
                                        //     $parser->keepListStartNumber = true;
                                        //     $parser->parse("<script type=\"text/javascript\"> row.todays</script>");
                                        // ?> 
                        + "</a>"
                        }},

                        {
                            data:'working_start_time',
                            name:'working_start_time', render:function(data, type, row){
                            return "<a href='report/"+ row.id +"'>" + row.working_start_time + "</a>"
                        }},

                        {
                            data:'working_end_time',
                            name:'working_end_time', render:function(data, type, row){
                            return "<a href='report/"+ row.id +"'>" + row.working_end_time + "</a>"
                        }},
                        {
                            data:'working_time',
                            name:'working_time', render:function(data, type, row){
                            return "<a href='report/"+ row.id +"'>" + row.working_time + "</a>"
                        }},

                        {
                            data:'tomorrows',
                            name:'tomorrows', render:function(data, type, row){
                            return "<a href='report/"+ row.id +"'>" + row.tomorrows + "</a>"
                        }},

                        {
                            data:'notice',
                            name:'notice', render:function(data, type, row){
                            return "<a href='report/"+ row.id +"'>" + row.notice + "</a>"
                        }},
                        {
                            data:'user_id',
                            name:'user_id', render:function(data, type, row){
                            return "<a href='report/"+ row.id +"'>" + row.username + "</a>"
                        }
                        },
                        { data: 'updated_at', name: 'updated_at', render:function(data, type, row){
                            return "<a href='report/"+ row.id +"'>" + row.updated_at + "</a>"
                        }},
                        // {
                        //     data:'nextkcikstatusid',
                        //     name:'nextkcikstatusid',
                        //     visible : false
                        // },
                        // {
                        //     data:'nextissueassigneeid',
                        //     name:'nextissueassigneeid',
                        //     visible : false
                        // }
                    ]
                });


            }


});

</script>


            </div>
            <div class="col-md-1"></div>
          </div>


        </div>
     </div>
  </div>


<style>

</style>
  <!-- <script src="{{asset('assets_/vendor/libs/dropzone/dropzone.js')}}"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.0/showdown.min.js"></script> -->
  <script src="{{asset('/assets/js/marked.min.js')}}"></script>
  <script src="{{asset('/assets/js/showdown.min.js')}}"></script>

  <script type="text/javascript">

  $( document ).ready(function() {


//get month dropdown on change selector
      
      $('body').on('change','#monthlist',function(e){

          e.preventDefault();

          let monthid = $(this).val();

          $("#monthnameholder").text(monthid);

          gettingreportlist(monthid);

          function gettingreportlist(monthid) {

            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });


            $.ajax({
                url: '{{ url('/reportlist') }}',
                type: 'GET',
                data: {
                  monthid:monthid,
                },
                success: function(response){
                   if (response) {
                      $("#results").html(response);
                    }
                },
                error: function() {
                  alert('Error occurs!');
               }
            });
          }
 


      });
      
      // $("#monthnameholder").text(<?php //echo $currentmonth; ?>);





  });

  </script>
  @endsection

