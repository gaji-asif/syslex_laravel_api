@extends('master')
@section('mainContent')

<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
    <div class="card overflow-hidden">
  <div class="row no-gutters row-bordered row-border-light">


    <div class="col-md-2 pt-0">
      @include('settings.generalSettings.general_settings_sidebar')
    </div>


    <div class="col-md-10">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="account-general">

          <div class="card-body media align-items-center pb-2">
            <div class="media-body">
              <button type="button" class="btn btn-outline-primary btn-sm md-btn-flat" data-toggle="modal" data-target="#issuecatmodal"><i class="fa fa-plus" style="font-size:12px"></i> Add Category</button>
            </div>
          </div>

          <hr class="border-light m-0">

          <div class="card-body">


            <table class="table table-bordered table-striped dtb_custom_tbl_common" id="issuecatlist">

              <thead>
                <tr>
                  <th style="width: 13.6px;"></th>
                  <th> List of Categories</th>
                  <th style="width: 70px !important"> Points</th>
                  <th style="width: 190px !important"> Details</th>
                  <th style="width: 13.6px;">Action</th>
                </tr>
              </thead>


              <tbody id="cattblecontent">
                @forelse ($dtbissuecategory as $issuecat)

                <tr class="row1" data-id="{{ $issuecat->id }}" id="{{$issuecat->id}}">

                  <td class="sorted" data-value="">
                   <div style="display: flex;color: #00000063;"> <i class="fas fa-th-list d-block"></i></div>
                    
                  </td>
                  <td data-value="{{ $issuecat->category_name }}">{{ $issuecat->category_name }}</td>
                  <td data-value="{{ $issuecat->points }}">{{ $issuecat->points }}</td>

                  <td data-value="{{ $issuecat->details }}">
                    <?php 
                      $string = $issuecat->details;
                      $words  = array_slice(explode(' ', $string), 0, 3);
                      echo $output = implode(' ', $words)."..";
                    ?>
                  </td>

                  <td data-value="{{ $issuecat->id }}" style="display: flex;">
                    <a href="#"  data-toggle="modal" data-target="#issuecateditmodal" class="mr-2 issueeditmodal" value="{{ $issuecat->id }}" data-issuecat="{{$issuecat->category_name}}" data-projectid='{{$id}}' data-points='{{ $issuecat->points }}' data-details='{{ $issuecat->details }}'><i class="far fa-edit d-block"></i><a>
              
                    <a href="#" data-toggle="modal" data-target="#issuedelconfirmmodal" class="issuedelconfirmmodal" value="{{ $issuecat->id }}"><i class="far fa-trash-alt d-block"></i></a>
                    
                  </td>
                </tr>
                @empty
                <p>No data</p>
                @endforelse
              </tbody>
            </table>
            <span style="display: flex;margin-left: -10px;">
                <i style="color: #00000063;margin-top: 3px;margin-right: 4px" class="fas fa-th-list d-block"></i> Drag  to rearrange order.
            </span>
          </div>
        </div>
      </div>
    </div>



<!-- Modal template -->
<div class="modal fade" id="issuecatmodal">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content" id="issuecatform">

      <div class="modal-header">
        <h5 class="modal-title">
          Add Category
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
      </div>
      <div class="modal-body">

            <div class="errmsg alert alert-danger" style="display:none">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>



        <div class="form-row mb-3">
          <div class="form-group col-5 mb-0">
            <label class="form-label">Category Name</label>
            <input required type="text" id="category_name" name="category_name" value="{{ old('category_name') }}" class="form-control required" placeholder="">
          </div>          
          <div class="form-group col-3 mb-0">
            <label class="form-label">Points</label>
            <input required type="number" id="points" name="points" value="{{ old('points') }}" class="form-control" placeholder="">
          </div>
          <div class="form-group col-4 mb-0">
          </div>
        </div>  


        <div class="form-row mb-3">
          <div class="form-group col-8 mb-0">
            <label class="form-label">Details</label>
            <textarea class="form-control" name="details" id="details" rows="3"></textarea>
          </div>          
          <div class="form-group col-4 mb-0">
          </div>
        </div>           

        <br>
        <label class="form-label">Existing Categories</label>
         <div class="form-row mt-1">

          <div class="form-group col" style="padding: 17px 8px 3px;background: #00000012;">
            <div class="demo-inline-spacing">
               @forelse ($dtbissuecategory as $issuecat)
              <span class="existingitembtn btn btn-sm" style="">{{ $issuecat->category_name }}</span>
              @empty
                <p>No users</p>
              @endforelse 
            </div>
          </div>
        </div>

        <input type="hidden" name="project_id" value="{{$id}}">



      </div>
      <div class="modal-footer">
        <button id="issuecatclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>



<!-- MODAL FOR EDIT -->

<!-- Modal template -->
<div class="modal fade" id="issuecateditmodal">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content" id="issuetypupdate">

      <div class="modal-header">
        <h5 class="modal-title">
          Edit Category
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
      </div>
      <div class="modal-body">

            <div class="errmsg alert alert-danger" style="display:none">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        <div class="form-row mb-3">
          <div class="form-group col-5 mb-0">
            <label class="form-label">Category Name</label>
            <input required type="text" id="edit_category_name" name="category_name" value="" class="form-control required" placeholder="">

          </div>
          <div class="form-group col-3 mb-0">
            <label class="form-label">Points</label>
            <input required type="number" id="edit_points" name="points" value="{{ old('points') }}" class="form-control" placeholder="">
          </div>
          <div class="form-group col-4 mb-0">
          </div>
        </div>  

        <div class="form-row mb-3">
          <div class="form-group col-8 mb-0">
            <label class="form-label">Details</label>
            <textarea class="form-control" name="details" id="edit_details" rows="3"></textarea>
          </div>          
          <div class="form-group col-4 mb-0">
          </div>
        </div>  


<br>   


        <label class="form-label">Existing Categories</label>
         <div class="form-row mt-1">

          <div class="form-group col" style="padding: 17px 8px 3px;background: #00000012;">
            <div class="demo-inline-spacing">
               @forelse ($dtbissuecategory as $issuecat)
              <span class="existingitembtn btn btn-sm">{{ $issuecat->category_name }}</span>
              @empty
                <p>No users</p>
              @endforelse 
            </div>
          </div>
        </div>

        <input type="hidden" name="project_id" value="{{$id}}">
        <input type="hidden" class="newlycolor" name="newlycolor" value="">


      </div>
      <div class="modal-footer">
        <button id="issuecatclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updateissuesavebtn">Save</button>
      </div>
    </form>
  </div>
</div>







  <!-- Modal -->
  <div class="modal fade" id="issuedelconfirmmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #f8d7da;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title">Are you sure to delete?</h6>
        </div>
<!--         <div class="modal-body">
          <p>Some text in the modal.</p>
        </div> -->
        <div class="modal-footer">
          <button  value="{{ $issuecat->id ?? '' }} type="button" class="btn btn-danger issuecatdelbtn" data-dismiss="modal">YES</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
</div>
  </div>
  <div class="col-lg-2"></div>
</div>



<style>
  .btn-outline-primary {
    border: 1px solid #38587d;
    border-radius: 0px;
    color: #38587d;
}  

.btn-outline-primary:hover {
  background: #718AA8;
  color: white;
}
</style>
<script type="text/javascript">
$( document ).ready(function() {

$('body').on('click','.issueeditmodal',function(e){

  e.preventDefault();

var issueid = $(this).attr('value');
var projectid = $(this).attr('data-projectid');
var category_name = $(this).attr('data-issuecat');
var category_points = $(this).attr('data-points');
var category_details = $(this).attr('data-details');
var oldcolor = $(this).attr('data-issuecolor');


$("#edit_category_name").val(category_name);
$("#edit_points").val(category_points);
$("#edit_details").val(category_details);

$(".editcolors").val(oldcolor);
$('.editcolors').css('background',oldcolor)


$('body').on('click','.updateissuesavebtn',function(e){

  e.preventDefault();

  var issuevalue = $("#edit_category_name").val();
  var catpoints = $("#edit_points").val();
  var catdtails = $("#edit_details").val();

  $('input[name="color"]:checked').each(function() {
    var colors = (this.value); 
    $(".newlycolor").val(colors);
  });

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

  var lastcolor = $(".newlycolor").val();

    $.ajax({
        url: 'category/'+issueid,
        type: 'POST',
        data: {
            issueid:issueid,
            projectid: projectid,
            category_name: issuevalue,
            points: catpoints,
            details: catdtails,
            color: lastcolor,
            oldcolor: oldcolor,
        },
        success: function(response){
          // alert(response);
          $('#issuecateditmodal').modal('hide');
          $("#msgcontainer").show();
          if (response) {
            $.iaoAlert({msg: "Data has been updated",
            type: "success",
            mode: "dark",})
            // $("#successmsg").html(response);
            // setTimeout(function() {
            //         $("#msgcontainer").fadeOut("slow");
            //     }, 2000 );
          }
          setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
          }, 1500);
        }
    });
});




});








// issue delete
$('body').on('click','.issuedelconfirmmodal',function(e){
e.preventDefault();
var id = $(this).attr('value');
//when confirm modal clicked
$('body').on('click','.issuecatdelbtn',function(e){
  e.preventDefault();
  issuedelete();
});


function issuedelete() {

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


        $.ajax({
            url: 'category/'+id,
            type: 'DELETE',
            data: {
            "id": id
        },
            success: function(response){

            $.iaoAlert({msg: "Data has been deleted",
            type: "success",
            mode: "dark",});

              //   $("#msgcontainer").show();
              //   if (response) {
              //       $("#successmsg").html(response);
              //       setTimeout(function() {
              //           $("#msgcontainer").fadeOut("slow");
              //       }, 2000 );
              // }

              setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1000);
            }
        });
}

});

// PROJECT LIST DRAG DROP SORTING
$( "#cattblecontent" ).sortable({
  items: "tr",
  cursor: 'move',
  opacity: 0.6,
  update: function() {
    sendOrderToServer();
  }
});

function sendOrderToServer() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var order = [];
    $('tr.row1').each(function(index,element) {
      order.push({
        id: $(this).attr('data-id'),
        position: index+1
      });
        //alert(JSON.stringify(order, null, 4));exit();
    });
    $.ajax({
        url: 'category',
        type: 'PUT',
        data: {
            order:order,
           _token: '{{csrf_token()}}'
        },
        success: function(response){
          $("#msgcontainer").show();
          if (response) {
          $.iaoAlert({msg: "Ordering Successfull",
            type: "success",
            mode: "dark",})
          }
        },
        error: function() {
          alert('Error occurs!');
       }
    });
  }
  });
</script>



@endsection