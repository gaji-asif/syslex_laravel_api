<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
  <title>Dashboard - BackApp LLC</title>

  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="{{asset('assets_/vendor/js/jquery.min.js')}}"></script>
  
  <!-- Icon fonts -->
  <link rel="stylesheet" href="{{asset('assets_/vendor/fonts/fontawesome.css')}}">
  <link rel="stylesheet" href="{{asset('assets_/vendor/fonts/ionicons.css')}}">
  <link rel="stylesheet" href="{{asset('assets_/vendor/fonts/linearicons.css')}}">
  <link rel="stylesheet" href="{{asset('assets_/vendor/fonts/open-iconic.css')}}">
  <link rel="stylesheet" href="{{asset('assets_/vendor/fonts/pe-icon-7-stroke.css')}}">

  <!-- Core stylesheets -->
  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/bootstrap.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets/css/mbr_style.css')}}">

  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/appwork.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/theme-corporate.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/colors.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/uikit.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">

  <!-- Load polyfills -->
  <script src="{{asset('assets_/vendor/js/polyfills.js')}}"></script>

  <script src="{{asset('assets_/vendor/js/material-ripple.js')}}"></script>
  <script src="{{asset('assets_/vendor/js/layout-helpers.js')}}"></script>

  <!-- Theme settings -->
  <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->
    <script src="{{asset('assets_/vendor/js/theme-settings.js')}}"></script>

    <!-- Core scripts -->
    <script src="{{asset('assets_/vendor/js/pace.js')}}"></script>

    <script src="{{asset('assets/js/demo.js')}}"></script>
    <script src="{{asset('/assets_/vendor/js/bootstrap.js')}}"></script>
    <!-- <script src="{{asset('assets/js/dashboards_dashboard-1.js')}}"></script> -->
    <!-- Libs -->
    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}">

    <link rel="stylesheet" href="{{asset('assets_/vendor/css/pages/account.css')}}">
    <link rel="stylesheet" href="{{asset('assets_/vendor/css/pages/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/my_style.css')}}">

    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/dragula/dragula.css')}}">

    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/bootstrap-select/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/bootstrap-multiselect/bootstrap-multiselect.css')}}">
    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/select2/select2.css')}}">
    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">

    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/datatables/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/iao-alert.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/gylphicon.css')}}">
    <link rel="stylesheet" href="{{asset('css/new_common_version.css')}}">
    <link rel="stylesheet" href="{{asset('assets_/vendor/libs/dropzone/dropzone.css')}}">
    <style type="text/css">
      .font_color{
        color: #FFFFFFF !important;
      }
      .fa-gear:hover{
        background-color: #718AA8;
        color: #FFFFFF;
        cursor: pointer;
      }
      .sidenav-inner li:hover{
        color: #000000;
      }

      .layout-sidenav-horizontal{
        background-image: -webkit-linear-gradient(40deg, #38587d 54%, #718AA8 46%);
      }
      .sidenav-inner{
        margin-left: 20px !important;
      }
      .sidenav-horizontal-prev{
        width: 1px;
      }

      div.dataTables_wrapper .dataTables_filter input{
        background-image: url('{{ URL::asset('assets_/img/searchicon.png')}}')
      }

      .pro_wrap:hover{
       background-color: #f2fcf8;
       cursor: pointer;
     }

     .tui-editor-contents img{
      border:1px solid gray;
    }
    img.font_icon_color{
      color: #FFFFFF !important;
    }
  </style>
</head>

<body>
  <div class="page-loader">
    <div class="bg-primary"></div>
  </div>

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-1 layout-without-sidenav">
    <div class="layout-inner">

      <!-- Layout navbar -->
      <nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-white container-p-x" id="layout-navbar">

        <a href="{{route('home')}}" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
          <span class="app-brand-logo demo bg-primary">
            @php 
            if (session()->has('user_id')){
            $developerid = Session::get('developer_id');
            $companylogo = \App\DtbDevelopGroup::where(['id' => $developerid])->pluck('logo_image_path')->first();
          }
          @endphp
       <!-- 
        @if(isset($companylogo)&&!empty($companylogo))
          <img  alt="Space Image" src="{{ $companylogo }}" width="32px">
        @else
        @endif -->
        @php $image_path = ""; @endphp
        @if(!empty($companylogo))
        @php $image_path = url($companylogo); @endphp
        <img src="//{{substr($image_path,env('AWS_BASE_URL'))}}" alt="" width="32px">
        @else
        <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" width="32px">
        @endif



      </span>

      @php 
      if (session()->has('user_id')){
      $developerid2 = Session::get('developer_id');
      $space_name = \App\DtbDevelopGroup::where(['id' => $developerid2])->pluck('space_name')->first();
    }
    @endphp

    @if(!empty($space_name))
    <span class="app-brand-text demo font-weight-normal ml-2">{{ $space_name }}</span>
    @endif
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="layout-navbar-collapse">
    <!-- Divider -->
    <hr class="d-lg-none w-100 my-2">

    <div class="navbar-nav align-items-lg-center">

    </div>

    <div class="navbar-nav align-items-lg-center ml-auto">
<!--             <div class="demo-navbar-notifications nav-item dropdown mr-lg-3">
              <a class="nav-link dropdown-toggle hide-arrow" href="#" data-toggle="dropdown">
                <i class="ion ion-md-notifications-outline navbar-icon align-middle"></i>
                <span class="badge badge-primary badge-dot indicator"></span>
                <span class="d-lg-none align-middle">&nbsp; Notifications</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="bg-primary text-center text-white font-weight-bold p-3">
                  1 New Notifications
                </div>
                <div class="list-group list-group-flush">
                  <a href="javascript:void(0)" class="list-group-item list-group-item-action media d-flex align-items-center">
                    <div class="ui-icon ui-icon-sm ion ion-md-home bg-secondary border-0 text-white"></div>
                    <div class="media-body line-height-condenced ml-3">
                      <div class="text-body">Login from 192.168.1.1</div>
                      <div class="text-light small mt-1">
                        Aliquam ex eros, imperdiet vulputate hendrerit et.
                      </div>
                      <div class="text-light small mt-1">12h ago</div>
                    </div>
                  </a>
                </div>

                <a href="javascript:void(0)" class="d-block text-center text-light small p-2 my-1">Show all notifications</a>
              </div>
            </div> -->

            <!-- <div class="demo-navbar-messages nav-item dropdown mr-lg-3">
              <a class="nav-link dropdown-toggle hide-arrow" href="#" data-toggle="dropdown">
                <i class="ion ion-ios-mail navbar-icon align-middle"></i>
                <span class="badge badge-primary badge-dot indicator"></span>
                <span class="d-lg-none align-middle">&nbsp; Messages</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="bg-primary text-center text-white font-weight-bold p-3">
                  1 New Messages
                </div>
                <div class="list-group list-group-flush">
                  <a href="javascript:void(0)" class="list-group-item list-group-item-action media d-flex align-items-center">
                    <img src="{{asset('assets_/img/avatars/6-small.png')}}" class="d-block ui-w-40 rounded-circle" alt>
                    <div class="media-body ml-3">
                      <div class="text-body line-height-condenced">Sit meis deleniti eu, pri vidit meliore docendi ut.</div>
                      <div class="text-light small mt-1">
                        Mae Gibson &nbsp;·&nbsp; 58m ago
                      </div>
                    </div>
                  </a>

                </div>

                <a href="javascript:void(0)" class="d-block text-center text-light small p-2 my-1">Show all messages</a>
              </div>
            </div> -->

            <!-- Divider -->
            <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">|</div>

            <div class="demo-navbar-user nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">

                  @php $image_path = ""; @endphp
                  @if(!empty(Session::get('users_image')))
                  @php $image_path = url(Session::get('users_image')); @endphp
                  <img src="//{{substr($image_path,env('AWS_BASE_URL'))}}" alt="" class="d-block ui-w-30 rounded-circle">
                  @else
                  <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-30 rounded-circle">
                  @endif
                  <span class="px-1 mr-lg-2 ml-2 ml-lg-0"><?php echo Session::get('users_name');?></span>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">


          @if(Session::has('role'))
            @if(Session::get('role') == '0')
              <a href="{{route('profile-update')}}" class="dropdown-item"><i class="ion ion-ios-person text-lightest"></i> &nbsp; My profile</a>
              <a href="{{route('report.index')}}" class="dropdown-item"><i class="ion ion-ios-calendar text-lighter"></i> &nbsp; Report</a>
              <a href="{{route('space.index')}}" class="dropdown-item"><i class="ion ion-md-settings text-lightest"></i> &nbsp; Space settings</a>
              <div class="dropdown-divider"></div>
              <a href="{{route('logout')}}" class="dropdown-item"><i class="ion ion-ios-log-out text-danger"></i> &nbsp; Log Out</a>
             @else
              <a href="{{route('profile-update')}}" class="dropdown-item"><i class="ion ion-ios-person text-lightest"></i> &nbsp; My profile</a>
              <a href="{{route('report.index')}}" class="dropdown-item"><i class="ion ion-ios-calendar text-lighter"></i> &nbsp; Report</a>
              <div class="dropdown-divider"></div>
              <a href="{{route('logout')}}" class="dropdown-item"><i class="ion ion-ios-log-out text-danger"></i> &nbsp; Log Out</a>
            @endif
          @endif







              </div>
            </div>
          </div>
        </div>
      </nav>
      <!-- / Layout navbar -->

      <!-- Layout container -->
      <div class="layout-container">

        <!-- Layout content -->
        <div class="layout-content">

          <!-- Layout sidenav -->
          <div id="layout-sidenav" class="layout-sidenav-horizontal sidenav sidenav-horizontal flex-grow-0" style="background-color: #718AA8 !important;">

            <!-- Links -->
            <ul class="sidenav-inner">

              <!-- Dashboards -->
              <li class="sidenav-item">
                <a href="{{route('home')}}" class="sidenav-link" style="color: #FFFFFF !important;">
                  <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 11.0729C0 4.96146 4.92253 0 11 0C17.0775 0 22 4.96146 22 11.0729C22 14.1795 20.7246 16.9899 18.6765 19L18.036 18.3442C19.9154 16.4997 21.0845 13.9228 21.0845 11.0729C21.0845 5.46444 16.568 0.917773 11 0.917773C5.43203 0.917773 0.915522 5.46444 0.915522 11.0729C0.915522 13.9272 2.0845 16.4996 3.96402 18.3442L3.32354 19C1.27547 16.99 0 14.1842 0 11.0729Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.26874 4L8 3.26823L8.73126 3L9 3.73177L8.26874 4Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.45487 5L5 4.45616L5.54513 4L6 4.54384L5.45487 5Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.63349 7L3 6.63391L3.36651 6L4 6.36609L3.63349 7Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.84919 10L2 9.84908L2.15081 9L3 9.15092L2.84919 10Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 12.8491L2.15081 13L2 12.1509L2.84919 12L3 12.8491Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4 15.2678L3.36651 16L3 14.7322L3.63349 14L4 15.2678Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.733 14L19 14.7322L18.267 16L17 15.2678L17.733 14Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.1508 12L20 12.1509L19.8492 13L19 12.8491L19.1508 12Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17 6.36609L18.267 6L19 6.63391L17.733 7L17 6.36609Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 4.54384L16.4549 4L17 4.45616L16.5451 5L16 4.54384Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13 3.73177L13.2687 3L14 3.26823L13.7313 4L13 3.73177Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11 11C10.3373 11 9.8 11.6716 9.8 12.5C9.8 13.3284 10.3373 14 11 14C11.6627 14 12.2 13.3284 12.2 12.5C12.2 11.6716 11.6627 11 11 11ZM9 12.5C9 11.1193 9.89543 10 11 10C12.1046 10 13 11.1193 13 12.5C13 13.8807 12.1046 15 11 15C9.89543 15 9 13.8807 9 12.5Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 13.4521L8.69542 13L9 13.5479L7.30458 14L7 13.4521Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13 11.2272L18.7075 9L19 9.77284L13.2925 12L13 11.2272Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.33333 17.8571C8.0899 17.8571 7.88889 18.051 7.88889 18.2857V18.7143C7.88889 18.949 8.0899 19.1429 8.33333 19.1429H13.6667C13.9101 19.1429 14.1111 18.949 14.1111 18.7143V18.2857C14.1111 18.051 13.9101 17.8571 13.6667 17.8571H8.33333ZM7 18.2857C7 17.5776 7.59898 17 8.33333 17H13.6667C14.401 17 15 17.5776 15 18.2857V18.7143C15 19.4224 14.401 20 13.6667 20H8.33333C7.59898 20 7 19.4224 7 18.7143V18.2857Z" fill="white"/>
                  </svg>
                  <div class="pl-2">Dashboard</div>
                </a>
              </li>

              <!-- Layouts -->
              <li class="sidenav-item">
                <a href="{{route('my_projects')}}" class="sidenav-link" style="color: #FFFFFF !important;">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.67999 0.649994C14.67 0.649994 18.71 4.68999 18.71 9.67999C18.71 14.67 14.67 18.71 9.67999 18.71C4.68999 18.71 0.650024 14.67 0.650024 9.67999C0.650024 4.68999 4.68999 0.649994 9.67999 0.649994ZM9.67999 0C4.33999 0 0 4.33999 0 9.67999C0 15.02 4.33999 19.36 9.67999 19.36C15.02 19.36 19.36 15.02 19.36 9.67999C19.36 4.33999 15.02 0 9.67999 0Z" fill="white"/>
                    <path d="M9.68005 19.0301C9.50005 19.0301 9.3501 18.8801 9.3501 18.7001V0.650085C9.3501 0.470085 9.50005 0.320068 9.68005 0.320068C9.86005 0.320068 10.0101 0.470085 10.0101 0.650085V18.7001C10.0001 18.8801 9.86005 19.0301 9.68005 19.0301Z" fill="white"/>
                    <path d="M9.68018 19.0299C6.75018 19.0299 4.4502 14.8799 4.4502 9.5899C4.4502 4.2999 6.75018 0.149902 9.68018 0.149902C12.6102 0.149902 14.9102 4.2999 14.9102 9.5899C14.9102 14.8799 12.6102 19.0299 9.68018 19.0299ZM9.68018 0.789886C7.15018 0.789886 5.10022 4.7299 5.10022 9.5799C5.10022 14.4299 7.16018 18.3699 9.68018 18.3699C12.2002 18.3699 14.2602 14.4299 14.2602 9.5799C14.2602 4.7299 12.2102 0.789886 9.68018 0.789886Z" fill="white"/>
                    <path d="M17.9398 6.55014H1.41986C1.23986 6.55014 1.08984 6.40015 1.08984 6.22015C1.08984 6.04015 1.23986 5.89014 1.41986 5.89014H17.9398C18.1198 5.89014 18.2698 6.04015 18.2698 6.22015C18.2698 6.40015 18.1198 6.55014 17.9398 6.55014Z" fill="white"/>
                    <path d="M17.9398 13.45H1.41986C1.23986 13.45 1.08984 13.3001 1.08984 13.1201C1.08984 12.9401 1.23986 12.79 1.41986 12.79H17.9398C18.1198 12.79 18.2698 12.9401 18.2698 13.1201C18.2598 13.3101 18.1198 13.45 17.9398 13.45Z" fill="white"/>
                  </svg>

                  <div class="pl-2">Projects</div>
                </a>
              </li>             

            </li>

            <li class="sidenav-divider mb-1"></li>
            <li class="sidenav-header small font-weight-semibold">ELEMENTS</li>

            <li class="sidenav-item">
              <a href="{{route('my_issues')}}" class="sidenav-link" style="color: #FFFFFF !important;">
                <svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.66943 1.4745C5.66943 1.04012 6.02157 0.687988 6.45595 0.687988H20.0003C20.4347 0.687988 20.7868 1.04012 20.7868 1.4745C20.7868 1.90888 20.4347 2.26102 20.0003 2.26102H6.45595C6.02157 2.26102 5.66943 1.90888 5.66943 1.4745Z" fill="white"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.66943 8.50063C5.66943 8.06625 6.02157 7.71411 6.45595 7.71411H20.0003C20.4347 7.71411 20.7868 8.06625 20.7868 8.50063C20.7868 8.93501 20.4347 9.28714 20.0003 9.28714H6.45595C6.02157 9.28714 5.66943 8.93501 5.66943 8.50063Z" fill="white"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.66943 15.525C5.66943 15.0907 6.02157 14.7385 6.45595 14.7385H20.0003C20.4347 14.7385 20.7868 15.0907 20.7868 15.525C20.7868 15.9594 20.4347 16.3116 20.0003 16.3116H6.45595C6.02157 16.3116 5.66943 15.9594 5.66943 15.525Z" fill="white"/>
                  <path d="M1.4745 2.94903C2.28885 2.94903 2.94903 2.28885 2.94903 1.4745C2.94903 0.660148 2.28885 0 1.4745 0C0.660148 0 0 0.660148 0 1.4745C0 2.28885 0.660148 2.94903 1.4745 2.94903Z" fill="white"/>
                  <path d="M1.4745 9.97512C2.28885 9.97512 2.94903 9.31497 2.94903 8.50062C2.94903 7.68627 2.28885 7.02612 1.4745 7.02612C0.660148 7.02612 0 7.68627 0 8.50062C0 9.31497 0.660148 9.97512 1.4745 9.97512Z" fill="white"/>
                  <path d="M1.4745 16.9998C2.28885 16.9998 2.94903 16.3396 2.94903 15.5253C2.94903 14.7109 2.28885 14.0508 1.4745 14.0508C0.660148 14.0508 0 14.7109 0 15.5253C0 16.3396 0.660148 16.9998 1.4745 16.9998Z" fill="white"/>
                </svg>

                <div class="pl-2">My Issues</div>
              </a>
            </li>

            <span style="background-image: url('{{ URL::asset('assets_/img/bg/1.jpg')}}');"></span>
            <!-- CHECKING THE ROLE OF LOGGED IN USER -->
            @php 
            $user_id = Session::get('user_id');
            $devsrole = \App\DtbUser::where(['id' => $user_id])->where(['role' => 0])->select('role')->get();
            @endphp
            <?php if ($devsrole->isEmpty()) { ?>

            <?php }else{ ?>
              <li class="sidenav-item">
                <a href="{{route('manageproject')}}" class="sidenav-link" style="color: #FFFFFF !important;">
                  <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.10548 1.20189C4.58938 1.20189 4.16453 1.62624 4.16453 2.14283V16.7981H18.8198C19.3359 16.7981 19.7608 16.3738 19.7608 15.8572V2.14283C19.7608 1.62673 19.3364 1.20189 18.8198 1.20189H5.10548ZM2.96271 17.3905C2.96267 17.3933 2.96265 17.3962 2.96265 17.3991C2.96265 17.7309 3.2317 18 3.56359 18H18.8198C19.9992 18 20.9626 17.0381 20.9626 15.8572V2.14283C20.9626 0.963462 20.0007 0 18.8198 0H5.10548C3.92611 0 2.96265 0.96194 2.96265 2.14283V17.3819C2.96265 17.3848 2.96267 17.3876 2.96271 17.3905Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10.3153C0 9.98341 0.269051 9.71436 0.600943 9.71436H1.98522C2.31711 9.71436 2.58616 9.98341 2.58616 10.3153C2.58616 10.6472 2.31711 10.9162 1.98522 10.9162H1.20189V15.0663C1.20189 15.9104 2.08268 16.7974 3.45941 16.7974C3.7913 16.7974 4.06035 17.0664 4.06035 17.3983C4.06035 17.7302 3.7913 17.9992 3.45941 17.9992C1.65333 17.9992 0 16.7865 0 15.0663V10.3153Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.6848 4.42894V6.95751H16.4557V4.42894H7.6848ZM6.48291 4.17155C6.48291 3.65074 6.90653 3.22705 7.4274 3.22705H16.7131C17.234 3.22705 17.6576 3.65077 17.6576 4.17155V7.2149C17.6576 7.73568 17.234 8.1594 16.7131 8.1594H7.4274C6.90653 8.1594 6.48291 7.73571 6.48291 7.2149V4.17155Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48291 10.4364C6.48291 10.1045 6.75196 9.83545 7.08385 9.83545H17.0647C17.3966 9.83545 17.6657 10.1045 17.6657 10.4364C17.6657 10.7683 17.3966 11.0373 17.0647 11.0373H7.08385C6.75196 11.0373 6.48291 10.7683 6.48291 10.4364Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48291 13.3148C6.48291 12.9829 6.75196 12.7139 7.08385 12.7139H17.0647C17.3966 12.7139 17.6657 12.9829 17.6657 13.3148C17.6657 13.6467 17.3966 13.9158 17.0647 13.9158H7.08385C6.75196 13.9158 6.48291 13.6467 6.48291 13.3148Z" fill="white"/>
                  </svg>
                  <div class="pl-2">Manage</div>
                </a>
              </li>  

              <li class="sidenav-item">
                <a href="{{route('managemember')}}" class="sidenav-link" style="color: #FFFFFF !important;">
                  <svg width="26" height="20" viewBox="0 0 26 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.4174 0.175694C18.7346 0.0651635 19.0717 0 19.4226 0C22.0211 0 23.6224 2.58624 23.6224 5.08644C23.6224 6.39891 23.2785 7.66498 22.4543 8.56718C23.6421 9.2556 24.4766 10.3393 25.0317 11.5554C25.7284 13.0817 26 14.8425 26 16.3985C26 16.6423 25.986 16.8804 25.9628 17.1117C25.9109 17.6385 25.4853 18 25.025 18H23.4746C23.1397 18 22.8681 17.712 22.8681 17.3568C22.8681 17.0016 23.1397 16.7136 23.4746 16.7136H24.7775C24.7836 16.6083 24.7869 16.5033 24.7869 16.3985C24.7869 14.9827 24.5372 13.4246 23.9398 12.1159C23.3468 10.8168 22.4267 9.79018 21.0771 9.33747C20.8447 9.25952 20.6788 9.04158 20.6561 8.7842C20.6334 8.52683 20.7581 8.28003 20.9729 8.15765C21.9313 7.61142 22.4094 6.51781 22.4094 5.08644C22.4094 3.02778 21.123 1.28641 19.4226 1.28641C19.2145 1.28641 19.0052 1.32494 18.796 1.39783C18.4778 1.50871 18.135 1.32502 18.0305 0.987539C17.9259 0.650056 18.0991 0.286581 18.4174 0.175694Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.62114 5.08681C2.62114 2.58643 4.38558 0 7.2488 0C7.7226 0 8.1696 0.101045 8.57757 0.256542C8.92074 0.387342 9.08877 0.76114 8.95287 1.09144C8.81698 1.42175 8.42861 1.58348 8.08544 1.45268C7.80291 1.34499 7.52351 1.28651 7.2488 1.28651C5.37518 1.28651 3.95778 3.028 3.95778 5.08681C3.95778 6.50635 4.46982 7.59189 5.50765 8.14129C5.74443 8.26664 5.87949 8.5169 5.84986 8.77543C5.82024 9.03397 5.63177 9.24989 5.3723 9.32256C3.7974 9.76363 2.80181 10.7848 2.18515 12.0765C1.5602 13.3856 1.33663 14.9554 1.33663 16.3984C1.33663 16.5036 1.34029 16.6085 1.34711 16.7135H3.19141C3.56051 16.7135 3.85973 17.0015 3.85973 17.3567C3.85973 17.712 3.56051 18 3.19141 18H1.07847C0.565194 18 0.101188 17.6347 0.041318 17.1122L0.0410773 17.1101C0.015476 16.8796 0 16.6426 0 16.3984C0 14.8507 0.236311 13.0775 0.970603 11.5394C1.56253 10.2995 2.48515 9.20276 3.85957 8.52188C2.98224 7.62153 2.62114 6.3743 2.62114 5.08681Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0098 0.0309447C10.8201 -0.34253 8.69771 2.72807 8.69771 5.81282L14.0098 0.0309447ZM13.88 1.31904C11.6287 1.05538 9.90008 3.22967 9.90008 5.81282C9.90008 7.4865 10.4844 8.81546 11.6272 9.49279C11.8402 9.61903 11.9617 9.87107 11.935 10.1314C11.9084 10.3918 11.7388 10.6093 11.5054 10.6825C9.79372 11.2192 8.72238 12.4745 8.06923 14.0483C7.4786 15.4714 7.23963 17.139 7.20645 18.7043H19.7925C19.7512 17.1507 19.4589 15.4815 18.8248 14.0535C18.1314 12.492 17.0452 11.2473 15.442 10.7009C15.2116 10.6223 15.0472 10.4028 15.0247 10.1435C15.0022 9.88422 15.126 9.63563 15.3389 9.51244C16.7409 8.70122 17.3357 6.8892 17.0158 4.698L17.0158 4.69794C16.7565 2.9204 15.4822 1.50635 13.8802 1.31905L13.88 1.31904ZM14.01 0.0309571C16.2093 0.288146 17.8692 2.20471 18.2036 4.49669C18.5037 6.55201 18.1245 8.61206 16.8419 9.92781C18.2663 10.7266 19.2577 12.0267 19.9094 13.4943C20.7046 15.2852 21.0095 17.3531 20.9998 19.1752C20.9988 19.3499 20.9324 19.5169 20.8156 19.6381C20.7698 19.6856 20.74 19.7173 20.7013 19.7584C20.6856 19.775 20.6685 19.7931 20.6483 19.8145C20.5359 19.9334 20.3847 20 20.2272 20H6.68888C6.53336 20 6.38389 19.9351 6.27187 19.8188C6.26556 19.8123 6.25937 19.8059 6.25316 19.7994C6.23039 19.7759 6.20735 19.7521 6.17682 19.7192C6.06547 19.5992 6.00226 19.4369 6.00077 19.2673C5.98478 17.4445 6.215 15.3424 6.97163 13.5193C7.59922 12.0071 8.5966 10.6745 10.109 9.87804C9.13302 8.84473 8.69771 7.37001 8.69771 5.81282" fill="white"/>
                  </svg>

                  <div class="pl-2">Member Manage</div>
                </a>
              </li>

            <?php } ?>
            <!-- CHECKING THE ROLE OF LOGGED IN USER ENDS -->
            <li class="sidenav-item">
              <a href="{{route('velocity')}}" class="sidenav-link" style="color: #FFFFFF !important;">
                <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.82996 14.4799C8.88996 16.9799 11.32 18.5899 14.03 18.5899C17.74 18.5899 20.7599 15.5699 20.7599 11.8599C20.7599 8.14988 17.74 5.12988 14.03 5.12988C11.73 5.12988 9.60999 6.28988 8.35999 8.23988L8.31 8.30988L8.22998 8.28988C8.20998 8.28988 8.18997 8.27988 8.15997 8.27988H5.38995C5.17995 8.27988 5.00995 8.44988 5.00995 8.65988C5.00995 8.86988 5.17995 9.03988 5.38995 9.03988H7.90997L7.82996 9.20988C7.58996 9.75988 7.42998 10.3499 7.34998 10.9499L7.33997 11.0599H0.380005C0.170005 11.0599 0 11.2299 0 11.4399C0 11.6499 0.170005 11.8199 0.380005 11.8199H7.28998V11.9399C7.29998 12.4699 7.35999 12.9899 7.48999 13.4899L7.52997 13.6499H2.33997C2.12997 13.6499 1.95996 13.8199 1.95996 14.0299C1.95996 14.2399 2.12997 14.4099 2.33997 14.4099H7.78998L7.82996 14.4799ZM14.03 5.87988C17.33 5.87988 20.0099 8.55988 20.0099 11.8599C20.0099 15.1599 17.33 17.8399 14.03 17.8399C11.63 17.8399 9.47997 16.4099 8.52997 14.2099L8.50995 14.1699L8.51996 14.1299C8.52996 14.0899 8.52997 14.0599 8.52997 14.0399C8.52997 13.9199 8.47 13.7999 8.37 13.7299L8.32996 13.7099L8.31995 13.6499C8.13995 13.0699 8.04999 12.4699 8.04999 11.8599C8.04999 8.56988 10.73 5.87988 14.03 5.87988Z" fill="white"/>
                  <path d="M20.4399 6.08L20.3599 5.99L20.9499 5.46L21.5199 6.06C21.5899 6.13 21.6799 6.17 21.7799 6.17H21.7899C21.8899 6.17 21.9799 6.13 22.0499 6.07C22.1199 6 22.1599 5.91 22.1699 5.81C22.1699 5.71 22.1299 5.61 22.0699 5.54L20.4199 3.82C20.2799 3.67 20.0399 3.66 19.8899 3.81C19.7399 3.95 19.7399 4.19 19.8799 4.34L20.4399 4.92L19.8299 5.47L19.7499 5.4C18.2999 4.12 16.4499 3.36 14.5399 3.25L14.4199 3.24V2.48H15.9099C16.1199 2.48 16.2899 2.31 16.2899 2.1V0.379999C16.2899 0.169999 16.1199 0 15.9099 0H12.1799C11.9699 0 11.7999 0.169999 11.7999 0.379999V2.1C11.7999 2.31 11.9699 2.48 12.1799 2.48H13.6699V3.24L13.5499 3.25C11.0699 3.39 8.77994 4.59 7.24994 6.55H8.23993C9.72993 4.92 11.8499 3.99 14.0499 3.99C18.3999 3.99 21.9399 7.53 21.9399 11.88C21.9399 16.23 18.3999 19.77 14.0499 19.77C11.4699 19.77 9.04989 18.5 7.56989 16.38H6.66992C8.23992 18.94 11.0499 20.53 14.0499 20.53C18.8199 20.53 22.6899 16.65 22.6899 11.89C22.6699 9.72 21.8799 7.67 20.4399 6.08ZM12.5399 1.71V0.75H15.5199V1.72H12.5399V1.71Z" fill="white"/>
                  <path d="M14.0004 13.2998C14.8504 13.2998 15.5504 12.5998 15.5504 11.7498C15.5504 11.6398 15.5404 11.5298 15.5104 11.4198L15.4904 11.3298L15.5704 11.2798L18.0404 9.84977C18.1304 9.79977 18.1904 9.71978 18.2204 9.61978C18.2504 9.51978 18.2304 9.41977 18.1804 9.32977C18.0804 9.14977 17.8504 9.08978 17.6604 9.18978L15.1104 10.6698L15.0404 10.6098C14.7504 10.3398 14.3804 10.1998 13.9904 10.1998C13.1404 10.1998 12.4404 10.8998 12.4404 11.7498C12.4404 12.5998 13.1404 13.2998 14.0004 13.2998ZM14.0004 10.9598C14.4404 10.9598 14.8004 11.3198 14.8004 11.7598C14.8004 12.1998 14.4404 12.5598 14.0004 12.5598C13.5604 12.5598 13.2004 12.1998 13.2004 11.7598C13.2004 11.3198 13.5604 10.9598 14.0004 10.9598Z" fill="white"/>
                </svg>

                <div class="pl-2">Velocity</div>
              </a>
            </li>


          </ul>
        </div>
        <style type="text/css">
         .common_breadcrum{
          background-color: #000000;
          padding: 10px;
          width: 100%;
          color: #FFFFFF;
          font-size: 21px;
          padding-left: 33px;

        }
      </style>
      <!-- / Layout sidenav -->

      @if(isset($common_array))
      <div class="common_breadcrum">
        {{$common_array['content_heading']}}
      </div>
      @endif

      <!-- Content -->
      <div class="container-fluid flex-grow-1 container-p-y pt-0">
       @yield('mainContent')
     </div>
     <!-- / Content -->

     <!-- Layout footer -->
     <nav class="layout-footer footer bg-footer-theme">
      <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
        <div class="pt-3">
          <span class="footer-text font-weight-bolder">BackApp LLC</span> ©
        </div>
        <div>
          <a href="javascript:void(0)" class="footer-link pt-3">About Us</a>
          <a href="javascript:void(0)" class="footer-link pt-3 ml-4">Help</a>
          <a href="javascript:void(0)" class="footer-link pt-3 ml-4">Contact</a>
          <a href="javascript:void(0)" class="footer-link pt-3 ml-4">Terms &amp; Conditions</a>
        </div>
      </div>
    </nav>
    <!-- / Layout footer -->
    <div class="has-modal modal fade" id="showDetaildModal">
      <div class="modal-dialog modal-dialog-centered" id="modalSize">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h6 class="modal-title" id="showDetaildModalTile"></h6>
            <button type="button" class="close icons" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body" id="showDetaildModalBody">
          </div>
          <!-- Modal footer -->
        </div>
      </div>
    </div>
  </div>
  <!-- Layout content -->

</div>
<!-- / Layout container -->

</div>
</div>

<!-- / Layout wrapper -->

<!-- Core scripts -->
<script src="{{asset('/assets_/vendor/libs/popper/popper.js')}}"></script>


<!-- For Sidenav in developer Settings -->
<script src="{{asset('assets_/vendor/js/sidenav.js')}}"></script>
<script src="{{asset('assets/js/ui_sidenav.js')}}"></script>


<!-- Libs -->
<script src="{{asset('/assets_/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('/assets_/vendor/libs/chartjs/chartjs.js')}}"></script>


<!-- Demo -->
<script src="{{asset('/assets_/vendor/libs/validate/validate.js')}}"></script>
<script src="{{asset('assets_/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets_/vendor/libs/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('/assets_/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('/assets_/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/js/forms_selects.js')}}"></script>
<script src="{{asset('/assets/js/forms_validation.js')}}"></script>


<!-- start  Datatable  js-->
<script src="{{asset('/assets/js/tables_datatables.js')}}"></script>
<script src="{{asset('/assets_/vendor/libs/datatables/datatables.js')}}"></script>
<script src="{{asset('/assets/js/bootstable.js')}}"></script>
<script src="{{asset('/assets/js/iao-alert.jquery.js')}}"></script>
<script src="{{asset('/assets/js/jquery-ui.js')}}"></script>
<!-- end  Datatable  js-->

<!-- Dummy Data -->
<script src="{{asset('assets/js/pages_users_list.js')}}"></script>
<script src="{{asset('assets_/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('assets/js/pages_users_edit.js')}}"></script>

<!-- For drag and drop -->
<script src="{{asset('assets_/vendor/libs/dragula/dragula.js')}}"></script>
<script src="{{asset('assets_/vendor/libs/sortablejs/sortable.js')}}"></script>
<script src="{{asset('assets_/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/js/ui_drag-and-drop.js')}}"></script>

<script src="{{asset('/js/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('/js/developer.js')}}"></script>
<script src="{{asset('/assets/js/mbr_jquery_ajaxify.js')}}"></script>
<!-- <script src="{{asset('/assets/js/editor.js')}}"></script> -->
@yield('issue-css')
<script>
//   alert(window.location.pathname);
//     $.ajaxSetup({
//         headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     var accessUrl= window.location.pathname;
//     $.ajax({
//         url: "/user_access_url",
//         type: 'post',
//         data: {
//         	"id":{{Session::get('user_id')}},
//         	"url1": accessUrl,
//         },
//         success: function(response){
// //         alert(response);

//         }
//     });
</script>
</body>
</html>