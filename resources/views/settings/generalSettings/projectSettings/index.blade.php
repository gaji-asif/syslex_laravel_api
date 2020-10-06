@extends('master')
@section('mainContent')

<!-- 	<h4 class="font-weight-bold py-3 mb-4">
		Project Home
		<div class="text-muted text-tiny mt-1"><small class="font-weight-normal">Today is Tuesday, 8 February 2018</small></div>
	</h4> -->
	<div class="mt-5">
  <div class="row">

  <div class="col-lg-3">
    @include('settings.generalSettings.general_settings_sidebar')
  </div>


  <div class="col-lg-9">
    <div class="card mb-4">
      <h6 class="card-header">Space Edit</h6>
      <div class="card-body">

         <form>
             {{ method_field('PATCH') }}
            <div class="form-group row">
              <div class="col-sm-12">
                @if(session()->has('id'))
                <br>
                <div class="alert alert-success mb-10 background-success" role="alert">
                  {{ session()->get('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            
                @endif
              </div>
            </div>

            <div class="form-group">
             <label class="col-form-label text-sm-right">Space Name</label>
             
              <input name="space_name" type="text" class="form-control  {{ $errors->has('space_name') ? ' is-invalid' : '' }}" placeholder="Space Name" value="{{ old('space_name')   }}">
              @if ($errors->has('space_name'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong></strong></span>
              </span>
              @endif
            </div>  


            <div class="form-group">
             <label class="col-form-label text-sm-right">Space Owner</label>
            
             <input type="hidden" name="space_owner_user_id" value="<?php if(isset($dtbuser->id)){echo $dtbuser->id; }else{echo ""; } ?>">
            </div>

            
            <div class="form-group{{ $errors->has('logo_image_path') ? ' has-error' : '' }}">
                <label for="image" class="col-form-label text-sm-right">Space Image</label>
                
                  <p><img  alt="Space Image" src=""></p>
                  <input id="logo_image_path" type="file" class="form-control" name="logo_image_path" value="{{ old('logo_image_path') }}"  autofocus>

                    @if ($errors->has('logo_image_path'))
                        <span class="help-block">
                            <strong>{{ $errors->first('logo_image_path') }}</strong>
                        </span>
                    @endif
                
            </div>
            <br>
            <div class="form-group row">
              <div class="col-sm-12 ml-sm-auto">
                <button type="submit" class="btn btn-success ">Update</button>
              </div>
            </div>
          
      </form>

      </div>
    </div>
  </div>

</div>

</div>
  
@endsection