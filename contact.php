<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $first_name = $_POST['First-Name'];
    $last_name = $_POST['Last-Name'];
    $email = $_POST['email'];
    $need = $_POST['need'];
    $message = $_POST['message'];

    $subject = "Thanks for contacting E-Commerce";
    $msg = "<p>Hello ". $first_name . ", </p>";
    $msg .= "<p>We have received your message and will reach out to you in 3-5 business days.<?p><br><hr>";
    $msg .= "<p>Name: ". $first_name . " " . $last_name. "</p>";
    $msg .= "<p>Email Address: <a href=\"mailto:\"". $email. ">". $email. "</a></p>";
    $msg .= "<p>Request: ". $need. "</p>";
    $msg .= "<p><b>Message: </b>". $message . "</p><hr>";
    $msg .= "<p>Regards,</p>";
    $msg .= "<img src=\"images/hp.png\"> <p>E-Commerce</p>";
    $headers = "From: E-Commerce <donotreply@localhost>\r\n";
	  $headers .= "Content-type: text/html\r\n";
    mail($email, $subject, $msg, $headers);
    header('Location: contact.php');
}

?>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
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
    require 'navbar.php'
    ?>
    <div class="position">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 py-4">
                    <h1>Contact Us</h1>
                    <form id="contact-form" method="post"
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Firstname *</label>
                                    <input id="form_name" type="text" name="First-Name" class="form-control"
                                        placeholder="Please enter your firstname *" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname">Lastname *</label>
                                    <input id="form_lastname" type="text" name="Last-Name" class="form-control"
                                        placeholder="Please enter your lastname *" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control"
                                        placeholder="Please enter your email *" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_need">Please specify your need *</label>
                                    <select id="form_need" name="need" class="form-control" required="required"
                                        data-error="Please specify your need.">
                                        <option value="Request replacement">
                                            Request replacement
                                        </option>
                                        <option value="Request order status">
                                            Request order status
                                        </option>
                                        <option value="Request copy of an invoice">
                                            Request copy of an invoice
                                        </option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Message *</label>
                                    <textarea id="form_message" name="message" class="form-control"
                                        placeholder="Type message here....*" rows="4" required="required"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-outline-success" value="Send message" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="contact-info">
            <div class="">
                <i class="fa fa-map-marker" aria-hidden="true"></i><b> Address</b>
                <div class="text">
                    <p>112 Oakwood Avenue<br />Kingston 5<br />Jamaica</p>
                </div>
            </div>
            <div class="">
                <i class="fa fa-phone" aria-hidden="true"></i><b> Phone</b>
                <div class="text">
                    <p>876-453-2222</p>
                </div>
            </div>
            <div class="">
                <i class="fa fa-envelope-o" aria-hidden="true"></i><b> Email</b>
                <div class="text">
                    <p>ecommerce@localhost</p>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
</body>

</html>