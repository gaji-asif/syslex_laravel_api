
<table id="table_id2" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
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
    <td>{{substr($value->file_name, 31)}}</td>
    <td>{{$value->file_size/100 }}  KB</td>
  
    <td>{{date('d-M-Y', strtotime($value->created_at))}}</td>
    <td>
      <div class="d-flex">
        <!-- <button class="btn btn-success mr-2" data-toggle="modal" data-target="#editmyModal"><span class="dripicons-document-edit"></span></button> -->
        <button style="color: #FFFFF;" class="btn btn-danger btn-sm mr-2 delete_files" file_id="{{$value->id}}"><span class="dripicons-trash" style="margin-bottom: 0px !important; color: #FFFFFF;"></span></button>
       
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