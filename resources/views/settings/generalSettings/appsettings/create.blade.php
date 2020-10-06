@extends('master')
@section('mainContent')
<style type="text/css">
  .issue_wrapper{
    margin:0 auto;
  }
  .gap{
    padding: 0px 50px 0px 50px;
  }
    .te-preview {
    background: white;
}
form#appaddform input {
    border-radius: 0px;
    font-size: 13px;
}
</style>
<div class="row">
  <div class="col-lg-10 issue_wrapper">
<!--     <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Dashboard /</span> Apps
    </h4> -->
    <div class="mb-4">
  

      <div class="card-body gap">

    <h4 class="px-0" style="color: black">
        Add App
         <a href="{{route('apps.index', $id)}}" class="btn btn-primary btn-sm pull-right dtb_custom_btn_default" style="margin-top: -1px">All Apps</a>
    </h4>

  {!! Form::open(['route' => ['apps.store', $id], 'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','id' => 'appaddform','class' => 'form-horizontal'])!!}

        <div class="form-group row">
          <div class="col-sm-12">
            @if(session()->has('message'))
            <br>
            <div class="alert alert-success mb-10 background-success" role="alert">
              {{ session()->get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
          </div>
        </div>


        <input type="hidden" name="project_id" value="<?php echo $id; ?>">



        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">App Name</label>
             <div class="">
              <input name="app_name" type="text" class="form-control  {{ $errors->has('app_name') ? ' is-invalid' : '' }}"  value="{{ old('app_name') }}">
              @if ($errors->has('app_name'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('app_name') }}</strong></span>
              </span>
              @endif
            </div>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">App Short Name</label>
              <div class="">
               <input type="text" name="app_short_name" class="form-control  {{ $errors->has('app_short_name') ? ' is-invalid' : '' }}"  value="{{ old('app_short_name') }}">

               @if ($errors->has('app_short_name'))
               <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('app_short_name') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>

          <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Target SDK</label>
             <div class="">
              <input name="target_sdk" type="text" class="form-control  {{ $errors->has('target_sdk') ? ' is-invalid' : '' }}" value="{{ old('target_sdk') }}">
              @if ($errors->has('target_sdk'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('target_sdk') }}</strong></span>
              </span>
              @endif
            </div>

            </div>
          </div>
      </div>        



      <div class="row">
          <div class="col-md-4  ">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Repository</label>
              <div class="">
               <input type="text" name="repo" class="form-control  {{ $errors->has('repo') ? ' is-invalid' : '' }}"  value="{{ old('repo') }}">

               @if ($errors->has('repo'))
               <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('repo') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>

          <div class="col-md-4  ">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Deployment Target</label>
              <div class="">
               <input type="text" name="deployment_target" class="form-control  {{ $errors->has('deployment_target') ? ' is-invalid' : '' }}"  value="{{ old('deployment_target') }}">

               @if ($errors->has('deployment_target'))
               <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('deployment_target') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
          </div>
          <div class="col-md-4  ">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Deploy Url</label>
              <div class="">
               <input type="text" name="deploy_url" class="form-control  {{ $errors->has('deploy_url') ? ' is-invalid' : '' }}"  value="{{ old('deploy_url') }}">

               @if ($errors->has('deploy_url'))
               <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('deploy_url') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>



      <div class="row">
          <div class="col-md-4">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Company Name</label>
             <div class="">
              <input name="company_name" type="text" class="form-control  {{ $errors->has('company_name') ? ' is-invalid' : '' }}"  value="{{ old('company_name') }}">
              @if ($errors->has('company_name'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('company_name') }}</strong></span>
              </span>
              @endif
            </div>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">IDE version</label>
              <div class="">
               <input type="text" name="ide_version" class="form-control  {{ $errors->has('ide_version') ? ' is-invalid' : '' }}" value="{{ old('ide_version') }}">

               @if ($errors->has('ide_version'))
               <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('ide_version') }}</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>          

        <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label text-sm-right">Screen Group</label>
                 <div class="">
                  <select name="screen_group_id" class="custom-select NoborderRadius" id="screen_group_id" style="height: 40px;">
                <option value="">Select Screen Group</option>
                  @foreach($screengrouplist as $screengrouplists)
                  <option value="{{ $screengrouplists->id }}">{{ $screengrouplists->screen_group_name }}</option>
                  @endforeach
                </select>
                </div> 
          </div>
        </div>
      </div>


      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
             <label class="col-form-label text-sm-right">Memo</label>
             <div class="">
              <div id="editSection"></div>
              <textarea id="content2bSavedHolder" name="memo" class="form-control" style="display: none;"> </textarea>

              @if ($errors->has('memo'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>The Memo field is required</strong></span>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>



  <div class="form-group row">
    <div class="col-sm-12 ml-sm-auto text-center">
      <button type="submit" class="btn btn-success dtb_custom_btn_default mt-4" style="padding: 5px 111px">Add</button>
    </div>
  </div>
</form>
</div>
</div>
</div>
</div>



<link rel="stylesheet" href="{{asset('css/for_marked/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/style.css')}}" />

<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor.css"></link> -->
<!-- <link rel="stylesheet" href="https://uicdn.toast.com/tui-editor/latest/tui-editor-contents.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.33.0/codemirror.css"></link> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css"></link> -->
<!-- <script src="{{asset('js/tui-editor-Editor-full.js')}}"></script> -->
<link rel="stylesheet" href="{{asset('css/for_marked/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('css/for_marked/github.min.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor.css')}}" />
<link rel="stylesheet" href="{{asset('tui-editor/css/tui-editor-contents.css')}}" />
<script src="{{asset('js/for_marked/tui-editor-Editor-full.js')}}"></script>



<script type="text/javascript">

          //initial content
          var content = [' * * *',' ',].join('\n');

          //TOAST UI MAIN SETTINGS
          var editor = new tui.Editor({
              el: document.querySelector('#editSection'),
              initialEditType: 'markdown',
              // initialEditType: 'wysiwyg',
              initialValue: content,
              previewStyle: 'vertical',
              height: '300px',
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
                            //var cllbackimg = document.location.origin +'/developmanage/public/'+myupload;
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
                url : '{{ url('/uploadappfiles') }}',
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
        $("#appaddform").submit(function(e){;
          var content2bSaved = editor.getValue(); 
          //var content2bSaved = editor.getHtml();
          $('#content2bSavedHolder').html(content2bSaved);

        });


      //FOR SHOWING MARKDOWN CONTENT USING SHOWDOWN JS
      // var markedcontent = document.getElementById('content').innerHTML =
      //   marked('<?php //if (!empty($wikipage)) {echo $wikipage->description; } ?>');

    </script>




@endsection
