<!DOCTYPE html>
<html>
<!-- Submiting Password reset request -->

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Forgot password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center centering">
            <div class="forgot">
                <h1>Forgot your password?</h1>
                <p>Change your password in three easy steps. This will help you to secure your password!</p>
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
                        <input class="form-control" type="email" id="email-for-pass" required name="email">
                        <small class="form-text text-muted">Enter the email address you used during the registration
                            on E-Commerece. Then we'll email a link to reset your password.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit" name="reset-request-submit">Get New
                        Password</button>
                    <a class="btn btn-danger" href="login.php">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>