@extends('master')
@section('mainContent')
<h4 class="font-weight-bold py-3 mb-4">
	<span class="text-muted font-weight-light">Dashboard /</span> Roles
</h4>

<div class="row">
	<div class="col-lg-4">
		<div class="card mb-4">
			@if(session()->has('message-success'))
				<div class="alert alert-success mb-10 background-success" role="alert">
					{{ session()->get('message-success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@elseif(session()->has('message-danger'))
			<div class="alert alert-danger">
				{{ session()->get('message-danger') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			<h6 class="card-header">
				Add New Role
			</h6>
			@if(isset($editData))
			{{ Form::open(['class' => '', 'files' => true, 'url' => 'role/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
			@else
			{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'role',
			'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
			@endif
			<div class="card-body">
				<div class="form-group">
						<label class="form-label">Role Name</label>
						<input type="text" class="form-control {{ $errors->has('role_name') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->role_name : ''}}" placeholder="Role" name="role_name">
						@if ($errors->has('role_name'))
						<span class="invalid-feedback" role="alert">
							<span class="messages"><strong>{{ $errors->first('role_name') }}</strong></span>
						</span>
						@endif
					</div>
					<button type="submit" class="btn btn-default mt-4">Submit</button>
			 </div>
			{{ Form::close()}}
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card">
			<h6 class="card-header">
				All Roles
			</h6>
			<div class="card-datatable table-responsive">
				<table class="datatables-demo table table-striped table-bordered">
					<thead>
						<tr>
							<th>#SL</th>
							<th>Role Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@php $sl = 1; @endphp
						@if(isset($roles))
							@foreach($roles as $role)
								<tr class="odd gradeX">
									<td>{{$sl++}}</td>
									<td>{{$role->role_name}}</td>
									<td>
										<a href="{{ url('role/'.$role->id.'/edit') }}"  title="edit">
											<button type="button" class="btn btn-info action-icon btn-sm"><i class="fa fa-edit"></i></button>
										</a>
										 <a class="modalLink" title="Delete" data-modal-size="modal-md" href="#">
											<button type="button" class="btn btn-danger action-icon btn-sm"><i class="fa fa-trash"></i></button>
										</a>
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
@endsection