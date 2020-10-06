<div class="row">
<div class="col-md-12">
  <div class="form-block mb-4">
    <!-- <form enctype="multipart/form-data" action="#" method="post"> -->
      @if(isset($editData))
      {{ Form::open(['class' => '', 'files' => true, 'url' => 'goal/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
      @else
      {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'goal',
      'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
      @endif

      <div class="form-row">
        <div class="form-group col-md-12">
          <div class="">

          <div class="form-group">
            <label class="control-label">Goal Image</label>
            <div class="new-image" id="image-preview" style="width: 100%;">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="upload_document" id="image-upload">
            </div>
        </div>


          <div class="form-row">
            <label class="control-label">Goal Name</label>
            <input type="text" class="form-control" name="goal_name" required="" value="@if(isset($editData)) {{$editData->goal_name}} @endif">
          </div>



          <div class="action-button mt-3 text-right">
            @if(isset($editData))
            <input type="submit" name="save" value="Update" class="btn btn-embossed btn-success">
            @else
            <input type="submit" name="save" value="Create" class="btn btn-embossed btn-success">
            @endif

           <button type="button" class="btn btn-danger modal_close" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    {{ Form::close()}}
  </div>
</div>
</div>

<script type="text/javascript">
  $(".modal_close").click(function(){
     var APP_URL = {!! json_encode(url('/')) !!};
     $("#showDetaildModal").hide();
     window.location.href = APP_URL+'/goal';
  });
</script>

<script src="{{asset('assets_new/js/custom.js')}}"></script>