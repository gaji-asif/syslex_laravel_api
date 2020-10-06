<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
    <title>Register - BackApp LLC</title>
    @include('partials.header')
    <link rel="stylesheet" href="{{asset('assets_/vendor/css/pages/authentication.css')}}">
    <style type="text/css">
    	.is-invalid{
    		border-bottom: 3px solid #9BBFEB;
    	}
    	.form-control.is-invalid{
    		border-color:#9BBFEB;
    	}
    	.invalid-feedback{
    		color: white;
    	}
    	.form-label{
    		color:gainsboro;
    	}
    </style>
</head>

<body>
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>

    <!-- <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('{{ URL::asset('assets_/img/bg/logbg3.png')}}');" > -->
    <div class="authentication-wrapper authentication-2 ui-bg-cover px-4" style="background-image: url('{{ URL::asset('assets_/img/bg/loginbg.png')}}');" >
        <!-- <div class="ui-bg-overlay bg-dark opacity-25"></div> -->

        <div class="authentication-inner py-5">
            <div class="card bg-transparent dtb_login_box border-0">

                                <div class="d-flex justify-content-center align-items-center">
                        <div class="">
                            <!-- <img src="{{asset('assets_/img/company_logo.png')}}" class="img-responsive" width="70" height="70"> -->
                            <h2 class="text-white font-weight-normal mb-4">backapp</h2>
                        </div>
                    </div>  


                <div class="dtb_loginbox_inner" style="width: 92%; padding: 37px;">
                    <!-- Logo -->
                    <!-- / Logo -->
                    
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'makeRegister',
					'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                    <h4 class="text-left text-white font-weight-normal logboxcolor">New Register</h4>
                    @if(session()->has('message-danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('message-danger') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!-- Form -->
                    <div class="form-group">
						<label class="form-label">Your Name</label>
						<input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{old('name')}}" placeholder="Name" name="name">
						@if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
							<span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
						</span>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label">Space Name</label>
						<input type="text" class="form-control {{ $errors->has('space_name') ? ' is-invalid' : '' }}" value="{{old('space_name')}}" placeholder="Space Name" name="space_name">
						@if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
							<span class="messages"><strong>{{ $errors->first('space_name') }}</strong></span>
						</span>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label">Email</label>
						<input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" placeholder="Email" name="email">
						@if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
							<span class="messages"><strong>{{ $errors->first('email') }}</strong></span>
						</span>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label">Password</label>
						<input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}" placeholder="Password" name="password">
						@if ($errors->has('password'))
						<span class="invalid-feedback" role="alert">
							<span class="messages"><strong>{{ $errors->first('password') }}</strong></span>
						</span>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label">Confirm Password</label>
						<input type="password" class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" value="{{old('confirm_password')}}" placeholder="Confirm Password" name="confirm_password">
						@if ($errors->has('confirm_password'))
						<span class="invalid-feedback" role="alert">
							<span class="messages"><strong>{{ $errors->first('confirm_password') }}</strong></span>
						</span>
						@endif
					</div>
                    <button type="submit" class="btn btn-success btn-block mt-4">Register</button>
                    <!-- / Form -->
                    {{ Form::close()}}

                    <div class="text-center my-2 mt-4 logboxcolor" >
                         Already Have Account ?<a href="{{route('login')}}" class="logboxcolor createacclink"> Sign in</a>
                    </div>
                </div>
                <div class="card-footer py-3 px-4 px-sm-5 border-0">

                </div>
            </div>
        </div>
    </div>

<style>

input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active  {
    -webkit-box-shadow: 0 0 0 30px #5076A3 inset !important;
     -webkit-text-fill-color: #E5E5E5 !important;
}
.btn-success:hover {
    background: #38587d;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #E5E5E5;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #E5E5E5;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: #E5E5E5;
}

.alert-danger {
    border-color: #26b4ff;
    background-color: #fffaf08f;
    color: black;
}

.alert-danger  button {;
    padding: 0px 8px !important;
}
</style>
    <script src="{{asset('assets_/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets_/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets_/vendor/js/sidenav.js')}}"></script>

    <!-- Libs -->
    <script src="{{asset('assets_/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <!-- Demo -->
    <script src="{{asset('assets/js/demo.js')}}"></script>

</body>
</html>
