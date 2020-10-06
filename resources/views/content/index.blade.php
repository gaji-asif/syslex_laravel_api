@extends('master')
@section('mainContent')

 <div class="page-content-wrapper">
    <!--Main Content-->
        <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title align-items-center"> 
                            <h5>Contents List ({{count($allContents)}})</h5>
                            <a href="{{route('content.create')}}" class="btn btn-primary mb-3">Create New</a>
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
                        <div class="col-12 workout_section">
                        <div class="block table-block mb-3">

                             <div class="row">

                                @foreach($allContents as $value)


                                <div class="col-md-4">
                                    <div class="inside">
                                        <div class="image" width style="width: 100%;">
                                            <!-- <video width="100%" controls>

  <source src="{{$value->video_link}}" type="video/mp4">
  <source src="{{$value->video_link}}" type="video/ogg">
  <source src="{{$value->video_link}}" type="video/wmv">
  Your browser does not support HTML video.
</video> -->

<!--  <iframe width="420" height="315" src="https://www.youtube.com/embed/A6XUVjK9W4o" frameborder="0" allowfullscreen></iframe> -->
 @php  $video = $value->video_link; @endphp 
@if(!empty($value->video_link))
<iframe width="100%" height="250" src="{{$video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

@else
  <img src="{{asset('assets_new/images/novideoavailable.jpg')}}" width="100%" height="250">
@endif
<!-- @if(!empty($value->video_link)) -->
<!-- <iframe width="100%" src="{{$video}}" height="250" frameborder="0" allowfullscreen></iframe>
@else
  <img src="{{asset('assets_new/images/novideoavailable.jpg')}}" width="100%" height="250">
@endif -->
                                        </div>
                                        <h3>{{$value->content_name}}</h3>
                                        <p>{{strip_tags($value->description)}}</p>
                                        <!-- <a href="edit-workout.php">More..</a> -->
                                        <div class="icons">
                                            <a href="{{route('content.edit', $value->id)}}"><span data-toggle="tooltip" title="Edit"><i class="dripicons-document-edit"></i></span></a>
                                            <!-- <a href="#" data-toggle="modal" data-target="#myModal"><span data-toggle="tooltip" title="Assign"><i class="dripicons-user-group"></i></span></a>
                                            <span data-toggle="tooltip" title="Play"><i class="dripicons-media-play"></i></span> -->
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                               
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection