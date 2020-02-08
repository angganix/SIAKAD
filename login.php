<?php
session_start();
if (!isset($_SESSION['app_token'])) {
    $_SESSION['app_token'] = base64_encode(openssl_random_pseudo_bytes(32));
} else {
	unset($_SESSION['app_token']);
	$_SESSION['app_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="asset/login/images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="asset/login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="asset/login/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="asset/login/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="asset/login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="asset/login/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="asset/login/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="asset/login/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="asset/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="asset/login/css/main.css">
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background:#eee;">
			<div class="wrap-login100">
				<div class="login100-form validate-form">
					<span class="login100-form-logo">
						<img src="asset/logo.jpeg" style="width: 40px;height: 40px;">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						SISTEM INFORMASI AKADEMIK
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" id="txtUsername" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" id="txtPassword" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" onclick="doLogin();">
							Login
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<script src="asset/login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="asset/login/vendor/animsition/js/animsition.min.js"></script>
	<script src="asset/login/vendor/bootstrap/js/popper.js"></script>
	<script src="asset/login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="asset/login/vendor/select2/select2.min.js"></script>
	<script src="asset/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="asset/login/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="asset/login/vendor/countdowntime/countdowntime.js"></script>
	<script src="asset/login/js/main.js"></script>
	<script type="text/javascript">
		window.csrf = {
			app_token: '<?= $_SESSION['app_token']; ?>'
		};

		$.ajaxSetup({
			data: window.csrf
		});

		$("#txtPassword").on("keypress", function(e) {
			if (e.which === 13) {
				doLogin();
			}
		});

		function doLogin() {
			var uname = $("#txtUsername").val();
			var paswd = $("#txtPassword").val();

			if (uname === "") {
				alert("Username tidak boleh kosong!");
			} else if (paswd === "") {
				alert("Password tidak boleh kosong!");
			} else {
				$.post("controller/cekLogin.php", {
					username: escape(uname),
					password: escape(paswd)
				}, function(data) {

					if (data.status === "invalid_password") {
						alert("Password salah...");
					} else if (data.status === "not_exists") {
						alert("Username tidak terdaftar");
					} else {
						location.href = "index.php";
					}

				}, "json");
			}
		}
	</script>

</body>

</html>