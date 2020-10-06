@extends('master')
@section('mainContent')
<style type="text/css">
  .settings_wrapper{
    width: 80%;
    margin: 0 auto;
  }
</style>
<div class="settings_wrapper">
<h4 class="font-weight-bold py-3 mb-4">
  Basic  settings
</h4>
<div class="card overflow-hidden">
  <div class="row no-gutters row-bordered row-border-light">
    <div class="col-md-3 pt-0">
      <div class="list-group list-group-flush account-settings-links">
        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Space</a>
        <a class="list-group-item list-group-item-action" data-toggle="list" href="{{route('timezone.index')}}">Timezone</a>
        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Notice</a>
      </div>
    </div>
    <div class="col-md-6">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="account-general">

          <div class="card-body media align-items-center">
            <img src="{{asset('assets_/img/avatars/5-small.png')}}" alt="" class="d-block ui-w-80">
            <div class="media-body ml-4">
              <label class="btn btn-outline-primary">
                Upload new photo
                <input type="file" class="account-settings-fileinput">
              </label> &nbsp;
              <button type="button" class="btn btn-default md-btn-flat">Reset</button>

              <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
            </div>
          </div>
          <hr class="border-light m-0">

          <div class="card-body">
            <div class="form-group">
              <label class="form-label">Username</label>
              <input type="text" class="form-control mb-1" value="nmaxwell">
            </div>
            <div class="form-group">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" value="Nelle Maxwell">
            </div>
            <div class="form-group">
              <label class="form-label">E-mail</label>
              <input type="text" class="form-control mb-1" value="nmaxwell@mail.com">
              <div class="alert alert-warning mt-3">
                Your email is not confirmed. Please check your inbox.<br>
                <a href="javascript:void(0)">Resend confirmation</a>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Company</label>
              <input type="text" class="form-control" value="Company Ltd.">
            </div>
          </div>

        </div>
        <div class="tab-pane fade" id="account-change-password">
          <div class="card-body pb-2">

            <div class="form-group">
              <label class="form-label">Current password</label>
              <input type="password" class="form-control">
            </div>

            <div class="form-group">
              <label class="form-label">New password</label>
              <input type="password" class="form-control">
            </div>

            <div class="form-group">
              <label class="form-label">Repeat new password</label>
              <input type="password" class="form-control">
            </div>

          </div>
        </div>
        <div class="tab-pane fade" id="account-info">
          <div class="card-body pb-2">

            <div class="form-group">
              <label class="form-label">Bio</label>
              <textarea class="form-control" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nunc arcu, dignissim sit amet sollicitudin iaculis, vehicula id urna. Sed luctus urna nunc. Donec fermentum, magna sit amet rutrum pretium, turpis dolor molestie diam, ut lacinia diam risus eleifend sapien. Curabitur ac nibh nulla. Maecenas nec augue placerat, viverra tellus non, pulvinar risus.</textarea>
            </div>
            <div class="form-group">
              <label class="form-label">Birthday</label>
              <input type="text" class="form-control" value="May 3, 1995">
            </div>
            <div class="form-group">
              <label class="form-label">Country</label>
              <select class="custom-select">
                <option>USA</option>
                <option selected>Canada</option>
                <option>UK</option>
                <option>Germany</option>
                <option>France</option>
              </select>
            </div>
         </div>
          <hr class="border-light m-0">
          <div class="card-body pb-2">

            <h6 class="mb-4">Contacts</h6>
            <div class="form-group">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" value="+0 (123) 456 7891">
            </div>
            <div class="form-group">
              <label class="form-label">Website</label>
              <input type="text" class="form-control" value="">
            </div>

          </div>
          <hr class="border-light m-0">
          <div class="card-body pb-2">

            <h6 class="mb-4">Interests</h6>
            <div class="form-group">
              <label class="form-label">Favorite music</label>
              <input type="text" class="form-control account-settings-tagsinput" value="Rock,Alternative,Electro,Drum & Bass,Dance">
            </div>
            <div class="form-group">
              <label class="form-label">Favorite movies</label>
              <input type="text" class="form-control account-settings-tagsinput" value="The Green Mile,Pulp Fiction,Back to the Future,WALL·E,Django Unchained,The Truman Show,Home Alone,Seven Pounds">
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="text-right mt-3">
  <button type="button" class="btn btn-success">Save changes</button>&nbsp;
  <button type="button" class="btn btn-default">Cancel</button>
</div>
</div>
@endsection
