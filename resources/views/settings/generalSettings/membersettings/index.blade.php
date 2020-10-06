    @extends('master')
    @section('mainContent')

    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <div class="card overflow-hidden">
          <div class="row no-gutters row-bordered row-border-light">


            <div class="col-md-2 pt-0">
              @include('settings.generalSettings.general_settings_sidebar')
            </div>


            <div class="col-md-10">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="account-general">

                  <div class="card-body media align-items-center pb-2">
                    <div class="media-body">
                      <h5>Add Member</h5>
                    </div>
                  </div>

                  <hr class="border-light m-0">

                  <div class="card-body">


                    <div class="pb-2 pt-1">


                     <div class="uikit-example">
                      <div class="card mb-1" style="background: #eff2f5;border: 1px solid #718aa89c;">
                        <div class="card-body">
                          <label><strong>Select User or Team for project</strong></label>


                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">

                                <div id="devlist"></div>
                                <span style="font-size: 13px;"><i style="font-size: 11px;" class="sidenav-icon ion ion-ios-bonfire"></i>Use cntrl button to select multiple.</span>

                                <div class="col-md-6">

                                </div>

                              </div>


                              <input type="button" name="teamadd" value="Add Selection to project" class="btn btn-success NoborderRadius" id="btnaddteam">
                            </div>




                            <div class="col-md-6">
                              <div class="form-group">
                                <div id="teamlist"></div>
                              </div>

                              <input type="button" name="teamadd" value="Add " class="btn btn-success pull-right NoborderRadius" style="background: #718aa8; color: #fff;font-size:13px;padding: 2px 35px;" id="btndaddteams">

                            </div>

                          </div>


                        </div>
                      </div>
                    </div>   

                    <div class="scrollbar" id="style-6">
                      <div class="force-overflow"></div>
                    </div>


                    <div class="uikit-example mt-2">
                      <div class="card mb-1" style="background: #eff2f5;border: 1px solid #718aa89c;">
                        <div class="card-body">


                          <div class="teamcontainer">

                           <label class="mb-4"><strong>Project's Users</strong></label>

                           <table class="table table-bordered table-striped " style="background: white" id="membertbl">

                            <thead>
                              <tr>
                                <th style="width: 13.6px;"></th>
                                <th>Members</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined At</th>
                                <th style="width: 13.6px;">Action</th>
                              </tr>
                            </thead>
                            <tbody id="tablecontents">
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
      </div>
    </div>
  </div>
  <div class="col-lg-2"></div>
</div>


<script type="text/javascript">
  $( document ).ready(function() {

  // teams portion


  getteams();
  function getteams() {
    $.ajax({
      type: "GET",
      url: "member/team",
      success: function (data) { 

        if (data == "") {
          var html='<select id="teamsselection" class="user-edit-multiselect form-control w-100" name="projectteams">';
          html += '<option value=""> No team available. </option>'

          html += '</select>';
          $('#teamlist').html(html);
        }else{

          var html='';
          var html='<select id="teamsselection" class="user-edit-multiselect form-control w-100" name="projectteams">';
          html += '<option value=""> Select Team to add </option>'
          data.forEach(function(teamsdata){
            html += '<option value="'+teamsdata.teamtblid+'">' + teamsdata.team_name + ' (' + teamsdata.total + ' member left to add)' + '</option>'
          })
          html += '</select>';
          $('#teamlist').html(html);
        }


      }
    });
  }



  $('body').on('click','#btndaddteams',function(e){

    e.preventDefault();
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    var selectedteam = $('#teamsselection').val();

    //var url = '{{ url("priority") }}';
    var proid = <?php echo $id; ?>;



    $.ajax({
      url: 'member/addteam',
      type: 'POST',
      data:{selectedteam:selectedteam,projectid:proid},

      success: function(data){     
       getteams();
       getdevs();
       getRecords();
       $.iaoAlert({msg: "Member added",
        type: "success",
        mode: "dark",});

     },
     error: function (request, status, error) {
      $.iaoAlert({msg: "Something went wrong",
        type: "warning",
        mode: "dark",})


    }



  });


  });



  // team portion end





  getdevs();
  function getdevs() {
    $.ajax({
      type: "GET",
      url: "member/list",
      success: function (data) { 
                        // <select id="memberselection" class="user-edit-multiselect form-control w-100" multiple name="projectdevs[]">
                        var html='';
                        var html='<select id="memberselection" class="user-edit-multiselect form-control w-100" multiple name="projectdevs[]">';
                        data.forEach(function(devs){
                          // html += '<option></option>'
                          html += '<option value="'+devs.id+'">' + devs.name + '</option>'

                        })
                        html += '</select>';
                        $('#devlist').html(html)



                      }
                    });
  }


  function getRecords() {
    $.ajax({
      type: "GET",
      url: "member/data",
      success: function (data) { 

        var html='';
        data.forEach(function(row){

          if(row.is_archived === 1){var archive = ' (archived)';}else if(row.is_archived === 0){var archive = '';}

          html += '<tr>'
          html += '<td></td>'
          html += '<td>' + row.name  +  archive   + '</td>'
          html += '<td>' + row.email + '</td>'
          html += '<td>' + row.role + '</td>'
          html += '<td>' + row.created_at + '</td>'

          html += '<td>'

          html += '<a href="#" class="memberdelbtn" data="'+ row.id +'"><i class="far fa-trash-alt d-block"></i></a>'
          html += '</td> </tr>';
        })
        $('#membertbl tbody').html(html)

        getdevs();
        getteams();

      }
    });
  }
  getRecords();




  $('body').on('click','#btnaddteam',function(e){
    e.preventDefault();
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    var selectedmember = $('#memberselection').val();
    //var url = '{{ url("priority") }}';
    var proid = <?php echo $id; ?>;

    $.ajax({
      url: 'member',
      type: 'POST',
      data:{selectedmember:selectedmember,projectid:proid},

      success: function(data){

              //alert(data);
              getRecords();

                // $('#prioritymodal').modal('hide');
                // document.getElementById("priorityform").reset();

                $.iaoAlert({msg: "Member added",
                  type: "success",
                  mode: "dark",});

                //  setTimeout(function(){// wait for 5 secs(2)
                //   location.reload(); // then reload the page.(3)
                // }, 1000);
                getteams();


              },
              error: function (request, status, error) {
                $.iaoAlert({msg: "Something went wrong",
                  type: "warning",
                  mode: "dark",})


              }



            });


  });


  $('body').on('click','.memberdelbtn',function(e){

    e.preventDefault();
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });


    var memberlsitid = $(this).attr('data');

    $.ajax({
      url: 'member',
      type: 'DELETE',
      data:{memberlsitid:memberlsitid},

      success: function(data){
            //alert(data);
            getRecords();
            getteams();
            $.iaoAlert({msg: "Member Removed",
              type: "success",
              mode: "dark",});
          },
          error: function (request, status, error) {
            $.iaoAlert({msg: "Something went wrong",
              type: "warning",
              mode: "dark",})
          }



        });

  });

  $('#teamtbl').DataTable( {
    "order": [],
    ordering:false
  } );


  $('#membertbl').DataTable( {
    "order": [],
    ordering:false
  } );






});
</script>


@endsection