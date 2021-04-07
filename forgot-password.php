<!DOCTYPE html>
<html>
<!-- Submiting Password reset request -->

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="HandheldFriendly" content="true" />
    <title>Forgot password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="images/e-commerce.png" />
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
    <script src="js/main.js"></script>
</head>

<body>
    <!-- Display different message in an alert -->
    <?php
        if(isset($_GET['reset'])){
            if($_GET['reset'] === 'fail'){
        ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="danger-alert">
        <strong>Error!</strong> There was error. Try again later!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
      } else if($_GET['reset'] === 'success'){
          ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        <strong>Success!</strong> An Email was sent with a link to reset your password.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
      }
    }
    ?>
    <!-- Display a form to send a link to reset a user password -->
    <div class="container">
        <div class="row justify-content-center centering">
            <div class="forgot">
                <h1>Forgot your password?</h1>
                <p>
                    Change your password in three easy steps. This will help you to
                    secure your password!
                </p>
                <ol>
                    <li>Enter your email address below.</li>
                    <li>Our system will send you a temporary link</li>
                    <li>Use the link to reset your password</li>
                </ol>
            </div>
            <form class="card w-75 pad" action="resetrequest.php" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="email-for-pass">Enter your email address</label>
                        <input class="form-control" type="email" id="email-for-pass" required name="email" />
                        <small class="form-text text-muted">Enter the email address you used during the registration on
                            E-Commerece. Then we'll email a link to reset your
                            password.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit" name="reset-request-submit">
                        Reset Password
                    </button>
                    <a class="btn btn-danger" href="login.php">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>