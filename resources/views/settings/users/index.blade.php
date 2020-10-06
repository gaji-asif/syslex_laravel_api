@extends('master_main')
@section('mainContent')
<div class="container pt-5">
	<div class="row">
		<div class="col-lg-3">
			@include('settings.developerSettings.developer_settings_sidebar')
		</div>

		<div class="col-lg-9 settgs_right_content">
			<div class="card mb-4 no_border">
				@if(session()->has('message-success'))
				<div class="alert success_message mb-10 background-success" role="alert">
					{{ session()->get('message-success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				
				<div class="card-body">
					 <h6 class="card_body_header">Users List
					 	<a href="{{route('settings-users.create')}}"><button class="pull-right btn btn-success btn-sm dtb_custom_btn_default">Add New User</button></a>
					 </h6>
					{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'search-users',
					'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search-users']) }}
					<!-- Filters -->
					<div class="mb-4 pl-2">
						<div class="form-row align-items-center">
							<div class="mb-4 mr-4">
								<label class="form-label">Role</label>
								<select class="custom-select" name="role">
									@if(isset($roles))
									<option value="">Select a Role</option>
									@foreach($roles as $role)
									<option value="{{$role->id}}">{{$role->role_name}}</option> 
									@endforeach
									@endif
								</select>
							</div>
							<div class="mb-4 mr-5" style="margin-right: 5px;">
								<label class="form-label">Team</label>
								<select class="custom-select" name="team_id">
									@if(isset($teams))
									<option value="">Select a Team</option>
									@foreach($teams as $team)
									<option value="{{$team->id}}">{{$team->team_name}}</option>
									@endforeach
									@endif
								</select>
							</div>

							<div class="col-xl-2 mb-4 pt-4">
								<button type="submit" class="btn btn-success dtb_custom_btn_default">Search</button>
							</div>
						</div>
					</div>
					<div class="col-lg-12 text-center loader_class" style="display: none;">
						<img class="img-responsive" src="{{asset('assets_/img/loader.gif')}}" height="80" width="80">
					</div>
					{{ Form::close()}}
					<div class="card no_border">
						<div class="table-responsive">
							<table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common">
								<thead>
									<tr>
										<th>Name</th>
										<th>E-mail</th>
										<th>Role</th>
										<th>Language</th>
										<th>Timezone</th>
										<th>Last Login</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="allUserstbody">
									@include('settings.users.allUsers')
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection