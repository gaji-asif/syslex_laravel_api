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
          <h6 class="card_body_header">Timezone</h6>
          <div class="row">
            <div class="col-md-12">

              @if (session('status'))
              <div class="alert success_message alert-dismissible fade show" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
              </div>
              @endif

              <form id="validation-form" class="pl-2" method="post" action="timezone">
                {{ csrf_field() }}
                <input type="hidden" name="develop_group_id" value="<?php echo Session::get('developer_id');?>">
                <div class="form-group">
                  <label class="form-label">Language</label>
                  
                  <div>
                    <select class="form-control {{ $errors->has('default_lang') ? ' is-invalid' : '' }}" name="default_lang" style="width: 100%">
                      <option value="">Select Language</option>
                      @foreach($languagelist as $languages)
                      <option value="{{ old('default_lang') ?? $languages->id }}" {{ $languages->id == $dtbdevelopgroup->default_lang ? 'selected':'' }}>{{ $languages->name }} - ( {{ $languages->code }})</option>
                      @endforeach
                    </select>
                    @if ($errors->has('default_lang'))
                    <span class="invalid-feedback" role="alert">
                      <span class="messages"><strong>{{ $errors->first('default_lang') }}</strong></span>
                    </span>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label">TimeZone</label>

<!--                   <select class="form-control {{ $errors->has('timezone_id') ? ' is-invalid' : '' }}" name="timezone_id" style="width: 100%">
                    <option value="">Select a TimeZone</option>
                    @foreach($timezonelist as $timezones)
                    <option value="{{ old('timezone_id') ?? $timezones->id }}" {{ $timezones->id == $dtbdevelopgroup->time_zone_id ? 'selected':'' }}>{{ $timezones->name }} - (Time Diff  {{ $timezones->time_difference }})</option>
                    @endforeach
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

                    <select class="form-control {{ $errors->has('timezone_id') ? ' is-invalid' : '' }}" name="timezone_id" style="width: 100%">
                      <option value="0">Please, select timezone</option>
                      <?php foreach(tz_list() as $t) { ?>
                        <option value="<?php print $t['zone'] ?>" {{ $t['zone'] == $dtbdevelopgroup->time_zone_id ? 'selected':'' }}>
                          <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                        </option>
                      <?php } ?>
                    </select>


                  
                  @if ($errors->has('timezone_id'))
                  <span class="invalid-feedback" role="alert">
                    <span class="messages"><strong>{{ $errors->first('timezone_id') }}</strong></span>
                  </span>
                  @endif

                </div>

                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->

                <div class="form-group row pt-5">
                  <div class="col-sm-12 ml-sm-auto">
                    <button type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle">Submit</button>
                  </div>
                </div>
              </form>

            </div>
            <div class="col-md-6"></div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

@endsection