@extends('master')
@section('mainContent')


<div class="mt-4">

 <a class="btn btn-success btn-sm mb-2 dtb_custom_btn_default dtb_secondary_bgcolor text-white" href="{{route('wiki.create', $id)}}">Add</a>

    <div class="row">
        <div class="col-md-8 col-lg-12 col-xl-9">


                <!-- Popular queries -->
                <div class="card mb-4">
                  <div class="card-body">

                            @if(isset($details))
                                  <p> The Search results for your query <b> {{ $query }} </b> are :</p>
                                    @foreach($details as $searchedwiki)
                                    <div class="srchlist">
                                      <a href="{{route('wiki.show', [$id,$searchedwiki->id])}}">{{$searchedwiki->title}}</a>
                                      <?php //echo substr($searchedwiki->description,0,40) ?>
                                      <?php 
                                      $line=$searchedwiki->description;
                                      if (preg_match('/^.{1,100}\b/s', $searchedwiki->description, $match))
                                      {
                                         echo $line=$match[0]."...";
                                      }

                                      ?>
                                    </div>
                                    @endforeach
                            @else
                            <p>No Result Matched!</p>
                            @endif
                       
                  </div>
 
                </div>
                <!-- / Popular queries -->
                <div class="card mb-4">
                  
                  <div class="card-body p-3">
                    <div class="row no-gutters">
                     

                    </div>
                  </div>
                </div>


              </div>
              <div class="col-md-4 col-lg-12 col-xl-3">

                <!-- Stats -->
                <div class="row">
                <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">

                    <div class="card mb-4">
                      <div class="card-header border-0 pb-0">Search</div>

                      <div class="card-footer border-0 small pt-0">

                         
                            {!! Form::open(['route' => ['project.wiki.search', $id]])!!}
          

                            <input type="text" name="q" class="form-control"> 
                            <input class="btn btn-success btn-sm mt-2 dtb_secondary_bgcolor" type="submit" value="Search Wiki">
                          </form>


                    
                      </div>
                    </div>

                  </div>

                  <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">

                    <div class="card mb-4">
                      <div class="card-header border-0 pb-0">Tags</div>

                        <div class="list-group-item border-top-0">

                        </div>


                    </div>

                  </div>
                  <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12">

                   <!--  <div class="card mb-4">
                      <div class="card-header border-0 pb-0">Category</div>
                      <div class="card-body text-center text-success text-xlarge py-3">Design</div>
                      <div class="card-footer border-0 small pt-0">

                      </div>
                    </div> -->

                    <div class="card mb-4 wikipagelinkholder">
                      <h6 class="card-header">Page Lists</h6>
                      <ul class="list-group list-group-flush">
                          @php 
                             $projectid = $id;
                             $wikipages = \App\DtbWiki::where(['project_id' => $projectid])->get();
                          @endphp

                          @forelse ($wikipages as $wikipage)
                            <li class="list-group-item d-flex justify-content-between align-items-center ">

                              <a href="{{route('wiki.show', [$id,$wikipage->id])}}">

                                <?php if (!empty($wikipage)) {
                               echo $wikipage->title;
                              } ?>
                                
                              </a>
                            </li>
                          @empty
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                              
                            </li>
                          @endforelse

                          <li class="list-group-item d-flex justify-content-between ">
                             
                          </li>

              
                      </ul>
                    </div>


                  </div>

                </div>
              </div>
              </div>
    </div>

 <script src="{{asset('/assets/js/marked.min.js')}}"></script>

  <script>
    var markedcontent = document.getElementById('content').innerHTML =
      marked('<?php if (!empty($wikipage)) {echo $wikipage->description; } ?>');
  </script>


<style type="text/css">
 .wikipagelinkholder  li.list-group-item.d-flex.justify-content-between.align-items-center {
    padding: 8px 16px 8px 17px;
}
.wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center:hover {
    background: #02bc7736;
}
.wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center:before {
    content: '';
    position: absolute;
    left: 13px;
    font-size: 10px;
    background: #00000045;
    width: 4px;
    height: 6px;
}
.wikipagelinkholder li.list-group-item.d-flex.justify-content-between.align-items-center a {
    padding-left: 7px;
}

.srchlist {
    padding: 15px 14px;
    background: aliceblue;
    margin-bottom: 5px;
    border-radius: 4px;
}
.srchlist a {
    margin-bottom: 10px;
    display: block;
}

.srchlist:hover {
    background: #e7eff6;
}
.srchlist a:hover {
    color: #02bc77;
    text-decoration: underline;
}
</style>

</div>
@endsection