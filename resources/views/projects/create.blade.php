
<!-- 
@if(session('developer_id'))

@else 
  <script>window.location = "login/";</script>
@endif -->

@extends('master')
@section('mainContent')

<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Dashboard /</span> Projects
</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">

            <h6 class="card-header">
              Add Project
            </h6>


            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'projects',
            'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            <div class="card-body">

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


                <button type="submit" class="btn btn-default mt-4">Submit</button>
             </div>
            {{ Form::close()}}

        </div>
    </div>


</div>
@endsection