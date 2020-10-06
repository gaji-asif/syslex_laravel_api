@extends('master_main')
@section('mainContent')
<style type="text/css">
	.settings_wrapper{
		width: 70%;
		margin: 0 auto;
	}
	.form-control{
		border-radius: 0px;
	}
	#profileDisplay{
	border: 1px solid #37343629;
    padding: 1px;
    min-height: 80px;
	}

.btn-outline-primary {
    border-color: #718aa8;
    background: transparent;
    padding: 3px 5px;
    color: #718aa8;
    border-radius: 0px;
    font-size: 13px;
}
.btn-outline-primary:hover {
    background: #38587d;
}
</style>
<div class="settings_wrapper pt-5">
	<div class="card overflow-hidden no_border">
		<div class="row no-gutters row-bordered row-border-light">
			<div class="col-md-3 pt-0">
				<div class="list-group list-group-flush account-settings-links">
					<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#account-social-links">links</a>

				</div>
			</div>
			<div class="col-md-9">
				@if(session()->has('message-success'))
				<div class="alert alert-success mb-10 background-success" role="alert">
					{{ session()->get('message-success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				<div class="tab-content">
					<div class="tab-pane fade show active padding_left_right mt-4" id="account-general">
						{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'profile_general',
						'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
						<input type="hidden" name="profile_general" id="profile_general_url" value="profile_general">
						<input type="hidden" name="user_id" id="user_id" value="{{$editData->id}}">
						<div class="card-body media align-items-center" style="border-bottom: none;">
							    @php $image_path = ""; @endphp
					            @if(!empty($editData->icon_image_path))
					            @php $image_path = url($editData->icon_image_path); @endphp
					           <img src="//{{substr($image_path,env('AWS_BASE_URL'))}}" alt="" class="d-block ui-w-80" id="profileDisplay" style="">
					            @else
					            <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-80" id="profileDisplay">
					            @endif
							<div class="media-body ml-4">
								<div>
									<p style="color: #8c8e90;margin-bottom: 9px;padding: 2px 0px;font-size: 18px;border-bottom: 1px solid #37343629;"><strong>ID : </strong>{{isset($editData)? $editData->id : ''}}</p>
								</div>
								<label class="btn btn-outline-primary">
									Upload new photo
									<input type="file" class="account-settings-fileinput" name="userImage" id="userImage" onChange="displayImage(this)" accept="image/*">
									@if ($errors->has('userImage'))
								<span class="invalid-feedback" role="alert">
									<span class="messages"><strong>{{ $errors->first('userImage') }}</strong></span>
								</span>
								@endif
								</label> &nbsp;

							</div>
						</div>
						
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Name</label>
								<input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->name : ''}}" name="name">
								@if ($errors->has('name'))
								<span class="invalid-feedback" role="alert">
									<span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
								</span>
								@endif
							</div>
							<div class="form-group">
								<label class="form-label">English Name</label>
								<input type="text" class="form-control {{ $errors->has('english_name') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->english_name : ''}}"  name="english_name">
								@if ($errors->has('english_name'))
								<span class="invalid-feedback" role="alert">
									<span class="messages"><strong>{{ $errors->first('english_name') }}</strong></span>
								</span>
								@endif
							</div>

							<div class="form-group">
								<label class="form-label">Email</label>
								<input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->email : ''}}"  name="email">
								@if ($errors->has('email'))
								<span class="invalid-feedback" role="alert">
									<span class="messages"><strong>{{ $errors->first('email') }}</strong></span>
								</span>
								@endif
							</div>
						</div>
						<div class="mb-3 mr-4">
							<button style="margin: 0 auto; display: block;" type="submit" class="btn btn-default mt-2 dtb_custom_btn_default text-center col-lg-4">Save changes</button>
						</div>
						{{ Form::close() }}
					</div>
					<div class="tab-pane fade padding_left_right mt-4" id="account-change-password">
						{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'profile_password', 'id' => 'profile_password']) }}
						<input type="hidden" name="profile_password" id="profile_password_url" value="profile_password">
						<input type="hidden" name="user_id" value="{{$editData->id}}">
						<div class="card-body pb-2">
							<div class="form-group">
								<label class="form-label">Current password</label>
								<input type="password" class="form-control" value="@if(isset($editData)) {{ md5($editData->password)}} @endif" name="current_password" readonly>
							</div>

							<div class="form-group">
								<label class="form-label">New password</label>
								<input type="password" class="form-control" name="password" id="password">
							</div>

							<div class="form-group position-relative">
								<label class="form-label">Confirm new password</label>
								<input type="password" class="form-control" name="confirm_password" id="confirm_password">
								<div class="invalid-tooltip">Password & Confirm password doesn't match.</div>
							</div>
						</div>
						<div class="mb-3 mr-4">
							<button style="margin: 0 auto; display: block;" type="submit" class="btn btn-default mt-2 dtb_custom_btn_default text-center col-lg-4">Save changes</button>
						</div>
						{{ Form::close() }}
					</div>
					<div class="tab-pane fade padding_left_right mt-4" id="account-info">
						{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'profile_info', 'id' => 'profile_info']) }}
						<input type="hidden" name="profile_info" id="profile_info_url" value="profile_info">
						<input type="hidden" name="user_id" value="{{$editData->id}}">
						<div class="card-body pb-2">
							<div class="form-group">
								<label class="form-label">Bio</label>
								<textarea name="introduce" class="form-control" rows="5">@if(isset($editData)) {{ $editData->introduce}} @endif</textarea>
							</div>
							
							<div class="form-group">
								<label class="form-label">Country</label>
								<input  type="text" class="form-control" value="@if(isset($editData)) {{ $editData->country}} @endif" name="country">
							</div>
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
							</div>
						<div class="mb-3 mr-4">
							<button style="margin: 0 auto; display: block;" type="submit" class="btn btn-default mt-2 dtb_custom_btn_default text-center col-lg-4">Save changes</button>
						</div>
							{{ Form::close() }}
						</div>
						<div class="tab-pane fade padding_left_right mt-4" id="account-social-links">
							{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'profile_links', 'id' => 'profile_links']) }}
							<input type="hidden" name="profile_links" id="profile_links_url" value="profile_links">
							<input type="hidden" name="user_id" value="{{$editData->id}}">
							<div class="card-body pb-2">
								<div class="form-group">
									<label class="form-label">URL 1</label>
									<input type="text" class="form-control" value="@if(isset($editData)){{$editData->url1}} @endif" name="url1">
								</div>
								<div class="form-group">
									<label class="form-label">URL 2</label>
									<input type="text" class="form-control" value="@if(isset($editData)){{$editData->url2}} @endif" name="url2">
								</div>
								<div class="form-group">
									<label class="form-label">URL 3</label>
									<input type="text" class="form-control" value="@if(isset($editData)){{$editData->url3}} @endif" name="url3">
								</div>
								<div class="form-group">
									<label class="form-label">URL 4</label>
									<input type="text" class="form-control" value="@if(isset($editData)){{$editData->url4}} @endif" name="url4">
								</div>
							</div>
							<div class="mb-3 mr-4">
							<button style="margin: 0 auto; display: block;" type="submit" class="btn btn-default mt-2 dtb_custom_btn_default text-center col-lg-4">Save changes</button>
						</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection