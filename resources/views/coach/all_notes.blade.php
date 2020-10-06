<ul>
	@if(isset($userNotes))
	@if(count($userNotes)>0)
	@foreach($userNotes as $value)
	<li>
		<span>At {{date('d-M-Y h:i:s', strtotime($value->date))}}</span>
		<p>{{$value->note}}</p>
		<div class="d-flex">
			<!-- <button class="btn btn-success mr-2 edit_notes"><span class="dripicons-document-edit"></span></button> -->
			<button class="btn btn-danger delete_notes" note_id="{{$value->id}}"><span class="dripicons-trash"></span></button>
		</div>
	</li>
	@endforeach
	@else
<li>No Notes Available</li>
	@endif


	@endif
</ul>



<script type="text/javascript">
	$(".delete_notes").click(function(e){
    e.preventDefault();
    
     if (confirm("Are you sure?")) {
        var note_id = $(this).attr('note_id');
        
        form_data = $(".note_wrapper").serialize();
    var url = $("#url").val();

    $.ajax({
      type: "POST",
      data: form_data,
      url: url+"/delete_note_c/"+note_id,
      success: function(data) {
      	$('.notes_success').show();
        // $("#allUserstbody").empty();
        $(".all_notes").html(data);
        $("#message").val('');
        $(this).parent('li').remove();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {}
    });
    }
    else{

    }
  });
</script>