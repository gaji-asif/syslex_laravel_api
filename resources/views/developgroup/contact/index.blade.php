@extends('master')
@section('mainContent')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Dashboard </span> Contact
</h4>

<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            <div class="row">
                <div class="col-md-6"><h6 class="mb-0">Contact List</h6></div>
                <div class="col-md-6"> 
                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">Add Contact</button>
                </div>
            </div>
            </div>
            
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


    <!-- modals file inclusion -->
       <!--  @include('partials.modals') -->
    <!-- modals file inclusion ends-->


        <script type="text/javascript">
            $( document ).ready(function() {

                $('#contactlist').SetEditable({
                columnsEd: "2,3,4,5,6,7,8,9,10",
                });



                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                $.get("{{ URL::to('contact') }}",function(data){

                })


            })
        </script>


</div>
@endsection