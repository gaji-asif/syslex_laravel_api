    <!-- MODAL CODE -->


    <!-- MODAL FOR CONTACT ENTRY FORM -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Contact</h4>
              </div>

            <div class="modal-body">

                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'contact',
                    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                        @if(session()->has('status'))
                            <div class="alert alert-success mb-10 background-success" role="alert">
                                {{ session()->get('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control {{ $errors->has('comapny_name') ? ' is-invalid' : '' }}" value="{{ old('comapny_name') }}" name="comapny_name">
                                @if ($errors->has('comapny_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('comapny_name') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                 <div class="col">
                                <label class="form-label">Comapny Name Kana</label>
                                <input type="text" class="form-control {{ $errors->has('comapny_name_kana') ? ' is-invalid' : '' }}" value="{{ old('comapny_name_kana') }}" name="comapny_name_kana">
                                @if ($errors->has('comapny_name_kana'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('comapny_name_kana') }}</strong></span>
                                </span>
                                @endif
                                </div>
                            </div>
                               
                        </div>



                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label class="form-label">Charge Person</label>
                                <input type="text" class="form-control {{ $errors->has('charge_person') ? ' is-invalid' : '' }}" value="{{ old('charge_person') }}" name="charge_person">
                                @if ($errors->has('charge_person'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('charge_person') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                 <div class="col">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control {{ $errors->has('charge_person_email') ? ' is-invalid' : '' }}" value="{{ old('charge_person_email') }}" name="charge_person_email">
                                @if ($errors->has('charge_person_email'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('charge_person_email') }}</strong></span>
                                </span>
                                @endif
                                </div>
                            </div>
                               
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label class="form-label">Depertment</label>
                                <input type="text" class="form-control {{ $errors->has('charge_person_dept') ? ' is-invalid' : '' }}" value="{{ old('charge_person_dept') }}"  name="charge_person_dept">
                                @if ($errors->has('charge_person_dept'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('charge_person_dept') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                 <div class="col">
                                <label class="form-label">Position</label>
                                <input type="text" class="form-control {{ $errors->has('charge_person_position') ? ' is-invalid' : '' }}" value="{{ old('charge_person_position') }}" placeholder="Project Name" name="charge_person_position">
                                @if ($errors->has('charge_person_position'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('charge_person_position') }}</strong></span>
                                </span>
                                @endif
                                </div>
                            </div>
                               
                        </div>




                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" name="phone">
                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('phone') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                 <div class="col">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control {{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{ old('zip_code') }}" placeholder="Project Name" name="zip_code">
                                @if ($errors->has('zip_code'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('zip_code') }}</strong></span>
                                </span>
                                @endif
                                </div>
                            </div>
                               
                        </div>


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label class="form-label">Adress</label>
                                <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}"  name="address"></textarea>
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('address') }}</strong></span>
                                </span>
                                @endif
                                </div>
                            </div>
                               
                        </div>


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}" value="{{ old('state') }}" placeholder="Project Name" name="state">
                                @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('state') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                 <div class="col">
                                <label class="form-label">Url</label>
                                <input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" value="{{ old('url') }}" placeholder="Project Name" name="url">
                                @if ($errors->has('url'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('url') }}</strong></span>
                                </span>
                                @endif
                                </div>
                            </div>
                               
                        </div>



                        <button type="submit" class="btn btn-default mt-4">Submit</button>
                
                {{ Form::close()}}

                </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

            </div>

          </div>
        </div>

