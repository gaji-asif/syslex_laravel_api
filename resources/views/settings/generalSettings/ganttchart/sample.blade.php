@extends('master')
@section('mainContent')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Dashboard /</span> Issues
</h4>

<div class="row">
    <div class="col-lg-12">
         <div class="card mb-4">
              <h6 class="card-header">
                Add Issue
              </h6>
              <d{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'issue',
            'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

              @if(session()->has('status'))
                  <div class="alert alert-success mb-10 background-success" role="alert">
                      {{ session()->get('status') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif


                  <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control  {{ $errors->has('project_name') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('project_name') }}">
                    </div>

                       @if ($errors->has('project_name'))
                        <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('project_name') }}</strong></span>
                        </span>
                        @endif

                  </div>




                  <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Textarea</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" placeholder="Textarea"></textarea>
                    </div>
                  </div>
                  <fieldset class="form-group">
                    <div class="row">
                      <label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Radios</label>
                      <div class="col-sm-10">
                        <div class="custom-controls-stacked">
                          <label class="custom-control custom-radio">
                            <input name="custom-radio-3" type="radio" class="custom-control-input" checked>
                            <span class="custom-control-label">Option one is this and that—be sure to include why it's great</span>
                          </label>
                          <label class="custom-control custom-radio">
                            <input name="custom-radio-3" type="radio" class="custom-control-input">
                            <span class="custom-control-label">Option two can be something else and selecting it will deselect option one</span>
                          </label>
                          <label class="custom-control custom-radio">
                            <input name="custom-radio-3" type="radio" class="custom-control-input" disabled>
                            <span class="custom-control-label">Option three is disabled</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Checkbox</label>
                    <div class="col-sm-10">
                      <label class="custom-control custom-checkbox m-0">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-label">Check me out</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                      <button type="submit" class="btn btn-success">Add</button>
                    </div>
                  </div>
                {{ Form::close()}}
              </div>
            </div>
    </div>
</div>
@endsection