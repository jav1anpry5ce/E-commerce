<?php

if (isset($_POST["reset-password-submit"])) {
	// check to see the unique identifer and match it back to the database.
	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["pwd"];
	$passwordRepear = $_POST["pwd-repeat"];
	$url = $_POST['url'];
	$url = str_replace("&password=empty", "", $url);
	$url = str_replace("&password=error", "", $url);
	$url = str_replace("&password=not-stronged", "", $url);

	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

	if (empty($password) || empty($passwordRepear)) {
			header("Location: ". $url . "&password=empty");
			exit();
		} else if($password != $passwordRepear) {
			header("Location: ". $url. "&password=error");
			exit();
		} else if(strlen($password) < 8 || !$uppercase || !$lowercase || !$number || !$specialChars){
			header('Location: '. $url . '&password=not-stronged');
			exit();
		}

		$currentDate = date("U");

		require 'conn.php';

		$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
		$stmt = mysqli_stmt_init($link);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			//echo "There was an error!";
			header("Location: forgot-password.php?reset=fail");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt);
			if (!$row = mysqli_fetch_assoc($result)) {
				//echo "you need to re-submit your reset request";
				header("Location: forgot-password.php?reset=fail");
				exit();
			}  else {

				$tokenBin = hex2bin($validator);
				$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

				if ($tokenCheck === false) {
					//echo "you need to re-submit your reset request";
					header("Location: forgot-password.php?reset=fail");
					exit();
				} elseif ($tokenCheck === true) {

					$tokenEmail = $row['pwdResetEmail'];

					$sql = "SELECT * FROM users WHERE email=?;";
					$stmt = mysqli_stmt_init($link);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						//echo "There was an error!";
						header("Location: forgot-password.php?reset=fail");
						exit();
					} else {
						mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						if (!$row = mysqli_fetch_assoc($result)) {
							//echo "There was an error!";
							header("Location: forgot-password.php?reset=fail");
							exit();
						} else{

							$sql = "UPDATE users SET password=? WHERE email=?";

							$stmt = mysqli_stmt_init($link);
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								//echo "There was an error!";
								header("Location: forgot-password.php?reset=fail");
								exit();
							} else {
								$newPwdHash = password_hash($password, PASSWORD_DEFAULT);
								mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
								mysqli_stmt_execute($stmt);

								$sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
								$stmt = mysqli_stmt_init($link);
								if (!mysqli_stmt_prepare($stmt, $sql)) {
									//echo "There was an error!";
									header("Location: forgot-password.php?reset=fail");
									exit();
								} else {
									mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
									mysqli_stmt_execute($stmt);
									// if password was reset the an email is sent to the user.

									$subject = "Password sucessfully reset for E-Commerce.";

									$message = '<p>This is to inform you that your password was successfully reset.</P>';
									$message .= '<p>Regards,</p>';
									$message .= '<p>E-Commerce</p>';

									$headers = "From: E-Commerce <donotreply@localhost>\r\n";
									$headers .= "Content-type: text/html\r\n";

									mail($tokenEmail, $subject, $message, $headers);

									header("Location: login.php");
								}
							}
						}
					}

				}
			}
		}

} else{
	header("Location: login.php");
}