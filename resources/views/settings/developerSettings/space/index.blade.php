@extends('master_main')
@section('mainContent')

<div class="container pt-5">
  <div class="row">

  <div class="col-lg-3">
    @include('settings.developerSettings.developer_settings_sidebar')
  </div>

  <div class="col-lg-9 settgs_right_content">
    <div class="card mb-4 no_border">
      
      <div class="card-body padding_left_right">
        <h6 class="card_body_header">Space Edit</h6>
          {!! Form::open(['route' => ['space.update', $dtbdevelopgroup->id], 'enctype' => 'multipart/form-data', 'class' => 'pl-2'])!!}
             {{ method_field('PATCH') }}
            

             @if(session()->has('message'))
                <div class="alert success_message mb-10 background-success" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
              </div>
            @endif

            <div class="form-group">
             <label class="col-form-label text-sm-right">Space Name</label>
             
              <input name="space_name" type="text" class="form-control  {{ $errors->has('space_name') ? ' is-invalid' : '' }}" placeholder="Space Name" value="{{ old('space_name') ?? $dtbdevelopgroup->space_name  }}">
              @if ($errors->has('space_name'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('space_name') }}</strong></span>
              </span>
              @endif
            </div>  


            <div class="form-group">
             <label class="col-form-label text-sm-right">Space Owner</label>
             <p><strong>{{ $dtbuser->english_name }}</strong></p>
             <input type="hidden" name="space_owner_user_id" value="<?php if(isset($dtbuser->id)){echo $dtbuser->id; }else{echo ""; } ?>">
            </div>

            
            <div class="form-group row" style="clear: both;">
              <div class="col-lg-12">
               
              <span style="float: left; width: 20%;"><label for="image" class="col-form-label text-sm-right">Space Image</label>
                
                    @php $image_path = ""; @endphp
                    @if(!empty($dtbdevelopgroup->logo_image_path))
<!--                     @php $image_path = url($dtbdevelopgroup->logo_image_path); @endphp -->
                    <p><img alt="Space Image" src="{{$dtbdevelopgroup->logo_image_path}}" class="d-block ui-w-80"></p>
                    @else
                    <p style="color: #02BC77">You didn't set any Space Image yet. Please set an image.</p>
                    @endif</span>
                
                    <span style="float: left; width: 50%; margin-top: 15px;" class="pt-4">
                      <input id="logo_image_path" type="file" class="form-control dtb_custom_btn_default" name="logo_image_path" value="{{ old('logo_image_path') ?? $dtbdevelopgroup->logo_image_path }}" placeholder="dklfdf"  autofocus>

                       <input type="hidden" name="oldimg" value="{{ $dtbdevelopgroup->logo_image_path }}">

                    @if ($errors->has('logo_image_path'))
                        <span class="help-block">
                            <strong>{{ $errors->first('logo_image_path') }}</strong>
                        </span>
                    @endif
                    </span>
                  </div> 
            </div>
            <br>
            <div class="form-group row pt-3">
              <div class="col-sm-12 ml-sm-auto">
                <button type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle">Update</button>
              </div>
            </div>
          
     {{ Form::close()}}

      </div>
    </div>
  </div>

</div>

<style type="text/css">
  input#logo_image_path {
    background: beige;
    padding: 5px 20px;
}
</style>
</div>


@endsection