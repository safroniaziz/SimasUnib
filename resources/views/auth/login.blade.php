<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Simas Unib - Login</title>
		<link rel="stylesheet" href="{{ asset('assets/login/style.css')  }}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<style>
			h2{
				margin: 0;
				padding: 0 0 20px;
				color: #efed40;
				text-align: center;
				padding-bottom: 10px !important;
			}

			h2{
				display: block;
				font-size: 24px;
				margin-inline-start: 0px;
				margin-inline-end: 0px;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div class="loginBox">
    <img src="{{ asset('assets/login/logo.png')  }}" height="100" class="user">
			{{-- @if($errors->any())
				<div class="alert alert-danger alert-block" role="alert" fadeIn>
					<button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Perhatian :</strong>{{$errors->first()}}
				</div>
				@if ($message = Session::get('error')) 
					@if ($pesan = Session::get('pesan')) 
					<div class="alert alert-danger alert-block" role="alert" fadeIn>
							<button type="button" class="close" data-dismiss="alert">×</button> 
							<strong>{{ $message }}</strong> {{ $pesan }}
						</div>
						@else
							<h2>SILAHKAN LOGIN DISINI</h2>
					@endif
					@else
						<h2>SILAHKAN LOGIN DISINI</h2>
				@endif
				@else
			@endif --}}
			<?php 
				if($errors->any()){
					?>
						<div class="alert alert-danger alert-block" role="alert" fadeIn>
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong>Perhatian :</strong>{{$errors->first()}}
						</div>
					<?php
				}
				elseif ($message = Session::get('error')) {
					if($pesan = Session::get('pesan')){
						?>
							<div class="alert alert-danger alert-block" role="alert" fadeIn>
								<button type="button" class="close" data-dismiss="alert">×</button> 
								<strong>{{ $message }}</strong> {{ $pesan }}
							</div>
						<?php
					}
					else{
						?>
							<h2>SILAHKAN LOGIN DISINI</h2>
						<?php
					}
				}
				else{
					?>
						<h2>SILAHKAN LOGIN DISINI</h2>
					<?php
				}
			?>
			
			<form method="post">
				@csrf
				
			<p>Username</p>
				<input type="text" name="username" placeholder="username">
				<p>Password</p>
				<input type="password" name="password" placeholder="••••••">
				<input type="submit" name="" value="Sign In">
				<a href="#">Forget Password</a>
			</form>
		</div>
	</body>
	<script>
		
	</script>
</html>
