<table id="table_id2" class="table table-striped table-bordered col-lg-12" cellspacing="0" width="100%" style="border-radius: 5px;">
  <thead>
    <tr>
      <th>Name</th>
      <th>File Size</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
   @if(isset($userFiles))
   @if(count($userFiles)>0)
   @foreach($userFiles as $value)
   <tr>
    <td>{{$value->file_name}}</td>
    <td>{{$value->file_size/100 }}  KB</td>
  
    <td>{{date('d-M-Y', strtotime($value->date))}}</td>
    <td>
      <div class="d-flex">
        <!-- <button class="btn btn-success mr-2" data-toggle="modal" data-target="#editmyModal"><span class="dripicons-document-edit"></span></button> -->
        <button class="btn btn-danger mr-2 delete_files" file_id="{{$value->id}}"><span class="dripicons-trash"></span></button>
       
      </div>
    </td>
  </tr>
  @endforeach
  @else
  <tr><td colspan="4">No Files has been uploaded Yet</td></tr>
  @endif
  @endif


</tbody>
</table>

<script type="text/javascript">
  $(".delete_files").click(function(e){
    e.preventDefault();
    
     if (confirm("Are you sure?")) {
        var file_id = $(this).attr('file_id');
        
        form_data = $(".files_wrapper").serialize();
    var url = $("#url").val();

    $.ajax({
      type: "POST",
      data: form_data,
      url: url+"/delete_file/"+file_id,
      success: function(data) {
        $('.files_success').show();
        // $("#allUserstbody").empty();
        $(".files_wrapper_data").html(data);
        //$("#message").val('');
        $(this).parent('li').remove();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {}
    });
    }
    else{

    }
  });
</script>