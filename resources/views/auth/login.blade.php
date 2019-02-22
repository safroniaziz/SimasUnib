
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Simas Unib - Login</title>
        <style>
            body
            {
                margin: 0;
                padding: 0;
                background: url({{ asset('assets/img/bg-book.png') }});
                background-size: cover;
                font-family: sans-serif;
            }
            .loginBox
            {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                width: 350px;
                height: 450px;
                padding: 80px 40px;
                box-sizing: border-box;
                background: rgba(0,0,0,.7);
            }
            .user
            {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                overflow: hidden;
                position: absolute;
                top: calc(-100px/2);
                left: calc(50% - 50px);
            }
            h2
            {
                margin: 0;
                padding: 0 0 20px;
                color: #efed40;
                text-align: center;
            }
            .loginBox p
            {
                margin: 0;
                padding: 0;
                font-weight: bold;
                color: #fff;
            }
            .loginBox input
            {
                width: 100%;
                margin-bottom: 20px;
            }
            .loginBox input[type="text"],
            .loginBox input[type="password"]
            {
                border: none;
                border-bottom: 1px solid #fff;
                background: transparent;
                outline: none;
                height: 40px;
                color: #fff;
                font-size: 16px;
            }
            ::placeholder
            {
                color: rgba(255,255,255,.5);
            }
            .loginBox input[type="submit"]
            {
                border: none;
                outline: none;
                height: 40px;
                color: #fff;
                font-size: 16px;
                background: #ff267e;
                cursor: pointer;
                border-radius: 20px;
            }
            .loginBox input[type="submit"]:hover
            {
                background: white;
                color: black;
            }
            .loginBox a
            {
                color: #fff;
                font-size: 14px;
                font-weight: bold;
                text-decoration: none;
            }

        </style>
	</head>
	<body>
		<div class="loginBox">
			<img src="{{ asset('assets/img/logo-utama.png') }}" class="user">
            <h2 style="text-transform: uppercase;">Silahkan Login Disini</h2>
            <form method="post">
				@csrf
				<p>Username</p>
				<input type="text" name="username"  placeholder="masukan username">
				<p>Password</p>
				<input type="password" name="password" placeholder="••••••">
				<input type="submit" name="" value="Login">
				<a href="#">Lupa Password?</a>
			</form>
		</div>
	</body>
</html>
