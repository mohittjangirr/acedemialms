<!DOCTYPE html>
<html lang="en">
<head>
	<title>VirtuExam-Powered By Codechamp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="login-ui/image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="login-ui/css/util.css">
	<link rel="stylesheet" type="text/css" href="login-ui/css/main.css">
	<style>
		/* Change the font for the entire page */
		body {
			font-family: 'Montserrat', serif;
		}

		.login100-form-title {
			background: none; /* Remove background */
		}

		.logo-image {
			width: 100px; /* Adjust the width as needed */
			margin-bottom: 20px; /* Add margin for spacing */
		}
		.mit-image {
			width: 180px; /* Adjust the width as needed */
			margin-bottom: 80x; /* Add margin for spacing */
		}

		/* Style the sign-up button as per provided CSS */
		.button {
			display: inline-block;
			width: auto;
			height: 47px;
			background: #ff8a00;
			-webkit-transition: all 200ms ease;
			-moz-transition: all 200ms ease;
			-ms-transition: all 200ms ease;
			-o-transition: all 200ms ease;
			transition: all 200ms ease;
		}

		.button a {
			display: block;
			position: relative;
			padding-left: 33px;
			padding-right: 77px;
			line-height: 47px;
			font-size: 12px;
			font-weight: 600;
			color: #FFFFFF;
			text-transform: uppercase;
			white-space: nowrap;
		}

		.button_arrow {
			position: absolute;
			top: 0;
			right: 0;
			width: 44px;
			height: 100%;
			background: #ff6600;
			text-align: center;
			-webkit-transition: all 200ms ease;
			-moz-transition: all 200ms ease;
			-ms-transition: all 200ms ease;
			-o-transition: all 200ms ease;
			transition: all 200ms ease;
		}

		.button_arrow i {
			font-size: 20px;
			line-height: 47px;
			color: #ffae00;
			-webkit-transition: all 200ms ease;
			-moz-transition: all 200ms ease;
			-ms-transition: all 200ms ease;
			-o-transition: all 200ms ease;
			transition: all 200ms ease;
		}

		.button:hover {
			background: #ffae00;
		}

		.button:hover .button_arrow {
			background: #ff8a00;
		}

		.button:hover .button_arrow i {
			color: #ffae00;
		}
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<img src="https://codechamp.live/images/home_logo.png" alt="Logo" class="logo-image">
			
				
				<div class="login100-form-title">
					<span class="login100-form-title-1">
						Student panel	<br><img src="assets/images/mit.png" alt="Logo" class="mit-image">
					</span>
				</div>
				<!-- Add the link to the admin panel here -->
<div class="button home_button"><a href="adminpanel/index.php"><div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>

<!-- Add the link below the sign-up button for logging in as an admin -->
<div style="text-align: center; margin-top: 20px;">
    <a href="adminpanel/index.php" style="text-decoration: none; color: #333;">Admin Panel</a>
</div>


				<form method="post" id="examineeLoginFrm" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="username" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn" align="right">
						<button type="submit" class="login100-form-btn button">
							Login
							<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
						</button>
					</div>
				</form>

				<!-- Add the link to the admin panel here -->
				<div class="button home_button"><a href="adminpanel/index"><div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
			</div>
		</div>
	</div>
	
	<script src="login-ui/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="login-ui/vendor/animsition/js/animsition.min.js"></script>
	<script src="login-ui/vendor/bootstrap/js/popper.js"></script>
	<script src="login-ui/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="login-ui/vendor/select2/select2.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/moment.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="login-ui/vendor/countdowntime/countdowntime.js"></script>
	<script src="login-ui/js/main.js"></script>

</body>
</html>
