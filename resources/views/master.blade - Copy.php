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

  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/appwork.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/theme-corporate.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/colors.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets_/vendor/css/rtl/uikit.css')}}" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/mbr_style.css')}}">

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
        background-image: -webkit-linear-gradient(40deg, #38587d 61%, #718AA8 46%);
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


     img.font_icon_color{
      color: #FFFFFF !important;
    }



    /* start from master header.blade.php*/

    .dragula-example {
      margin-bottom: 6px;
    }

    .sortable-example {
      margin: 0;
      padding: 0;
    }

    .sortable-example li {
      padding: 6px 10px;
      margin-bottom: 8px;
      list-style: none;
    }

    .sortable-example-inline li {
      margin-right: 8px;
      display: inline-block;
    }

    [dir=rtl] .sortable-example-inline li {
      margin-right: 0;
      margin-left: 8px;
    }

    #sortable-3 {
      width: 220px;
    }

    #sortable-3 img {
      margin-right: 8px;
      margin-bottom: 8px;
      width: 100px;
      height: 100px;
      border-radius: 999px;
      display: block;
      float: left;
    }

    [dir=rtl] #sortable-3 img {
      margin-right: 0;
      margin-left: 8px;
      float: right;
    }
    .tui-editor-contents img{
      border:1px solid gray;
      margin: 15px 0 10px !important;
    }

    /* end from master header.blade.php*/
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
          <a href="{{route('issue.index', $id)}}" class="sidenav-link" style="color: #FFFFFF !important;">
            <svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M5.66943 1.4745C5.66943 1.04012 6.02157 0.687988 6.45595 0.687988H20.0003C20.4347 0.687988 20.7868 1.04012 20.7868 1.4745C20.7868 1.90888 20.4347 2.26102 20.0003 2.26102H6.45595C6.02157 2.26102 5.66943 1.90888 5.66943 1.4745Z" fill="white"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M5.66943 8.50063C5.66943 8.06625 6.02157 7.71411 6.45595 7.71411H20.0003C20.4347 7.71411 20.7868 8.06625 20.7868 8.50063C20.7868 8.93501 20.4347 9.28714 20.0003 9.28714H6.45595C6.02157 9.28714 5.66943 8.93501 5.66943 8.50063Z" fill="white"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M5.66943 15.525C5.66943 15.0907 6.02157 14.7385 6.45595 14.7385H20.0003C20.4347 14.7385 20.7868 15.0907 20.7868 15.525C20.7868 15.9594 20.4347 16.3116 20.0003 16.3116H6.45595C6.02157 16.3116 5.66943 15.9594 5.66943 15.525Z" fill="white"/>
              <path d="M1.4745 2.94903C2.28885 2.94903 2.94903 2.28885 2.94903 1.4745C2.94903 0.660148 2.28885 0 1.4745 0C0.660148 0 0 0.660148 0 1.4745C0 2.28885 0.660148 2.94903 1.4745 2.94903Z" fill="white"/>
              <path d="M1.4745 9.97512C2.28885 9.97512 2.94903 9.31497 2.94903 8.50062C2.94903 7.68627 2.28885 7.02612 1.4745 7.02612C0.660148 7.02612 0 7.68627 0 8.50062C0 9.31497 0.660148 9.97512 1.4745 9.97512Z" fill="white"/>
              <path d="M1.4745 16.9998C2.28885 16.9998 2.94903 16.3396 2.94903 15.5253C2.94903 14.7109 2.28885 14.0508 1.4745 14.0508C0.660148 14.0508 0 14.7109 0 15.5253C0 16.3396 0.660148 16.9998 1.4745 16.9998Z" fill="white"/>
            </svg>

            <div class="pl-2">All Issues</div>
          </a>
        </li>             



        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">ELEMENTS</li>

        <!-- Layouts -->
        <li class="sidenav-item">
          <a href="{{route('issue.create', $id)}}" class="sidenav-link" style="color: #FFFFFF !important;">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.4364 9.62517H12.8588C12.5917 9.62517 12.3751 9.40848 12.3751 9.14143V6.56365C12.3751 6.2966 12.1586 6.08008 11.8914 6.08008H10.1088C9.84169 6.08008 9.62509 6.2966 9.62509 6.56365V9.14143C9.62509 9.40848 9.40857 9.62517 9.14143 9.62517H6.56382C6.2966 9.62517 6.08008 9.84169 6.08008 10.1089V11.8914C6.08008 12.1585 6.2966 12.3752 6.56382 12.3752H9.14143C9.40857 12.3752 9.62509 12.5917 9.62509 12.8589V15.4364C9.62509 15.7036 9.84169 15.9201 10.1088 15.9201H11.8914C12.1586 15.9201 12.3751 15.7036 12.3751 15.4364V12.8589C12.3751 12.5917 12.5917 12.3752 12.8588 12.3752H15.4364C15.7036 12.3752 15.9202 12.1585 15.9202 11.8914V10.1089C15.9202 9.84169 15.7036 9.62517 15.4364 9.62517Z" fill="white"/>
              <path d="M11 0C4.92478 0 0 4.92495 0 11C0 17.0752 4.92478 22 11 22C17.0751 22 22 17.0752 22 11C22 4.92495 17.0751 0 11 0ZM11 19.25C6.45086 19.25 2.75 15.5491 2.75 11C2.75 6.45103 6.45086 2.75 11 2.75C15.549 2.75 19.25 6.45103 19.25 11C19.25 15.5491 15.549 19.25 11 19.25Z" fill="white"/>
            </svg>


            <div class="pl-2">Add Issue</div>
          </a>
        </li>             



        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">ELEMENTS</li>

        <li class="sidenav-item">
          <a href="{{route('wiki.index', $id)}}" class="sidenav-link" style="color: #FFFFFF !important;">
            <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.1834 16.9375H5.81689V17.8751H15.1834V16.9375Z" fill="white"/>
              <path d="M15.1834 13.135H5.81689V14.0726H15.1834V13.135Z" fill="white"/>
              <path d="M15.1834 9.33301H5.81689V10.2709H15.1834V9.33301Z" fill="white"/>
              <path d="M15.1833 5.53125H10.7686V6.46883H15.1833V5.53125Z" fill="white"/>
              <path d="M16.8832 0H9.1367C8.58057 0 8.04716 0.231602 7.6539 0.643199L2.82177 5.70573C2.42843 6.11768 2.20752 6.67666 2.20752 7.25931V19.9995C2.20752 21.1026 3.06429 22 4.11721 22H16.8832C17.9359 22 18.7927 21.1026 18.7927 19.9995V1.99985C18.7928 0.897102 17.9359 0 16.8832 0ZM8.4597 1.39V5.88676C8.4597 6.37287 8.27902 6.56232 7.81501 6.56232H3.52244L8.4597 1.39ZM17.719 19.9995C17.719 20.4824 17.3438 20.8749 16.8832 20.8749H4.11721C3.65631 20.8749 3.28131 20.4824 3.28131 19.9995V7.56241H8.38997C8.95476 7.56241 9.41446 7.08086 9.41446 6.48884V1.12509H16.8832C17.3438 1.12509 17.719 1.51727 17.719 1.99985V19.9995Z" fill="white"/>
            </svg>


            <div class="pl-2">Wiki</div>
          </a>
        </li>

        <span style="background-image: url('{{ URL::asset('assets_/img/bg/1.jpg')}}');"></span>
        <!-- CHECKING THE ROLE OF LOGGED IN USER -->


        <li class="sidenav-item">
          <a href="{{route('apps.index', $id)}}" class="sidenav-link" style="color: #FFFFFF !important;">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12.0405 5.56239C11.7345 5.42116 11.3792 5.34222 11 5.34033H10.9886C10.4845 5.34145 10.0221 5.47586 9.66222 5.71846C9.48269 5.84066 9.32818 5.99097 9.2147 6.17169C9.10156 6.35164 9.03208 6.56494 9.03174 6.78928L9.0249 8.47323V8.47778C9.02452 8.70212 9.09322 8.91624 9.20597 9.09692C9.37562 9.36943 9.63571 9.57404 9.94087 9.71601C10.2468 9.85764 10.6022 9.93619 10.9814 9.93808H10.9829H10.9924C11.4965 9.93735 11.9592 9.80255 12.3191 9.56004C12.4986 9.43818 12.6531 9.28744 12.7663 9.1068C12.8794 8.92685 12.9489 8.71351 12.9496 8.48917L12.9564 6.80527V6.80376V6.80067C12.9568 6.57637 12.8878 6.36226 12.7754 6.18157C12.6053 5.90937 12.3453 5.70436 12.0405 5.56239ZM12.1847 8.48612C12.184 8.55749 12.1646 8.62542 12.1175 8.70135C12.0484 8.81367 11.9095 8.93592 11.7122 9.02589C11.5159 9.11587 11.2654 9.17358 10.9924 9.17319H10.9886H10.9845C10.6193 9.17242 10.2947 9.06688 10.0844 8.92148C9.9789 8.84933 9.90258 8.76928 9.85631 8.69374C9.8096 8.61777 9.79022 8.54911 9.78988 8.47774V8.47735V8.47624L9.79254 7.78195C9.86353 7.82711 9.93829 7.86849 10.0173 7.90454C10.3035 8.03589 10.6398 8.10988 11.0001 8.10988C11.4506 8.10911 11.8633 7.99374 12.1875 7.79329L12.1847 8.48612ZM12.1916 6.80217L12.1901 7.17381C12.0963 7.2854 11.9581 7.39016 11.7835 7.47029C11.5656 7.5705 11.2942 7.63203 11 7.6316C10.6078 7.63237 10.2563 7.5219 10.0176 7.35866C9.92605 7.2964 9.85167 7.22731 9.79512 7.15593L9.79662 6.79229C9.7974 6.72092 9.81673 6.65298 9.86344 6.5774C9.93253 6.46508 10.0715 6.34245 10.2689 6.25286C10.4655 6.1625 10.7157 6.10518 10.9886 6.10556H10.9955H10.9966C11.3621 6.10591 11.6867 6.21182 11.8966 6.35684C12.0022 6.42899 12.0784 6.50904 12.1251 6.58462C12.1719 6.66055 12.1912 6.72921 12.1916 6.80058V6.80217Z" fill="white"/>
              <path d="M4.3667 3.24984C4.36746 3.24907 4.36868 3.24907 4.36944 3.24826L4.38768 3.2356L4.3667 3.24984Z" fill="white"/>
              <path d="M18.1047 4.36289C18.0745 4.15526 18.0024 3.96048 17.8968 3.79123L17.8866 3.7749L17.8966 3.79123C17.689 3.4602 17.3798 3.22293 17.0347 3.06351L17.0342 3.06313C16.6864 2.90405 16.2898 2.81906 15.8707 2.81868H15.8705C15.5943 2.81868 15.3321 2.86156 15.0853 2.93177L13.2573 2.06475C13.2482 1.79907 13.167 1.5508 13.0381 1.34201C12.8333 1.0121 12.5285 0.773363 12.1868 0.610855L12.1709 0.603293L12.1861 0.610855C11.8419 0.449164 11.4485 0.359574 11.0313 0.353902L11.0307 0.397172L11.0309 0.353902L10.9933 0.353516H10.9911C10.4414 0.354633 9.92853 0.499266 9.51607 0.774867L9.51552 0.775254C9.30957 0.914172 9.12549 1.08991 8.98691 1.30781C8.85062 1.52343 8.7633 1.78154 8.75746 2.05791L6.81012 2.98114C6.51784 2.87711 6.19859 2.81906 5.86171 2.81863H5.86111C5.30423 2.81975 4.7853 2.96782 4.36945 3.24759L4.36623 3.24991C4.15856 3.39111 3.97315 3.57029 3.83496 3.79157L3.86439 3.74448L3.83518 3.79123C3.70764 3.99469 3.62678 4.23763 3.61423 4.49652L0 6.20964V16.4313L10.9998 21.6462L22 16.4313V6.20964L18.1047 4.36289ZM14.6759 4.6381C14.6766 4.56673 14.696 4.4988 14.7427 4.42321C14.7947 4.33861 14.8862 4.24825 15.0122 4.17039L15.0266 4.17722L15.224 4.09373C15.4044 4.01742 15.6272 3.96882 15.8705 3.96921C16.2186 3.96805 16.5265 4.06864 16.7185 4.20111C16.815 4.26642 16.8818 4.33741 16.9201 4.39967C16.9585 4.46266 16.9718 4.51276 16.9721 4.56518V5.03324C16.8867 5.11029 16.7801 5.18088 16.6537 5.23859C16.4357 5.33879 16.1643 5.40032 15.8705 5.40032C15.478 5.4011 15.1265 5.29024 14.8877 5.127C14.8012 5.06813 14.7302 5.00325 14.6748 4.9357L14.6759 4.6381ZM14.6691 6.32278V6.32205L14.6721 5.55673C14.74 5.59966 14.8118 5.63837 14.8873 5.67326C15.1735 5.80462 15.5103 5.87827 15.8705 5.87865C16.3252 5.87788 16.7413 5.76023 17.067 5.55639L17.0635 6.33189C17.0632 6.40326 17.0434 6.47119 16.9968 6.54673C16.9277 6.65914 16.7887 6.78173 16.5914 6.8717C16.3951 6.96168 16.1446 7.019 15.8716 7.019H15.8678H15.8636C15.4984 7.01823 15.1739 6.9127 14.9636 6.76729C14.858 6.69519 14.7817 6.61505 14.7354 6.53955C14.6888 6.46324 14.6694 6.39492 14.669 6.32355V6.32278H14.6691ZM9.90692 2.08602C9.90804 2.03402 9.92136 1.9847 9.95973 1.92316C10.0159 1.83207 10.1381 1.72198 10.3199 1.64C10.5003 1.55763 10.7348 1.50413 10.9915 1.50413L11.0161 1.50448C11.3627 1.50791 11.6679 1.61155 11.8585 1.74519C11.9541 1.81123 12.0202 1.88299 12.0581 1.94521C12.0969 2.00902 12.1098 2.05912 12.1101 2.1115V2.113L12.1052 2.59055C12.0221 2.66566 11.9188 2.7348 11.7969 2.79208C11.581 2.89421 11.3118 2.95871 11.0191 2.96215H11.0184L10.9914 2.96254C10.6058 2.96292 10.2599 2.8555 10.0246 2.69609C9.97906 2.66566 9.9388 2.63232 9.90159 2.59889L9.90692 2.08602ZM9.80023 3.76463V3.76313L9.80934 3.12573C9.87693 3.16788 9.9483 3.20625 10.0227 3.24041C10.3055 3.36868 10.6369 3.44043 10.9915 3.44043H11.0253H11.0256C11.4739 3.43399 11.8835 3.31402 12.2043 3.11129L12.1944 3.80636C12.1926 3.87661 12.1732 3.94304 12.1269 4.01664C12.0578 4.12673 11.9211 4.24631 11.7272 4.33367C11.534 4.42132 11.2879 4.47714 11.02 4.47675L10.9858 4.47637C10.6225 4.47108 10.301 4.3625 10.0926 4.21598C9.98783 4.1431 9.91229 4.06223 9.86597 3.98635C9.81969 3.91004 9.8007 3.84137 9.80031 3.77035V3.76463H9.80023ZM4.75986 4.56523C4.76025 4.5128 4.77353 4.4627 4.81186 4.39971C4.8684 4.30668 4.99293 4.1932 5.17778 4.1089C5.36151 4.02425 5.60029 3.96882 5.86145 3.96925C6.15188 3.96848 6.41339 4.03791 6.60511 4.13966L6.81695 4.25125L6.84355 4.23875C6.91032 4.29491 6.96119 4.35339 6.99574 4.40882C7.04241 4.48513 7.0614 4.55345 7.06179 4.62521V4.62672L7.06063 4.93115C6.96687 5.04729 6.82567 5.15626 6.64495 5.23863C6.42709 5.33884 6.15562 5.40037 5.86145 5.40037C5.46932 5.40114 5.11779 5.29028 4.87902 5.12704C4.83502 5.09744 4.79591 5.06517 4.75982 5.03251V4.56523H4.75986ZM4.66039 6.30155V6.30078L4.66344 5.55673C4.73142 5.59966 4.80309 5.63837 4.87867 5.67326C5.16489 5.80462 5.5012 5.87827 5.86145 5.87865C6.31623 5.87788 6.73264 5.76023 7.05835 5.55639L7.05491 6.31066C7.05452 6.38203 7.03514 6.44997 6.98809 6.5255C6.919 6.63787 6.78008 6.7605 6.58273 6.85048C6.38606 6.94045 6.13589 6.99777 5.863 6.99777H5.85501C5.48982 6.997 5.16527 6.89147 4.95498 6.74606C4.84945 6.67396 4.77314 6.59382 4.72682 6.51833C4.68016 6.44202 4.66078 6.3737 4.66039 6.30232V6.30155ZM10.5218 20.1465L1.15057 15.7039V7.39098L10.5219 11.8335V20.1465H10.5218ZM10.9998 20.3735L10.9717 20.3598H11.0283L10.9998 20.3735ZM10.9998 11.0022L1.78866 6.6352L3.89817 5.63493L3.8955 6.29773V6.30228C3.89512 6.52666 3.96382 6.74073 4.07657 6.92142C4.24626 7.19358 4.5063 7.39854 4.81151 7.54056C5.11706 7.68175 5.47241 7.76073 5.85204 7.76257H5.85355H5.86304C6.36715 7.76146 6.8295 7.62705 7.18936 7.38411C7.36931 7.26263 7.52383 7.11194 7.63692 6.93087C7.75006 6.75092 7.8195 6.53762 7.82023 6.31363L7.82706 4.62968V4.62779V4.62512C7.82745 4.40036 7.75839 4.18667 7.64599 4.0056C7.62167 3.96766 7.59589 3.93084 7.56856 3.89513L9.04333 3.1959L9.03534 3.75204V3.77022C9.03495 3.99348 9.10254 4.20601 9.21375 4.38596C9.38115 4.65774 9.63776 4.8639 9.93996 5.00815C10.2429 5.15201 10.5951 5.23477 10.9725 5.24121L11.0199 5.2416C11.5161 5.24082 11.9716 5.10986 12.328 4.87224C12.5057 4.75266 12.659 4.60463 12.7725 4.42695C12.8856 4.24966 12.9562 4.03976 12.9593 3.81847L12.968 3.20123L14.2545 3.81121C14.1952 3.87536 14.1406 3.94334 14.0939 4.01733C13.9808 4.19729 13.9113 4.41058 13.911 4.63492L13.9041 6.31887V6.32342C13.9034 6.54776 13.9724 6.76188 14.0852 6.94256C14.2549 7.21472 14.5149 7.41968 14.8197 7.56165C15.1257 7.70285 15.481 7.78187 15.8606 7.78372H15.8622H15.8716C16.3757 7.7826 16.8385 7.64819 17.1984 7.40525C17.3779 7.28377 17.5324 7.1327 17.6455 6.95201C17.7587 6.77206 17.8281 6.55876 17.8289 6.33477L17.8323 5.50723L20.2113 6.63507L10.9998 11.0022Z" fill="white"/>
            </svg>
            <div class="pl-2">Apps</div>
          </a>
        </li>



        <li class="sidenav-item">
          <a href="{{route('screengroup.index', $id)}}" class="sidenav-link" style="color: #FFFFFF !important;">
            <img width="21px" src="{{ URL::asset('assets_/img/screenicon.png')}}" alt="">

            <div class="pl-2">Screens</div>
          </a>
        </li>  



        <li class="sidenav-item">
          <a href="{{route('ganttchart', $id)}}" class="sidenav-link" style="color: #FFFFFF !important;">
           <svg xmlns="http://www.w3.org/2000/svg" height="512px" viewBox="0 0 480 480" width="512px" style="width: 25px;float:left;height: 24px;"><g><path d="m264 216h208v48h-208zm0 0" fill="#57a4ff" data-original="#57A4FF" class="active-path" style="fill:#5F7D95;" data-old_color="#57a4ff"/><path d="m264 136h152v48h-152zm0 0" fill="#57a4ff" data-original="#57A4FF" class="active-path" style="fill:#5F7D95" data-old_color="#57a4ff"/><path d="m264 376h72v48h-72zm0 0" fill="#57a4ff" data-original="#57A4FF" class="active-path" style="fill:#5F7D95" data-old_color="#57a4ff"/><path d="m8 216h208v48h-208zm0 0" fill="#57a4ff" data-original="#57A4FF" class="active-path" style="fill:#5F7D95" data-old_color="#57a4ff"/><path d="m128 56h88v48h-88zm0 0" fill="#57a4ff" data-original="#57A4FF" class="active-path" style="fill:#5F7D95" data-old_color="#57a4ff"/><path d="m80 296h136v48h-136zm0 0" fill="#57a4ff" data-original="#57A4FF" class="active-path" style="fill:#5F7D95" data-old_color="#57a4ff"/><g fill="#1e81ce"><path d="m232 0h16v480h-16zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m256 208v64h224v-64zm208 48h-192v-32h192zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m424 128h-168v64h168zm-16 48h-136v-32h136zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m360 48h-104v64h104zm-16 48h-72v-32h72zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m256 352h152v-64h-152zm16-48h120v32h-120zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m256 432h88v-64h-88zm16-48h56v32h-56zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m0 272h224v-64h-224zm16-48h192v32h-192zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m56 192h168v-64h-168zm16-48h136v32h-136zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m120 112h104v-64h-104zm16-48h72v32h-72zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m72 352h152v-64h-152zm16-48h120v32h-120zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/><path d="m136 432h88v-64h-88zm16-48h56v32h-56zm0 0" data-original="#1E81CE" class="" style="fill:#FFFFFF" data-old_color="#1E81CE"/></g></g> </svg>
            <div class="pl-2">Gantt Chart</div>
          </a>
        </li>



{{--         <li class="sidenav-item">
          <a href="{{route('screengroup.index', $id)}}" class="sidenav-link" style="color: #FFFFFF !important;">
            <img width="21px" src="{{ URL::asset('assets_/img/screenicon.png')}}" alt="">

            <div class="pl-2">Screens</div>
          </a>
        </li> --}}





        <!-- CHECKING THE ROLE OF LOGGED IN USER ENDS -->
        <li class="sidenav-item">
          @if (isset($id))
            <a href="{{route('project.settings', $id)}}" class="sidenav-link" style="color: #FFFFFF !important;">
          @else
           <a href="#" class="sidenav-link" style="color: #FFFFFF !important;">
          @endif
         
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0)">
                <path d="M21.3799 9.24461L19.002 8.68327C18.8285 8.08364 18.594 7.51121 18.2983 6.9759L19.5807 4.90034C19.7771 4.58259 19.7289 4.17224 19.4652 3.90845L18.0905 2.53384C17.8272 2.27048 17.4172 2.2224 17.0991 2.41868L15.0243 3.70147C14.4886 3.4058 13.9162 3.17089 13.317 2.99781L12.7557 0.618719C12.6697 0.256063 12.3453 -0.000976562 11.9723 -0.000976562H10.0284C9.65551 -0.000976562 9.33148 0.256063 9.24554 0.618719L8.6842 2.99786C8.08457 3.17093 7.51218 3.40511 6.97684 3.70151L4.90127 2.41799C4.58391 2.22244 4.17317 2.27014 3.90938 2.53388L2.53481 3.90811C2.27146 4.17181 2.22338 4.58297 2.41927 4.89991L3.70245 6.97586C3.40678 7.51117 3.17182 8.0836 2.99918 8.68241L0.619695 9.24379C0.257039 9.33055 0 9.65419 0 10.0275V11.971C0 12.3439 0.257039 12.6688 0.619695 12.7543L2.99922 13.3157C3.1723 13.9149 3.40682 14.4869 3.70249 15.0218L2.41893 17.0982C2.22337 17.4159 2.27107 17.8267 2.53481 18.0908L3.90904 19.4646C4.17278 19.7288 4.58391 19.7764 4.90084 19.5801L6.97718 18.2966C7.51296 18.5926 8.08534 18.8272 8.68416 18.9999L9.2455 21.3789C9.33144 21.7428 9.65547 21.999 10.0284 21.999H11.9723C12.3452 21.999 12.6697 21.7428 12.7556 21.3789L13.317 18.9999C13.9158 18.8272 14.4882 18.5926 15.0232 18.2966L17.0991 19.5798C17.4172 19.7761 17.8272 19.728 18.0913 19.4643L19.4656 18.0896C19.7289 17.8263 19.777 17.4155 19.5806 17.0978L18.2975 15.0222C18.5939 14.4872 18.8281 13.9148 19.0012 13.3156L21.3803 12.7543C21.7441 12.6683 22 12.3443 22 11.971V10.0271C22 9.65458 21.7437 9.33055 21.3799 9.24461ZM10.9998 17.0714C7.64818 17.0714 4.92847 14.3517 4.92847 10.9989C4.92847 7.64566 7.64822 4.92634 10.9998 4.92634C14.3526 4.92634 17.0723 7.64566 17.0723 10.9989C17.0723 14.3517 14.3526 17.0714 10.9998 17.0714Z" fill="white"/>
                <path d="M11.0001 7.7561C9.20958 7.7561 7.75732 9.20883 7.75732 10.9997C7.75732 12.7907 9.20958 14.2434 11.0001 14.2434C12.7911 14.2434 14.2437 12.7907 14.2437 10.9997C14.2437 9.20883 12.791 7.7561 11.0001 7.7561Z" fill="white"/>
              </g>
              <defs>
                <clipPath id="clip0">
                  <rect width="22" height="22" fill="white"/>
                </clipPath>
              </defs>
            </svg>


            <div class="pl-2">Project Settings</div>
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
  <div class="common_breadcrum mb-5">  

    @if(isset($id) && !empty($id))
      @php
        $dtb_projects = DB::table('dtb_projects')->select('project_name')->where('id', $id)->first();
        if (!empty($dtb_projects)) {
          echo "[ " .$dtb_projects->project_name . " ]&nbsp;&nbsp;";
        }
        
      @endphp
    @endif

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
</script>
</body>
</html>
