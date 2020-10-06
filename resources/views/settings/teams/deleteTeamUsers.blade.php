{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'settings-teams/'.$user_id,
'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>
<input type="hidden" name="team_id" value="{{$team_id}}">
{{ Form::close()}}