@extends('master')
@section('mainContent')
<div class="page-content-wrapper">
<!--Main Content-->
  <div class="sm-gutter">
    <div class="container-fluid padding-25 sm-padding-10">
      <div class="row">
        <div class="col-md-12 mb-4"><a href="{{route('customer.index')}}" class="btn btn-primary btn-sm">Go Back</a></div>
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
            <h5 class="text-truncate">Customer Detail</h5>
          </div>
        </div>

        <div class="col-md-12">
          <div class="block">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3 nav flex-column nav-pills sidebar_tabs" id="v-pills-tab" aria-orientation="vertical">
                  <a class="nav-link active" href="#v-pills-client-data" data-toggle="pill">Customer Data</a>
                  <a class="nav-link" href="#v-pills-coaching" data-toggle="pill">Coaching</a>
                  <a class="nav-link" href="#v-pills-membership" data-toggle="pill">Memberships</a>
                  <a class="nav-link" href="#v-pills-files" data-toggle="pill">Files</a>
                  <a class="nav-link" href="#v-pills-notes" data-toggle="pill">Notes</a>
                </div>

                <!-- tabs -->
                <div class="col-md-9 p-0 tab-content" id="v-pills-tabContent">
                  <!-- single tab start -->
                  <div class="tab-pane fade show active client_data_tab" id="v-pills-client-data">
                    <div class="row">
                      <div class="col-md-4 left_side">
                        <div class="image">
                         @if(isset($details->icon_image_path) && !empty($details->icon_image_path))
                         <img src="{{asset($details->icon_image_path)}}">  
                         @else
                         <img src="{{asset('assets_new/images/No-avatar.png')}}">
                         @endif
                       </div>
                       <a href="{{route('customer.edit', $details->id)}}" class="btn btn-success mt-2 pt-2">Edit Details</a>

                       <!-- <a href="{{url('delete_customer_view/'. $details->id)}}" title="Are You sure to Unsubscripe ?" data-modal-size="modal-md" class="modalLink btn btn-danger">
                         Unsubscribe
                       </a> -->

                       <!-- <a href="{{url('change_to_staff_view/'. $details->id)}}" title="Change Staff" data-modal-size="modal-md" class="modalLink btn btn-warning">
                         Change To Staff
                       </a> -->

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
                    <div class="col-md-12 mb-3"><h3>Intake</h3></div>
                    <div class="col-md-6 mb-3">
                      <label>Forms</label>
                      <span>Mandatory Intake Questionnaire <input type="checkbox"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Main goal</label>
                      <select class="form-control">
                        <option value="" selected="">-</option>
                        <option value="shape">Lose Weight</option>
                        <option value="power">Build Muscle</option>
                        <option value="vitality">Improve well-being</option>
                        <option value="performance">Improve Performance</option>
                        <option value="rehab">Rehabilitation</option>
                        <option value="fit">Get Fit</option>
                        <option value="tone">Shape and Tone</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Level</label>
                      <select class="form-control">
                        <option value="">-</option>
                        <option value="novice" id="novice">Novice</option>
                        <option value="beginner" id="beginner">Beginner</option>
                        <option value="intermediate" id="intermediate">Intermediate</option>
                        <option value="advanced" id="advanced">Advanced</option>
                        <option value="expert" id="expert">Expert</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>More Information </label>
                      <div class="d-flex"><input type="text" class="form-control"><button class="btn btn-success">Save</button></div>
                    </div>

                    <div class="col-md-12 mt-4 mb-3"><h3>Medical</h3></div>
                    <div class="col-md-6 mb-3">
                      <label>Injuries</label>
                      <select multiple="multiple" class="my-select form-control mt-2" placeholder="Select a tag" name="bodypart_id[]" required>
                        <option value="">-</option>
                        <option value="ankle">Ankle</option>
                        <option value="combination">Combination</option>
                        <option value="core">Core</option>
                        <option value="elbow">Elbow</option>
                        <option value="fingers">Fingers</option>
                        <option value="hip">Hip</option>
                        <option value="knee">Knee</option>
                        <option value="neck">Neck</option>
                        <option value="shoulder">Shoulder</option>
                        <option value="spine">Spine</option>
                        <option value="wrist">Wrist</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>More Information </label>
                      <div class="d-flex"><input type="text" class="form-control"><button class="btn btn-success">Save</button></div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Chronic diseases </label>
                      <select multiple="multiple" class="my-select form-control mt-2" placeholder="Select a tag" name="bodypart_id[]" required>
                        <option value="">-</option>
                        <option value="burnout">Burnout / Overworked</option>
                        <option value="cfs">CFS (chronic fatigue syndrome)</option>
                        <option value="cancer">Cancer</option>
                        <option value="cardiovascular">Cardiovascular diseases</option>
                        <option value="lungs">Chronic afflictions of lungs and airways (COPD and asthma)</option>
                        <option value="back-shoulder-neck">Chronic back, shoulder, and neck disorders</option>
                        <option value="diabetes">Diabetes mellitus type 2</option>
                        <option value="fibromyalgia">Fibromyalgia</option>
                        <option value="insulin_resistance">Insulin resistance</option>
                        <option value="metabolic_syndrome">Metabolic syndrome</option>
                        <option value="msd">Musculoskeletal disorders (MSDs)</option>
                        <option value="osteoarthritis">Osteoarthritis</option>
                        <option value="osteoporosis">Osteoporosis</option>
                        <option value="obesity">Overweight and/or Obesitas</option>
                        <option value="arthritis">Rheumatoid arthritis</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>More Information </label>
                      <div class="d-flex"><input type="text" class="form-control"><button class="btn btn-success">Save</button></div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Emergency Contact </label>
                      <div class="d-flex"><input type="text" class="form-control"><button class="btn btn-success">Save</button></div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Emergency Phone </label>
                      <div class="d-flex"><input type="text" class="form-control"><button class="btn btn-success">Save</button></div>
                    </div>

                    <div class="col-md-12 mt-4 mb-3"><h3>Program</h3></div>
                    <div class="col-md-4 mb-3">
                      <label>Training Plan: </label>
                      <span>Demo</span>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>Start date: </label>
                      <span>10/5/2019</span>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>End date: </label>
                      <span>15/1/2020</span>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>Nutrition Plan: </label>
                      <span>Demo</span>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>Start date: </label>
                      <span>10/5/2019</span>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>Goal: </label>
                      <span>Demo</span>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>Goal date: </label>
                      <span>15/1/2020</span>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label>Challenges: </label>
                      <span>Demo</span>
                    </div>

                    <div class="col-md-12 mt-4 mb-3"><h3>Coaches</h3></div>
                    <div class="col-md-6 mb-3">
                      <label>Account Manager:</label>
                      <select class="form-control">
                        <option value="0">-</option>
                        <option value="18247299">Bridget Higgins</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Coach:</label>
                      <select  multiple="multiple" class="my-select form-control mt-2" placeholder="Select a tag" name="bodypart_id[]" required>
                        <option>All</option>
                        <option>Bridget Higgins</option>
                      </select>
                    </div>

                   <!--  <div class="col-md-12 mt-4 mb-3"><h3>Bookings</h3></div>
                    <div class="col-md-4 mb-3">
                      <label>Filter By: </label>
                      <select class="form-control">
                        <option value="0">None</option>
                        <option value="-1 month" selected="selected">Past month</option>
                        <option value="-3 months">Past 3 months</option>
                        <option value="-6 months">Past 6 months</option>
                        <option value="-1 year">Past year</option>
                        <option value="">All</option>
                      </select>
                    </div>

                    <div class="table-responsive">
                      <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
                        <thead>
                          <tr>
                            <th>Sr. No.</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Demo</td>
                            <td>Demo</td>
                            <td>Demo</td>
                            <td>Demo</td>
                          </tr>
                        </tbody>
                      </table>
                    </div> -->
                  </div>
                </div>
                <!-- single tab end -->

                <!-- single tab start -->
                <div class="tab-pane fade client_data_tab" id="v-pills-membership">
                  @if(!empty($details->plan_type))
                  <div class="row">
                    <div class="col-md-12 package_details">
                      <div class="inside">
                        <div class="title"><h4>{{$usersPlan->package_name}}</h4></div>
                        <div class="price">${{$usersPlan->package_value}}/{{$usersPlan->timeframe}}</div>
                        <div class="availiblity">
                         <ul>
                                                @if(isset($allMemberShipFeatures))
                                                @foreach($allMemberShipFeatures as $value)
                                                <li>{{$value->feature_name}}</li>
                                                @endforeach
                                                @endif
                                            </ul>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 mt-2">
                      <p id="demo"></p>
                     <!--  <div class="expiry_date">Expiry Date: 23/05/2020</div> -->
                    </div>
                  </div>

                  @else
                  <div class="col-md-12 package_details">
                      <div class="inside">
                        <div class="title"><h4>This user yet No Membership Select</h4></div>
                       
                      </div>
                    </div>
                  @endif

                </div>
                <!-- single tab end -->

                <!-- single tab start -->
                <div class="tab-pane fade client_data_tab" id="v-pills-files">
                   <div class="col-lg-12 alert alert-success mb-10 background-success notes_success" role="alert">
                   Successfully Added
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="row col-lg-12">
                    <div class="col-md-12 mb-3"><h3> Upload New File</h3></div>
                     @if(isset($editNotesData))
                  {{ Form::open(['class' => 'files_wrapper', 'files' => true, 'url' => 'customer/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                  @else
                  {{ Form::open(['class' => 'form-horizontal files_wrapper', 'files' => true, 'url' => 'add_file',
                  'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                  @endif
                    <div class="col-md-12 mb-3">
                      <span>
                    <!--   <input type="file" name="files" class="form-control-file"> -->
                      <input type="file" name="files" class="" required="">
                  </span>

                      </div>
                      <input type="hidden" name="user_id_for_file" id="" value="{{$details->id}}">
                      <div class="col-md-12 save mb-5">
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                  {{ Form::close()}}
                  <div class="col-lg-12 mb-2"><h3>All Files</h3></div>
                    <div class="files_wrapper_data mt-3 col-lg-12">
                      @include('customers.all_files')
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
                  {{ Form::open(['class' => 'note_wrapper', 'files' => true, 'url' => '', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                  @else
                  {{ Form::open(['class' => 'form-horizontal note_wrapper', 'files' => true,
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
                    @include('customers.all_notes')
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
      url: url+"/add_note",
      success: function(data) {
        //alert(data);
        $('.notes_success').show();
        // $("#allUserstbody").empty();
        $(".all_notes").html(data);
        // $("#message").val('');
        var activeEditor = tinyMCE.get('message');
var content = 'HTML or plain text content here...';
activeEditor.setContent('');
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {}
    });

  });

</script>

<script type="text/javascript">

$('.files_wrapper').submit(function(event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    var url = $("#url").val();

    $.ajax({
      type: "POST",
      data: formData,
      url: url+"/add_file",
      cache:false,
      contentType: false,
      processData: false,
      success: function(data) {
        $('.files_success').show();
        // $("#allUserstbody").empty();
        $(".files_wrapper_data").html(data);
        var fileopen = $(".files"),
        clone = fileopen.clone(true);
        fileopen.replaceWith(clone);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {}
    });

  });

</script>

@endsection