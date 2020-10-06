@if(!empty($allUsers))
@foreach($allUsers as $allUser)
<tr class="odd" role="row">
	<td class="sorting_1">{{$allUser->name}}</td>
	<td>{{$allUser->email}}</td>
	<td>
		@if(isset($allUser->role))
		{{$allUser->role_name}}
		@endif
	</td>
	<td>
		@if(isset($allUser->language_id))
		{{$allUser->language_name}}
	    @endif
	</td>
	<td>{{$allUser->timezone_name}}</td>
	<td><span class="badge badge-outline-success">10.12PM</span></td>
	<td class="text-center text-nowrap" style="color: #4E5155;">
		<a class="action_icon_color" href="{{route('settings-users.edit', $allUser->id)}}"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
		<a href="{{url('delete_user_view/'.$allUser->id)}}" class="modalLink action_icon_color" data-modal-size="modal-md"><span class="glyphicon glyphicon-trash"></span></a>
		
	</td>
</tr>
@endforeach
@else
<tr>
	<td colspan="7" class="text-center text-danger">No User Found</td>
</tr>
@endif
