@extends('master')
@section('mainContent')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Dashboard /</span> Projects
</h4>

<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <h6 class="card-header">
                Project List
            </h6>
            <div class="card-datatable table-responsive">

                <table class="datatables-demo table table-striped table-bordered" id="projectlist">
                    <thead>
                        <tr>
                            <th style="display: none;"></th>
                            <th>#SL</th>
                            <th>Project Title</th>
                            <th>Project Key</th>
                            <th>Project Details </th>
                            <th></th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $sl = 1; @endphp
                        @if(isset($projectlist))
                            @foreach($projectlist as $projects)
          
                                <a href="{{ route('projects.show', ['id' => $projects->id]) }}">
                                    <tr class="odd gradeX projectlist" id="{{$projects->id}}">
                                    <td style="display: none;">{{$projects->id}}</td>
                                    <td>{{$sl++}}</td>
                                    <td class="proname">{{$projects->project_name}}</td>
                                    <td class="prokey">{{$projects->project_key}}</td>
                                    <td class="prodtail">{{$projects->project_detail}}</td>
                                    <td class=""><a href="{{ URL::to('projects/' . $projects->id) }}">Details</a></td>
                                    </tr>
                                </a>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<script type="text/javascript">
$( document ).ready(function() {


// ############ PRJECT MODULE CODE ##################

// $("#msgcontainer").hide();
$('#projectlist').SetEditable({
columnsEd: "2,3,4",

onEdit: function(columnsEd) {

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var projectid = columnsEd[0].childNodes[1].innerHTML;
    var projecttitle = columnsEd[0].childNodes[5].innerHTML;
    var projectkey = columnsEd[0].childNodes[7].innerHTML;
    var projectdetail = columnsEd[0].childNodes[9].innerHTML;
    
    $.ajax({
        url: 'projects/'+projectid,
        type: 'PUT',
        data: {
            id:projectid,
            project_name: projecttitle,
            project_key: projectkey,
            project_detail: projectdetail,
        },
        success: function(response){
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
        }
    });
}, 


onDelete: function() {}, 


onBeforeDelete: function(columnsEd) {

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

      var projectid = columnsEd[0].childNodes[1].innerHTML;

        $.ajax({
            url: 'projects/'+projectid,
            type: 'DELETE',
            success: function(response){

            $.iaoAlert({msg: "Data has been deleted",
            type: "warning",
            mode: "dark",})

              //   $("#msgcontainer").show();
              //   if (response) {
              //       $("#successmsg").html(response);
              //       setTimeout(function() {
              //           $("#msgcontainer").fadeOut("slow");
              //       }, 2000 );
              // }
            }
        });

      },


onAdd: function() {} 


});



});
</script>
</div>
@endsection