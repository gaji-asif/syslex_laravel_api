@extends('master_main')
@section('mainContent')
<style type="text/css">
  .project_details:hover{
      background-color: #FFD950;
  }
  .datatables-demo, th, td 
{
    text-align: center; 
    vertical-align: middle;
}
</style>

<div class="container mt-4">
  <h4 class="font-weight-bold py-2 mb-0 px-2">
    <div class="row">
    <!-- <input type="text" value="{{$current_month}}"> -->

     <div class="col-lg-4">
      {{ Form::open(['class' => '', 'files' => true, 'url' => 'velocity_search/'.$current_month.'/p',
   'method' => 'GET', 'enctype' => 'multipart/form-data']) }}
      <button type="submit" class="btn btn-warning bgtransparent hovercustombg"><span class="glyphicon glyphicon-chevron-left"></span>Previous month</button>
       {{ Form::close()}}
    </div>
   
     <div class="col-lg-4 text-center">Monthly Valocity <span class="text-muted">({{ \Carbon\Carbon::parse($current_month)->format('M-Y') }})</span></div>
     
     <div class="col-lg-4">
      {{ Form::open(['class' => '', 'files' => true, 'url' => 'velocity_search/'.$current_month.'/n',
   'method' => 'GET', 'enctype' => 'multipart/form-data']) }}
      <button type="submit" class="btn btn-warning pull-right bgtransparent hovercustombg">Next month<span class="glyphicon glyphicon-chevron-right"></span></button>
       {{ Form::close()}}
    </div>
   </div>
  </h4>
<div class="container px-5">
   <div class="card-datatable ">
    <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
     <div class="row">
      <div class="col-sm-12 col-md-6">
      </div>
      <div class="col-sm-12 col-md-6">

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
          <thead>
           <tr>
            <th width="20%">Project Name</th>
            <th>Valocity Value(Last Month)</th>
            <th></th>
            <th>Valocity Value(Current Month)</th>
          </tr>
        </thead>
        <tbody style="overflow: hidden !important;">
          @if(isset($velocityResult))
          @foreach($velocityResult as $value)
           <tr role="row" class="odd">
            <td class="">
              <div class="p-0 p-md-0">
                 {{$value->project_name}}
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
              <strong>
                @if($value->previous_velocity == '')
                0
                @else
                {{$value->previous_velocity}}
                @endif
                </strong>
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
                @if((int)$value->previous_velocity < (int)$value->velocity)
                <!-- <span class="glyphicon glyphicon-arrow-up" style="font-size: 30px; color: red;"></span> -->
                    <span class="valocityupicon valocityindication"></span>

                @elseif((int)$value->previous_velocity > (int)$value->velocity)
                    <span class="valocitydownicon valocityindication"></span>
        
                @elseif((int)$value->previous_velocity == (int)$value->velocity)
                <!-- <span>&#8680;</span> -->
                <span class="glyphicon glyphicon-arrow-right" style="font-size: 30px; color: green;"></span>
                @else

                @endif
              
              
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
            
                @if($value->velocity == '')
                0
                @else
                {{$value->velocity}}
                @endif
              </div>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>
</div>

<div class="mt-5">
    <h4 class="font-weight-bold py-0 px-4 mb-0">
   Members Valocity
 </h4>
</div>
<div class="container px-5 mt-0">

   <div class="card-datatable  pt-3">
    <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
     <div class="row">
      <div class="col-sm-12 col-md-6">
      </div>
      <div class="col-sm-12 col-md-6">

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common" style="overflow: hidden !important;">
          <thead>
           <tr>
            <th width="20%">Name</th>
            <th>Valocity Value(Last Month)</th>
            <th></th>
            <th>Valocity Value(Current Month)</th>
          </tr>
        </thead>
        <tbody style="overflow: hidden !important;">
        <?php 
  if(isset($Membersvelocity)){
    foreach($Membersvelocity as $value){
      if(!empty($value->name)){

          ?>
   
           <tr role="row" class="odd">
            <td class="">
              <div class="p-0 p-md-0">
                 {{$value->name}}
               
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
              <strong>
                @if($value->previous_velocity == '')
                0
                @else
                {{$value->previous_velocity}}
                @endif
              </strong>
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
               
                @if((int)$value->previous_velocity < (int)$value->velocity)
                <!-- <span class="glyphicon glyphicon-arrow-up" style="font-size: 30px; color: red;"></span> -->
                <span class="valocityupicon valocityindication"></span>
                @elseif((int)$value->previous_velocity > (int)$value->velocity)
                 <span class="valocitydownicon valocityindication"></span>
                <!-- <span class="glyphicon glyphicon-arrow-down" style="font-size: 30px; color: blue;"></span> -->
                @elseif((int)$value->previous_velocity == (int)$value->velocity)
                <span class="glyphicon glyphicon-arrow-right" style="font-size: 30px; color: green;"></span>
                @else

                @endif
              
              
              </div>
            </td>
            <td class="">
              <div class="p-0 p-md-0">
                @if($value->velocity == '')
                0
                @else
                {{$value->velocity}}
                @endif
              </div>
            </td>
          </tr>
        <?php 
        } 
      }
      }
      ?>
          
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>
</div>
</div>


<style>
.valocityupicon{
    background-image: url('{{ URL::asset('assets_/img/valocityUpIcon.png')}}');
}

.valocitydownicon{
    background-image: url('{{ URL::asset('assets_/img/valocityDownIcon.png')}}');
}

.valocitydrighticon{
    background-image: url('{{ URL::asset('assets_/img/valocityDownIcon.png')}}');
}
  .valocityindication{
          padding: 18px;
      display: block;
      background-repeat: no-repeat;
      width: 28px;
      text-align: center;
      margin: 0 auto;
      background-position: center;
          background-size: 55%;
  }

</style>

<style>
div#DataTables_Table_0_wrapper .col-sm-12.col-md-6 {
    /* padding-left: 0px; */
    padding: 0px !important;
}
.default-style div.card-datatable [class*="col-md-"] {
    padding: 0px !important;
  }
  .dtb_custom_tbl_common tbody tr td {
    padding: 0px 7px 0px !important;
}
ul.pagination {
    display: none;
}
.totalprojecticon{background-image: url(http://localhost/developmentmanage/public/assets_/img/totalproject.png);}
</style>
<script type="text/javascript">
 $(document).ready(function() {
   $('.datatables-demo').dataTable({
      "bLengthChange": false,
      "bPaginate":false,
      "bInfo": false,
      "order":[],
     });
 });
</script>
@endsection
