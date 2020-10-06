@extends('master_main')
@section('mainContent')

<div class="container pt-4">
  <div class="row">

		<div class="col-lg-3">
			@include('settings.developerSettings.developer_settings_sidebar')
		</div>





  <div class="col-lg-9">
    <div class="card mb-4">
      <h6 class="card-header">Add Contact</h6>
      <div class="card-body">



            <div class="card-datatable table-responsive">

                <!-- <div style="width: 80%;margin: 0 auto">
                    <div class="alert alert-success background-success msgcontainer" id="msgcontainer" style="display: none;" role="alert">
                    <span id="successmsg"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                </div> -->

                <table class="datatables-demo table table-striped table-bordered" id="contactlist">
                    <thead>
                        <tr>
                            <th style="display: none;"></th>
                            <th>#SL</th>
                            <th>Comapny Name</th>
                            <th>Company Name Kana</th>
                            <th>Charge Person</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>State</th>
                            <th>Address</th>
                            <th>Url</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $sl = 1; @endphp
                        @if(isset($contactlist))
                            @foreach($contactlist as $contact)
                                <tr class="odd gradeX contactlist" id="{{$contact->id}}">
                                    
                                    <td>{{$sl++}}</td>
                                    <td style="display: none;">{{$contact->company_name}}</td>
                                    <td>{{$contact->company_name}}</td>
                                    
                                    <td class="company_name_kana">{{$contact->company_name_kana}}</td>
                                    <td class="charge_person">{{$contact->charge_person}}</td>
                                    <td class="charge_person_email">{{$contact->charge_person_email}}</td>
                                    <td class="phone">{{$contact->phone}}</td>
                                    <td class="charge_person_position">{{$contact->charge_person_position}}</td>
                                    <td class="state">{{$contact->state}}</td>
                                    <td class="address">{{$contact->address}}</td>
                                    <td class="url">{{$contact->url}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>



      </div>
    </div>
  </div>

</div>

</div>


@endsection