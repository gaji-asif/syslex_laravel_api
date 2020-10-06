@extends('master_main')
@section('mainContent')
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />

<br>
<div class="wikisingletop">


 <div class="attachmentholder " style="padding-left: 32px">
  <div class="attachmentbtn">
    <p>
      {{--<a href="{{ $newsid }}/edit" class="btn btn-success btn-sm dtb_custom_btn_default" href="#">Edit</a>
      <a class="btn btn-success btn-sm dtb_custom_btn_default" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
       attachment
     </a> --}}
      <a class="btn btn-success btn-sm mb-2 pull-left dtb_custom_btn_default " href="{{route('news-all')}}">All Newses</a>
   </p>
 </div>
</div>
</div>



<div style="padding: 3px 30px">
  <div class="row">
    <div class="col-md-9">
      <!-- Popular queries -->
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="wikipageheader">{{$newsdetails->title}}</h5>

          @if(!empty($newsdetails))
          <div class="tui-editor-contents">
            <?php 
            $parser = new \cebe\markdown\GithubMarkdown();
            $parser->html5 = true;
            $parser->enableNewlines = true;
            $parser->keepListStartNumber = true;
            echo $parser->parse($newsdetails->detail);


            ?>
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
          {{--<div class="card mb-4">
            <div class="card-header border-0 pb-0">Search</div>
            <div class="card-footer border-0 small pt-0">
              {!! Form::open(['route' => ['news-search', $newsid]])!!}
              <input type="text" name="q" class="form-control"> 
              <input class="btn btn-success btn-sm mt-2 dtb_secondary_bgcolor" type="submit" value="Search">
            </form>
          </div>
        </div> --}}
       <div class="card mb-4 wiki-toc-holder">
        <h6 class="card-header">Table of content</h6>
        <ul class="list-group list-group-flush" id="toc-main">
        </ul>
      </div>
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


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.0/showdown.min.js"></script> -->
<script src="{{asset('/assets/js/marked.min.js')}}"></script>
<script src="{{asset('/assets/js/showdown.min.js')}}"></script>




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


@endsection