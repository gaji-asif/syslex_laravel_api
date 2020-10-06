@extends('master_main')
@section('mainContent')
<!-- 		<h4 class="font-weight-bold py-2 mb-4">
		 <span class="text-muted font-weight-light">Dashboard /</span> Manage Members
		</h4> -->

		<div class="row mt-4">
          <div class="col-md-1"></div>
          <div class="col-md-7">
            <!-- Popular products -->
            <div class="card mb-4 no_border">
              <h6 class="card-header" style="background: #38587d;color: #fff;">Members List</h6>




          <div class="row px-3">
          <label class="custom-control custom-checkbox mt-4 ml-4 mb-0">
          <input type="checkbox" name="is_archived" value="1" class="custom-control-input" id="chckarchived" style="border-color: #000">
          <span class="custom-control-label" style="color: #000">Include archived members</span>
          </label>
          <label class="custom-control custom-checkbox mt-4 ml-0 mb-0">
          <a class="btn-primary btn-sm mt-1 dtb_custom_btn_default" id="chckarchivedbtn" href="#" style="padding: 4px 12px;">Search</a>
          </label>
          </div>



              <div class="table-responsive px-4"><br> 

{{-- TABLE ARCHIVED --}}
            <table id="tblarchived" class="table card-table table table-striped table-bordered  dtb_custom_tbl_common tblarchived">
                  <thead>
                    <tr>
                      <th style="width:10px !important">ID</th>
                      <th width="250px">Name</th>
                      <th width="250px">Email</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php 
                    $loggedindeveloper = Session::get('developer_id');
                    if ($loggedindeveloper !== "" ) {

                      $totaldevs = DB::table('dtb_users')->select('id')->where('developer_id', $loggedindeveloper)->count();

                      $memberlists = DB::table('dtb_users')
                      ->select('id','ud_id','email','name','icon_image_path','is_archived')
                      ->where('developer_id', $loggedindeveloper)->get();
                      // $projectofdeveloper = \App\DtbProject::where('developer_id', '=', $loggedindeveloper)->get()->toArray();
                    }
                ?>
              @php $image_path = "";
              $sl=1;
              @endphp

              <?php if (isset($memberlists)) {?>
                 @foreach($memberlists as $memberlist)
                      <tr>
                        <td class="align-middle p-1" style="text-align: center;width: 10px !important">
                          <a href="{{route('managemember.show', $memberlist->id)}}" class="text-body">{{ $memberlist->id ?? "" }}</a>
                        </td>

                        <td class="align-middle">

                          <span style="float: left;margin-right: 14px">
                            @if(!empty($memberlist->icon_image_path))
                            @php $image_path = url($memberlist->icon_image_path); @endphp
                            <img src="//{{ $memberlist->icon_image_path }}" alt="" class="d-block ui-w-30 rounded-circle" style="margin:0 auto">
                            @else
                            <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-30 rounded-circle" style="margin:0 auto">
                            @endif
                          </span>

                          <a style="float: left;margin-top: px;" href="{{route('managemember.show', $memberlist->id)}}" class="text-body">
                            {{ $memberlist->name ?? "" }}<span class="ml-1"></span>
                            <span style="color: gray;font-size: 12px">@if ($memberlist->is_archived == 1) (Archived)  @endif</span>
                            
                          </a>
                        </td>
                        
                        <td class="align-middle"><a href="{{route('managemember.show', $memberlist->id)}}" class="text-body">{{ $memberlist->email ?? "" }}</a></td>

                      </tr>
                  @endforeach
              <?php }else{ ?>

                <tr>
                <td class="align-middle p-1">
                    <img class="d-block ui-w-40 rounded-circle" src="" alt="" style="margin:0 auto">
                  </td>
                  <td class="align-middle">
                    <a href="" class="text-body"></a>
                  </td>
                  <td class="align-middle"><a href="" class="text-body"></a></td>
                </tr>

              <?php } ?>

                  </tbody>
                </table>







{{-- TABLE NOT ARCHIVED --}}

                <table id="tblnotarchived" class="table card-table table table-striped table-bordered  dtb_custom_tbl_common tblnotarchived">
                  <thead>
                    <tr>
                      <th style="width:10px !important">ID</th>
                      <th width="250px">Name</th>
                      <th width="250px">Email</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php 
                    $loggedindeveloper = Session::get('developer_id');
                    if ($loggedindeveloper !== "" ) {
                      $totaldevs2 = DB::table('dtb_users')->select('id')->where('developer_id', $loggedindeveloper) ->where('is_archived', 0)->count();
                      $memberlists2 = DB::table('dtb_users')
                      ->select('id','ud_id','email','name','icon_image_path')
                      ->where('developer_id', $loggedindeveloper)
                      ->where('is_archived', 0)->get();
                      // $projectofdeveloper = \App\DtbProject::where('developer_id', '=', $loggedindeveloper)->get()->toArray();
                    }
                ?>
              @php 
              $image_path2 = "";
              @endphp
              <?php if (isset($memberlists2)) {?>
                 @foreach($memberlists2 as $memberlist2)
                      <tr>
                        <td class="align-middle p-1" style="text-align: center;width: 10px !important">
                          <a href="{{route('managemember.show', $memberlist2->id)}}" class="text-body">{{ $memberlist2->id ?? "" }}</a>
                        </td>
                        <td class="align-middle">
                          <span style="float: left;margin-right: 14px">
                            @if(!empty($memberlist2->icon_image_path))
                            @php $image_path2 = url($memberlist2->icon_image_path); @endphp
                            <img src="//{{ $memberlist2->icon_image_path }}" alt="" class="d-block ui-w-30 rounded-circle" style="margin:0 auto">
                            @else
                            <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-30 rounded-circle" style="margin:0 auto">
                            @endif
                          </span>
                          <a style="float: left;margin-top: px;" href="{{route('managemember.show', $memberlist2->id)}}" class="text-body">{{ $memberlist2->name ?? "" }}</a>
                        </td>
                        <td class="align-middle"><a href="{{route('managemember.show', $memberlist2->id)}}" class="text-body">{{ $memberlist2->email ?? "" }}</a></td>
                      </tr>
                  @endforeach
              <?php }else{ ?>
                <tr>
                <td class="align-middle p-1">
                    <img class="d-block ui-w-40 rounded-circle" src="" alt="" style="margin:0 auto">
                  </td>
                  <td class="align-middle">
                    <a href="" class="text-body"></a>
                  </td>
                  <td class="align-middle"><a href="" class="text-body"></a></td>
                </tr>
              <?php } ?>
                  </tbody>
                </table>
                <br>
              </div>

            </div>
            <!-- / Popular products -->
          </div>
  	      <div class="col-md-3">
  	      	<div class="card mb-4 no_border">
                    <h6 class="card-header text-white dtb_primary_bgcolor " style="padding: 23px 32px;text-align: center;">

                     <div style="display: inline-flex;"><span class="totaldevs"></span> 
                      <span class="witharchivecount" style="font-size: 43px;font-weight: 500;">{{ $totaldevs ?? "" }}
                      <p style="font-size: 10px;text-align: center;margin-top: -12px;">Total Enlisted User</p>
                      </span>
                      <span class="withoutarchivecount" style="font-size: 43px;font-weight: 500;">{{ $totaldevs2 ?? "" }}
                        <p style="font-size: 10px;text-align: center;margin-top: -12px;">Total Active User</p>
                      </span>
                    </div>

                    </h6>
                    <div class="text-black" style="background: #F5F5F5">
                      <div class="d-flex">
                      </div>
                      <div class="text-center mt-3 mb-4">
                        Members makes the project greater
                      </div>
                    </div>
                    <div class="card-footer border-0 text-center py-3 bg-white text-black">
                      <div class="row">
                        <div class="col">
                          <div class=" small mb-1">Active</div>
                          <strong class="text-big">-</strong>
                        </div>
                        <div class="col">
                          <div class=" small mb-1">Inactive</div>
                          <strong class="text-big">-</strong>
                        </div>
                      </div>
                    </div>
            </div>
              <div class="" style="padding: 1px;text-align: center;">
                <a href="{{route('userreportmanage')}}" class="btn btn-success reportmanagebtn">Manage Report</a>
              </div> 
  	      </div>
          <div class="col-md-1"></div>
    </div>

<style>
.totaldevs {
display: block;

background-image: url("assets_/img/memmbericonwhite.png");;
width: 58px;
height: 46px;
margin-right: 3px;
background-repeat: no-repeat;
margin-top: 13px;
background-size: 53px;
}
.reportmanagebtn{
  width: 100%;
    background: #38587D;
}
.custom-checkbox .custom-control-label::before {
    background-size: 65%;
    border-color: #000;
}


div#tblarchived_wrapper {
    display: none;
}

/*div#tblnotarchived_wrapper {
    display: none;
}*/
</style>


<script>
  




$(document).ready(function() {


//initially not archived table will show and archived table will hide
       $('#tblnotarchived').dataTable({
          // "bLengthChange": false,
          // "paginate": false,
          // "order":[]
         });
       $("#tblnotarchived").show();
       $("div#tblarchived_wrapper").css({"display": "none"});

       $("#tblarchived").hide();
       $('#tblarchived').dataTable({
          // "bLengthChange": false,
          // "paginate": false,
          // "searching": false,
          // "bInfo": false,
          // "order":[]
        });

       $(".witharchivecount").hide();
       $(".withoutarchivecount").show();
       




//after clicking search button this code will execute
        $('#chckarchivedbtn').click(function(e){
            e.preventDefault();

            if($("#chckarchived").is(":not(:checked)")){
              alert('check the box first!');
            }

            if($("#chckarchived").is(":checked")){


             $("#tblnotarchived").hide();
             $("div#tblnotarchived_wrapper").css({"display": "none"});
             $("#tblarchived").show();
             $("div#tblarchived_wrapper").css({"display": "block"});

             $(".witharchivecount").show();
             $(".withoutarchivecount").hide();


          }else if($("#chckarchived").is(":not(:checked)")){

            $("#tblnotarchived").show();
            $("div#tblnotarchived_wrapper").css({"display": "block"});
            $("#tblarchived").hide();
            $("div#tblarchived_wrapper").css({"display": "none"});

            $(".witharchivecount").hide();
            $(".withoutarchivecount").show();
  
          }

        });



//uncheck after check ,this will be triggered
        $('#chckarchived').change(function() {
          if($("#chckarchived").is(":not(:checked)")){
            $("#tblnotarchived").show();
            $("div#tblnotarchived_wrapper").css({"display": "block"});
            $("#tblarchived").hide();
            $("div#tblarchived_wrapper").css({"display": "none"});

            $(".witharchivecount").hide();
            $(".withoutarchivecount").show();

          }  
        });












 });


</script>

@endsection