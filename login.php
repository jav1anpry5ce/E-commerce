<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "conn.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";


        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["firstname"] = $firstname;

                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.scss">
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    </script>
</head>
<body>
    <?php
    if(isset($_GET["password"])) {
        if ($_GET["password"] == "updated") {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucess!</strong> Your password was reset successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
    }

    ?>
    <div class="container">
        <div class="card card-container">
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <h1>Login</h1>
                <div class="form-control">
                    <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus value="<?php echo $username; ?>">
                    <span class="help-block" style="color: red;"><?php echo $username_err; ?></span>
                </div>
                <div class="form-control">
                    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <span class="help-block" style="color: red;"><?php echo $password_err; ?></span>
                </div>
                <input class="button" type="submit" value="Sign In"></input><br>
            </form>
            <a href="register.php">Not a member? Sign up here</a><br>
                <a href="forgot_password.php" class="forgot-password">
                    Forgot your password?
                </a>
            </div><!-- /card-container -->
        </div><!-- /container -->
</body>
</html>
