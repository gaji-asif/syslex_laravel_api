@extends('master_main')
@section('mainContent')
<div class="container pt-5">
  <div class="row">
  <div class="col-lg-3 col-md-3">
@include('settings.developerSettings.developer_settings_sidebar')
</div>
<div class="col-lg-9 col-md-9 settgs_right_content">
    <div class="card mb-4 no_border">
      <div class="card-body padding_left_right">
        <h6 class="card_body_header" style="padding-left: 0px;">Create Project</h6>
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'projects',
            'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

            @if(session()->has('status'))
                <div class="alert alert-success mb-10 background-success" role="alert">
                    {{ session()->get('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <input type="hidden" name="developer_id" value="<?php echo Session::get('developer_id');?>">
                <div class="form-group">
                        <label class="form-label">Project Name</label>
                        <input type="text" class="form-control {{ $errors->has('project_name') ? ' is-invalid' : '' }}" value="{{ old('project_name') }}" placeholder="Project Name" name="project_name">
                        @if ($errors->has('project_name'))
                        <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('project_name') }}</strong></span>
                        </span>
                        @endif
                </div>

                <div class="form-group">
                        <label class="form-label">Project Key</label>
                        <input type="text" class="form-control {{ $errors->has('project_key') ? ' is-invalid' : '' }}" value="{{ old('project_key') }}" placeholder="Project Key" name="project_key">
                        <small>Project Key is the code name of the project. Short abbreviations are good.
                        You can use half-width uppercase letters,half-width numbers and underscores. </small>
                        @if ($errors->has('project_key'))
                        <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('project_key') }}</strong></span>
                        </span>
                        @endif
                </div>

                <div class="form-group">
                        <label class="form-label">Project Details</label>
                        <textarea class="form-control {{ $errors->has('project_detail') ? ' is-invalid' : '' }}" placeholder="Project Detail" rows="5" id="Prject Description" name="project_detail">{{ old('project_detail') }}</textarea>
                        @if ($errors->has('project_detail'))
                        <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('project_detail') }}</strong></span>
                        </span>
                        @endif
                </div>

                <div class="col-sm-12 ml-sm-auto pt-3">
                <button type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle">Submit</button>
              </div>

                
            {{ Form::close()}}
        </div>
    </div>
  </div>

</div>

</div>


@endsection
