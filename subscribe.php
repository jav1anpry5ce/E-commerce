<?php
if(isset($_POST['subscribe'])){
    $email = $_POST['email'];
    $url = $_POST['url'];

    $subject = "Thanks for subscribing to E-Commerce News Letter";
    $message = "<p>Hi,</p>";
    $message .= "<p>Thank you for subscribing as a reward use code J7I75# for 50% off all items.</p>";
    $message .= "<p>Regards,</p>";
    $message .= "<p>E-Commerce</p>";
    $headers = "From: E-Commerce <donotreply@localhost>\r\n";
	$headers .= "Content-type: text/html\r\n";
    mail($email, $subject, $message, $headers);

    header('Location: '. $url);
}