{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'workout_category/'.$id,
'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
<button type="button" class="modal_close btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>
{{ Form::close()}}

<script type="text/javascript">
  $(".modal_close").click(function(){
     var APP_URL = {!! json_encode(url('/')) !!};
     $("#showDetaildModal").hide();
     window.location.href = APP_URL+'/workout_category';
  });
</script>