@extends('master_main')
@section('mainContent')

<div class="container pt-5">
  <div class="row">
  <div class="col-lg-3">
   @include('settings.developerSettings.developer_settings_sidebar')
</div>

<div class="col-lg-9 settgs_right_content">
    <div class="card mb-4 no_border">
      <div class="card-body">
        <h6 class="card_body_header" style="padding-left: 0px;float: left">News List</h6>
        <span style="float: right;"><a href="{{route('news-create')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default">Add News</a></span>
            <div class="table-responsive">
              <table class="table table-striped table-bordered dtb_custom_tbl_common" id="projectlisttbl">
                    <thead>
                        <tr>
                            <th style="display: none;"></th>
                            <th >#SL</th>
                            <th>Title</th>
                            <th>Detail</th>
                          <th>Created at</th>
                          <th style="width: 1px !important;padding: 0px !important"></th>
                        </tr>
                    </thead>
                    <tbody id="tablecontents">
                        @php $sl = 1; @endphp
                        @if(isset($newslist))
                            @foreach($newslist as $newsitem)
          
                                
                                   <div>
                                    <tr class="odd gradeX projectlist row1" data-id="{{ $newsitem->id }}" id="{{$newsitem->id}}">
                                    <td style="display: none;">{{$newsitem->id}}</td>
                                    <td width="20px">
                                      <a href="{{ route('news-single', ['id' => $newsitem->id]) }}">
                                      <div style="cursor: pointer;" title="change display order">
                                        <div style="display: flex;color: #00000063;"> <i class="fas fa-th-list d-block"></i></div>
                                      <!-- <i class="fa fa-ellipsis-v"></i>
                                      <i class="fa fa-ellipsis-v"></i> -->
                                      </div>
                                      </a>
                                    </td>
                                    <td class="proname"><a href="{{ route('news-single', ['id' => $newsitem->id]) }}">{{$newsitem->title}}</a></td>
                                    <td class="prokey"><a href="{{ route('news-single', ['id' => $newsitem->id]) }}">@php echo  substr($newsitem->detail, 0,100 ). "....";@endphp</a></td>
                                    <td class="prodtail"><a href="{{ route('news-single', ['id' => $newsitem->id]) }}">{{$newsitem->created_at}}</a></td>
                                    <td class=""><a href="{{ route('news-edit', ['id' => $newsitem->id]) }}"><span class="glyphicon glyphicon-edit" style="color: black"></span></a></td>
                                    </tr>
                                   </div>
                                </a>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

      </div>
    </div>
  </div>

</div>

</div>
<style type="text/css">
#projectlisttbl tr:hover td a{ color: #02BC77; }
#projectlisttbl tr:hover { background: #f3f3f3; }
#projectlisttbl tr td a {
    display: block;
    padding: 12px 9px;
}
#projectlisttbl tr td {
    padding:0px;
}
.projectlist td a {
    color: rgba(24,28,33,0.9);
}
</style>

<script type="text/javascript">

  $( document ).ready(function() {

      $('#projectlisttbl').DataTable( {
        "order": [],
        ordering:true
    } );



// PROJECT LIST DRAG DROP SORTING
$( "#tablecontents" ).sortable({
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
       // alert(JSON.stringify(order, null, 4));exit();
    });
    $.ajax({
        url: 'newsorder',
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
