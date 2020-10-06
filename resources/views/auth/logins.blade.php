<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="ie=edge" http-equiv="x-ua-compatible">
<meta content="width=device-width, initial-scale=1" name="viewport">
<title>Dashboard</title>
<link href="../assets/images/favicon.png" rel="shortcut icon">
<link rel="stylesheet" href="{{asset('assets_new/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/plugins/customScroll/jquery.mCustomScrollbar.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/icons/simple-line/css/simple-line-icons.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/icons/dripicons/dripicons.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/icons/fontawesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/icons/metrize/metrize.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/plugins/date-range/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/main.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/sweetalert.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/css/normalize.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/lightbox.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/fileuploader.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/checkbox.css')}}">
<link rel="stylesheet" href="{{asset('assets_new/css/jquery.mswitch.css')}}">

<script src="{{asset('assets_new/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets_new/js/sweetalert.js')}}"></script>
<script src="{{asset('assets_new/js/fileuploader.min.js')}}"></script>
<script src="{{asset('assets_new/js/jquery.uploadPreview.js')}}"></script>
<script src="{{asset('assets_new/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets_new/js/jquery.mswitch.js')}}"></script>
<script src="{{asset('assets_new/js/header.js')}}"></script>

</head>
<body>



<section style="background: url('{{ URL::asset('assets_new/images/login-back.jpg')}}'); background-size: cover">
    <div class="bg-primary-trans">
        <div class="height-100-vh d-flex justify-content-center align-items-center">

            <div class="col-12 col-md-6 col-lg-4">
                <div class="login-div" style="padding: 20px; margin: 30px auto 15px;">
                    <div class="d-block text-center mb-2"><img src="{{asset('assets_new/images/logo.png')}}"></div>
                     @if(session()->has('message-danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('message-danger') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'checkLogin',
                    'method' => 'POST', 'id' => 'needs-validation', 'enctype' => 'multipart/form-data']) }}
                   <!--  <form action="home.php" method="post" name="login" id="needs-validation" novalidate> -->  
                        <div class="form-group">
                            <label>Login</label>
                            <input class="form-control input-lg" placeholder="Email" name="email" type="text" required>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                        <div class="form-group">
                            <label class="mt-1">Password</label>
                            <input class="form-control input-lg" placeholder="Password" name="password" type="password" required>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit" style="width: 100%">Sign In</button>
                    <!-- </form> -->
                       {{ Form::close()}}
                </div>
                <div style="text-align: center; color: #fff; text-transform: uppercase; font-size: 14px;"> &copy; Copyrights <a href="#" target="_blank" style="color: #fff; font-weight: bold;">WholisticFit</a></div>
            </div>

        </div>
    </div>
</section>


<script src="{{asset('assets_new/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets_new/js/popper.min.js')}}"></script>
<script src="{{asset('assets_new/js/modernizr.custom.js')}}"></script>
<script src="{{asset('assets_new/plugins/customScroll/jquery.mCustomScrollbar.min.js')}}"></script>
<script src="{{asset('assets_new/plugins/sortable2/sortable.min.js')}}"></script>
<script src="{{asset('assets_new/plugins/date-range/moment.min.js')}}"></script>
<script src="{{asset('assets_new/plugins/date-range/daterangepicker.js')}}"></script>
<script src="{{asset('assets_new/plugins/data-tables/datatables.min.js')}}"></script>
<script src="{{asset('assets_new/plugins/editable/editable.js')}}"></script>
<script src="{{asset('assets_new/js/main.js')}}"></script>
<script src="{{asset('assets_new/js/lightbox.js')}}"></script>
<script src="{{asset('assets_new/js/custom.js')}}"></script>
<script src="{{asset('assets_new/js/chosen.jquery.js')}}"></script>
<script src="{{asset('assets_new/js/ImageSelect.jquery.js')}}"></script>

<script type="text/javascript">
$(".my-select").chosen({width:"100%"});
</script>
</body>
</html>


