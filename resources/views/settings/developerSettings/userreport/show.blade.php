  @extends('master_main')
  @section('mainContent')
<style type="text/css">
  .issue_wrapper{
    margin:0 auto;
  }
  .gap{
    padding: 0px 50px 0px 50px;
  }
</style>
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />

<div class="row mt-4">
  <div class="col-md-2"></div>
  <div class="col-md-8">
<!--         <div class="row mt-4">
          <div class="col-md-12">
            <div class="card pb-0 mb-2" >

            </div>
          </div>
        </div> -->

<div class="card pb-4 mb-2 appsingleinfo bg-transparent border-0">

                <div class="row no-gutters align-items-center">
                <div class="col-12 col-md-12 px-4 pt-3">

                  <div class="center-block" style="border-bottom: 1px solid #0000002e;padding-bottom: 13px;margin-bottom: 20px;">

                    <h4 style="float: left"> <!-- <i style="float: left;font-size: 32px;margin-right: 5px;margin-top: -7px;color: #26B4FF" class="lnr lnr-tag d-block"></i>  -->
                    <!--  Report | <?php if (!empty($reports->date)) {  echo substr_replace($reports->date ,"",-8); } else{ echo ""; } ?> -->

                     Report |

                      @if(Session()->get('language_id') == 1)
                      {{ date('m-d-Y', strtotime($reports->date)) }}
                      @elseif(Session()->get('language_id') == 15)
                      {{ date('m-d-Y', strtotime($reports->date)) }}
                      @elseif(Session()->get('language_id') == 53)
                      {{ date('Y-m-d', strtotime($reports->date)) }}

                      @else

                      @endif
                    </h4>

                  <span class="pull-right" style="margin-left: 8px;"><a href="{{route('report.index')}}" class="btn btn-primary btn-sm dtb_custom_btn_default" style="padding: 3px 28px;">List</a></span> 

                  <span class="pull-right"><a href="#" class="btn btn-primary btn-sm dtb_custom_btn_default" id="reportdelbtn" style="padding: 3px 28px;margin-left:8px">Delete</a></span>

                  <span class="pull-right"><a href="{{route('report.edit', [$reportsid = $reports->id])}}" class="btn btn-primary btn-sm dtb_custom_btn_default" style="padding: 3px 28px;">Edit</a></span>  &nbsp&nbsp 

                  </div>

                  
                  
                </div>
              </div>



<br>
    <div class="row px-4">
                
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Start Time</a></li>
              <li><span class="appvalue"><?php if (!empty($reports->working_start_time)) {?> {{$reports->working_start_time}} <?php }else{ echo "---"; } ?></span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">End Time</a></li>
              <li><span class="appvalue"><?php if (!empty($reports->working_end_time)) {?> {{$reports->working_end_time}} <?php }else{ echo "---"; } ?></span></li>
            </ul>
          </div>
    </div>    

    <div class="row px-4">
                
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Total working time</a></li>
              <li>
                <span class="appvalue">
                  <?php if (!empty($reports->working_time)) {?> {{$reports->working_time}} <?php }else{ echo "---"; } ?>
                </span>
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold"><br></a></li>
              <li><span class="appvalue"></span></li>
            </ul>
          </div>
    </div>    





    <div class="no-gutters row-bordered h-100">
      <div class="card-body pt-2">
        <h6>Today's work(s)</h6>
        @if(isset($reports->todays))
         <div class="tui-editor-contents"><?php 
                $parser = new \cebe\markdown\GithubMarkdown();
                $parser->html5 = true;
                $parser->enableNewlines = true;
                $parser->keepListStartNumber = true;
                echo $parser->parse($reports->todays);
                ?>
       </div>
        @endif
      </div>
    </div>    

    <div class="no-gutters row-bordered h-100">
      <div class="card-body pt-2">
        <h6>Tomorrow's work(s)</h6>
        @if(isset($reports->tomorrows))
         <div class="tui-editor-contents"><?php 
                $parser = new \cebe\markdown\GithubMarkdown();
                $parser->html5 = true;
                $parser->enableNewlines = true;
                $parser->keepListStartNumber = true;
                echo $parser->parse($reports->tomorrows);
                ?>
       </div>
        @endif
      </div>
    </div>    


    <div class="no-gutters row-bordered h-100">
      <div class="card-body pt-2">
        <h6>Notice</h6>
        @if(isset($reports->notice))
         <div class="tui-editor-contents"><?php 
                $parser = new \cebe\markdown\GithubMarkdown();
                $parser->html5 = true;
                $parser->enableNewlines = true;
                $parser->keepListStartNumber = true;
                echo $parser->parse($reports->notice);
                ?>
       </div>
        @endif
      </div>
    </div>

</div>



  <div class="d-flex col-xl-12 align-items-stretch">
    <!-- Stats + Links -->
    <div class="card d-flex w-100 mb-4">

   </div>
  </div>
  </div>
  <div class="col-md-2"></div>
</div>


<style>
  input#myInput {
    background: transparent;
    border: none;
    padding: 0;
}
  span.borderbottom {
    border-bottom: 1px solid #0000003b;
    width: 465px;
    height: 0px;
    display: block;
    margin-top: 4px;
    float: left;
}  

span.borderbottom2 {
    border-bottom: 1px solid #0000003b;
    width: 455px;
    height: 0px;
    display: block;
    margin-top: 4px;
    float: left;
}
  .memoholder {
    padding: 22px;
    border-radius: 4px;
}
.memoholder h5 {
    padding-left: 4px;
    font-weight: 700;
    font-size: 18px;
}
div#wikidescTargetDiv {
    background: #fcfade87;
    padding: 12px;
    border: 1px solid #00000012;
    border-radius: 4px;
}

.wordbreak_custom{
  word-break: break-all;
}
span.appvalue {
    color: #000;
    font-weight: 400;
}

.tooltip {
    position: absolute;
    display: inline-block;
    opacity: 1;
    right: -6px;
    top: 1px;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
button#myInput {
    border: 0px;
    background: transparent;
}
.tui-editor-contents {
    background: white;
    padding: 1px 20px 18px;
    }

    .btnrepocopy{
    border: navajowhite;
    background: transparent;
    width: 11px;
    float: left;
    display: block;
    margin-top: -2px;
    margin-right: 22px;
    cursor: pointer;
    }
</style>


<script type="text/javascript">





$('body').on('click','#reportdelbtn',function(e){
  e.preventDefault();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $.ajax({
      url : '{{ url('/reportdelete') }}',
      method: 'DELETE',
      data: {
          reportid:{{ $reports->id ?? '' }},
      },
      success: function(response){
        if (response) {

        $.iaoAlert({msg: "Screen Deleted !",
          type: "success",
          mode: "dark",});

          setTimeout(function(){// wait for 5 secs(2)
            window.location.href = "{{ route('report.index')}}";
          }, 1000);


        }

      },
      error: function() {
        alert('Error occurs!');
     }
  });



  });







</script>

@endsection
