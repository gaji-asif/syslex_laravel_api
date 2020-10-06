{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'change_to_staff/'.$id,
'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
<div class="col-md-12">
	<label class="control-label">Change Role:</label>
	<select class="form-control" name="role" required="">
		@foreach($roles as $role)
		<option value="{{$role->id}}">{{$role->role_name}}</option>
		@endforeach
	</select>
</div>
<br><br>
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>
{{ Form::close()}}