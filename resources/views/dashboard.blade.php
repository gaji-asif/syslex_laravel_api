@extends('master')
@section('mainContent')
  <div class="page-content-wrapper">

        <!--Main Content-->
        <div class="sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10 home_blocks">
                <div class="row">

                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 single_blocks">
                        <div class="block counter-block mb-4">
                            <div class="value">19</div>
                            <i class="dripicons-stopwatch i-icon"></i>
                            <p class="label">Exercises</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 single_blocks">
                        <div class="block counter-block mb-4">
                            <div class="value">16</div>
                            <i class="dripicons-to-do i-icon"></i>
                            <p class="label">Contents</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 single_blocks">
                        <div class="block counter-block mb-4">
                            <div class="value">8</div>
                            <i class="dripicons-user i-icon"></i>
                            <p class="label">Bodyparts</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 single_blocks">
                        <div class="block counter-block mb-4">
                            <div class="value">6</div>
                            <i class="dripicons-lifting i-icon"></i>
                            <p class="label">Equipments</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 single_blocks">
                        <div class="block counter-block mb-4">
                            <div class="value">4</div>
                            <i class="dripicons-pulse i-icon"></i>
                            <p class="label">Levels</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 single_blocks">
                        <div class="block counter-block mb-4">
                            <div class="value">4</div>
                            <i class="dripicons-trophy i-icon"></i>
                            <p class="label">Goals</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 single_blocks">
                        <div class="block counter-block mb-4">
                            <div class="value">15</div>
                            <i class="dripicons-cutlery i-icon"></i>
                            <p class="label">Recipes</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 single_blocks">
                        <div class="block counter-block mb-4">
                            <div class="value">9</div>
                            <i class="dripicons-article i-icon"></i>
                            <p class="label">Posts</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="block counter-block mb-4 bg-white">
                            <canvas id="canvas" height="100"></canvas>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="section-title">
                            <h4>Summary</h4>
                        </div>
                    </div>

                    <!-- <div class="col-12 col-md-6 col-lg-6">
                        <div class="block table-block mb-4">
                            <div class="block-heading d-flex align-items-center" style="border:0; padding-bottom: 0;">
                                <h5 class="text-truncate">Exercises</h5>
                                <div class="graph-pills graph-home">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active active-2" href="../controller/exercises.php">View All <i class="fa fa-angle-right" style="margin-left: 5px"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="custom-scroll" style="max-height: 250px;">
                                <div class="table-responsive text-no-wrap">
                                    <table class="table">
                                        <tbody class="text-middle">
                                                                                <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/exercise_1519942162.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Overhead Lunge with Medicine Ball</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_exercise.php?id=20"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_e20();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_e20() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_exercise.php?id=20" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/exercise_1519941887.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Reclining Triceps Press</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_exercise.php?id=19"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_e19();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_e19() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_exercise.php?id=19" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/exercise_1519941525.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Barbell High Pull</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_exercise.php?id=18"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_e18();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_e18() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_exercise.php?id=18" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/exercise_1519940878.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">90-degree Static Hold</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_exercise.php?id=17"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_e17();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_e17() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_exercise.php?id=17" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/exercise_1519940754.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Glutes Stretch</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_exercise.php?id=16"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_e16();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_e16() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_exercise.php?id=16" });}
  </script>
  
                                                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                       </div>
                    </div> -->  

                  <!--   <div class="col-12 col-md-6 col-lg-6">
                        <div class="block table-block mb-4">
                            <div class="block-heading d-flex align-items-center" style="border:0; padding-bottom: 0;">
                                <h5 class="text-truncate">Workouts</h5>
                                <div class="graph-pills graph-home">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active active-2" href="../controller/workouts.php">View All <i class="fa fa-angle-right" style="margin-left: 5px"></i></a>
                                    </li>
                                </ul>
                            </div>
                            </div>

                    <div class="custom-scroll" style="max-height: 250px;">
                                <div class="table-responsive text-no-wrap">
                                    <table class="table">
                                        <tbody class="text-middle">
                                                                                <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/workout_1519950433.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">At-Home Cardio for Fat Loss</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_workout.php?id=16"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_w16();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_w16() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_workout.php?id=16" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/workout_1519950276.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">The Ultimate Full-Body Landmine Workout</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_workout.php?id=15"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_w15();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_w15() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_workout.php?id=15" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/workout_1519949966.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Real Man's Cardio WorkoutS</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_workout.php?id=14"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_w14();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_w14() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_workout.php?id=14" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/workout_1519949759.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Top It Off With This Full-Body Finisher</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_workout.php?id=13"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_w13();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_w13() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_workout.php?id=13" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/workout_1519949368.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Level Up Your Triceps Routine</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_workout.php?id=12"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_w12();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_w12() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_workout.php?id=12" });}
  </script>
  
                                                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                       </div>
                    </div>  -->


                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="block table-block mb-4">
                            <div class="block-heading d-flex align-items-center" style="border:0; padding-bottom: 0;">
                                <h5 class="text-truncate">Posts</h5>
                                <div class="graph-pills graph-home">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active active-2" href="../controller/posts.php">View All <i class="fa fa-angle-right" style="margin-left: 5px"></i></a>
                                    </li>
                                </ul>
                            </div>
                            </div>

                    <div class="custom-scroll" style="max-height: 250px;">
                                <div class="table-responsive text-no-wrap">
                                    <table class="table">
                                        <tbody class="text-middle">
                                                                                <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/post_1519977985.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">5 Ways to Torch Your Core in Every Workout</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_post.php?id=9"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_p9();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_p9() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_post.php?id=9" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/post_1519977831.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Even Light Exercise Can Help You Live Longer</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_post.php?id=8"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_p8();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_p8() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_post.php?id=8" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/post_1519977690.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">What to Do If Working Out Is Killing Your Knees</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_post.php?id=7"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_p7();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_p7() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_post.php?id=7" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/post_1519534580.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Jason Statham to Play Assassin in ‘Killer's Game': Report</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_post.php?id=6"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_p6();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_p6() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_post.php?id=6" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/post_1519534490.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Sly Stallone on Death Rumors: 'Ignore This Stupidity'</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_post.php?id=5"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_p5();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_p5() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_post.php?id=5" });}
  </script>
  
                                                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                       </div>
                    </div> 

                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="block table-block mb-4">
                            <div class="block-heading d-flex align-items-center" style="border:0; padding-bottom: 0;">
                                <h5 class="text-truncate">Recipes</h5>
                                <div class="graph-pills graph-home">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active active-2" href="../controller/recipes.php">View All <i class="fa fa-angle-right" style="margin-left: 5px"></i></a>
                                    </li>
                                </ul>
                            </div>
                            </div>

                    <div class="custom-scroll" style="max-height: 250px;">
                                <div class="table-responsive text-no-wrap">
                                    <table class="table">
                                        <tbody class="text-middle">
                                                                                <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/recipe_1519976893.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Slow-cooker Stuffed Peppers</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_recipe.php?id=15"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_r15();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_r15() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_diet.php?id=15" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/recipe_1519976739.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Spring Pea Coconut Curry</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_recipe.php?id=14"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_r14();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_r14() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_diet.php?id=14" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/recipe_1519976534.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Supergreen Candy Salad</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_recipe.php?id=13"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_r13();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_r13() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_diet.php?id=13" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/recipe_1519976213.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">A nutritious, muscle-building breakfast</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_recipe.php?id=12"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_r12();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_r12() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_diet.php?id=12" });}
  </script>
  
                                                                    <tr>
                                            <td class="product">
                                                <img class="product-img" src="../images/recipe_1519975733.jpg">
                                            </td>
                                            <td class="name"><span class="span-title">Super-Easy Barbacoa &amp; Jicama Tacos</span></td>
                                            <td class="price price-td-home"><a href="../controller/edit_recipe.php?id=11"><i class="fa fa-cog a-i-color"></i></a> <a style="cursor: pointer;" onclick="alertdelete_r11();"><i class="fa fa-trash-o a-i-color"></i></a></td>
                                        </tr>

                            <script type="text/javascript">
  function alertdelete_r11() {
  swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "../controller/delete_diet.php?id=11" });}
  </script>
  
                                                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                       </div>
                    </div> 

        </div>
    </div>
@endsection