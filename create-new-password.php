<?php
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $url = "https://";
    }else{
        $url = "http://";
    }
    $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
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
</head>

<body>
    <script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2000);
    </script>
    <!-- Show different errors that may occur -->
    <?php
    if(isset($_GET['password'])){
        if($_GET['password'] === 'not-stronged'){
            ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="danger-alert">
        <strong>Error!</strong> Password wasn't strong try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
        } else if($_GET['password'] === 'empty'){
            ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="danger-alert">
        <strong>Error!</strong> Password was empty. Try again!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    } else if($_GET['password'] === 'error'){
        ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="danger-alert">
        <strong>Error!</strong> Password did not match. Try again!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
        }
    }
    // Get unique valdiator to ensure user is authenticated.
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
                        <input type="hidden" name="url" value="<?php echo $url ?>" />
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