@extends('layouts.home')


@section('content')


<div id="loading-icon-bx"></div>
	<div class="account-form">
    <!-- url('{{ asset('img/big-loader.gif')}}'); -->
		<div class="account-head" style="background-image: 	url({{ asset('assets/home/images/background/bg2.jpg') }});">
        
			<img src="{{ asset('assets/home/images/7.png') }}" alt="">
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Login to Medical <span>Academy</span></h2>
					<!-- <p>Don't have an account? <a href="register.html">Create one here</a></p> -->
		
				<form class="contact-bx" method="POST" action="{{ route('login') }}">
                    @csrf
					<div class="row placeani">
                        <!-- Email Address -->
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Email Address</label>
									<input name="email" type="email" id="email" required autofocus class="form-control">
								</div>
							</div>
						</div>
                        <!-- Password -->
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Your Password</label>
									<input name="password" id="password" type="password" class="form-control" required autocomplete="current-password">
								</div>
							</div>
						</div>
						<!-- <div class="col-lg-12">
							<div class="form-group form-forget">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
									<label class="custom-control-label" for="customControlAutosizing">Remember me</label>
								</div>
								<a href="forget-password.html" class="ml-auto">Forgot Password?</a>
							</div>
						</div> -->
						<div class="col-lg-12 m-b30">
							<button name="submit" type="submit" value="Submit" class="btn button-md">Login</button>
						</div>
						<!-- <div class="col-lg-12">
							<h6>Login with Social media</h6>
							<div class="d-flex">
								<a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a>
								<a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i>Google Plus</a>
							</div>
						</div> -->
					</div>
				</form>
			</div>
		</div>
	</div>

    @endsection