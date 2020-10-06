@extends('master')
@section('mainContent')

 <div class="page-content-wrapper">
    <!--Main Content-->
        <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title align-items-center"> 
                            <h5>Challenges</h5>
                            <a href="#" class="btn btn-success mb-3 mr-2">Add Challenge</a>
                        </div>
                    </div>

                    <div class="col-12 challenge_section">
                        <div class="block">
                          <div class="row">
                            
                            <div class="col-md-6 mb-3">
                              <label class="control-label">Search Challenges</label>
                              <input type="text" name="search" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="control-label">Filter</label>
                              <select class="form-control">
                                <option value="">Filter challenges</option>
                                <option id="all" value="all">All</option>
                                <option id="recent" value="recent">Recent</option>
                                <option id="body" value="body">Body</option>
                                <option id="performance" value="performance">Performance</option>
                                <option id="my_challenges" value="my_challenges">My Challenges</option>
                                <option id="challenges_created_by_me" value="challenges_created_by_me">Challenges created by me</option>
                                <option id="my_challenges_in_progress" value="my_challenges_in_progress">My Challenges - In progress</option>
                                <option id="my_challenges_completed" value="my_challenges_completed">My Challenges - Completed</option>
                                <option id="my_challenges_expired" value="my_challenges_expired">My Challenges - expired</option>
                              </select>
                          </div>

                         <!--  <div class="col-md-12 countries">
                            <ul>
                              <li class="active"><a href="#"><img src="../images/en.png"></a></li>
                              <li><a href="#"><img src="../images/no.png"></a></li>
                              <li><a href="#"><img src="../images/lv.png"></a></li>
                              <li><a href="#"><img src="../images/lt.png"></a></li>
                              <li><a href="#"><img src="../images/el.png"></a></li>
                              <li><a href="#"><img src="../images/pl.png"></a></li>
                              <li><a href="#"><img src="../images/tr.png"></a></li>
                              <li><a href="#"><img src="../images/ru.png"></a></li>
                              <li><a href="#"><img src="../images/it.png"></a></li>
                              <li><a href="#"><img src="../images/pt_br.png"></a></li>
                              <li><a href="#"><img src="../images/fr.png"></a></li>
                              <li><a href="#"><img src="../images/es.png"></a></li>
                              <li><a href="#"><img src="../images/de.png"></a></li>
                              <li><a href="#"><img src="../images/nl.png"></a></li>
                            </ul>
                          </div>

 -->
                          <div class="col-md-4 challenge_listings mt-3 mb-3">
                            <div class="inside">
                              <a href="#">
                                <div class="image"><img src="../images/bodypart_1517098824.jpg"></div>
                                <div class="subname">Virtuagym</div>
                                <h3>Steps - Total Cumulative - 3000 steps</h3>
                                <p>1 participants, Steps, Total Cumulative 3000 steps , Combined Progress , Weekly   </p>
                                <div class="participants">1 Participants</div>
                                <div class="count_timer" id="demo"></div>
                              </a>
                            </div>
                          </div>

                          <div class="col-md-4 challenge_listings mt-3 mb-3">
                            <div class="inside">
                              <a href="#">
                                <div class="image"><img src="../images/bodypart_1517097903.jpg"></div>
                                <div class="subname">Virtuagym</div>
                                <h3>Burnt Calories - Total Cumulative kcal</h3>
                                <p>1 participants, Steps, Total Cumulative 3000 steps , Combined Progress , Weekly   </p>
                                <div class="participants">10 Participants</div>
                                <div class="count_timer" id="demo1"></div>
                              </a>
                            </div>
                          </div>

                          <div class="col-md-4 challenge_listings mt-3 mb-3">
                            <div class="inside">
                              <a href="#">
                                <div class="image"><img src="../images/bodypart_1517098045.jpg"></div>
                                <div class="subname">Virtuagym</div>
                                <h3>Steps - Total Cumulative - 3000 steps</h3>
                                <p>1 participants, Steps, Total Cumulative 3000 steps , Combined Progress , Weekly   </p>
                                <div class="participants">19 Participants</div>
                                <div class="count_timer" id="demo2"></div>
                              </a>
                            </div>
                          </div>

                          <div class="col-md-4 challenge_listings mt-3 mb-3">
                            <div class="inside">
                              <a href="#">
                                <div class="image"><img src="../images/bodypart_1517098401.jpg"></div>
                                <div class="subname">Virtuagym</div>
                                <h3>Steps - Total Cumulative - 3000 steps</h3>
                                <p>1 participants, Steps, Total Cumulative 3000 steps , Combined Progress , Weekly   </p>
                                <div class="participants">22 Participants</div>
                                <div class="count_timer" id="demo3"></div>
                              </a>
                            </div>
                          </div>

                          <div class="col-md-4 challenge_listings mt-3 mb-3">
                            <div class="inside">
                              <a href="#">
                                <div class="image"><img src="../images/bodypart_1519938334.jpg"></div>
                                <div class="subname">Virtuagym</div>
                                <h3>Steps - Total Cumulative - 3000 steps</h3>
                                <p>1 participants, Steps, Total Cumulative 3000 steps , Combined Progress , Weekly   </p>
                                <div class="participants">28 Participants</div>
                                <div class="count_timer" id="demo4"></div>
                              </a>
                            </div>
                          </div>

                          <div class="col-md-4 challenge_listings mt-3 mb-3">
                            <div class="inside">
                              <a href="#">
                                <div class="image"><img src="../images/bodypart_1517097991.jpg"></div>
                                <div class="subname">Virtuagym</div>
                                <h3>Steps - Total Cumulative - 3000 steps</h3>
                                <p>1 participants, Steps, Total Cumulative 3000 steps , Combined Progress , Weekly   </p>
                                <div class="participants">32 Participants</div>
                                <div class="count_timer" id="demo5"></div>
                              </a>
                            </div>
                          </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
@endsection