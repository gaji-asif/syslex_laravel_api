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
					<h6 class="card_body_header">Team - {{$team_details->team_name}}
					 	<a href="{{route('settings-teams.index')}}"><button class="pull-right btn btn-success btn-sm dtb_custom_btn_default">All Teams</button></a>
					 </h6>
					{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-users-team',
					'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
					
					<!-- Filters -->
					<div class="mb-4 pl-2">
						<div class="form-row align-items-center">
							<div class=" col-lg-4 mb-4 mr-3">
								<label class="form-label">Add Member</label>
								<select style="border-radius: 0px;" class="user-edit-multiselect form-control w-100 {{ $errors->has('users') ? ' is-invalid' : '' }} no_border_radius" multiple name="users[]">
										@if(isset($users))
											@foreach($users as $user)
												<option value="{{$user->id}}">{{$user->name}}</option>
											@endforeach
										@endif
										</select>
										@if ($errors->has('users'))
									<span class="invalid-feedback" role="alert">
										<span class="messages"><strong>{{ $errors->first('users') }}</strong></span>
									</span>
									@endif
							</div>
							<div class="form-group row col-md-3 pt-3">
								<input type="hidden" name="team_id" value="{{$team_id}}">
								<div class="col-sm-10 ml-sm-auto">
									<button type="submit" class="btn btn-primary dtb_custom_btn_default">Add</button>
								</div>
							</div>
						</div>
					</div>


						{{ Form::close()}}
						<div class="card">
							<h6 class="card-header">All Members ({{count($allTeamsMembers)}})</h6>
							<div class="card-datatable table-responsive">
								<table class="dtb_custom_tbl_common datatables-demo table table-striped table-bordered">
									<thead>
										<tr>
											<th>User Name</th>
											<th>Role</th>
											<th>User ID</th>
											<th>E-mail</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="allUserstbody">
										@if(!empty($allTeamsMembers))
										@foreach($allTeamsMembers as $allTeamsMember)
										<tr class="odd" role="row">
											<td>
												<span class="mr-2">
													@if(!empty($allTeamsMember->icon_image_path))
													<img src="{{asset($allTeamsMember->icon_image_path)}}" alt="" class="ui-w-30 rounded-circle">
													@else
													<img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="ui-w-30 rounded-circle">
													@endif
												</span>
												<span>{{$allTeamsMember->name}}</span>
											</td>
											<td>{{$allTeamsMember->role_name}}</td>
											<td>{{$allTeamsMember->ud_id}}</td>
											<td>{{$allTeamsMember->email}}</td>
											<td class="text-center text-nowrap">
												<a href="{{url('delete_view/'.$allTeamsMember->user_id.'/'.$allTeamsMember->team_id)}}" class="modalLink" data-modal-size="modal-md"><span class="pull-right btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> </span></a>
											</td>
										</tr>
										@endforeach
										@else
										<tr>
											<td colspan="7" class="text-center text-danger">No Data Found</td>
										</tr>
										@endif

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