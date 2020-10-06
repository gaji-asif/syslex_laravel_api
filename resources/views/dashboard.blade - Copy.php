@extends('master')
@section('mainContent')
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
    <div class="card overflow-hidden">
  <div class="row no-gutters row-bordered row-border-light">


    <div class="col-md-2 pt-0">
    @include('settings.generalSettings.general_settings_sidebar')
    </div>


    <div class="col-md-10">
      <div class="tab-content">
            <div class="tab-pane fade show active" id="account-general">

              <div class="card-body media align-items-center">
                  <h5>Project General Settings</h5>
              </div>

              <hr class="border-light m-0">

  

            {!! Form::open(['route' => ['project.settings', $id]])!!}
            {{ method_field('PUT') }}

                <div class="card-body">


                @if(session()->has('message'))
                <div class="alert alert-success mb-10 background-success" role="alert">
                  {{ session()->get('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            
                @endif


                <div class="form-group">
                  <label class="form-label">Project Name</label>
                  <input type="text" class="form-control mb-1 {{ $errors->has('project_name') ? ' is-invalid' : '' }}"  name="project_name"  value="{{ $DtbProject->project_name  ?? '' }}">
                  @if ($errors->has('project_name'))
                  <span class="invalid-feedback" role="alert">
                      <span class="messages"><strong>{{ $errors->first('project_name') }}</strong></span>
                  </span>
                  @endif

                </div>
                <div class="form-group">
                  <label class="form-label">Project Key</label>
                  <input type="text" class="form-control {{ $errors->has('project_key') ? ' is-invalid' : '' }}" name="project_key" value="{{ $DtbProject->project_key  ?? '' }}">
                  @if ($errors->has('project_key'))
                  <span class="invalid-feedback" role="alert">
                      <span class="messages"><strong>{{ $errors->first('project_key') }}</strong></span>
                  </span>
                  @endif

                </div>


                <div class="form-group">
                        <label class="form-label">Project Details</label>
                        <textarea class="form-control {{ $errors->has('project_detail') ? ' is-invalid' : '' }}" placeholder="Project Detail" rows="5" id="Prject Description" name="project_detail">{{ $DtbProject->project_detail ?? '' }}</textarea>
                        @if ($errors->has('project_detail'))
                        <span class="invalid-feedback" role="alert">
                            <span class="messages"><strong>{{ $errors->first('project_detail') }}</strong></span>
                        </span>
                        @endif
                </div>

                <div class="form-group">
                    @if(Session::has('role'))
                      @if(Session::get('role') == '0')
                        <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_archive" value="1" class="custom-control-input" 
                        <?php
                          if(!empty($DtbProject->is_archived)) { if ($DtbProject->is_archived == 1) 
                          { ?> checked="checked"
                        <?php }} ?>>
                        <span class="custom-control-label">Archive this project</span>
                        </label>
                    @endif
                  @endif
                </div>
                <div style="clear: both"></div>

                <div class="text-center mt-4">
                  <div class="form-group">
                  <input type="submit" name="submit" value="Submit" class="btn btn-primary dtb_custom_btn_default">
                </div>
                </div>



                <div class="deleteareae" style="margin-top: 60px;display: block;">
                  <label for="delete"><strong>Delete Project</strong></label>
                  <hr>
                  <p style="font-size: 13.8px;">Once you delete your project, there is no going back. Please be certain.</p>
                  
                    <div class="form-group text-center">
                    <a href="#" class="btn btn-danger projectdeleteconfirmation dtb_custom_btn_default deletebtn" style="" data-toggle="modal" data-target="#projectdeleteconfirmation" value="{{ $DtbProject->id ?? '' }}">Delete</a>
                  </div>
                </div>



              </div>
              </form>


            </div>


      </div>
    </div>

    
  </div>
</div>



  <!-- Modal -->
  <div class="modal fade" id="projectdeleteconfirmation" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #f8d7da;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title">Are you sure to delete?</h6>
        </div>
<!--         <div class="modal-body">
          <p>Some text in the modal.</p>
        </div> -->
        <div class="modal-footer">
         

          <button  value="{{ $DtbProject->id ?? '' }}" type="button" class="btn btn-danger projectdelbtn" data-dismiss="modal">YES</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
        </div>
      </div>
      
    </div>
  </div>


  
  </div>
  <div class="col-lg-2"></div>
</div>

<style>
.custom-checkbox .custom-control-label::before {
    border-color: #00000054;
}

  .deleteareae hr {
    padding: 0px !IMPORTANT;
    margin: 0px;
    margin-bottom: 6px;
    margin-top: -4px;
}

.deletebtn{
margin-left: 8px;color: red;border-color: red
}

.deletebtn:hover{
  
color: white !IMPORTANT;
    border-color: white !important;
}

</style>

<script type="text/javascript">
$( document ).ready(function() {


// issue delete
$('body').on('click','.projectdeleteconfirmation',function(e){
e.preventDefault();
var projectid = $(this).attr('value');

  //when confirm modal clicked
  $('body').on('click','.projectdelbtn',function(e){
    e.preventDefault();
    
    deleteproject();
  });


function deleteproject() {

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

        $.ajax({
            url: 'project',
            type: 'DELETE',
            data: {
            "projectid": projectid
        },
            success: function(response){
            $.iaoAlert({msg: "Data has been deleted",
            type: "success",
            mode: "dark",});
              setTimeout(function(){// wait for 5 secs(2)
            
                window.location.href = "{{URL::to('projects')}}";
              }, 1000);
            }
        });

  }

 });


});
</script>
@endsection