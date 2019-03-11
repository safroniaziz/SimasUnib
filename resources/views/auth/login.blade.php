<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Simas Unib - Login</title>
  <link rel="stylesheet" href="{{ asset('assets/login/style.css')  }}">
	</head>
	<body>
		<div class="loginBox">
    <img src="{{ asset('assets/login/logo.png')  }}" height="100" class="user">
			<h2>SILAHKAN LOGIN DISINI</h2>
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
</html>
