@extends('master')
@section('mainContent')
<div class="page-content-wrapper">
<!--Main Content-->
  <div class="sm-gutter">
    <div class="container-fluid padding-25 sm-padding-10">
      <div class="row">
        <div class="col-md-12 mb-4"><a href="{{route('coach.index')}}" class="btn btn-primary btn-sm">Go Back</a></div>
        <div class="col-lg-12"> 
          @if(session()->has('message-success'))
          <div class="alert alert-success mb-10 background-success" role="alert">
            {{ session()->get('message-success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        </div>

        <div class="col-12">
          <div class="block-heading d-flex align-items-center title-pages">
            <h5 class="text-truncate">Coach Detail</h5>
          </div>
        </div>

        <div class="col-md-12">
          <div class="block">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3 nav flex-column nav-pills sidebar_tabs" id="v-pills-tab" aria-orientation="vertical">
                  <a class="nav-link active" href="#v-pills-client-data" data-toggle="pill">Coach Data</a>
                  <a class="nav-link" href="#v-pills-coaching" data-toggle="pill">Customers</a>
                  <a class="nav-link" href="#v-pills-membership" data-toggle="pill">Memberships</a>
                  <a class="nav-link" href="#v-pills-files" data-toggle="pill">Latest Activities</a>
                  <a class="nav-link" href="#v-pills-notes" data-toggle="pill">Notes</a>
                </div>

                <!-- tabs -->
                <div class="col-md-9 p-0 tab-content" id="v-pills-tabContent">
                  <!-- single tab start -->
                  <div class="tab-pane fade show active client_data_tab" id="v-pills-client-data">
                    <div class="row">
                      <div class="col-md-4 left_side">
                        <div class="image">
                         @if(isset($details->icon_image_path))
                         <img src="{{asset($details->icon_image_path)}}">  
                         @else
                         <img src="{{asset('assets_new/images/walk.png')}}">
                         @endif
                       </div>
                       <a href="{{route('coach.edit', $details->id)}}" class="btn btn-success">Edit Details</a>

                      <!--  <a href="{{url('delete_customer_view/'. $details->id)}}" title="Are You sure to Unsubscripe ?" data-modal-size="modal-md" class="modalLink btn btn-danger">
                         New Task
                       </a> -->

                        <a  title="Are You sure to Unsubscripe ?" data-modal-size="modal-md" class="btn btn-danger">
                         New Task
                       </a>

                       <a href="{{url('change_to_customer_view/'. $details->id)}}" title="Change To Customer" data-modal-size="modal-md" class="modalLink btn btn-warning">
                         Change To Customer
                       </a>

                     </div>


                     <div class="col-md-8 right_side">
                      <div class="row">
                        <div class="col-md-6">
                          <label>Member ID:</label>
                          <span>
                            @if(isset($details))
                            {{$details->id}}
                            @endif
                          </span>
                        </div>

                        <div class="col-md-6">
                          <label>First name:</label>
                          <span>
                            @if(isset($details))
                            {{$details->first_name}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label>Last name:</label>
                          <span>
                            @if(isset($details))
                            {{$details->last_name}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label>Gender: </label>
                          <span>
                            @if(isset($details))
                            {{$details->gender}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label>Birthday: </label>
                          <span>
                            @if(isset($details))
                            {{date('m-d-Y', strtotime($details->birth_of_date))}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label>Email address: </label>
                          <span>
                            @if(isset($details))
                            {{$details->email}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label>Mobile phone:</label>
                          <span>
                            @if(isset($details))
                            {{$details->id}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-12 mt-4 mb-3"><h3>Address data</h3></div>
                        <div class="col-md-6">
                          <label>Street address:</label>
                          <span>
                            @if(isset($details))
                            {{$details->current_address}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label>ZIP code:</label>
                          <span>
                            @if(isset($details))
                            {{$details->zipcode}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label>City:</label>
                          <span>
                            @if(isset($details))
                            {{$details->city}}
                            @endif
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label>Country:</label>
                          <span>
                            @if(isset($details))
                            {{$details->country}}
                            @endif
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>           
                </div>
                <!-- single tab end -->

                <!-- single tab start -->
                <div class="tab-pane fade client_data_tab" id="v-pills-coaching">
                  <div class="row">
                                        <div class="col-md-12 mb-3"><h3>All Customers</h3></div>
                                        <div class="table-responsive">
                                          <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
                                              <thead>
                                                  <tr>
                                                      <th>Id</th>
                                                      <th>Image</th>
                                                      <th>First Name</th>
                                                      <th>Last Name</th>
                                                      <th>Ends On</th>
                                                      <th>Last Online</th>
                                                      <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>1</td>
                                                      <td width="40px" align="center"><img src="../images/workout_1519950433.jpg" style="width: 40px; height: 40px; padding: 2px;"></td>
                                                      <td>Ravinder</td>
                                                      <td>Singh</td>
                                                      <td>15-04-2020</td>
                                                      <td>09-04-2020 00:23:03</td>
                                                      <td><a href="customer-detail.php" class="btn btn-primary">View Detail</a></td>
                                                  </tr>
                                                  <tr>
                                                      <td>2</td>
                                                      <td width="40px" align="center"><img src="../images/workout_1519950433.jpg" style="width: 40px; height: 40px; padding: 2px;"></td>
                                                      <td>Ravinder</td>
                                                      <td>Singh</td>
                                                      <td>15-04-2020</td>
                                                      <td>09-04-2020 00:23:03</td>
                                                      <td><a href="customer-detail.php" class="btn btn-primary">View Detail</a></td>
                                                  </tr>
                                                  <tr>
                                                      <td>3</td>
                                                      <td width="40px" align="center"><img src="../images/workout_1519950433.jpg" style="width: 40px; height: 40px; padding: 2px;"></td>
                                                      <td>Ravinder</td>
                                                      <td>Singh</td>
                                                      <td>15-04-2020</td>
                                                      <td>09-04-2020 00:23:03</td>
                                                      <td><a href="customer-detail.php" class="btn btn-primary">View Detail</a></td>
                                                  </tr>
                                                  <tr>
                                                      <td>4</td>
                                                      <td width="40px" align="center"><img src="../images/workout_1519950433.jpg" style="width: 40px; height: 40px; padding: 2px;"></td>
                                                      <td>Ravinder</td>
                                                      <td>Singh</td>
                                                      <td>15-04-2020</td>
                                                      <td>09-04-2020 00:23:03</td>
                                                      <td><a href="customer-detail.php" class="btn btn-primary">View Detail</a></td>
                                                  </tr>
                                                  <tr>
                                                      <td>5</td>
                                                      <td width="40px" align="center"><img src="../images/workout_1519950433.jpg" style="width: 40px; height: 40px; padding: 2px;"></td>
                                                      <td>Ravinder</td>
                                                      <td>Singh</td>
                                                      <td>15-04-2020</td>
                                                      <td>09-04-2020 00:23:03</td>
                                                      <td><a href="customer-detail.php" class="btn btn-primary">View Detail</a></td>
                                                  </tr>
                                                  <tr>
                                                      <td>6</td>
                                                      <td width="40px" align="center"><img src="../images/workout_1519950433.jpg" style="width: 40px; height: 40px; padding: 2px;"></td>
                                                      <td>Ravinder</td>
                                                      <td>Singh</td>
                                                      <td>15-04-2020</td>
                                                      <td>09-04-2020 00:23:03</td>
                                                      <td><a href="customer-detail.php" class="btn btn-primary">View Detail</a></td>
                                                  </tr>
                                                  <tr>
                                                      <td>7</td>
                                                      <td width="40px" align="center"><img src="../images/workout_1519950433.jpg" style="width: 40px; height: 40px; padding: 2px;"></td>
                                                      <td>Ravinder</td>
                                                      <td>Singh</td>
                                                      <td>15-04-2020</td>
                                                      <td>09-04-2020 00:23:03</td>
                                                      <td><a href="customer-detail.php" class="btn btn-primary">View Detail</a></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                      </div>
                </div>
                <!-- single tab end -->

                <!-- single tab start -->
                <div class="tab-pane fade client_data_tab" id="v-pills-membership">
                  <div class="row">
                    <div class="col-md-12 package_details">
                      <div class="inside">
                        <div class="title"><h4>Premium (Monthly)</h4></div>
                        <div class="price">$4.99/Per Month</div>
                        <div class="availiblity">
                          <ul>
                            <li>7-Day Free Trial</li>
                            <li>Premium Class Access </li>
                            <li>Join The WF Community </li>
                            <li>New Content Every Week</li>
                            <li>Access To Premium Recipes </li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 mt-2">
                      <p id="demo"></p>
                      <div class="expiry_date">Expiry Date: 23/05/2020</div>
                    </div>
                  </div>
                </div>
                <!-- single tab end -->

                <!-- single tab start -->
                <div class="tab-pane fade client_data_tab" id="v-pills-files">
                 <div class="row">
                                          <div class="col-md-6 mb-3"><h3>Latest Activitiesss</h3></div>
                                          <div class="col-md-12 mt-3 all_activity_list">
                                            <ul>
                                              <li>
                                                  <div class="left">
                                                    <div class="image"><img src="{{asset('assets_new/images/avatar.jpg')}}"></div>
                                                    <div class="text">
                                                      <p>Bridget Higgins stepsburned 32 calories with steps</p>
                                                      <div class="like active"><small>2 days ago</small> <span class="dripicons-thumbs-up">1</span></div>
                                                    </div>
                                                  </div>
                                                  <div class="right"><a href="#"><img src="{{asset('assets_new/images/exercise_1519884492.jpg')}}"></a></div>
                                              </li>
                                            
                                               <li>
                                                  <div class="left">
                                                    <div class="image"><img src="{{asset('assets_new/images/avatar.jpg')}}"></div>
                                                    <div class="text">
                                                      <p>Bridget Higgins stepsburned 32 calories with steps</p>
                                                      <div class="like active"><small>2 days ago</small> <span class="dripicons-thumbs-up">1</span></div>
                                                    </div>
                                                  </div>
                                                  <div class="right"><a href="#"><img src="{{asset('assets_new/images/exercise_1519884492.jpg')}}"></a></div>
                                              </li>
                                               <li>
                                                  <div class="left">
                                                    <div class="image"><img src="{{asset('assets_new/images/avatar.jpg')}}"></div>
                                                    <div class="text">
                                                      <p>Bridget Higgins stepsburned 32 calories with steps</p>
                                                      <div class="like active"><small>2 days ago</small> <span class="dripicons-thumbs-up">1</span></div>
                                                    </div>
                                                  </div>
                                                  <div class="right"><a href="#"><img src="{{asset('assets_new/images/exercise_1519884492.jpg')}}"></a></div>
                                              </li>
                                               <li>
                                                  <div class="left">
                                                    <div class="image"><img src="{{asset('assets_new/images/avatar.jpg')}}"></div>
                                                    <div class="text">
                                                      <p>Bridget Higgins stepsburned 32 calories with steps</p>
                                                      <div class="like active"><small>2 days ago</small> <span class="dripicons-thumbs-up">1</span></div>
                                                    </div>
                                                  </div>
                                                  <div class="right"><a href="#"><img src="{{asset('assets_new/images/exercise_1519884492.jpg')}}"></a></div>
                                              </li>
                                            </ul>
                                          </div>
                                        </div>
              </div>
              <!-- single tab end -->

              <!-- single tab start -->
              <div class="tab-pane fade client_data_tab" id="v-pills-notes">
                <div class="row col-lg-12">
                  <div class="col-lg-12 alert alert-success mb-10 background-success notes_success" role="alert">
                   Successfully Added
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="row">

                  

                  @if(isset($editNotesData))
                  {{ Form::open(['class' => 'note_wrapper', 'files' => true, 'url' => 'coach/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                  @else
                  {{ Form::open(['class' => 'form-horizontal note_wrapper', 'files' => true, 'url' => 'add_note_c',
                  'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                  @endif

                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">

                  <div class="col-md-12 mb-3"><h3>Add New Note</h3></div>

                  <div class="col-md-12 col-lg-12 mb-3">
                    <textarea style="width: 100%;" class="col-lg-12" id="message" name="note" placeholder=" Keep your Note Here" required="required"></textarea>
                  </div>
                  <input type="hidden" name="user_id" id="" value="{{$details->id}}">

                  <div class="col-md-12 save mb-5">
                    <button type="submit" class="btn btn-success save_note_data">Save</button>
                  </div>
                  {{ Form::close()}}

                  <div class="col-md-12 mb-2"><h3>Overview</h3></div>

                  <div class="col-md-12 all_notes">
                    @include('coach.all_notes')
                  </div>
                </div>
              </div>
              <!-- single tab end -->
            </div>
            <!-- end tabs -->
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
</div>
<script type="text/javascript">

  $(".save_note_data").click(function(e){
    e.preventDefault();
    $('.loader_class').show();
    form_data = $(".note_wrapper").serialize();
    var url = $("#url").val();

    $.ajax({
      type: "POST",
      data: form_data,
      url: url+"/add_note_c",
      success: function(data) {
        $('.notes_success').show();
        // $("#allUserstbody").empty();
        $(".all_notes").html(data);
        $("#message").val('');
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {}
    });

  });




</script>

@endsection