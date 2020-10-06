@extends('master')
@section('mainContent')
<style type="text/css">
  .teams_wrapper{
    width: 80%;
    margin: 0 auto;
  }
</style>
<div class="teams_wrapper">
<h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
  <div>Teams</div>
  <button type="button" class="btn btn-primary rounded-pill d-block"><span class="ion ion-md-add"></span>&nbsp; Add team</button>
</h4>

<div class="row">
  <div id="dragula-left-drag-handles" class="col-12">
    <div class="dragula-example card card-condenced">
      <div class="card-body">
        <span class="handle ion ion-ios-move d-inline-block bg-primary text-white p-2 mr-2 mb-1"></span>Team 1</div>
      </div>
      <div class="dragula-example card card-condenced">
        <div class="card-body">
          <span class="handle ion ion-ios-move d-inline-block bg-primary text-white p-2 mr-2 mb-1"></span>Team 2</div>
        </div>
        <div class="dragula-example card card-condenced">
        <div class="card-body">
          <span class="handle ion ion-ios-move d-inline-block bg-primary text-white p-2 mr-2 mb-1"></span>Team 3</div>
        </div>
      </div>
</div>
</div>
@endsection


