@extends('master_main')
@section('mainContent')
<style type="text/css">
  .project_details:hover{
      background-color: #FFD950;
  }
</style>
<div class="container mt-5">
<div class="card no_border ">
   <div class="card-datatable table-responsive">
    <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
     <div class="row">
      <div class="col-sm-12 col-md-6">
      </div>
      <div class="col-sm-12 col-md-6">

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <table id="myprojecttbl" class="datatables-demo table table-striped table-bordered" style="overflow: hidden !important;">
          <thead style="display: none;">
           <tr>
            <th>Projects</th>
          </tr>
          
        </thead>
        <tbody style="overflow: hidden !important;">
          @php $sl = 1; @endphp
          @foreach($newslist as $newses)
           <tr role="row" class="odd">
            <td class="pro_wrap">
              <a href="{{ route('news-single', ['id' => $newses->id]) }}">
              <div class="p-2">
              <p class="text-body text-large font-weight-semibold mb-1">{{$newses->title}}</p>
              <div class="mt-1"> 
                @if(!empty($newses->detail))
                <div class="mr-3 mb-2 black_font_color"><i class="vacancy-tooltip ion ion-md-business text-light"></i> &nbsp; @php echo  substr($newses->detail, 0,180 ). "....";@endphp</div>
                @endif
                <div class="mr-3 black_font_color"><i class="black_font_color vacancy-tooltip ion ion-md-time"></i> &nbsp; {{date('d-M-Y', strtotime($newses->created_at))}}</div>
              </div>
            
            </div>
            </a>
          </td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>
</div>
</div>

<script>
$(document).ready(function() {
    $('#myprojecttbl').DataTable( {
        "order": []
    } );
} );
</script>

@endsection
