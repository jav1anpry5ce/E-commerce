<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title>Create new password</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<style type="text/css">
		html, body {
			margin: 0;
			padding: 0;
			height: 100%;
			background: #007bff;
			background: -webkit-linear-gradient(left, #3931af, #00c6ff);
			color: #ffffff;
		}
		span {
			color: #0099ff;
		}
		#login .container #login-row #login-column #login-box {
			margin-top: 120px;
			max-width: 600px;
			height: 320px;
			border: 1px solid #9C9C9C;
			background-color: #EAEAEA;
		}
		#login .container #login-row #login-column #login-box #login-form {
			padding: 20px;
		}
		#login .container #login-row #login-column #login-box #login-form #register-link {
			margin-top: -85px;
		}
	</style>
</head>
<body>
	<?php
	$selector = $_GET["selector"];
	$validator = $_GET["validator"];

	if (empty($selector) || empty($validator)) {
		header("Location: ../forgot_password.php?validate=couldnotvalidate");

	} else {
		if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
			?>
		<!--
			<form action="../resetpassword.php" method="POST">
				<input type="hidden" name="selector" value="<?php //echo $selector?>">
				<input type="hidden" name="validator" value="<?php //echo $validator?>">
				<label for="pwd">Create new password</label><br>
				<input type="password" name="pwd" id="pwd" placeholder="Enter a new password..."><br>
				<label for="pwd2">Repeat new password</label><br>
				<input type="password" id="pwd2" name="pwd-repeat" placeholder="repeat new password..."><br><br>
				<button type="submit" name="reset-password-submit">Reset password</button>
			</form> 
		-->
		<div id="login">
			<div class="container">
				<div id="login-row" class="row justify-content-center align-items-center">
					<div id="login-column" class="col-md-6">
						<div id="login-box" class="col-md-12">
							<form id="login-form" class="form" action="../resetpassword.php" method="POST">
								<h3 class="text-center text-info">Create new password</h3>
								<input type="hidden" name="selector" value="<?php echo $selector?>">
								<input type="hidden" name="validator" value="<?php echo $validator?>">
								<div class="form-group">
									<label for="pwd" class="text-info">New Password</label><br>
									<input class="form-control" type="password" name="pwd" id="pwd">
								</div>
								<div class="form-group">
									<label for="pwd2" class="text-info">Confirm Password:</label><br>
									<input class="form-control" type="password" id="pwd2" name="pwd-repeat">
								</div>
								<div class="form-group">
									<button type="submit" name="reset-password-submit" class="btn btn-info btn-md">Reset password</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}
?>
</body>
</html>