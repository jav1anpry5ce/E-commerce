<?php

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $url = "https://";
    }else{
        $url = "http://";
    }
    $url .= $_SERVER['HTTP_HOST'];

// Check if the user press the button to reset their password and execute the code below.
if (isset($_POST["reset-request-submit"])) {

	// create unique identifer to aunthenciate that correct user is trying to reset their password.
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url .= "/e-commerce/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

	require 'conn.php';

	$userEmail = $_POST["email"];
	// delete any previous request
	$sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
	$stmt = mysqli_stmt_init($link);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}
	// input the new request
	$sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($link);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}

	mysqli_stmt_close($stmt);
	mysqli_close($link);
	// send reset email to user.
	$to = $userEmail;

	$subject = "Rest your password for E-Commerce.";

	$message = '<p>We recieved a password reset request. The link to reset your password is down below. If you did not make this request ignore this email.</P>';
	$message .= '<p>Here is your password reset link: </br>';
	$message .= '<a href="' .$url . '">' . $url . '</a></p>';

	$headers = "From: E-Commerce <donotreply@localhost>\r\n";
	$headers .= "Content-type: text/html\r\n";

	mail($to, $subject, $message, $headers);

	header("Location: forgot-password.php?reset=success");


} else {
	header("Location: forgot-password.php?reset=fail");
}