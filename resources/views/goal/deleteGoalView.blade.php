{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'goal/'.$id,
'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
<button class="btn btn-secondary btn-default pull-right ml-2 modal_close" data-dismiss="modal">Cancel</button>
{{ Form::close()}}


<script type="text/javascript">
	$(".modal_close").click(function(){
	   var APP_URL = {!! json_encode(url('/')) !!};
	   $("#showDetaildModal").hide();
	   window.location.href = APP_URL+'/goal';
	});
</script>