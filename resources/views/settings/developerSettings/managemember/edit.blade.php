@extends('master_main')
@section('mainContent')


		<div class="row mt-4">

        <div class="col-md-2">
        </div>

          <div class="col-md-8">

            <!-- Popular products -->
                <?php 
                  if (isset($id)) {
                      $skillinfo = DB::table('dtb_user_skills')->where('id', $id)->first();
                      // $projectofdeveloper = \App\DtbProject::where('developer_id', '=', $loggedindeveloper)->get()->toArray();
                    }
                ?>

            <div class="card mb-4 mt-4">
              <h6 class="card-header" style="background: #38587d;color: #fff;">
                <span style="float: left;">Edit Skill</span>
                <a data="<?php echo $skillinfo->id; ?>" href="#" class="btn btn-sm btn-default pull-right skilldelbtn" style="color: white;border-color: white">Delete</a>
              </h6>

              <?php if (isset($skillinfo)) {?>
			
             {!! Form::open(['route' => ['userskill.update', $id], 'method' => 'PUT','files' => true, 'enctype' => 'multipart/form-data','id' => 'skilleditform','class' => 'form-horizontal'])!!}
                        <div class="modal-body pt-0">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                      <div class="col-md-7 pl-0">
                                          <div class="col-sm-12">
                                          @if(session()->has('message'))
                                          <div class="alert alert-success mb-0 background-success" role="alert">
                                          {{ session()->get('message') }}
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                          @endif
                                          </div>
                                      </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>

                                  <input type="hidden" name="user_id2" id="user_id2" value="{{ $skillinfo->user_id ?? '' }}">
                                  <br>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="row">

                                        <div class="col-md-6">
                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Skill Name </label>
                                          </div>        
                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Technical </label>
                                          </div>
                                        </div>

                                      <div class="col-md-6">
                                      <div class="form-group">

                                        <div class="">
                                        <input name="name" id="name" type="text" required class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('name') ??  $skillinfo->name }}">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
                                        </span>
                                        @endif
                                        </div>
                                      </div>

                                      <div class="form-group">

                                      <div class="">
                                      <input id="technical" name="technical" type="text" class="summable form-control  {{ $errors->has('technical') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('technical') ??  $skillinfo->technical }}">
                                      @if ($errors->has('technical'))
                                      <span class="invalid-feedback" role="alert">
                                      <span class="messages"><strong>{{ $errors->first('technical') }}</strong></span>
                                      </span>
                                      @endif
                                      </div>
                                      </div>
                                      </div>
                                      </div>  
                                    </div>

                                    <div class="col-md-4">
                                    </div>
                                  </div>                       

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="row">

                                        <div class="col-md-6">
                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Sence </label>
                                          </div>        
                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Comprehend </label>
                                          </div>
                                        </div>

                                      <div class="col-md-6">
                                      <div class="form-group">
                                    
                                        <div class="">
                                        <input name="sence" id="sence" type="text" class="summable form-control  {{ $errors->has('sence') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('sence') ??  $skillinfo->sence }}">
                                        @if ($errors->has('sence'))
                                        <span class="invalid-feedback" role="alert">
                                        <span class="messages"><strong>{{ $errors->first('sence') }}</strong></span>
                                        </span>
                                        @endif
                                        </div>
                                      </div>

                                      <div class="form-group">

                                      <div class="">
                                      <input name="comprehend" id="comprehend" type="text" class="summable form-control  {{ $errors->has('comprehend') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('comprehend') ?? $skillinfo->comprehend }}">
                                      @if ($errors->has('comprehend'))
                                      <span class="invalid-feedback" role="alert">
                                      <span class="messages"><strong>{{ $errors->first('comprehend') }}</strong></span>
                                      </span>
                                      @endif
                                      </div>
                                      </div>
                                      </div>
                                      </div>  
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div> 

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="row">

                                        <div class="col-md-6">    
                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Communication </label>
                                          </div>
                                        </div>
                                      <div class="col-md-6">
                                      <div class="form-group">
                                    
                                        <div class="">
                                        <input name="communication" id="communication" type="text" class="summable form-control  {{ $errors->has('communication') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('communication') ?? $skillinfo->communication }}">
                                        @if ($errors->has('communication'))
                                        <span class="invalid-feedback" role="alert">
                                        <span class="messages"><strong>{{ $errors->first('communication') }}</strong></span>
                                        </span>
                                        @endif
                                        </div>
                                      </div>

                                      </div>
                                      </div>  
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div> 

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="row">

                                        <div class="col-md-6">
                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Quality </label>
                                          </div> 

                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Speed </label>
                                          </div>     

                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Total </label>
                                          </div>
                                        </div>

                                      <div class="col-md-6">
                                      <div class="form-group">
                                    
                                        <div class="">
                                        <input name="quality" id="quality" type="text" class="summable form-control  {{ $errors->has('quality') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('quality') ?? $skillinfo->quality }}">
                                        @if ($errors->has('quality'))
                                        <span class="invalid-feedback" role="alert">
                                        <span class="messages"><strong>{{ $errors->first('quality') }}</strong></span>
                                        </span>
                                        @endif
                                        </div>
                                      </div>                                      

                                      <div class="form-group">
                                    
                                        <div class="">
                                        <input name="speed" id="speed" type="text" class="summable form-control  {{ $errors->has('speed') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('speed') ?? $skillinfo->speed }}">
                                        @if ($errors->has('speed'))
                                        <span class="invalid-feedback" role="alert">
                                        <span class="messages"><strong>{{ $errors->first('speed') }}</strong></span>
                                        </span>
                                        @endif
                                        </div>
                                      </div>


                                      <div class="form-group">

                                      <div class="">
                                      <input name="total" id="total" type="text" class="form-control  {{ $errors->has('total') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('total') ?? $skillinfo->total }}">
                                      @if ($errors->has('total'))
                                      <span class="invalid-feedback" role="alert">
                                      <span class="messages"><strong>{{ $errors->first('total') }}</strong></span>
                                      </span>
                                      @endif
                                      </div>
                                      </div>
                                      </div>
                                      </div>  
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                  </div> 

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="row">

                                        <div class="col-md-3">
                                          <div class="form-group">
                                          <label class="col-form-label text-sm-left col-md-12">Comment </label>
                                          </div>        

                                        </div>

                                      <div class="col-md-9">
                                        <div class="form-group">
                                           <div>

                                             <div id="editSection"></div>
                                              <!-- <button id="dummycontentaddbtn">Add Dummy Content</button> -->
                                              <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" id="content2bSavedHolder2" name="comment" style="display:none"></textarea>

                                              @if ($errors->has('comment'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                        
                                        </div>


                                        <!-- HOLDER OF DB DESC CONTENT,WHERE FROM CONTENT BEING SUPPLIED TO SHOWDOWN AND TUI EDITOR TO BE EDITED. -->
                                        <textarea id="commentconent" rows="10" cols="82">
                                          <?php if (!empty($skillinfo)) { echo $skillinfo->comment;} ?>
                                        </textarea>

                                      </div>
                                      </div>  
                                    </div>

                                    <div class="col-md-4">
                                    </div>
                                  </div>    
                        </div>
                        <div class="modal-footer" style="border: none">
                          <input type="submit" class="btn btn-primary " id="btnskilladdform" value="Update">
                        </div>
              </form>


              <?php }else{ ?>


              <?php } ?>
            </div>
          </div>
         <div class="col-md-2">
          </div>
    </div>
<style>
  #commentconent{
    display: none !important;
  }
</style>

  <script src="{{asset('/assets/js/showdown.min.js')}}"></script>
<!--   <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link> -->
<!--   <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link> -->
<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link> -->
<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link> -->
<!--   <script src="https://uicdn.toast.com/tui-editor/latest/tui-editor-Editor-full.js"></script> -->
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>


  <script type="text/javascript">
        var text = document.getElementById('commentconent').value,
        target = document.getElementById('editSection'),
        converter = new showdown.Converter(),
        html = converter.makeHtml(text);
        target.innerHTML = html;

        var editor = new tui.Editor({
          el: document.querySelector('#editSection'),
          height: '400px',
          previewStyle: 'vertical',
          initialValue: text,
          exts: [
                  {
                    name: 'chart',
                    minWidth: 100,
                    maxWidth: 600,
                    minHeight: 100,
                    maxHeight: 300
                  },
                  'scrollSync',
                  'colorSyntax',
                  'uml',
                  'mark',
                  'table'
                ],  
                hooks: {
                        addImageBlobHook: function (blob, callback) {
                            var myupload = ImageUpload(blob);
                            //console.log(blob);
                            var cllbackimg = myupload;
                            //var cllbackimg = document.location.origin +'/developmentmanage/public/'+myupload;
                            callback(cllbackimg, 'alt text');
                        }
                    }
        });


function ImageUpload(images){
    var myresult = "";
    var dataimg = new FormData();
    var form = dataimg.append('file', images);
  
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url : '{{ url('/wiki/upload/wiki') }}',
      method: 'POST',
      async: false,
      cache : false,
      contentType : false,
      processData : false,
      data :  dataimg,
        success: function (response) {
        //alert(response);
        //console.log(response);
        myresult = response;
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert('error in uploading file');
        }
    });
 
    return myresult;
}



        //BIND TOAST UI EDITOR CONTENT TO TEXTAREA WHEN SUBMIT BUTTON CLICKED
        $("#skilleditform").submit(function(e){
          var content2bSaved = editor.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder2').html(content2bSaved);
        });





///////////APP DELETE OPERATION ////////////////////
  $('body').on('click','.skilldelbtn',function(e){
     e.preventDefault();

    var skillid = $(this).attr('data');

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
             $.ajax({
                url:'delete',
                type: 'DELETE',
                data: {
                "skillid": skillid,
                "memberid": <?php echo $skillinfo->user_id; ?>
              },
                success: function(response){
                $.iaoAlert({msg: "Data has been deleted",
                type: "success",
                mode: "dark",});
                  setTimeout(function(){// wait for 5 secs(2)
                    window.location.href = "{{ route('managemember.show',$skillinfo->user_id)}}";
                  }, 1500);
                }
            });


    });




$(document).ready(function(){

    //iterate through each textboxes and add keyup
    //handler to trigger sum event
    $(".summable").each(function() {

      $(this).keyup(function(){
        calculateSum();
      });
    });

  });

  function calculateSum() {

    var sum = 0;
    //iterate through each textboxes and add the values
    $(".summable").each(function() {
      //add only if the value is number
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }

    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#total").val(sum.toFixed(2));
  }


  </script>




@endsection