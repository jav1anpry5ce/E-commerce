<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $first_name = $_POST['First-Name'];
    $last_name = $_POST['Last-Name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];
    $err = "";

    $subject = "Thanks for contacting E-Commerce";
    $msg = "<p>Hello ". $first_name . ", </p>";
    $msg .= "<p>We have received your message and will reach out to you in 3-5 business days.<?p><br><hr>";
    $msg .= "<p>Name: ". $first_name . " " . $last_name. "</p>";
    $msg .= "<p>Email Address: <a href=\"mailto:\"". $email. ">". $email. "</a></p>";
    $msg .= "<p>Telephone: ". $number. "</p>";
    $msg .= "<p><b>Message: </b>". $message . "</p>";
    $msg .= "<p>Regards,</p>";
    $msg .= "<img src=\"images/hp.png\"> <p>E-Commerce</p>";
    $headers = "From: E-Commerce <donotreply@localhost>\r\n";
	$headers .= "Content-type: text/html\r\n";
    mail($email, $subject, $msg, $headers);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="images/e-commerce.png" />
    <title>Contact Us</title>
</head>

<body>
    <?php
require 'navbar.php';
?>
    <div class="container">
        <div class="row justify-content-center">
            <form class="card w-50" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="card-body">
                    <h1>Contact Us</h1>
                    <div class="form-group">
                        <label for="First-Name">First Name</label>
                        <input type="text" class="form-control" name="First-Name" id="First-Name"
                            placeholder="Enter your first name" />
                    </div>
                    <div class="form-group">
                        <label for="Last-Name">Last Name</label>
                        <input type="text" class="form-control" name="Last-Name" id="Last-Name"
                            placeholder="Enter your last name" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Enter your email" />
                    </div>
                    <div class="form-group">
                        <label for="number">Contact Number</label>
                        <input type="text" class="form-control" name="number" id="number"
                            placeholder="Enter your phone number" />
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-info" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    require 'footer.php';
    ?>
</body>

</html>