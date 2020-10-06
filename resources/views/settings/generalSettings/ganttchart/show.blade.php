@extends('master')
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
  <div class="col-md-1"></div>
  <div class="col-md-10">
<!--         <div class="row mt-4">
          <div class="col-md-12">
            <div class="card pb-0 mb-2" >

            </div>
          </div>
        </div> -->


<div class="card pb-4 mb-2 appsingleinfo bg-transparent border-0">

                <div class="row no-gutters align-items-center">
                <div class="col-12 col-md-12 px-4 pt-3">

                  <h4 style="float: left"> <!-- <i style="float: left;font-size: 32px;margin-right: 5px;margin-top: -7px;color: #26B4FF" class="lnr lnr-tag d-block"></i>  -->
                      <?php if (!empty($appdata->app_name)) {?> {{$appdata->app_name}} <?php }else{ echo ""; } ?>
                  </h4>

                  <span class="pull-right"><a href="{{route('apps', [$id])}}" class="btn btn-primary btn-sm dtb_custom_btn_default" style="padding: 3px 28px;margin-left:8px">All Apps</a></span>&nbsp&nbsp  

                  <span class="pull-right"><a href="{{route('apps.edit', [$id,$appdata->id])}}" class="btn btn-primary btn-sm dtb_custom_btn_default" style="padding: 3px 28px;">Edit</a></span> 

                  
                </div>
              </div>



<br>
    <div class="row px-4">
                
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">App Short Name</a></li>
              <li><span class="appvalue"><?php if (!empty($appdata->app_short_name)) {?> {{$appdata->app_short_name}} <?php }else{ echo "---"; } ?></span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Targated SDK</a></li>
              <li><span class="appvalue"><?php if (!empty($appdata->target_sdk)) {?> {{$appdata->target_sdk}} <?php }else{ echo "---"; } ?></span></li>
            </ul>
          </div>
    </div>    

    <div class="row px-4">
                
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Deployment Target</a></li>
              <li><span class="appvalue"><?php if (!empty($appdata->deployment_target)) {?> {{$appdata->deployment_target}} <?php }else{ echo "---"; } ?></span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Deployment Url</a></li>
              <li><span class="appvalue">{{$appdata->deploy_url}}</span></li>
            </ul>
          </div>
    </div>    

    <div class="row px-4">   
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">IDE Version</a></li>
              <li><span class="appvalue"><?php if (!empty($appdata->ide_version)) {?> {{$appdata->ide_version}} <?php }else{ echo "---"; } ?></span></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Company Name</a></li>
              <li><span class="appvalue"><?php if (!empty($appdata->company_name)) {?> {{$appdata->company_name}} <?php }else{ echo "---"; } ?></span></li>
            </ul>
          </div>
    </div> 


    <div class="row px-4">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li><a href="javascript:void(0)" class="text-body font-weight-semibold">Repository</a></li>
              <li style="width: 72%">
                <span class="appvalue">

                <span id="repoholder"><?php if (!empty($appdata->repo)) {?> {{$appdata->repo}} <?php }else{ echo "---"; } ?></span>

                 <input readonly type="text" value="<?php if (!empty($appdata->repo)) {?> {{$appdata->repo}} <?php }else{ echo "---"; } ?>"  id="myInput" style="width: 100%;height:30px;border: none;overflow-y: scroll;">

                  <div class="tooltip">
                      <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                    
                    <a href="#" onmouseout="outFunc()" class="btns btnrepocopy" data-clipboard-text="<?php if (!empty($appdata->repo)) {?> {{$appdata->repo}} <?php }else{ echo "---"; }?>"  onclick="myFunction()">
                       <svg class="octicon octicon-clippy" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M2 13h4v1H2v-1zm5-6H2v1h5V7zm2 3V8l-3 3 3 3v-2h5v-2H9zM4.5 9H2v1h2.5V9zM2 12h2.5v-1H2v1zm9 1h1v2c-.02.28-.11.52-.3.7-.19.18-.42.28-.7.3H1c-.55 0-1-.45-1-1V4c0-.55.45-1 1-1h3c0-1.11.89-2 2-2 1.11 0 2 .89 2 2h3c.55 0 1 .45 1 1v5h-1V6H1v9h10v-2zM2 5h8c0-.55-.45-1-1-1H8c-.55 0-1-.45-1-1s-.45-1-1-1-1 .45-1 1-.45 1-1 1H3c-.55 0-1 .45-1 1z"></path></svg>
                    </a>
                  </div>
              </span>
            </li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Created At</a></li>
              <li><span class="appvalue"><?php if (!empty($appdata->created_at)) {?> {{$appdata->created_at}} <?php }else{ echo "---"; } ?></span></li>
            </ul>
          </div>
    </div> 


    <div class="row px-4">
          <div class="col-md-6">
            <ul class="appinfobox">
              <li> <a href="javascript:void(0)" class="text-body font-weight-semibold">Screen Group</a></li>
              <li><span class="appvalue">

                <?php 
                if (!empty($appdata->screen_group_id)) {?>
                  <a href="{{route('screengroup.show', [$id,$appdata->screen_group_id])}}">{{$appdata->screen_group_name}}</a>
                <?php }else{
                  echo "";
                }
               ?>
                 
              </a>


                </span></li>
            </ul>
          </div>
          <div class="col-md-6">

          </div>
    </div>

    <div class="no-gutters row-bordered h-100">
      <!-- MEMO AREA -->
      <div class="card-body pt-2">
        <h6>Memo</h6>
        @if(isset($appdata->memo))
         <div class="tui-editor-contents"><?php 
                $parser = new \cebe\markdown\GithubMarkdown();
                $parser->html5 = true;
                $parser->enableNewlines = true;
                $parser->keepListStartNumber = true;
                echo $parser->parse($appdata->memo);
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
  <div class="col-md-1"></div>
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

$("#myInput").hide();

function myFunction() {

 $("#repoholder").hide();
 $("#myInput").show();

  var copyText = document.getElementById("myInput");

  var copyText = document.getElementById("myInput");
  copyText.focus();
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied";
}

function outFunc() {
   $("#repoholder").show();
   $("#myInput").hide();
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}

  </script>

@endsection
