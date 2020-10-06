   <nav id="navigation" class="navigation-sidebar bg-primary">
        <div class="navigation-header"><a href="home.php"><img src="{{asset('assets_new/images/logo.png')}}" style="max-width: 130px;"></a></div>

        <!--Navigation Profile area-->
        <div class="navigation-profile" style="padding-bottom: 12px;">        
            <img class="profile-img rounded-circle" src="{{asset('assets_new/images/avatar.jpg')}}" alt="profile image">
            <a href="{{route('logout')}}" class="circle-white-btn profile-setting" data-toggle="tooltip" title="Signout"><i class="fa fa-sign-out star-color"></i></a>
        </div>


        <!--Navigation Menu Links-->
        <div class="navigation-menu">
            <ul class="menu-items custom-scroll mCustomScrollbar _mCS_1"><div id="mCSB_1" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                <li>
                    <a href="{{route('home')}}">
                        <span class="icon-thumbnail"><i class="dripicons-view-apps"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-user"></i></span>
                        <span class="title">Users</span>
                    </a>
                    <!--Submenu-->
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('customer.index')}}"> 
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Customers</span>
                            </a>
                        </li>
                       <!--  <li>
                            <a href="{{route('coach.index')}}"> 
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Coaches</span>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-document"></i></span>
                        <span class="title">Plans</span>
                    </a>
                    <!--Submenu-->
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Task</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="workout.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Workout</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="#">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Meal Plan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('challenges.index')}}">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Challenges</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <span class="icon-thumbnail"><i class="dripicons-user-group"></i></span>
                        <span class="title">Community</span>
                    </a>
                </li>

                 <li>
                     <a href="{{route('content.index')}}"> 
                        <span class="icon-thumbnail"><i class="dripicons-user-group"></i></span>
                        <span class="title">Content / Video</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-rocket"></i></span>
                        <span class="title">Masters</span>
                    </a>

                     <ul class="sub-menu">
                        <li>
                            <a href="{{route('goal.index')}}"> 
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Goals</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('workout_category.index')}}"> 
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Category</span>
                            </a>
                        </li>
                     
                    </ul>
                </li>

            

                <li>
                    <a href="{{route('memberships.index')}}"> 
                        <span class="icon-thumbnail"><i class="dripicons-trophy"></i></span>
                        <span class="title">Memberships</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon-thumbnail"><i class="dripicons-gear"></i></span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon-thumbnail"><i class="dripicons-question"></i></span>
                        <span class="title">Help</span>
                    </a>
                </li>

            
            <!--
                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-to-do"></i></span>
                        <span class="title">Workouts</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="workouts.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>

                        <li>
                            <a href="new_workout.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Workout</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-user"></i></span>
                        <span class="title">Bodyparts</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="bodyparts.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>

                        <li>
                            <a href="new_bodypart.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Bodypart</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-lifting"></i></span>
                        <span class="title">Equipments</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="equipments.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>

                        <li>
                            <a href="new_equipment.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Equipment</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-pulse"></i></span>
                        <span class="title">Levels</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="levels.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>
                        <li>
                            <a href="new_level.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Level</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-trophy"></i></span>
                        <span class="title">Goals</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="goals.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>
                        <li>
                            <a href="new_goal.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Goal</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-cutlery"></i></span>
                        <span class="title">Recipes</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="recipes.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>
                        <li>
                            <a href="new_recipe.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Recipe</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-folder"></i></span>
                        <span class="title">Categories</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="categories.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>
                        <li>
                            <a href="new_category.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Category</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-article"></i></span>
                        <span class="title">Posts</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="posts.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>
                        <li>
                            <a href="new_post.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Post</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-bookmarks"></i></span>
                        <span class="title">Tags</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="tags.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>

                        <li>
                            <a href="new_tag.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Tag</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="have-submenu">
                        <span class="icon-thumbnail"><i class="dripicons-message"></i></span>
                        <span class="title">Quotes</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="quotes.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">Show All</span>
                            </a>
                        </li>
                        <li>
                            <a href="new_quote.php">
                                <span class="icon-thumbnail"><i class="dripicons-dot"></i></span>
                                <span class="title">New Quote</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="strings.php">
                        <span class="icon-thumbnail"><i class="dripicons-document-edit"></i></span>
                        <span class="title">Strings</span>
                    </a>
                </li>
            -->

            </div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 90px; max-height: 203.172px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
        </div>
    </nav>  
