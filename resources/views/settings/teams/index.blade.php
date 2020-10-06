@extends('master_main')
@section('mainContent')
<style type="text/css">
	.form-control{
		border-radius: 0px;
	}
</style>
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
				<div class="card-body padding_left_right">
					<h6 class="card_body_header" style="padding-left: 0px;">Teams ({{count($teams)}})</h6>
					<div class="teams_wrapper">
					  @if(isset($editData))
				      {{ Form::open(['class' => '', 'files' => true, 'url' => 'settings-teams/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
				      @else
				      {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'settings-teams',
				      'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
				      @endif
					<!-- Filters -->
					<div class="mb-4 pl-2">
						<div class="form-row align-items-center">
							<div class="mb-4 mr-3">
								<label class="form-label">@php echo (isset($editData)) ? 'Edit' : 'Add'; @endphp Team</label>
								<input name="team_name" type="text" class="form-control {{ $errors->has('team_name') ? ' is-invalid' : '' }}" placeholder="Team Name" value="@if(isset($editData)) {{$editData->team_name}} @endif">
									@if ($errors->has('team_name'))
									<span class="invalid-feedback" role="alert">
										<span class="messages"><strong>{{ $errors->first('team_name') }}</strong></span>
									</span>
									@endif
							</div>
							<div class="form-group row col-md-3 pt-3">
								<div class="col-sm-10 ml-sm-auto">
									<button type="submit" class="btn btn-primary dtb_custom_btn_default">@php echo (isset($editData)) ? 'Update' : 'Add'; @endphp</button>
								</div>
							</div>
						</div>
					</div>
					{{ Form::close()}}

						<div class="row">
							@if(isset($teams))
							@if(count($teams)>0)
							@foreach($teams as $team)
							<div id="dragula-left-drag-handles" class="col-12">
								<div class="dragula-example card card-condenced mb-2" style="border-radius: 0px;">
									<div class="card-body">
										<font class="bold_and_font_16">{{$team->team_name}}</font> - ({{$team->total_members}}) Member
										<a href="{{url('delete_team_view/'.$team->id)}}" class="modalLink pull-right ml-2" data-modal-size="modal-md"><span class="glyphicon glyphicon-trash"></span></a>
										
										<a href="{{route('settings-teams.edit', $team->id)}}" class="pull-right action_icon_color"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;

										<a class="pull-right mr-3" href="{{route('add-member', $team->id)}}"><img src="{{asset('images/add_member.png')}}"></a>
										</div>
									</div>
									
								</div>
								@endforeach
								@else
								<div class="col-md-12">
									<div class="alert alert-danger mb-10 background-success w-100 text-center" role="alert">
										Their are no Teams created.
									</div>
							   </div>
								@endif
								@endif
							</div>
						  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endsection