<div class="sidenavs-10 sidenav sidenav-vertical d-inline-flex bg-white">
	<ul class="sidenav-inner" style="margin-left: 0px !important;">
		
		<!-- <li class="sidenav-divider mt-0"></li> -->
		<li class="sidenav-item open">

          <a href="javascript:void(0)" class="sidenav-link sidenav-toggle  {{ (request()->is('space')) ? 'menu_parent_bg' : '' }} {{ (request()->is('timezone')) ? 'menu_parent_bg' : '' }} {{ (request()->is('notice')) ? 'menu_parent_bg' : '' }}">
            <i class="sidenav-icon ion"><img src="{{asset('images/icon_4.png')}}"></i>
            <div class="menu_li_heading">Basic Settings</div>
          </a>
          <ul class="sidenav-menu sidenav_menu_custom">
            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('space.index')}}" class="sidenav-link {{ (request()->is('space')) ? 'actives' : '' }}">
                <div>Space</div>
              </a>
            </li>
            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('timezone.index')}}" class="sidenav-link {{ (request()->is('timezone')) ? 'actives' : ''}}">
                <div>Timezone</div>
              </a>
            </li>
            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('notice.index')}}" class="sidenav-link {{ (request()->is('notice')) ? 'actives' : ''}}">
                <div>Notice</div>
              </a>
            </li>            

            <li class="sidenav-item sidenav_link_li mb-1">
              <a href="{{route('news')}}" class="sidenav-link {{ (request()->is('news')) ? 'actives' : ''}}">
                <div>News</div>
              </a>
            </li>
          </ul>
        </li>

		<li class="sidenav-item open">
			<a href="javascript:void(0)" class="sidenav-link sidenav-toggle  {{ (request()->is('settings-users')) ? 'menu_parent_bg' : '' }} {{ (request()->is('settings-teams')) ? 'menu_parent_bg' : '' }}">
				<i class="sidenav-icon ion"><img src="{{asset('images/icon_2.png')}}"></i>
				<div class="menu_li_heading">User Settings</div>
			</a>

			<ul class="sidenav-menu sidenav_menu_custom">
				<li class="sidenav-item mb-1">
					<a href="{{route('settings-users.index')}}" class="sidenav-link {{ (request()->is('settings-users')) ? 'actives' : ''}}">
						<div>User</div>
					</a>
				</li>
        <li class="sidenav-item mb-1">
          <a href="{{route('settings-teams.index')}}" class="sidenav-link {{ (request()->is('settings-teams')) ? 'actives' : ''}}">
            <div>Team</div>
          </a>
        </li>
			</ul>
		</li>

		<li class="sidenav-item open">
        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle  {{ (request()->is('projects')) ? 'menu_parent_bg' : '' }} {{ (request()->is('projects/create')) ? 'menu_parent_bg' : '' }}">
          <i class="sidenav-icon ion"><img src="{{asset('images/icon_3.png')}}"></i>
          <div class="menu_li_heading">Project Settings</div>
        </a>


        <ul class="sidenav-menu sidenav_menu_custom">
          <li class="sidenav-item mb-1">
            <a href="{{route('projects.index')}}" class="sidenav-link {{ (request()->is('projects')) ? 'actives': ''}}">
              <div>Projects</div>
            </a>
          </li>
          <li class="sidenav-item  mb-1">
            <a href="{{route('projects.create')}}" class="sidenav-link {{ (request()->is('projects/create')) ? 'actives': ''}}">
              <div>Project Add</div>
            </a>
          </li>
        </ul>
      </li>

		 <li class="sidenav-item open">
        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle {{ (request()->is('contact')) ? 'menu_parent_bg' : '' }}">
         <i class="sidenav-icon ion"><img src="{{asset('images/icon_1.png')}}"></i>
          <div class="menu_li_heading">Contract Settings</div>
        </a>


        <ul class="sidenav-menu sidenav_menu_custom">
          <li class="sidenav-item mb-1">
             <a href="{{route('contact.index')}}" class="sidenav-link {{ (request()->is('contact')) ? 'actives': ''}}">
              <div>Contract</div>
            </a>
          </li>
        </ul>
      </li>
    </ul>
</div>
