<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_COOKIE["loggedin"])){
    header("location: home.php");
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
        $sql = "SELECT id, username, firstname, password FROM users WHERE username = ? OR email = ?";


        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $firstname, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in cookie variables
                            setcookie("loggedin", true, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie("id", $id, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie("username", $username, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie("firstname", $firstname, time() + (10 * 365 * 24 * 60 * 60));

                            // Redirect user to home page
                            header("location: home.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username/email.";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="images/e-commerce.png" />
</head>
<!-- Display Html -->

<body>
    <div class="container">
        <div class="row justify-content-center centering">
            <form class="card w-50" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <h1>Login</h1>
                        <input class="form-control" type="text" name="username" id="inputEmail" class="form-control"
                            placeholder="Username/Email" required autofocus value="<?php echo $username; ?>">
                        <span class="help-block" style="color: red;"><?php echo $username_err; ?></span>
                    </div>
                    <input name="password" type="password" id="inputPassword" class="form-control"
                        placeholder="Password" required>
                    <span class="help-block" style="color: red;"><?php echo $password_err; ?></span>
                </div>
                <input class="btn btn-outline-dark btn-lg" type="submit" value="Sign In"></input><br>
                <div class="card-footer">
                    <a href="register.php">Not a member? Sign up here</a><br>
                    <a href="forgot-password.php" class="forgot-password">
                        Forgot your password?
                    </a>
                </div>
        </div>
        </form>
    </div>
</body>

</html>