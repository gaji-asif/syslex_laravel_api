<style type="text/css">
  .left_sidebar, #layout-sidenav{
    background-color: #38587d !important; 
    font-size: 16px;
  }

 .sidenav-item a, .sidenav-item i{
    color: #FFFFFF !important;
  }

  .layout-sidenav-toggle i {
    color: #FFFFFF !important;
  }
</style>
<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark left_sidebar">

  <!-- Brand demo (see assets/css/demo/demo.css) -->
  <div class="app-brand demo">


<!-- SHOW COMPANY LOGO START -->
      <span class="app-brand-logo demo bg-primary">
        @php 
        if (session()->has('user_id')){
         $developerid = Session::get('developer_id');
         $companylogo = \App\DtbDevelopGroup::where(['id' => $developerid])->pluck('logo_image_path')->first();
         }
        @endphp

        @if(isset($companylogo)&&!empty($companylogo))
          <img  alt="Space Image" src="{{ $companylogo }}" width="32px">
        @else
        @endif
      </span>
<!-- SHOW COMPANY LOGO END -->

        @php 
          if (session()->has('user_id')){
           $developerid2 = Session::get('developer_id');
           $space_name = \App\DtbDevelopGroup::where(['id' => $developerid2])->pluck('space_name')->first();
           }
        @endphp

        @if(!empty($space_name))
        <a href="#" class="app-brand-text demo sidenav-text font-weight-normal ml-2">{{ $space_name }}</a>
        @endif


    <a href="{{route('home')}}" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
      <i class="ion ion-md-menu align-middle"></i>
    </a>
  </div>





  <div class="sidenav-divider mt-0"></div>
  

  <!-- Links -->
  <ul class="sidenav-inner py-1">

    <!-- Dashboards -->
    <li class="sidenav-item">
      <a href="{{route('home')}}" class="sidenav-link"><i class="sidenav-icon ion ion-md-speedometer"></i>
        <div>Dashboard</div>
      </a>
    </li>
          <li class="sidenav-item {{ (request()->segment(3) == 'issue') ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-logo-buffer"></i>
              <div>Issues</div>
            </a>

            <ul class="sidenav-menu">
              <li class="sidenav-item {{ (request()->segment(3) == 'issue') ? 'active' : '' }}">
                <a href="{{route('issue.index', $id)}}" class="sidenav-link">
                  <div>All Issues</div>
                </a>
              </li>
              <li class="sidenav-item {{ (request()->segment(4) == 'create') ? 'active ' : '' }}">
                
                <a href="{{route('issue.create', $id)}}" class="sidenav-link">
                  <div>Add Issue</div>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="sidenav-item">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-ios-albums"></i>
              <div>Files</div>
            </a>

            <ul class="sidenav-menu">
              
              <li class="sidenav-item">
                <a href="#" class="sidenav-link">
                  <div>All Files</div>
                </a>
                
              </li>
              <li class="sidenav-item">
                <a href="" class="sidenav-link">
                  <div>Add File</div>

                </a>
              </li>
            </ul>
          </li> -->
          <li class="sidenav-item {{ (request()->segment(3) == 'wiki') ? 'active' : '' }}">
            <a href="{{route('wiki.index', $id)}}" class="sidenav-link "><i class="sidenav-icon ion ion-md-document"></i>
              <div>Wiki</div>
            </a>
          </li>
          <!-- <li class="sidenav-item">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle">
              <i class="sidenav-icon ion ion-md-document"></i>
              <div>Settings</div>
            </a>
            <ul class="sidenav-menu">
              <li class="sidenav-item">
                <a href="" class="sidenav-link">
                  <div>Basic</div>
                </a>
              </li>
              <li class="sidenav-item">
                <a href="{{route('timezone.index')}}" class="sidenav-link">
                  <div>Time Zone</div>
                </a>
              </li>

              <li class="sidenav-item">
                <a href="{{route('role.index')}}" class="sidenav-link">
                  <div>Role</div>
                </a>
              </li>
              <li class="sidenav-item">
                <a href="#" class="sidenav-link">
                  <div>User</div>
                </a>
              </li>
            </ul>
          </li> -->

<!-- 
          <li class="sidenav-item">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-settings"></i>
              <div>Basic Settings</div>
            </a>
            <ul class="sidenav-menu">


            <li class="sidenav-item">
               <a  href="{{route('timezone.index')}}" class="sidenav-link">
                      <div>Timezone</div>
                    </a>
            </li>

                </ul>
              </li>

              <li class="sidenav-item">
                <a href="javascript:void(0)" class="sidenav-link sidenav-toggle">
                  <div>Contract Settings</div>
                </a>

                <ul class="sidenav-menu">
                  <li class="sidenav-item">
                    <a  href="{{route('contact.index')}}" class="sidenav-link">
                      <div>Contract</div>
                    </a>
                  </li>
                
                </ul>
              </li>              



            </ul>
          </li> -->

           <li class="sidenav-item {{ (request()->segment(3) == 'apps') ? 'active' : '' }}">
              <a href="{{route('apps.index', $id)}}" class="sidenav-link"><i class="sidenav-icon ion ion-md-cube"></i>
                <div>Apps </div>
              </a>
            </li>

           <li class="sidenav-item {{ (request()->segment(3) == 'settings') ? 'active' : '' }}">
              <a href="{{route('project.settings', $id)}}" class="sidenav-link"><i class="sidenav-icon ion ion-md-speedometer"></i>
                <div>Project Settings</div>
              </a>
            </li>
        </ul>
      </div>