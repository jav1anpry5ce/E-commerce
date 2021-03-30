<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Create new password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    // Get unique valdiator to ensure user is authenticate.
	$selector = $_GET["selector"];
	$validator = $_GET["validator"];

	if (empty($selector) || empty($validator)) {
		header("Location: ../forgot-password.php?validate=couldnotvalidate");

	} else {
		if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
			?>
    <!-- Display form to reset password -->
    <div class="container">
        <div class="row justify-content-center centering">
            <form class="card w-50" action="resetpassword.php" method="POST">
                <h1 class="text-center text-primary">Create new password</h1>
                <input type="hidden" name="selector" value="<?php echo $selector?>">
                <input type="hidden" name="validator" value="<?php echo $validator?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="pwd" class="text-primary">New Password</label><br>
                        <input class="form-control" type="password" required name="pwd" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd2" class="text-primary">Confirm Password:</label><br>
                        <input class="form-control" type="password" id="pwd2" required name="pwd-repeat">
                    </div>
                    <button type="submit" name="reset-password-submit" class="btn btn-outline-secondary btn-md">Reset
                        password</button>
                </div>
            </form>
        </div>
    </div>

    <?php
	}
}
?>
</body>

</html>