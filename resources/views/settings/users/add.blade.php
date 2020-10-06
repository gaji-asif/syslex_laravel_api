@extends('master_main')
@section('mainContent')
<div class="container pt-5">
  <div class="row">
    <div class="col-lg-3">
      @include('settings.developerSettings.developer_settings_sidebar')
    </div>
    <div class="col-lg-9 settgs_right_content">
      @if(isset($editData))
      {{ Form::open(['class' => '', 'files' => true, 'url' => 'role/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
      @else
      {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'settings-users',
      'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
      @endif
      <div class="card mb-4 no_border">
        @if(session()->has('message-success'))
        <div class="alert alert-success mb-10 background-success" role="alert">
          {{ session()->get('message-success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        
        <div class="card-body padding_left_right">
          <h6 class="card_body_header">Add New User
            <a href="{{route('settings-users.index')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default">User List</a>
          </h6>
          <div class="media align-items-center">
            <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-80" id="profileDisplay">
            <div class="media-body ml-3">
              <label class="form-label d-block mb-2">User Image</label>
              <label class="btn btn-outline-primary btn-sm">
                Upload
                <input type="file" class="user-edit-fileinput" name="userImage" id="userImage" onChange="displayImage(this)" accept="image/*">
              </label>&nbsp;
            </div>
          </div>
          <hr class="border-light m-0">
          <div class="pb-2 pt-3">
            <h5 class="mb-4">User Info</h5>
            <div class="form-group">
              <label class="form-label">User ID</label>
              <input type="text" class="form-control {{ $errors->has('ud_id') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->ud_id : ''}}" placeholder="User ID" name="ud_id">
              @if ($errors->has('ud_id'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('ud_id') }}</strong></span>
              </span>
              @endif
            </div>
            <div class="form-group">
              <label class="form-label">Name</label>
              <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->user_id : ''}}" placeholder="Name" name="name">
              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
              </span>
              @endif
            </div>
            <div class="form-group">
              <label class="form-label">Email</label>
              <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"  placeholder="Email" name="email" id="emailexist">
              <p class="error_message">Email Exist</p>
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('email') }}</strong></span>
              </span>
              @endif
              
              <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
              <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
              <input type="hidden" name="emailCheck_url" id="emailCheck_url" value="emailCheck">

            </div>


            <div class="form-group">
              <label class="form-label">Role</label>
              <select class="custom-select {{ $errors->has('role') ? ' is-invalid' : '' }}" name="role">
                @if(isset($roles))
                <option value="">Select a Role</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}"
                  @if(isset($editData))
                  @if($editData->language_id == $language->id)
                  selected
                  @endif
                  @endif
                  >{{$role->role_name}}</option>
                  @endforeach
                  @endif
                </select>
                @if ($errors->has('role'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('role') }}</strong></span>
                </span>
                @endif
              </div>


              <hr class="border-light m-0">
              <div class="pb-2 pt-3">
                <h5 class="mb-4">Language & Timezone</h5>
                <div class="form-group">
                  <label class="form-label">Language</label>
                  <select class="custom-select" name="language_id">
                    @if(isset($languages))
                    <option value="">Select a Language</option>
                    @foreach($languages as $language)
                    <option value="{{$language->id}}"
                      @if(isset($editData))
                      @if($editData->language_id == $language->id)
                      selected
                      @endif
                      @endif
                      >{{$language->name}}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Timezone</label>
<!--                     <select class="custom-select" name="timezone_id">
                      @if(isset($timezones))
                      <option value="">Select a Timezone</option>
                      @foreach($timezones as $timezone)
                      <option value="{{$timezone->id}}"

                        >{{$timezone->name}}</option>
                        @endforeach
                        @endif
                      </select> -->

                    <?php

                    function tz_list() {
                      $zones_array = array();
                      $timestamp = time();
                      foreach(timezone_identifiers_list() as $key => $zone) {
                        date_default_timezone_set($zone);
                        $zones_array[$key]['zone'] = $zone;
                        $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
                      }
                      return $zones_array;
                    }
                    ?>

                    <select class="form-control custom-select {{ $errors->has('timezone_id') ? ' is-invalid' : '' }}" name="timezone_id" style="width: 100%">
                      <option value="0">Please, select timezone</option>
                      <?php foreach(tz_list() as $t) { ?>
                        <option value="<?php print $t['zone'] ?>">
                          <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                        </option>
                      <?php } ?>
                    </select>

                    
                    </div>

                    <hr class="border-light m-0">
                    <div class="pb-2 pt-3">
                      <h5 class="mb-4">Teams</h5>
                      <div class="form-group">
                        <label class="form-label">Assign in a Team</label>
                        <select class="custom-select" name="team_id">
                          @if(isset($developer_teams))
                          <option value="">Select a Team</option>
                          @foreach($developer_teams as $developer_team)
                          <option value="{{$developer_team->id}}"
                            @if(isset($editData))
                            @if($editData->language_id == $language->id)
                            selected
                            @endif
                            @endif
                            >{{$developer_team->team_name}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>

                        <hr class="border-light m-0">
                        <div class="pb-2 pt-3">
                          <h5 class="mb-4">Projects</h5>
                          <div class="form-group">
                            <label class="form-label">Please Select the Projects to have this user join</label>
                            <select class="user-edit-multiselect form-control w-100" multiple name="projects[]">
                              @if(isset($projects))
                              @foreach($projects as $project)
                              <option value="{{$project->id}}"
                                @if(isset($editData))
                                @if($editData->language_id == $language->id)
                                selected
                                @endif
                                @endif
                                >{{$project->project_name}}</option>
                                @endforeach
                                @endif
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group row pt-3">
                            <div class="col-sm-12 ml-sm-auto">
                              <button type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle">Submit</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{ Form::close()}}
              </div>
            </div>
          </div>
          @endsection