@extends('master')
@section('mainContent')

<div class="page-content-wrapper">
    <!--Main Content-->
    <div class="content sm-gutter">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="row">
                <div class="col-12">
                    <div class="section-title align-items-center"> 
                        <h5>Category List ({{count($workout_categories)}})</h5>
                        <a href="{{route('workout_category.create')}}" title="Add New Category" data-modal-size="modal-md" class="btn btn-primary mb-3 modalLink">Create New</a>
                    </div>
                </div>

                <div class="col-12">
                    @if(session()->has('message-success'))
                    <div class="alert alert-success mb-10 background-success" role="alert">
                      {{ session()->get('message-success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="block table-block mb-4" style="margin-top: 20px;">

                    <div class="row">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl = 1; @endphp
                                    @if(isset($workout_categories))
                                    @foreach($workout_categories as $value)
                                    <tr>
                                        <td>{{ $sl++}}</td>
                                        <td align="center">

                                           @php $cat_image = ""; @endphp
                                           @if(!empty($value->cat_image))

                                           <img src="{{asset($value->cat_image)}}" alt="" class="d-block ui-w-80" id="profileDisplay" style="width: 40px; height: 40px; padding: 2px;">
                                           @else
                                           <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-80" id="profileDisplay" style="width: 40px; height: 40px; padding: 2px;">
                                           @endif

                                       </td>
                                       <td>{{$value->cat_name}}</td>
                                       <td>


                                         <a href="{{route('delete_category_view', $value->id )}}" class="btn btn-danger modalLink" title="Are You Sure You want to Delete Category ?" data-modal-size="modal-md">Delete</a>
                                     </td>
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
</div>
</div>
@endsection