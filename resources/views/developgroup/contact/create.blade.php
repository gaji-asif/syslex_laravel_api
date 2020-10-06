@extends('master')
@section('mainContent')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Dashboard /</span> Contact
</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">

            <h6 class="card-header">
              Add Contact
            </h6>


                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'contact/'.Session::get('developer_id'),
                    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     {{ method_field('PATCH') }}
                    <div class="card-body">
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
                                <input type="text" class="form-control {{ $errors->has('company_name') ? ' is-invalid' : '' }}" value="{{ old('company_name') }}" name="company_name">
                                @if ($errors->has('company_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('company_name') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                 <div class="col">
                                <label class="form-label">Comapny Name Kana</label>
                                <input type="text" class="form-control {{ $errors->has('company_name_kana') ? ' is-invalid' : '' }}" value="{{ old('company_name_kana') }}" name="company_name_kana">
                                @if ($errors->has('company_name_kana'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('company_name_kana') }}</strong></span>
                                </span>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label class="form-label">Charge Person Name</label>
                                <input type="text" class="form-control {{ $errors->has('charge_person_name') ? ' is-invalid' : '' }}" value="{{ old('charge_person_name') }}" name="charge_person_name">
                                @if ($errors->has('charge_person_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('charge_person_name') }}</strong></span>
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
                                <input type="text" class="form-control {{ $errors->has('charge_person_position') ? ' is-invalid' : '' }}" value="{{ old('charge_person_position') }}" name="charge_person_position">
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
                                <input type="text" class="form-control {{ $errors->has('tel') ? ' is-invalid' : '' }}" value="{{ old('tel') }}" name="tel">
                                @if ($errors->has('tel'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('tel') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                 <div class="col">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control {{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{ old('zip_code') }}" name="zip_code">
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
                                <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}"  name="address">{{ old('address') }}</textarea>
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
                                <input type="text" class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}" value="{{ old('state') }}"  name="state">
                                @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('state') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                 <div class="col">
                                <label class="form-label">Url</label>
                                <input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" value="{{ old('url') }}" name="url">
                                @if ($errors->has('url'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('url') }}</strong></span>
                                </span>
                                @endif
                                </div>
                            </div>
                               
                        </div>



                        <button type="submit" class="btn btn-default mt-4">Submit</button>
                </div>
                {{ Form::close()}}


        </div>
    </div>


</div>
@endsection