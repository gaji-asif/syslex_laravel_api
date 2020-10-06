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
              <button type="button" class="btn btn-outline-primary btn-sm md-btn-flat" data-toggle="modal" data-target="#dtbversionmodal"><i class="fa fa-plus" style="font-size:12px"></i> Add Version</button>
            </div>
          </div>

          <hr class="border-light m-0">

          <div class="card-body">


            <table class="table table-bordered table-striped dtb_custom_tbl_common" id="dtbversionlist">

              <thead>
                <tr>
                  <th style="width: 13.6px;"></th>
                  <th> Version Name</th>
                  <th> Start Date</th>
                  <th> End Date</th>
                  <th> Color</th>
                  <th style="width: 13.6px;">Action</th>
                </tr>
              </thead>


              <tbody id="versioncontenttbl">
                @forelse ($DtbGenVersion as $dtbversion)

                <tr class="row1" data-id="{{ $dtbversion->id }}" id="{{$dtbversion->id}}">

                  <td class="sorted" data-value="">
                   <div style="display: flex;color: #00000063;"> <i class="fas fa-th-list d-block"></i></div>
                    
                  </td>
                  <td data-value="">{{ $dtbversion->version_name }}</td>
                   <td data-value="">{{ date( 'd-M-Y',strtotime($dtbversion->start_date)) }}</td>
                  <td data-value="">{{ date( 'd-M-Y',strtotime($dtbversion->end_date)) }}</td>
                  <td data-value="{{ $dtbversion->version_name }}" style="text-align: center;"><button class="btn btn-sm" style="color:white;background: {{ $dtbversion->color }}">{{ $dtbversion->version_name }}</button></td>
                  <td data-value="{{ $dtbversion->id }}" style="display: flex;">
                     <a href="#"  data-toggle="modal" data-target="#dtbversioneditmodal" class="mr-2 versioneditmodal" value="{{ $dtbversion->id }}" data-issuecolor="{{$dtbversion->color}}" data-dtbversion="{{$dtbversion->version_name}}" data-dtbversionenddate="{{ empty(old('end_date')) ? $dtbversion->end_date : old('end_date')  }}" data-dtbversionstartdate="{{ empty(old('start_date')) ? $dtbversion->start_date : old('start_date')  }}" data-projectid='{{$id}}'><i class="far fa-edit d-block"></i><a>
              

                    <a href="#" data-toggle="modal" data-target="#versiondelconfirmmodal" class="versiondelconfirmmodal" value="{{ $dtbversion->id }}"><i class="far fa-trash-alt d-block"></i></a>
                    
                  </td>
                </tr>
                @empty
                <p>No data</p>
                @endforelse
              </tbody>
            </table>
            <span style="">
                <i style="    color: #00000063; margin-top: 3px; margin-right: 4px;float: left;margin-left: 0px;" class="fas fa-th-list d-block"></i> Drag  to rearrange order.
            </span>

          </div>



        </div>


      </div>
    </div>



<!-- Modal template -->
<div class="modal fade" id="dtbversionmodal">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content" id="dtbversionform">

      <div class="modal-header">
        <h5 class="modal-title">
          Add Version
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




        <div class="form-row">
          <div class="form-group col-md-6">
           <label class="form-label">Version</label>
            <input required type="text" id="version_name" name="version_name" value="{{ old('version_name') }}" class="form-control required" placeholder="">
          </div>
          <br>
        </div> 

        <div class="form-row mt-1">

            <div class="form-group col-md-5">
                <label class="form-label">Start Date</label>
                <input type="date" id="start_date" data-date="" data-date-format="YYY MMMM DD" name="start_date" class="form-control" value="">
                
          </div>

          <div class="form-group col-md-5">
         {{--  <label class="custom-control mt-0 ml-0"> --}}
            <label class="form-label">End Date</label>
                <input type="date" id="end_date" data-date="" data-date-format="YYY MMMM DD" name="end_date" class="form-control" value="">
          </div>
         {{--  </label> --}}
         <div class="col-md-2"></div>
          </div> 



          <div class="form-row mt-1">
          <div class="form-group col">
          <label class="form-label">Choose any color to set the color for this status</label>
          <div class="demo-inline-spacing issuebgcolorholder">

          <label class="switcher switcher-square">
          <input type="checkbox" name="color" value="#d73a4a" id="color" class="switcher-input required editcolor">
          <span class="switcher-indicator">
          <span class="switcher-yes"></span>
          <span class="switcher-no red"></span>
          </span>
          <span class="switcher-label"></span>
          </label>

          <label class="switcher switcher-square">
          <input type="checkbox" class="switcher-input editcolor"  name="color" value="#b6DD05">
          <span class="switcher-indicator">
          <span class="switcher-yes"></span>
          <span class="switcher-no green"></span>
          </span>
          <span class="switcher-label"></span>
          </label>

          <label class="switcher switcher-square">
          <input type="checkbox" class="switcher-input editcolor"  name="color" value="#0075ca">
          <span class="switcher-indicator">
          <span class="switcher-yes"></span>
          <span class="switcher-no blue"></span>
          </span>
          <span class="switcher-label"></span>
          </label>


          <label class="switcher switcher-square">
          <input type="checkbox" class="switcher-input editcolor" name="color" value="#e4e669">
          <span class="switcher-indicator">
          <span class="switcher-yes"></span>
          <span class="switcher-no yellow"></span>
          </span>
          <span class="switcher-label"></span>
          </label>


          <label class="switcher switcher-square">
          <input type="checkbox" class="switcher-input editcolor" name="color" value="#4caf93">
          <span class="switcher-indicator">
          <span class="switcher-yes"></span>
          <span class="switcher-no color5"></span>
          </span>
          <span class="switcher-label"></span>
          </label>




          <label class="switcher switcher-square">
          <input type="checkbox" class="switcher-input editcolor" name="color" value="#f42858">
          <span class="switcher-indicator">
          <span class="switcher-yes"></span>
          <span class="switcher-no color6"></span>
          </span>
          <span class="switcher-label"></span>
          </label>


          <label class="switcher switcher-square" style="padding-left: 0px">
          <input type="text" placeholder="put cursor to pick color" value="" class="editcolor jscolor {required:false,hash:true,refine:false,width:243, zIndex:99999, height:150,borderColor:'#FFF', backgroundColor:'#666'} " style="border: 1px solid #80808075;border-radius: 3px;padding: 2px 5px;font-size: 13px;" value="#f3f3f3">
          <input type="checkbox" id="inptcolorvalue"  name="color" style="display: none;">
          </label>


          </div>
          </div>
          </div>     




          <label class="form-label mt-3">Existing Version</label>
         <div class="form-row mt-1">

          <div class="form-group col" style="padding: 17px 8px 3px;background: #00000012;">
            <div class="demo-inline-spacing">
               @forelse ($DtbGenVersion as $dtbversion)
              <span  style="background-color: {{ $dtbversion->color ?? '' }} !important;" class="existingitembtn btn btn-sm">{{ $dtbversion->version_name }}</span>
              @empty
                <p>No users</p>
              @endforelse 
            </div>
          </div>
        </div>

        <input type="hidden" name="project_id" value="{{$id}}">



      </div>
      <div class="modal-footer">
        <button id="dtbversionclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>



<!-- MODAL FOR EDIT -->

<!-- Modal template -->
<div class="modal fade" id="dtbversioneditmodal">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content" id="issuetypupdate">

      <div class="modal-header">
        <h5 class="modal-title">
          Edit Version
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


        <div class="form-row">
          <div class="form-group col-md-6">
           <label class="form-label">Version</label>
            <input required type="text" id="edit_version_name" name="version_name" value="{{ old('version_name') }}" class="form-control required" placeholder="">
          </div>
          <br>
        <label class="ml-3">
                  <div class="form-group col pl-0 mb-0">
                    <label class="form-label">Background Color</label>
                    <span class="oldcolrolabel"><input type="button" class="btn editcolors" name="oldercolor"><br>
                  </div>
       </label>
        </div> 


        <div class="form-row mb-2">
          <div class="form-group col-md-5">
             {{--  <label class="custom-control mt-0 ml-2"> --}}
                <label class="form-label">Start Date</label>
                <input type="date" id="editstartdate" data-date="" data-date-format="YYY MMMM DD" name="start_date" class="form-control" value="">
                
              {{-- </label> --}}
          </div>         
          <div class="form-group col-md-5">
                <label class="form-label">End Date</label>
                <input type="date" id="editenddate" data-date="" data-date-format="YYY MMMM DD" name="end_date" class="form-control" value="">
          </div>
          <div class="col-md-2"></div>
        </div> 
<br>  
        <div class="form-row mt-2" style="margin-top: -15px !important">
        <div class="form-group col">
        <label class="form-label">Choose any color to change the color of this status</label>
        <div class="demo-inline-spacing issuebgcolorholder">

        <label class="switcher switcher-square">
        <input type="checkbox" name="color" value="#d73a4a" id="color" class="switcher-input required editcolor">
        <span class="switcher-indicator">
        <span class="switcher-yes"></span>
        <span class="switcher-no red"></span>
        </span>
        <span class="switcher-label"></span>
        </label>

        <label class="switcher switcher-square">
        <input type="checkbox" class="switcher-input editcolor"  name="color" value="#b6DD05">
        <span class="switcher-indicator">
        <span class="switcher-yes"></span>
        <span class="switcher-no green"></span>
        </span>
        <span class="switcher-label"></span>
        </label>

        <label class="switcher switcher-square">
        <input type="checkbox" class="switcher-input editcolor"  name="color" value="#0075ca">
        <span class="switcher-indicator">
        <span class="switcher-yes"></span>
        <span class="switcher-no blue"></span>
        </span>
        <span class="switcher-label"></span>
        </label>


        <label class="switcher switcher-square">
        <input type="checkbox" class="switcher-input editcolor" name="color" value="#e4e669">
        <span class="switcher-indicator">
        <span class="switcher-yes"></span>
        <span class="switcher-no yellow"></span>
        </span>
        <span class="switcher-label"></span>
        </label>


        <label class="switcher switcher-square">
        <input type="checkbox" class="switcher-input editcolor" name="color" value="#4caf93">
        <span class="switcher-indicator">
        <span class="switcher-yes"></span>
        <span class="switcher-no color5"></span>
        </span>
        <span class="switcher-label"></span>
        </label>




        <label class="switcher switcher-square">
        <input type="checkbox" class="switcher-input editcolor" name="color" value="#f42858">
        <span class="switcher-indicator">
        <span class="switcher-yes"></span>
        <span class="switcher-no color6"></span>
        </span>
        <span class="switcher-label"></span>
        </label>


        <label class="switcher switcher-square" style="padding-left: 0px">
        <input type="text" placeholder="put cursor to pick color" value="" class="editcolor jscolor {required:false,hash:true,refine:false,width:243, zIndex:99999, height:150,borderColor:'#FFF', backgroundColor:'#666'} " style="border: 1px solid #80808075;border-radius: 3px;padding: 2px 5px;font-size: 13px;" value="#f3f3f3">
        <input type="checkbox" id="inptcolorvalue"  name="color" style="display: none;">
        </label>


        </div>
        </div>
        </div>





        <label class="form-label">Existing Version</label>
         <div class="form-row mt-1">

          <div class="form-group col" style="padding: 17px 8px 3px;background: #00000012;">
            <div class="demo-inline-spacing">
               @forelse ($DtbGenVersion as $dtbversion)
              <span style="background-color: {{ $dtbversion->color ?? '' }} !important;" class="existingitembtn btn btn-sm">{{ $dtbversion->version_name }}</span>
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
        <button id="dtbversionclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updateversionsavebtn">Save</button>
      </div>
    </form>
  </div>
</div>







  <!-- Modal -->
  <div class="modal fade" id="versiondelconfirmmodal" role="dialog">
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
          <button  value="{{ $dtbversion->id ?? '' }} type="button" class="btn btn-danger dtbversiondelbtn" data-dismiss="modal">YES</button>
          <button type="button" class="btn btn-primary delcancelbtn" data-dismiss="modal">CANCEL</button>
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
<script src="{{asset('js/jscolor.js')}}"></script>
<script type="text/javascript">
$( document ).ready(function() {


                        $(".jscolor").on("change", function(){
                            var inputboxcolor = $(this).val();

                            if (inputboxcolor != "") {
                              $('#color-error').text('');
                              $('#inptcolorvalue').attr('checked', true);
                              $('#inptcolorvalue').val(inputboxcolor);
                            }else{
                              $('#inptcolorvalue').attr('checked', false);
                              $('#inptcolorvalue').val("");
                            }

                        });

// ##################################### CODE FOR general VERSION STARTS #########################

//form required validation code
 $("#dtbversionform").validate({
   rules: {
      version_name: {
      required: true
      },
      'color[]': {
      required: true
      }
    },
    messages: {
        version_name: {
        required: "Version Name field is required",
         },
          color: {
          required: "Select any background color",
          },  
    },
  });

//issue CAT entry form submit process
$('body').on('submit','#dtbversionform',function(e){

$.ajaxSetup({
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});
e.preventDefault();

    var formdata = $(this).serialize();
    var version_name = $('#version_name').val();
    var end_date = $('#end_date').val();
    var url = '{{ url("version") }}';

    $.ajax({
        url: 'version',
        type: 'POST',
        data: formdata,

        success: function(data){
            // $.iaoAlert({msg: "Data has been saved",
            // type: "success",
            // mode: "dark",})
            // // showdata();
            alert(data);
              $('#dtbversionmodal').modal('hide');
              document.getElementById("dtbversionform").reset();
               $.iaoAlert({msg: "Data has been saved",
              type: "success",
              mode: "dark",});
               setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1000);


        },
        error: function (request, status, error) {
            $.iaoAlert({msg: "Please fill the field",
            type: "warning",
            mode: "dark",});
            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
                $('.errmsg').show();
                $('.alert-danger').append('<p>'+value+'</p>');
              setTimeout(function() { 
                 $('.errmsg').hide();
                  $('.alert-danger').append('');
              }, 2000);
            });
            $("#result").html('');
        }

    });

});

$('#dtbversionclosebtn').on('click',function(e){
  e.preventDefault();
  document.getElementById("dtbversionform").reset();
});


   // $('#dtbversionlist').DataTable( {
   //      "order": [],
   //      ordering:false
   //  } );






$('body').on('click','.versioneditmodal',function(e){

e.preventDefault();

var versionid = $(this).attr('value');
var projectid = $(this).attr('data-projectid');
var version_name = $(this).attr('data-dtbversion');
var end_date = $(this).attr('data-dtbversionenddate');
var start_date = $(this).attr('data-dtbversionstartdate');
var oldcolor = $(this).attr('data-issuecolor');

$("#edit_version_name").val(version_name);
document.getElementById("editenddate").value = end_date.substr(0, 10);
document.getElementById("editstartdate").value = start_date.substr(0, 10);


$(".editcolors").val(version_name);
$('.editcolors').css('background',oldcolor);

$('body').on('click','.updateversionsavebtn',function(e){
  e.preventDefault();
  
  var versionvalue = $("#edit_version_name").val();
  var end_date_final = document.getElementById("editenddate").value;
  var start_date_final = document.getElementById("editstartdate").value;


  $('input[name="color"]:checked').each(function() {
  var colors = (this.value);
  $(".newlycolor").val(colors);
  });

  var lastcolor = $(".newlycolor").val();


    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        url: 'version/'+versionid,
        type: 'POST',
        data: {
            versionid:versionid,
            projectid: projectid,
            version_name: versionvalue,
            end_date: end_date_final,
            start_date: start_date_final,
            color: lastcolor,
            oldcolor: oldcolor,
        },
        success: function(response){
           alert(response);
          $('#dtbversioneditmodal').modal('hide');
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








// VERSION delete
$('body').on('click','.versiondelconfirmmodal',function(e){
e.preventDefault();
var id = $(this).attr('value');
//when confirm modal clicked
$('body').on('click','.dtbversiondelbtn',function(e){
  e.preventDefault();
  issuedelete();
});

// set id empty
$('body').on('click','.delcancelbtn',function(e){
e.preventDefault();

$("#versiondelconfirmmodal").attr('value') == "";
});




function issuedelete() {

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


        $.ajax({
            url: 'version/'+id,
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

// VERSION LIST DRAG DROP SORTING
$( "#versioncontenttbl" ).sortable({
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
        url: 'version',
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