    @extends('master_main')
    @section('mainContent')

    <div class="row mt-5">

          <div class="col-md-1"></div>
          <div class="col-md-10 issue_wrapper ">

          <div class="card mb-4">
          <h6 class="card-header dtb_primary_bgcolor text-white" style="padding-bottom: 11px">
            Member info add
            <a href="{{route('managemember')}}" class="btn btn-sm btn-default NoborderRadius " style="color: #FFFFFF !important;float: right;border:1px solid white ;display: flex;font-size: 13px;">
              <i class="sidenav-icon ion ion-ios-people" style="font-size: 20px;"></i>
              <div>Member Manage</div>
            </a>
          </h6>
          <div class="card-body gap">


        <!-- Button trigger modal -->

                    @php 
                      $singlemember = DB::table('dtb_users')
                      ->join('mtb_languages', 'dtb_users.language_id', '=', 'mtb_languages.id')
                      ->select('dtb_users.id','dtb_users.email','dtb_users.name','dtb_users.icon_image_path','dtb_users.ud_id','dtb_users.english_name','dtb_users.role','dtb_users.country','mtb_languages.name as languagename','dtb_users.introduce','dtb_users.created_at','dtb_users.timezone_id','dtb_users.is_archived')->where('dtb_users.id', $memberid)->first();
                    @endphp
                    <?php if (isset($singlemember)) {?>

                      <!-- profile modal Modal -->
                      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          
                            <div class="modal-body" style="padding: 12px">
                            
                                <div class="twPc-div">
                                    <a class="twPc-bg twPc-block"></a>

                                  <div>
                                    
                                    <div class="twPc-button">
                                      <a href="#" style="color: white" class="rolbutton">
                                        <?php 
                                          if (isset($singlemember->role)) {
                                            if ($singlemember->role == 0) {
                                              echo "Admin";
                                            }elseif($singlemember->role == 1){
                                              echo "Super Admin";
                                            }elseif($singlemember->role == 2){
                                              echo "Viewer";
                                            }elseif($singlemember->role == 3){
                                              echo "Reporter";
                                            }elseif($singlemember->role == 4){
                                              echo "Guest";
                                            }
                                          }else{ ?>
                                            &nbsp;
                                         <?php } ?>
                                      </a>
                                    </div>

                                    <a href="#" class="twPc-avatarLink">
                                      @if(!empty($singlemember->icon_image_path))
                                          @php $image_path = url($singlemember->icon_image_path); @endphp
                                          <img src="//{{ $singlemember->icon_image_path }}" alt="" align="left" class="d-block ui-w-85  ">
                                          @else
                                          <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" align="left" class="d-block ui-w-85">
                                      @endif
                                    </a>

                                    <div class="twPc-divUser">

                                      <div class="twPc-divName">
                                        <a href="#">{{ $singlemember->name ?? '' }}</a> <span style="color: gray;font-size: 13px;margin-left: 4px;text-transform: uppercase;border-left: 2px solid gray;padding-left: 7px;border-color: #1e70cd;"> Id : {{ $singlemember->ud_id ?? '' }}</span>
                                      </div>
                                      <span style="margin-top: -4px;float: left;margin-bottom: 20px;">
                                        <a href="#" style="color: #000000a1"><span>{{ $singlemember->email ?? '' }}</span></a>
                                      </span>

                                     
                                    </div>
                                    <div class="twPc-divStats">
                                      <ul class="twPc-Arrange">
                                        <li class="twPc-ArrangeSizeFit">
                                         <span class="twPc-StatLabel">Country</span> <span class="twPc-StatValue">{{ $singlemember->country ?? 'not found' }}</span>
                                        </li>
                                      </ul>                                 

                                      <ul class="twPc-Arrange">
                                        <li class="twPc-ArrangeSizeFit">
                                         <span class="twPc-StatLabel">Language </span> <span class="twPc-StatValue">{{ $singlemember->languagename ?? 'not found' }}</span>
                                        </li>
                                      </ul> 


                                      <ul class="twPc-Arrange">
                                        <li class="twPc-ArrangeSizeFit">
                                         <span class="twPc-StatLabel">Introduce </span> <span class="twPc-StatValue">{{ $singlemember->introduce ?? 'not found' }}</span>
                                        </li>
                                      </ul> 

                                      <ul class="twPc-Arrange">
                                        <li class="twPc-ArrangeSizeFit">
                                         <span class="twPc-StatLabel">Enlisted at </span> <span class="twPc-StatValue">
                                          {{ date('F d, Y', strtotime($singlemember->created_at)) ?? 'not found'  }}
                                          </span>
                                        </li>
                                      </ul>                            

                                    </div>
                                  </div>
                                </div>
                              
                            </div>

                              <a class="closebtn" href="#" data-dismiss="modal">X</a>

                          </div>
                        </div>
                      </div>



                      
                        <div class="row">
                            <div class="col-md-2"></div>
                              <div class="col-md-10">
                                <div class="media align-items-center py-2 pl-0">

                                 <!--  <img src="//{{substr($singlemember->icon_image_path,env('AWS_BASE_URL'))}}" alt="" class="d-block ui-w-100" style="border: 1px solid #80808036;padding: 2px;"> -->

                                   @if(!empty($singlemember->icon_image_path))
                                    @php $image_path = url($singlemember->icon_image_path); @endphp
                                    <img src="//{{ $singlemember->icon_image_path }}" alt="" class="d-block ui-w-100" style="border: 1px solid #80808036;padding: 2px;">
                                    @else
                                    <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-100" style="border: 1px solid #80808036;padding: 2px;">
                                    @endif


                                  <div class="media-body ml-4">
                                    <h4 class="font-weight-bold mb-0">{{ $singlemember->name ?? '' }} <span class="text-muted font-weight-normal">{{ $singlemember->email ?? '' }}</span></h4>
                                    <!-- <div class="text-muted mb-2"> {{ $singlemember->english_name ?? '' }}</div> -->
                                    <div class="text-muted mb-2"><strong>User ID:</strong> {{ $singlemember->ud_id ?? '' }}</div>
                                    
                                    
                                    <button type="button" class="btn btn-default btn-sm NoborderRadius" data-toggle="modal" data-target="#exampleModalCenter">
                                      Profile
                                    </button>&nbsp;
                                    <a href="javascript:void(0)" class="btn btn-default btn-sm icon-btn NoborderRadius"><i class="ion ion-md-mail"></i></a>
                                  </div>
                                </div>
                              </div>
                            <div class="col-md-4">
                            </div>
                        </div> 
                     
                    <?php }else{ } ?>


            @php 
              $memberextrainfo = DB::table('dtb_user_infos')->where('user_id', $memberid)->first();
            @endphp

            <?php if (isset($memberextrainfo) && !empty($memberextrainfo)) {?>
                     
                {!! Form::open(['route' => ['managemember.update', $memberid], 'method' => 'PUT','files' => true, 'enctype' => 'multipart/form-data','id' => 'memberinfoeditform','class' => 'form-horizontal'])!!}

                <div class="row mt-2">
                    <div class="col-md-2"></div>
                      <div class="col-md-7 pl-0">
                          <div class="col-sm-12">
                          @if(session()->has('message'))
                          <div class="alert alert-success mb-0 background-success" role="alert">
                          {{ session()->get('message') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                          </div>
                          @endif
                          </div>
                      </div>
                    <div class="col-md-3">
                    </div>
                </div>
                <!-- <input type="hidden" name="developer_id" value="<?php //echo Session::get('developer_id');?>">
                <input type="hidden" name="author_user_id" value="<?php //echo Session::get('user_id');?>"> -->
                <input type="hidden" name="user_id" value="<?php echo $memberid;?>">
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                        <label class="col-form-label text-sm-left col-md-12">Sallery Monthly </label>
                        </div>        
                        <div class="form-group">
                        <label class="col-form-label text-sm-left col-md-12">Sallery Hourly </label>
                        </div>
                      </div>

                    <div class="col-md-6">
                    <div class="form-group">
                  
                      <div class="editinputholder">
                      <input name="sallary_month"  type="text" class="form-control NoborderRadius  {{ $errors->has('sallary_month') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('issue_title') ?? $memberextrainfo->sallary_month }}">
                      @if ($errors->has('sallary_month'))
                      <span class="invalid-feedback" role="alert">
                      <span class="messages"><strong>{{ $errors->first('sallary_month') }}</strong></span>
                      </span>
                      @endif
                      </div>
                    </div>

                    <div class="form-group">

                    <div class="editinputholder">
                    <input name="sallary_per_hour"   type="text" class="form-control NoborderRadius  {{ $errors->has('sallary_per_hour') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('issue_title') ?? $memberextrainfo->sallary_per_hour }}">
                    @if ($errors->has('sallary_per_hour'))
                    <span class="invalid-feedback" role="alert">
                    <span class="messages"><strong>{{ $errors->first('sallary_per_hour') }}</strong></span>
                    </span>
                    @endif
                    </div>
                    </div>
                    </div>
                    </div>  
                  </div>

                  <div class="col-md-6 text-right">
                    <div style="width: 80%">
                      <a href="#" id="edituserinfo" title="edit" data-toggle="tooltip" data-placement="top">Edit</a>
                      <!-- i title="edit" id="editiconuser" class="lnr lnr-pencil d-block" style="color: black;font-size: 16px;float: right;"></i> -->
                    </div>
                   <!--  <i class="far fa-edit d-block"></i> -->
                  </div>
                </div> 
                <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="col-form-label text-sm-left col-md-12">Memo </label>
                      </div>
                    </div>
                    <div class="col-md-7 pl-0">
                      <div class="form-group">
                        <div class="col-md-12">
                                <div id="contentofmemo">
                                      @if(!empty($memberextrainfo))
                                    <?php 
                                    $parser = new \cebe\markdown\GithubMarkdown();
                                    $parser->html5 = true;
                                    $parser->enableNewlines = true;
                                    $parser->keepListStartNumber = true;
                                    echo $parser->parse($memberextrainfo->memo);
                                    ?>
                           
                                  @endif
                                </div>
                        <div id="editSection3"></div>

                        <textarea  id="content2bSavedHolder3" name="memo" style="display:none"></textarea>

                          <textarea id="memodbdata" rows="10" cols="82" style="display: none;"><?php if (!empty($memberextrainfo&&!empty($memberextrainfo->memo))) { echo $memberextrainfo->memo;} else { echo ' *** '; } ?>
                          </textarea>

                        @if ($errors->has('memo'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('memo') }}</strong>
                        </span>
                        @endif
                        </div>


                      </div>
                    </div>
                    <div class="col-md-3"></div>
                </div> 
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-7">
                     <!--   <a href="{{route('managemember')}}" class="btn btn-sm btn-default" style="color: #FFFFFF !important;float: right;display: flex;font-size: 13px;">
                          <div>Back to list</div>
                        </a> -->
                      <button  type="submit" class="btn btn-success dtb_primary_btn NoborderRadius userxtrainfoupdatebtn">Update</button>
                    </div>

                    <div class="col-md-3">
                    
                    </div>


                </div> 
                {!! Form::close() !!}

          <?php }else{ ?>

            {!! Form::open(['route' => ['managemember.store', $memberid], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'membermanageform','class' => 'form-horizontal'])!!}
            <div class="row">
                <div class="col-md-2"></div>
                  <div class="col-md-7 pl-0">
                      <div class="col-sm-12">
                      @if(session()->has('message'))
                      <div class="alert alert-success mb-0 background-success" role="alert">
                      {{ session()->get('message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      @endif
                      </div>
                  </div>
                <div class="col-md-3">
                </div>
            </div>
            <!-- <input type="hidden" name="developer_id" value="<?php //echo Session::get('developer_id');?>">
            <input type="hidden" name="author_user_id" value="<?php //echo Session::get('user_id');?>"> -->
            <input type="hidden" name="user_id" value="<?php echo $memberid;?>">
            <br>
            <div class="row">
              <div class="col-md-4">
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                    <label class="col-form-label text-sm-left col-md-12">Sallery Monthly </label>
                    </div>        
                    <div class="form-group">
                    <label class="col-form-label text-sm-left col-md-12">Sallery Hourly </label>
                    </div>
                  </div>

                <div class="col-md-6">
                <div class="form-group">
              
                  <div class="">
                  <input name="sallary_month" type="text" class="form-control NoborderRadius  {{ $errors->has('sallary_month') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('issue_title',isset($copyFlag) && $copyFlag ?$dtbissue->issue_title:'') }}">
                  @if ($errors->has('sallary_month'))
                  <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('sallary_month') }}</strong></span>
                  </span>
                  @endif
                  </div>
                </div>

                <div class="form-group">

                <div class="">
                <input name="sallary_per_hour" type="text" class="form-control NoborderRadius  {{ $errors->has('sallary_per_hour') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('issue_title',isset($copyFlag) && $copyFlag ?$dtbissue->issue_title:'') }}">
                @if ($errors->has('sallary_per_hour'))
                <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('sallary_per_hour') }}</strong></span>
                </span>
                @endif
                </div>
                </div>
                </div>
                </div>  
              </div>

              <div class="col-md-6">
              </div>
            </div> 
            <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="col-form-label text-sm-left col-md-12">Memo </label>
                  </div>
                </div>
                <div class="col-md-7 pl-0">
                  <div class="form-group">
                    <div class="col-md-12">
                    <div id="editSection"></div>
                    <!-- <button id="dummycontentaddbtn">Add Dummy Content</button> -->
                    <textarea id="content2bSavedHolder" name="memo" style="display:none"></textarea>
                    @if ($errors->has('memo'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('memo') }}</strong>
                    </span>
                    @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-3"></div>
            </div> 
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-7">
                 <!--   <a href="{{route('managemember')}}" class="btn btn-sm btn-default" style="color: #FFFFFF !important;float: right;display: flex;font-size: 13px;">
                      <div>Back to list</div>
                    </a> -->
                  <button type="submit" class="btn btn-success dtb_primary_btn NoborderRadius">Save</button>
                </div>
                <div class="col-md-3"></div>
            </div> 
            </form>

        <?php } ?>

 <!-- archiving user starts here -->
                    @if(Session::has('role'))
                        @if(Session::get('role') == '0')

                         @if (isset($singlemember->is_archived))
                           @if ($singlemember->is_archived == 1 )
                            <a href="" class="btn btn-success dtb_primary_btn NoborderRadius pull-right" data-toggle="modal" data-target="#unarchiveconfrmmodal" style="background: #7d3a38 !important;position: absolute;right: 23px;bottom: 23px;">Unarchive</a>
                          @else
                            <a href="" class="btn btn-success dtb_primary_btn NoborderRadius pull-right" data-toggle="modal" data-target="#archiveconfrmmodal" style="background: #7d3a38 !important;position: absolute;right: 23px;bottom: 23px;">Archive</a>
                          @endif
                         @endif

                      @endif
                    @endif

 <!-- Modal for archive confirmation -->
                      <div class="modal fade" id="archiveconfrmmodal" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color: #f8d7da;">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h6 class="modal-title">Are you sure to archive this member?</h6>
                            </div>
                            <div class="modal-footer">
                              <button  value="{{ $memberid }}" type="button" class="btn btn-danger archivecnfrmbtn"  data="" >YES</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
                            </div>
                          </div>
                        </div>
                      </div>


 <!-- Modal for unarchive confirmation -->
                      <div class="modal fade" id="unarchiveconfrmmodal" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color: #f8d7da;">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h6 class="modal-title">Are you sure to unarchive this member?</h6>
                            </div>
                            <div class="modal-footer">
                              <button  value="{{ $memberid }}" type="button" class="btn btn-danger unarchivecnfrmbtn"  data="" >YES</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
                            </div>
                          </div>
                        </div>
                      </div>




          </div>
          </div>
          </div>
          <div class="col-md-1"></div>
    </div>


  <!-- SKILL PORTION -->
        <div class="row">
            <div class="col-md-12">
                  <!-- Sale stats -->
                  <div class="card mb-4">
                    <h6 class="card-header with-elements dtb_primary_bgcolor text-white NoborderRadius">
                      <div class="card-header-title NoborderRadius"> <i class="lnr lnr-bookmark d-block" style="float: left;margin-top: 2px;margin-right: 6px;font-size: 17px;"></i> Skill</div>
                      <div class="card-header-elements ml-auto NoborderRadius">
                        <button data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" type="button" class="btn btn-default btn-sm md-btn-flat NoborderRadius" style="color: #fff;font-weight: bold;border: 1px solid #fff">
                          Add Skill
                        </button>
                      </div>
                    </h6>
                    <div class="px-2 py-2 table-responsive" id="skillportion" style="padding: 4px 19px !important">

                    <div class="row">
                          <div class="col-md-12 pt-2 mb-3">
                              <div class="col-sm-12">
                              @if(session()->has('msg'))
                              <div class="alert alert-success mb-0 background-success" role="alert">
                              {{ session()->get('msg') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              @endif
                              </div>
                          </div>
                    </div>

                      <table class="table card-table table-bordered table-striped dtb_custom_tbl_common" id="skilltbl">
                        <thead>
                          <tr>
                            <th>Skill Name</th>
                            <th>Technical</th>
                            <th>Sence</th>
                            <th>Comprehend</th>
                            <th>Communication</th>
                            <th>Quality</th>
                            <th>Speed</th>
                            <th>Total</th>
                            <!-- <th>Comment</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        @php 
                             $skilllist = \App\DtbUserSkill::where('user_id',$memberid)->orderBy('id', 'desc')->get();
                        @endphp
                      <?php if (isset($skilllist)) {?>
                        @foreach($skilllist as $skillinfo)
                          <tr>
                            <td><a href="{{route('userskill.edit', $skillinfo->id)}}">{{ $skillinfo->name ?? "" }}</td>
                            <td>{{ $skillinfo->technical ?? "" }}</a></td>
                            <td>{{ $skillinfo->sence ?? "" }}</a></td>
                            <td>{{ $skillinfo->comprehend ?? "" }}</a></td>
                            <td>{{ $skillinfo->communication ?? "" }}</a></td>
                            <td>{{ $skillinfo->quality ?? "" }}</a></td>
                            <td>{{ $skillinfo->speed ?? "" }}</a></td>
                            <td>{{ $skillinfo->total ?? "" }}</a></td>
                            <!-- <td>{{ $skillinfo->comment }}</td> -->
                          </tr>
                          @endforeach
                      <?php }else { } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- / Sale stats -->
                </div>
            </div>



  <!-- skill add modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

          {!! Form::open(['route' => ['userskill.store', $memberid], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'addskill','class' => 'form-horizontal'])!!}
              <div class="modal-body pt-0">
                      <div class="row">
                          <div class="col-md-2"></div>
                            <div class="col-md-7 pl-0">
                                <div class="col-sm-12">
                                @if(session()->has('message'))
                                <div class="alert alert-success mb-0 background-success" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                @endif
                                </div>
                            </div>
                          <div class="col-md-3">
                          </div>
                      </div>

                        <input type="hidden" name="user_id2" id="user_id2" value="<?php echo $memberid;?>">
                        <br>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="row">

                              <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Skill Name </label>
                                </div>        
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Technical </label>
                                </div>
                              </div>

                            <div class="col-md-6">
                            <div class="form-group">

                              <div class="">
                              <input name="name" id="name" type="text" required class="form-control NoborderRadius   {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('name') }}">
                              @if ($errors->has('name'))
                              <span class="invalid-feedback" role="alert">
                              <span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
                              </span>
                              @endif
                              </div>
                            </div>

                            <div class="form-group">

                            <div class="">
                            <input id="technical" name="technical" type="text" class="summable form-control NoborderRadius  {{ $errors->has('technical') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('technical') }}">
                            @if ($errors->has('technical'))
                            <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('technical') }}</strong></span>
                            </span>
                            @endif
                            </div>
                            </div>
                            </div>
                            </div>  
                          </div>

                          <div class="col-md-6">
                             <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Total </label>
                                </div>        
                              </div>

                            <div class="col-md-6">
                            <div class="form-group">

                            <div class="">
                            <input name="total" id="total" type="text" class="form-control NoborderRadius  {{ $errors->has('total') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('total') }}">
                            @if ($errors->has('total'))
                            <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('total') }}</strong></span>
                            </span>
                            @endif
                            </div>
                            </div>
                            </div>
                            </div> 
                          </div>
                        </div>                       

                        <div class="row">
                          <div class="col-md-6">
                            <div class="row">

                              <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Sence </label>
                                </div>        
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Comprehend </label>
                                </div>
                              </div>

                            <div class="col-md-6">
                            <div class="form-group">
                          
                              <div class="">
                              <input name="sence" id="sence" type="text" class="form-control NoborderRadius summable  {{ $errors->has('sence') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('sence') }}">
                              @if ($errors->has('sence'))
                              <span class="invalid-feedback" role="alert">
                              <span class="messages"><strong>{{ $errors->first('sence') }}</strong></span>
                              </span>
                              @endif
                              </div>
                            </div>

                            <div class="form-group">

                            <div class="">
                            <input name="comprehend" id="comprehend" type="text" class="summable form-control NoborderRadius  {{ $errors->has('comprehend') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('comprehend') }}">
                            @if ($errors->has('comprehend'))
                            <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('comprehend') }}</strong></span>
                            </span>
                            @endif
                            </div>
                            </div>
                            </div>
                            </div>  
                          </div>
                          <div class="col-md-4">
                          </div>
                        </div> 


                        <div class="row">
                          <div class="col-md-6">
                            <div class="row">

                              <div class="col-md-6">    
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Communication </label>
                                </div>
                              </div>
                            <div class="col-md-6">
                            <div class="form-group">
                          
                              <div class="">
                              <input name="communication" id="communication" type="text" class="summable form-control NoborderRadius  {{ $errors->has('communication') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('communication') }}">
                              @if ($errors->has('communication'))
                              <span class="invalid-feedback" role="alert">
                              <span class="messages"><strong>{{ $errors->first('communication') }}</strong></span>
                              </span>
                              @endif
                              </div>
                            </div>

                            </div>
                            </div>  
                          </div>
                          <div class="col-md-4">
                          </div>
                        </div> 



                        <div class="row">
                          <div class="col-md-6">
                            <div class="row">

                              <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Quality </label>
                                </div>        
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Speed </label>
                                </div>
                              </div>

                            <div class="col-md-6">
                            <div class="form-group">
                          
                              <div class="">
                              <input name="quality" id="quality" type="text" class="summable form-control NoborderRadius  {{ $errors->has('quality') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('quality') }}">
                              @if ($errors->has('quality'))
                              <span class="invalid-feedback" role="alert">
                              <span class="messages"><strong>{{ $errors->first('quality') }}</strong></span>
                              </span>
                              @endif
                              </div>
                            </div>

                            <div class="form-group">

                            <div class="">
                            <input name="speed" id="speed" type="text" class="summable form-control NoborderRadius  {{ $errors->has('speed') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('speed') }}">
                            @if ($errors->has('speed'))
                            <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('speed') }}</strong></span>
                            </span>
                            @endif
                            </div>
                            </div>
                            </div>
                            </div>  
                          </div>
                          <div class="col-md-4">
                          </div>
                        </div> 

                        <div class="row">
                          <div class="col-md-6">
 
                          </div>
                          <div class="col-md-4">
                          </div>
                        </div> 

                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">

                              <div class="col-md-3">
                                <div class="form-group">
                                <label class="col-form-label text-sm-left col-md-12">Comment </label>
                                </div>        

                              </div>

                            <div class="col-md-9">
                              <div class="form-group">
                                 <div>
                                  <div id="editSection2"></div>
                                  <!-- <button id="dummycontentaddbtn">Add Dummy Content</button> -->
                                  <textarea id="content2bSavedHolder2" name="comment" style="display:none"></textarea>
                                  @if ($errors->has('comment'))
                                  <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('comment') }}</strong>
                                  </span>
                                  @endif
                                  </div>
                              
                              </div>
                            </div>
                            </div>  
                          </div>

                          <div class="col-md-4">
                          </div>
                        </div> 
                      
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary NoborderRadius " data-dismiss="modal" >Close</button>
                <input type="submit" class="btn btn-primary NoborderRadius dtb_primary_btn" id="btnskilladdform" value="Add" style="border-radius: 33px;padding: 4px 25px;">
              </div>
          </form>


      </div>
    </div>
  </div>
  <!-- skill add modal -->
  <script src="{{asset('/assets/js/showdown.min.js')}}"></script>
  <script>
  $( document ).ready(function() {

// ###############FOR EDIT SALLERY INFO


      $("#edituserinfo").click(function(){
          if ($(this).text() == "Show") {
              $("#contentofmemo").css('display', 'block');
              $(this).text('Edit');

          }else{
              $("#contentofmemo").css('display', 'none');
              $(this).text('Show');
          }
      });


      $(".editinputholder input").prop('disabled', true);
      $(".userxtrainfoupdatebtn").prop('disabled', true);
      $("#editSection3").hide();
      $("#contentofmemo").show();
      // $(".userxtrainfoupdatebtn").hide();
      $("#edituserinfo").click(function(e){
         e.preventDefault();
        $(".editinputholder input").toggleDisabled();
        $(".userxtrainfoupdatebtn").toggleDisabled();
        // $("input").prop('disabled', false).toggle();
      // $("#contentofmemo").hide();
       $('#editSection3').toggle();
      });

      (function($) {
          $.fn.toggleDisabled = function(){
              return this.each(function(){
                  this.disabled = !this.disabled;
              });
          };
      })(jQuery);


        // var content = [].join('\n');
        // @if (isset($copyFlag) && $copyFlag)
        //   content=[] ;
        //     @foreach(explode("\r\n", old("details", $dtbissue->issue_text)) as $arrRec)
        //     content.push('{{$arrRec}}');
        //     @endforeach
        //     content = content.join('\n');
        // @endif
        // var placeholder = [' ',' ',].join('\n');
        var memodbdatas = document.getElementById('memodbdata').value,
        targettoput = document.getElementById('editSection3'),

        contentconverter = new showdown.Converter(),
        convertedhtml = contentconverter.makeHtml(memodbdatas);
        targettoput.innerHTML = convertedhtml;

        var initcontent = [].join('\n');
        if (memodbdatas.length>0)
          initcontent = [];

      //TOAST UI MAIN SETTINGS
      var editor3 = new tui.Editor({
          el: document.querySelector('#editSection3'),
          initialEditType: 'markdown',
          // initialEditType: 'wysiwyg',
          initialValue:memodbdatas,
          previewStyle: 'vertical',
          height: '300px',
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
                        var myupload = ImageUpload23(blob);
                        //console.log(blob);
                        //var cllbackimg = document.location.origin +'/'+myupload;
                        var cllbackimg = myupload;
                        callback(cllbackimg, 'alt text');
                    }
                }
      });
  function ImageUpload3(images){
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


        //BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED
        $("#memberinfoeditform").submit(function(e){
          // e.preventDefault();
          var content2bSaved3 = editor3.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder3').html(content2bSaved3);
        });
// ###############FOR EDIT SALLERY INFO ENDS





              $('#skilltbl').DataTable();
  // ################ CODE FOR SKILL ADD MARKDOWN ##################################
              //initial content
              var content = [].join('\n');
              @if (isset($copyFlag) && $copyFlag)
                content=[] ;
                  @foreach(explode("\r\n", old("details", $dtbissue->issue_text)) as $arrRec)
                  content.push('{{$arrRec}}');
                  @endforeach
                  content = content.join('\n');
              @endif
                  
              var placeholder = [' ',' ',].join('\n');

              //TOAST UI MAIN SETTINGS
              var editor2 = new tui.Editor({
                  el: document.querySelector('#editSection2'),
                  initialEditType: 'markdown',
                  placeholder:placeholder,
                  // initialEditType: 'wysiwyg',
                  initialValue: content,
                  previewStyle: 'vertical',
                  height: '300px',
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
                                var myupload = ImageUpload2(blob);
                                //console.log(blob);
                                //var cllbackimg = document.location.origin +'/'+myupload;
                                var cllbackimg = myupload;
                                callback(cllbackimg, 'alt text');
                            }
                        }
              });

              function ImageUpload2(images){

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
                    type: 'post',
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

        $("#addskill").submit(function(e){
          var content2bSaved2 = editor2.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder2').html(content2bSaved2);
        });

    
  });


$(document).ready(function(){

    //iterate through each textboxes and add keyup
    //handler to trigger sum event
    $(".summable").each(function() {

      $(this).keyup(function(){
        calculateSum();
      });
    });

  });

  function calculateSum() {

    var sum = 0;
    //iterate through each textboxes and add the values
    $(".summable").each(function() {

      //add only if the value is number
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }

    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#total").val(sum.toFixed(2));
  }

  </script>


  <!-- WORKING DAYS -->
  <?php 
    $workingdays = DB::select(DB::raw(" 
          SELECT daily.month as month, count(daily.date) as wokingdays FROM (SELECT user_id,user_name,DATE_FORMAT(created_at, '%Y-%m') as month, DATE_FORMAT(created_at, '%Y%m%d') as date FROM dtb_activity_logs WHERE user_id = $memberid GROUP by date) daily GROUP BY daily.month"
      ));
    //dd($workingdays);
  ?>

        <div class="row">
            <div class="col-md-12">
                  <!-- Sale stats -->
                  <div class="card mb-0">
                    <div class="table-responsive">
                      <table class="table card-table table-bordered table-striped dtb_custom_tbl_common" id="workingdaytbl">
                      <thead>

                        <tr>  
                          <th></th>
                            <?php   
                              for ($i = 12; $i >= 0; $i--) { ?>
                                <th> <?php  echo $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?></th>
                                  
                              <?php } ?>
                        </tr>

                      </thead>
                     <tbody>

                        <tr>
                          <th>Working Days</th>
                              <?php if (isset($workingdays)) 
                                  { 
                                    for ($i = 12; $i >= 0; $i--) 
                                    { 
                                      $monthgenerated = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                                      <?php $j=0; ?>
                                      @foreach ($workingdays as $workingday)
                                            @if($monthgenerated == $workingday->month) 
                                            <?php $j++; ?>
                                            <th>{{ $workingday->wokingdays }}</th> 
                                            @endif   
                                      @endforeach
                                      <?php if( $j ==0){ ?>
                                        <th>0</th>
                                      <?php  } ?>
                                  <?php } 

                                  } 
                              ?>
                        </tr>



<!-- ##########  FEEDBACK COUNT START ############## -->
  <?php 
      $feedbackinfo = DB::select(DB::raw(" 
          SELECT user_id,sum(feedback_count) as fc,DATE_FORMAT(created_at, '%Y-%m') as month FROM dtb_issues WHERE user_id = $memberid GROUP by month"
      ));
      // $feedbackinfo = DB::select(DB::raw(" 
      //     SELECT daily.month as month, sum(daily.feedback_count) as feedbackcount FROM (SELECT user_id,feedback_count,DATE_FORMAT(created_at, '%Y-%m') as month, DATE_FORMAT(created_at, '%Y%m%d') as date FROM dtb_issues WHERE user_id = $memberid GROUP by date) daily GROUP BY daily.month"
      // ));
  ?>
                          <tr>
                          <th>Feedback Count</th>
                           <?php if (isset($feedbackinfo)) {

                            for ($i = 12; $i >= 0; $i--) 
                            { 
                              $monthgenerated = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                              <?php $j=0; ?>
                              @foreach ($feedbackinfo as $feedback)
                                    @if($monthgenerated == $feedback->month) 
                                    <?php $j++; ?>
                                     <th>{{ $feedback->fc ?? '' }}</th> 
                                    @endif   
                              @endforeach
                              <?php if( $j ==0){ ?>
                                <th>0</th>
                              <?php  } 
                          } 
                           } ?>
                        </tr>
<!-- ##########  FEEDBACK COUNT STARTS ############## -->


<!-- ########## VALOCITY ALL PROJECT starts ############## -->

  <?php 
      $valocityallproject = DB::select(DB::raw(" 
          SELECT DATE_FORMAT(i.complete_date, '%Y-%m') as month,i.user_id , u.name , SUM(estimate_hour1) as velocity FROM dtb_issues i LEFT JOIN dtb_users u ON i.user_id = u.id WHERE i.is_closed = 1 and i.user_id = $memberid group by i.user_id , month order by month DESC"
      ));
  ?>
                          <tr>
                            <th  class="titletd">Valocity All Projects</th>
                        <?php if (isset($valocityallproject)) { 

                            for ($i = 12; $i >= 0; $i--) 
                            { 
                              $monthgenerated = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                              <?php $j=0; ?>
                              @foreach ($valocityallproject as $valoallpro)
                                    @if($monthgenerated == $valoallpro->month) 
                                    <?php $j++; ?>
                                     <th>{{ $valoallpro->velocity ?? '' }}</th> 
                                    @endif   
                              @endforeach
                              <?php if( $j ==0){ ?>
                                <th>0</th>
                              <?php  } 
                          } 
                       } ?>
                        </tr>

<!-- ##########  VALOCITY ALL PROJECT ENDS ############## -->


<!-- ##########  USER VALOCITY PER DAY STARTS ############## -->

                      <?php 
                          $valocityperday = DB::select(DB::raw(" 
                              SELECT velocity.month, velocity.user_id,velocity.velocity, working_daycount.working_days, (velocity.velocity / working_daycount.working_days) as perdayvelocity 
                              FROM (SELECT DATE_FORMAT(i.complete_date, '%Y-%m') as month,i.user_id , u.name , SUM(estimate_hour1) as velocity 
                              FROM dtb_issues i 
                              LEFT JOIN dtb_users u ON i.user_id = u.id 
                              WHERE i.is_closed = 1 
                              group by i.user_id , month) as velocity 
                              INNER JOIN (select daily.month as month, daily.user_id, count(daily.date) as working_days 
                              from (SELECT user_id,user_name,DATE_FORMAT(created_at, '%Y-%m') as month, DATE_FORMAT(created_at, '%Y-%m-%d') as date 
                              FROM dtb_activity_logs 
                              GROUP by date) daily 
                              GROUP BY daily.month,daily.user_id) as working_daycount ON velocity.month = working_daycount.month 
                              WHERE velocity.user_id = $memberid AND working_daycount.user_id = $memberid"
                          ));

                      ?>


                        <tr>
                          <th class="titletd">Valocity per day</th>
                           <?php if (isset($valocityperday)) { 


                            for ($i = 12; $i >= 0; $i--) 
                            { 
                              $monthgenerated = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                              <?php $j=0; ?>
                              @foreach ($valocityperday as $valocitypd)
                                    @if($monthgenerated == $valocitypd->month) 
                                    <?php $j++; ?>
                                     <th>{{ $valocitypd->perdayvelocity ?? '' }}</th> 
                                    @endif   
                              @endforeach
                              <?php if( $j ==0){ ?>
                                <th>0</th>
                              <?php  } 
                            } 

                             } ?>
                        </tr>

<!-- ##########  USER VALOCITY PER DAY ENDS ############## -->

<!-- ##########  USER VALOCITY PER PROJECT STARTS ############## -->
                        <tr>
                          <th style="padding: 3px 5px" class="dtb_primary_bgcolor">
                            <h5 class="m-0 perprojectitle d-flex">Valocity per project <i class="fas fa-level-down-alt d-block ml-2" style="font-size: 9px;margin-top: 1px;"></i></h5>
                          </th>
                        </tr>
                        <?php 
                            $projecofuser = DB::select(DB::raw(" 
                                SELECT i.project_id,p.project_name FROM dtb_issues i LEFT JOIN dtb_projects p ON i.project_id = p.id WHERE i.user_id = $memberid group by i.project_id"
                            ));   
                        ?>

                        @foreach($projecofuser as $userproject)

                              <?php 
                                   $valocityeachproject = DB::select(DB::raw(" 
                                      SELECT DATE_FORMAT(i.complete_date, '%Y-%m') as month,i.project_id,i.user_id , u.name , SUM(estimate_hour1) as velocity FROM dtb_issues i LEFT JOIN dtb_users u ON i.user_id = u.id WHERE i.is_closed = 1 and i.user_id = $memberid and project_id = $userproject->project_id group by month order by month DESC"
                                  ));
                              ?>

                              <tr>
                                <th class="titletd" width="190px">{{ $userproject->project_name ?? '' }}</th>
                                  <?php if (isset($valocityeachproject)) { 
                                      for ($i = 12; $i >= 0; $i--) 
                                      { 
                                        $monthgenerated = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                                        <?php $j=0; ?>
                                        @foreach ($valocityeachproject as $valoeachpro)
                                              @if($monthgenerated == $valoeachpro->month) 
                                              <?php $j++; ?>
                                               <th>{{ $valoeachpro->velocity ?? '' }}</th> 
                                              @endif   
                                        @endforeach
                                        <?php if( $j ==0){ ?>
                                          <th>0</th>
                                        <?php  } 
                                      } 
                                     // @foreach ($valocityeachproject as $valoeachpro)
                                     //    <th>{{ $valoeachpro->velocity ?? '' }}</th>
                                     // @endforeach
                                } ?>
                            </tr>

                        @endforeach

<!-- ##########  USER VALOCITY PER PROJECT ENDS ############## -->


                      </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- / Sale stats -->
                </div>
            </div>

            <br>





  <style>
    tbody tr th {
    width: 107px;
}
tr.perprothead th {
    padding: 0;
    margin: 0;
    border: none;
    box-shadow: 0;
}
thead tr th {
    padding: 0;
    margin: 0;
    height: 0px !important;
    width: 107px;
}
.perprojectitle {
    background: #38587d;
    font-size: 11px;
    color: white;
    padding: 2px 3px;
    text-transform: uppercase;
}
tbody tr th:first-child {
    background: #CBDAEB;
    width: 170px;
    border-bottom: 1px solid white;
    border-top: 1px solid white;
    text-align: center;
    font-weight: 600;
    font-size: 13px;
    color: black;
    padding: 11px 19px 9px 0px;
    display: block;
}
.card-header:first-child {
    border-radius: 0;
}

  .rolbutton{
      color: white;
      background: #02bc77;
      border-radius: 3px;
      font-size: 13px;
      padding: 1px 6px;
  }

    a.twPc-avatarLink img {
      height: 94px !important;
  }
    a.closebtn {
      position: absolute;
      right: 4px;
      font-size: 11px;
      color: black;
  }
    #editSection{
      height: 238px !important;
    }
  .valoprojecttitle {
      width: 100%;
      margin: 0 auto;
      padding: 6px 13px 7px 13px;
      background: #718aa84a;
  }

  .valoprojecttitle span {
      font-size: 16px;
      font-weight: 500;
  }

  .profileinfo.bio {
      margin-top: 4px;
  }

  .twPc-div {
      background: #fff none repeat scroll 0 0;
      border: 1px solid #e1e8ed;
      border-radius: 6px;
     width: 100%;
  }
  .twPc-bg {
      background-image: url(http://tk2-402-42070.vs.sakura.ne.jp/assets_/img/bg/4.jpg);
      background-position: 0 73%;
      background-size: 100% auto;
      border-bottom: 1px solid #e1e8ed;
      border-radius: 4px 4px 0 0;
      height: 100px;
      width: 100%;
  }
  .twPc-block {
      display: block !important;
  }
  .twPc-button {
      margin: -25px -8px 0;
      text-align: right;
      width: 100%;
  }
  .twPc-avatarLink {
      background-color: #fff;
      border-radius: 6px;
      display: inline-block !important;
      float: left;
      margin: -47px 5px 0 8px;
      max-width: 100%;
      padding: 1px;
      vertical-align: bottom;
          border-radius: 0px;
  }
  .twPc-avatarImg {
      border: 2px solid #fff;
      border-radius: 7px;
      box-sizing: border-box;
      color: #fff;
      height: 90px;
      width: 90px;
  }
  .twPc-divUser {
      margin: 7px 0 0;
  }
  .twPc-divName {
      font-size: 18px;
      font-weight: 700;
      line-height: 21px;
  }
  .twPc-divName a {
      color: inherit !important;
  }
  .twPc-divStats {
      margin-left: 11px;
      padding: 18px 0;
  }
  .twPc-Arrange {
      box-sizing: border-box;
      display: table;
      margin: 0;
      min-width: 100%;
      padding: 0;
      table-layout: auto;
  }
  ul.twPc-Arrange {
      list-style: outside none none;
      margin: 0;
      padding: 0;
      margin-bottom: 7px;
  }
  .twPc-ArrangeSizeFit {
     
      padding: 0;
      vertical-align: top;
  }
  .twPc-ArrangeSizeFit a:hover {
      text-decoration: none;
  }
  .twPc-StatValue {
      display: block;
      font-size: 18px;
      font-weight: 500;
      transition: color 0.15s ease-in-out 0s;
  }
  .twPc-StatLabel {
      color: #8899a6;
      font-size: 10px;
      letter-spacing: 0.02em;
      overflow: hidden;
      text-transform: uppercase;
      transition: color 0.15s ease-in-out 0s;
  }

  .right_info {
      float: right;
      display: inline-grid;
      margin-top: -21px;
      margin-right: 21px;
      font-size: 13px;
  }


  li.twPc-ArrangeSizeFit span {
      float: left;
      font-size: 11px;
      font-weight: 500;
      text-transform: capitalize;
      width: 100px;
  }

  .roloholder{
        color: white;
      margin-top: -10px;
      float: right;
      margin-right: 8px;
  }
  }

i#editiconuser:hover {
    color: green !important;
    font-weight: bold !important;
}

.btn-success.disabled, .btn-success:disabled {

    background: #38587d !important;
}
a#edituserinfo i:hover {
    font-weight: 700;
    color: #02bc77 !important;
}
div#contentofmemo {
    border: 1px solid #f3f3f3;
    padding: 2px 6px;
}
  </style>



<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>

        <script type="text/javascript">

// FOR ARCHIVE CODE
        $(".archivecnfrmbtn").click(function(e){
          e.preventDefault();
              var memberid = $(this).val();
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url : '{{ url('/archiveuser') }}',
                type: 'put',
                data :{
                "memberid": memberid
                },
                success: function (response) {
                  $('#archiveconfrmmodal').modal('hide');
                  $.iaoAlert({msg: "Member has been archived!",
                  type: "success",
                  mode: "dark",});
                    setTimeout(function(){// wait for 5 secs(2)
                      location.reload(); // then reload the page.(3)
                    }, 1500);

                },
                  error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('error in uploading file');
                  }
              });
        }); 


// FOR UNARCHIVE CODE
        $(".unarchivecnfrmbtn").click(function(e){
          e.preventDefault();
              var memberid = $(this).val();
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url : '{{ url('/unarchiveuser') }}',
                type: 'put',
                data :{
                "memberid": memberid
                },
                success: function (response) {
                  $('#unarchiveconfrmmodal').modal('hide');
                  $.iaoAlert({msg: "Member has been unarchived!",
                  type: "success",
                  mode: "dark",});
                    setTimeout(function(){// wait for 5 secs(2)
                      location.reload(); // then reload the page.(3)
                    }, 1500);

                },
                  error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('error in uploading file');
                  }
              });
        });





              //CONTENT FOR YOUTUBE VIDEO EMBED
              var vdocontent = [
                '```youtube',
                'XGSy3_Czz8k',
                '```'
              ].join('\n');

              //initial content
              var contentinit = [' * * *',' ',].join('\n');
              @if (isset($copyFlag) && $copyFlag)
                content=[] ;
                  @foreach(explode("\r\n", old("details", $dtbissue->issue_text)) as $arrRec)
                  content.push('{{$arrRec}}');
                  @endforeach
                  content = content.join('\n');
              @endif
                  
              var placeholder = [' ',' ',].join('\n');

              //TOAST UI MAIN SETTING
              var editor = new tui.Editor({
                  el: document.querySelector('#editSection'),
                  initialEditType: 'markdown',
                  // placeholder:placeholder,
                  // initialEditType: 'wysiwyg',
                  // initialValue: contentinit,
                  previewStyle: 'vertical',
                  height: '300px',
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
                                //var cllbackimg = document.location.origin +'/'+myupload;
                                var cllbackimg = myupload;
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
          type: 'post',
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
      $("#membermanageform").submit(function(e){
        var content2bSaved = editor.getValue(); 
        //var content2bSaved = editor.getHtml();
        $('#content2bSavedHolder').html(content2bSaved);
      });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');

    $('#workingdaytbl').DataTable();
    $('#valocityallprojecttbl').DataTable();
    $('#feedbacktbl').DataTable();
    $('.valocityeachprotbl').DataTable();

  </script>





    @if(session()->has('msg'))
        <script>
            $(document).ready(function () {
              // Handler for .ready() called.
              $('html, body').animate({
                  scrollTop: $('#skillportion').offset().top
              }, 'slow');
          });
        </script>

      @endif




    @endsection
