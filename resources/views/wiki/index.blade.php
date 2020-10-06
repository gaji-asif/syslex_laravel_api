@extends('master')
@section('mainContent')

@php 
$wikifirstdata = \App\DtbWiki::where('project_id',$id)->orderBy('id', 'desc')->first();
@endphp
<div class="row">
<div class="col-lg-12">
<div class="wikisingletop mt-2">
 <a class="btn btn-success btn-sm mb-2 pull-left dtb_custom_btn_default dtb_secondary_bgcolor text-white" href="{{route('wiki.create', $id)}}">Add</a>

 <div class="attachmentholder pull-right">
  <div class="attachmentbtn">
    <p>
      <?php if (empty($wikifirstdata)) {

      }else{ ?>
        <a href="wiki/{{ $wikifirstdata->id ?? '' }}/edit" class="btn btn-success btn-sm dtb_custom_btn_default" href="#">Edit</a>
        <a class="btn btn-success btn-sm dtb_custom_btn_default" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
         attachment
       </a>
     <?php } ?>

   </p>
 </div>
</div>
</div>
</div>
</div>

<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <div class="form-group">

      <?php if (isset($wikifirstdata->id)) { $wikiid= $wikifirstdata->id;}else{ $wikiid=''; } ?>
      {!! Form::open(['route' => ['project.wiki.wikifileupload', $id, $wikiid],'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','class' => 'dropzone','id' => 'fileupload']) !!}


      @csrf
      <div class="fallback">
        <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg,*.skp,*.sketch,*.zip,*.sql,*.pdf,*.txt,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
      </div>
      {!! Form::close() !!}
    </div>
  </div><br>
</div>


<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />

<div class="row">
  
  <div class="col-md-8 col-lg-12 col-xl-9">
    <!-- Popular queries -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="wikipageheader">{{$wikifirstdata->title ?? 'Wiki content is not available! Please add new.' }}</h5>

        <div id="content markdowncontentholder">
          @if(!empty($wikifirstdata))
          <div class="tui-editor-contents">
            <?php 
            $parser = new \cebe\markdown\GithubMarkdown();
            $parser->html5 = true;
            $parser->enableNewlines = true;
            $parser->keepListStartNumber = true;
            echo $parser->parse($wikifirstdata->description);

            ?>
          </div>
          @endif
        </div>

      </div>
    </div>
    <!-- / Popular queries -->
    <div class="card mb-4" style="">
      <h6 class="card-header">Attached files</h6>
      <div class="card-body p-3">
        <div class="row no-gutters">
          @php $image_path = ""; @endphp


          <?php 
          if (isset($wikifirstdata->id)) {

            $wikiid = $wikifirstdata->id;
            $wikiattachments = \App\DtbWikiAttachment::where(['wiki_id' => $wikiid])->get(); ?>


            @forelse ($wikiattachments as $attachment)
            <div class="col-md-6 col-lg-12 col-xl-6 p-1">

              <div class="project-attachment ui-bordered p-2">

                <?php if ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'png' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'jpg' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'gif'  || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'jpeg') {?>
                  <div class="imgthumbholder">
                    <img class="project-attachment-img attachmentimgholdermain" alt="iamge" src="{{$attachment->file_path}}">
                  </div>

                <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'PNG' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'JPG' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'GIF'){?>
                  <div class="imgthumbholder">
                    <img class="project-attachment-img attachmentimgholdermain" alt="iamge" src="{{ $attachment->file_path }}">
                  </div>

                <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'xls' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'xlsx'){?>
                  <div class="fileextholder project-attachment-img attachmentimgholder">
                   <i class='far fa-file-excel' style='font-size:25px;color:green'></i>
                 </div>

               <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'pdf'){?>
                <div class="fileextholder project-attachment-img attachmentimgholder">
                 <i class='far fa-file-pdf' style='font-size:25px;color:#cc0000'></i>
               </div>


             <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'ppt' || $ext = pathinfo($attachment->file_path, PATHINFO_EXTENSION) == 'pptx'){?>
              <div class="fileextholder project-attachment-img attachmentimgholder">
               <i class='far fa-file-powerpoint' style='font-size:25px;color:#D04423'></i>
             </div>

           <?php }elseif ($ext = pathinfo($attachment->file_path, PATHINFO_EXTENSION) == 'doc' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'docx'){?>
            <div class="fileextholder project-attachment-img attachmentimgholder">
             <i class='far fa-file-word' style='font-size:25px;color:black'></i>
           </div>    

         <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'gif'){?>
          <div class="fileextholder project-attachment-img attachmentimgholder">
           <i class='far fa-file-archive' style='font-size:25px;color:red'></i>
         </div>

       <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'sql' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'php' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'html' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'css' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'blade.php'){?>
        <div class="fileextholder project-attachment-img attachmentimgholder">
         <i class='far fa-file-code' style='font-size:25px;color:black'></i>
       </div>


     <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'txt' || $ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'TXT'){?>
      <div class="fileextholder project-attachment-img attachmentimgholder">
       <i class="fa fa-file-alt" style="font-size:25px"></i><i class="fa fa-file-zip-o" style="font-size:48px;color:red"></i>
     </div>

   <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'zip'){?>
    <div class="fileextholder project-attachment-img attachmentimgholder">
     <i class="fa fa-file-archive" style="font-size:25px"></i>
   </div>

 <?php }elseif ($ext = pathinfo($attachment->file_name, PATHINFO_EXTENSION) == 'sketch'){?>
  <div class="fileextholder project-attachment-img attachmentimgholder">
   <i class="fa fa-leaf" style="font-size:25px"></i>
 </div>

<?php }else{ ?>
  <div class="fileextholder project-attachment-img attachmentimgholder">
   <i class="fa fa-question" style="font-size:25px;color:black"></i>

 </div>
<?php } ?>

<div style="background-image: url({{$attachment->file_path}})"></div>
<div class="media-body ml-3">
  <a href="#" class="demo_img" title="" target="_blank">
    <strong class="project-attachment-filename" style="color: black">{{$attachment->file_name}}</strong>
    <div><img src="{{$attachment->file_path}}" alt="" /></div>
  </a>
  <!-- <div class="text-muted small">527KB</div> -->
  <div>

    <a href="{{$attachment->file_path}}" download="{{$attachment->file_name}}">Download</a> | 
    <a href="javascript:void(0)" data="{{ $attachment->id }}" class="attachmentdelbtn">Delete</a>
  </div>
</div>
</div>

</div>

@empty

<p>no attachment found</p>

@endforelse

<?php }else{ } ?>

</div>
</div>
</div>
</div>


<div class="col-md-4 col-lg-12 col-xl-3">
  <div class="row">
    <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">
      <div class="card mb-4">
        <div class="card-header border-0 pb-0">Search</div>
        <div class="card-footer border-0 small pt-0">
          {!! Form::open(['route' => ['project.wiki.search', $id]])!!}
          <input type="text" name="q" class="form-control"> 
          <input class="btn btn-success btn-sm mt-2 dtb_secondary_bgcolor" type="submit" value="Search Wiki">
      <!--   </form> -->
         {{ Form::close()}}
      </div>
    </div>
  </div>

  <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">

    <div class="card mb-4">
      <div class="card-header border-0 pb-0">Tags</div>

      <div class="list-group-item border-top-0">

      </div>


    </div>
  </div>
  <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">

               <!--  <div class="card mb-4">
                  <div class="card-header border-0 pb-0">Category</div>
                  <div class="card-body text-center text-success text-xlarge py-3">Design</div>
                  <div class="card-footer border-0 small pt-0">

                  </div>
                </div> -->

                <div class="card mb-4 wikipagelinkholder">
                  <h6 class="card-header">Page Lists</h6>
                  <ul class="list-group list-group-flush">
                    @php 
                    $projectid = $id;
                    $wikipages = \App\DtbWiki::where(['project_id' => $projectid])->orderBy('id', 'desc')->get();
                    @endphp

                    @forelse ($wikipages as $wikipage)

                    <li class="list-group-item d-flex justify-content-between align-items-center {{ (request()->segment(4) == $wikipage->id || '' ) ? 'active' : '' }}">

                      <a href="{{route('wiki.show', [$id,$wikipage->id])}}">

                        <?php if (!empty($wikipage)) {
                         echo $wikipage->title;
                       } ?>

                     </a>
                   </li>
                   @empty
                   <li class="list-group-item d-flex justify-content-between align-items-center">
                     No page link available.
                   </li>
                   @endforelse

                   <li class="list-group-item d-flex justify-content-between ">

                   </li>


                 </ul>
               </div>

               <div class="card mb-4 wiki-toc-holder">
                <h6 class="card-header">Table of content</h6>
                <ul class="list-group list-group-flush" id="toc-main">
                </ul>
              </div>

            </div>
          </div>
        </div>
      </div>



    <style>  
      .btn-success:focus, .btn-success.focus {
        box-shadow: 0 0 0 2px #f5f5f5;
      }
    </style>

    <script src="{{asset('assets_/vendor/libs/dropzone/dropzone.js')}}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.0/showdown.min.js"></script> -->
    <script src="{{asset('/assets/js/marked.min.js')}}"></script>
    <script src="{{asset('/assets/js/showdown.min.js')}}"></script>

    <script>

      Dropzone.options.fileupload = {
        maxFilesize: 50,
        accept: function (file, done) {
          if (file.type != "application/vnd.ms-excel" && file.type != "image/jpeg, image/png, image/jpg,*.skp,*.sketch,*.zip,*.sql,*.pdf,*.txt,text/csv") {
            done("Error! Files of this type are not accepted");
          } else {

            done();
          }
        }
      }

      Dropzone.options.fileupload = {
        acceptedFiles: ""
      }

      if (typeof Dropzone != 'undefined') {
        Dropzone.autoDiscover = false;
      }

      ;
      (function ($, window, undefined) {
        "use strict";

        $(document).ready(function () {

    // Dropzone Example
    if (typeof Dropzone != 'undefined') {
      if ($("#fileupload").length) {
        var dz = new Dropzone("#fileupload"),
        dze_info = $("#dze_info"),
        status = {
          uploaded: 0,
          errors: 0
        };
        var $f = $('<tr><td class="name"></td><td class="size"></td><td class="type"></td><td class="status"></td></tr>');

        dz.on("success", function (file, responseText) {

            //alert('attachment uploaded');

            setTimeout(function () {
              location.reload()
            }, 1000);

            var _$f = $f.clone();

            _$f.addClass('success');

            _$f.find('.name').html(file.name);
            if (file.size < 1024) {
              _$f.find('.size').html(parseInt(file.size) + ' KB');
            } else {
              _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
            }
            _$f.find('.type').html(file.type);
            _$f.find('.status').html('Uploaded <i class="entypo-check"></i>');

            dze_info.find('tbody').append(_$f);

            status.uploaded++;

            dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');

            toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {
              timeOut: 50000000
            });


          })
        .on('error', function (file) {
          var _$f = $f.clone();

          dze_info.removeClass('hidden');

          _$f.addClass('danger');

          _$f.find('.name').html(file.name);
          _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
          _$f.find('.type').html(file.type);
          _$f.find('.status').html('Uploaded <i class="entypo-cancel"></i>');

          dze_info.find('tbody').append(_$f);

          status.errors++;

          dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');

          toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {
            timeOut: 5000
          });
        });
      }
    }
  });
      })(jQuery, window); 



//   run();
//   function run() {
//     var text = document.getElementById('wikidescsrc').value,
//         target = document.getElementById('wikidescTargetDiv'),
//         converter = new showdown.Converter({tables: true}),
//         html = converter.makeHtml(text);

//       target.innerHTML = html;
//   }
</script>

<script type="text/javascript">

  $( document ).ready(function() {

    $('body').on('click','.attachmentdelbtn',function(e){
     e.preventDefault();
     var wikiid = $(this).attr('data');

     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


     $.ajax({
      url: 'wiki/'+wikiid,
      type: 'DELETE',
      data: {
        "wikiid": wikiid
      },
      success: function(response){

        $.iaoAlert({msg: "Data has been deleted",
          type: "success",
          mode: "dark",});
              setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
              }, 1500);
            }
          });


   });


  });
</script>


<script type="text/javascript">

  $( document ).ready(function() {

    toc_builder();

    function toc_builder(){
      var children = $(".tui-editor-contents").children("h1,h2,h3,h4");
      var html = "";
      for( var i = 0; i < children.length; i++){
        $(children[i]).prop("id", "toc-item-"+i);
        html += "<li class=\"list-group-item d-flex justify-content-between align-items-cente tocelem\"><a href=\"#toc-item-"+ i + "\">" + $(children[i]).html() + "</a></li>";
      }
      $("#toc-main").html(html);


        //smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
          a.addEventListener('click', function (e) {
            e.preventDefault();
            var href = this.getAttribute("href");
            var elem = document.querySelector(href)||document.querySelector("a[name="+href.substring(1, href.length)+"]");
            window.scroll({
              top: elem.offsetTop, 
              left: 0, 
              behavior: 'smooth' 
            });
          });
        });


      //FIXED TOC BAR AFTER SCROLLING 
      var fixmeTop = $('.wiki-toc-holder').offset().top;
      $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= fixmeTop) {
          $('.wiki-toc-holder').css({
            position: 'fixed',
            top: '5px',
            right: '2%',
            width: '284px'
          });
        } else {
          $('.wiki-toc-holder').css({
            position: 'static'
          });
        }
      });

    }



  });
</script>

<style type="text/css">
  .fileextholder {
    font-size: 11px;
    text-align: center;
    display: block;
    width: 66px;
    border: 1px solid #f3f3f3;
    padding: 8px;
    margin-top: 3px;
  }


  .imgthumbholder {
    width: 65px;
    float: right;
    vertical-align: middle;
    height: 49px;
    overflow: hidden;
    border: 1px solid #f3f3f3;
  }
  .attachmentimgholdermain {
    /* float: right; */
    max-width: 51%;
    margin: 0 auto;
    padding-top: 4px;
    display: block;
    padding-bottom: 4px;
  }
</style>

@endsection