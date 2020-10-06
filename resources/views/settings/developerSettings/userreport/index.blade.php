  @extends('master_main')
  @section('mainContent')

  <div class="mt-5">

     <div class="card-datatable" style="margin-top: 0px; padding: 0px;">
        <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">


           <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8" style="padding: 0px 12px !important; border-bottom: 1px solid #babbbc6b;padding-bottom: 23px !important;">

                <div class="screentgrpbtnholder">
                  
                  <div class="" style="float: left;">
                     <div class="monthholder" style="width: 350px">
                      <select name="reportmonth" id="monthlist" class="custom-select">
                        <option value="">Select Month</option>
                        <?php   
                          for ($i = 12; $i >= 0; $i--) { ?>
                          <option value="<?php  echo $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>"> <?php  echo $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                          </option>
                        <?php } ?>
                      </select>


                     </div>

                  </div>

                  <a href="{{route('reportcreate')}}" class="btn btn-success btn-sm  dtb_custom_btn_default" style="float: right;" >Add New Report</a> 

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

              <div class="col-md-2">
              </div>
           </div>



          <div class="row mt-4">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="ui-timeline ui-timeline-with-info">
                  <div class="ui-timeline-separator text-big">
                    <div class="ui-timeline-track-bg d-inline-block rounded text-white small font-weight-semibold py-1 px-2 mb-3" style="background: #38587d !important;width: 115px;text-align: center;"><span id="monthnameholder"><?php echo date("Y-m", strtotime( date( 'Y-m-01' ))); ?></span></div>
                  </div>

                  <div id="results">

                    @php 
                      $currentmonth = date("Y-m", strtotime( date( 'Y-m-01' )));
                      $getroportlist = DB::table('dtb_daily_report')
                      ->where('user_id',session()->get('user_id'))
                      ->where('date', 'like', '%' . $currentmonth . '%')
                      ->select('*')
                      ->get();
                    @endphp


                    <?php if (isset($getroportlist)) {?>
                    
                      @foreach($getroportlist as $getroportlists)
                          <div class="ui-timeline-item">
                           <a href="{{route('report.show', [$getroportlists->id])}}" class="text-body" style="color: #718AA8 !important">
                            <div class="ui-timeline-info text-right small font-weight-semibold">
                              {{-- {{ $getroportlists->date ? : '' }} --}}
                              <?php echo substr_replace($getroportlists->date ,"",-8) ?>
                            </div>
                            <div class="ui-timeline-badge ui-w-40">
                              <div class="ui-square bg-success rounded-circle text-white" style="background: #718AA8 !important">
                                <div class="d-flex ui-square-content">
                                  <div class="ion ion-md-list-box m-auto"></div>
                                </div>
                              </div>
                            </div>
                            <div class="card card-condenced">
                              <div class="card-body py-2">
                                <div class="text-big font-weight-bold mb-2">
                                  <span class="text-body" style="color: #718AA8 !important">Work Report</span>
                                </div>
                                <div class="text-muted">
                                  Click here to see details
                                </div>
                              </div>
                            </div>
                          </a>
                          </div>
                      
                      @endforeach

                    <?php } ?>





                  {{-- <div class="ui-timeline-item">
                   <a href="#" class="text-body" style="color: #718AA8 !important">
                    <div class="ui-timeline-info text-right small font-weight-semibold">
                      02/04/2020
                    </div>
                    <div class="ui-timeline-badge ui-w-40">
                      <div class="ui-square bg-success rounded-circle text-white" style="background: #718AA8 !important">
                        <div class="d-flex ui-square-content">
                          <div class="ion ion-md-list-box m-auto"></div>
                        </div>
                      </div>
                    </div>
                    <div class="card card-condenced">
                      <div class="card-body py-2">
                        <div class="text-big font-weight-bold mb-2">
                          <span class="text-body" style="color: #718AA8 !important">Work Report</span>
                        </div>
                        <div class="text-muted">
                          Click here to see details
                        </div>
                      </div>
                    </div>
                  </a>
                  </div> --}}

                  </div>


                </div>
            </div>
            <div class="col-md-2"></div>
          </div>






        </div>
     </div>
  </div>


<style>
  .notfoundmsg{
    background: white;
    padding: 2px 7px;
    border: 1px solid #00000017;
    border-radius: 2px;
  }
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

