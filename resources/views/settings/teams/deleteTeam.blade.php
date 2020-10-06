{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'delete_team/'.$team_id,
'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>
{{ Form::close()}}