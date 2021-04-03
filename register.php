<?php

session_start();

// Include config file
require_once "conn.php";

// Define variables and initialize with empty values
$username =  $firstname = $lastname = $email = $password = $confirm_password = "";
$username_err = $firstname_err = $lastname_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter a username.";
	} else{
        // Prepare a select statement
		$sql = "SELECT id FROM users WHERE username = ?";

		if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
			$param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				/* store result */
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt) == 1){
					$username_err = "This username is already taken.";
				} else{
					$username = trim($_POST["username"]);
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

            // Close statement
			mysqli_stmt_close($stmt);
		}
	}

	$input_firstname = trim($_POST["firstname"]);
	if(empty($input_firstname)) {
		$firstname_err = "Please enter your first name";
	} elseif(!filter_var($input_firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		$firstname_err = "Please enter a valid first name.";
	} else {
		$firstname = $input_firstname;
	}

	$input_lastname = trim($_POST["lastname"]);
	if(empty($input_lastname)) {
		$lastname_err = "Please enter your last name";
	} elseif(!filter_var($input_lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		$lastname_err = "Please enter a valid last name.";
	} else {
		$lastname = $input_lastname;
	}

	if(empty(trim($_POST["email"]))){
		$email_err = "Please enter an email.";
	} else{
        // Prepare a select statement
		$sql = "SELECT id FROM users WHERE email = ?";

		if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
			$param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				/* store result */
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt) == 1){
					$email_err = "Please check your email. This email is already taken.";
				} else{
					$email = trim($_POST["email"]);
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

            // Close statement
			mysqli_stmt_close($stmt);
		}
	}


    // Validate password
	$input_password = trim($_POST['password']);

	$uppercase = preg_match('@[A-Z]@', $input_password);
	$lowercase = preg_match('@[a-z]@', $input_password);
	$number = preg_match('@[0-9]@', $input_password);
	$specialChars = preg_match('@[^\w]@', $input_password);

	if(empty($input_password)){
		$password_err = "Please enter a password.";     
	} elseif(strlen(trim($_POST["password"])) < 8 || !$uppercase || !$lowercase || !$number || !$specialChars){
		$password_err = "Password must have atleast 8 characters, a number, a lowercase letter, a uppercase letter and a special character.";
	} else{
		$password = $input_password;
	}

    // Validate confirm password
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = "Please confirm password.";     
	} else{
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($password_err) && ($password != $confirm_password)){
			$confirm_password_err = "Password did not match.";
		}
	}



    // Check input errors before inserting in database
	if(empty($username_err) && empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
		$sql = "INSERT INTO users (username, firstname, lastname, email, password, created_at) VALUES (?, ?, ?, ?, ?, ?)";

		if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_firstname, $param_lastname, $param_email, $param_password, $created_at);

            // Set parameters
			$param_username = $username;
			$param_firstname = $firstname;
			$param_lastname = $lastname;
			$param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$created_at = date('Y-m-d H:i:s');
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				// Sends email to the new user.
				$to = $email;
				$subject = "Welcome to E-Commerce";
				$message = "<p>Hello ". $firstname . ",</p>";
				$message .= "<p>We are delighted to have you join E-Commerce. You'll find great deals here.</p>";
				$message .= "<p>Regards, </p>";
				$message .= "<p>E-Commerce</p>";
				$headers = "From: E-Commerce <donotreply@localhost>\r\n";
				$headers .= "Content-type: text/html\r\n";
				mail($to, $subject, $message, $headers);
                // Redirect to login page
            	header("location: login.php");
            } else{
            	echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!-- Display registration HTML -->
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="images/e-commerce.png" />
</head>

<body>
    <div class="container">
        <div class="row justify-content-center reg-centering">
            <form class="card w-50" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="card-body">
                    <h1>Registeration</h1>
                    <div class="form-group">
                        <input class="form-control" type="text" name="firstname" placeholder="First Name"
                            value="<?php echo $firstname; ?>" />
                        <span class="danger"><?php echo $firstname_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="lastname" placeholder="Last Name"
                            value="<?php echo $lastname; ?>" />
                        <span class="danger"><?php echo $lastname_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email"
                            value="<?php echo $email; ?>" />
                        <span class="danger"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="username" placeholder="Username"
                            value="<?php echo $username; ?>" />
                        <span class="danger"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password"
                            value="<?php echo $password; ?>" />
                        <span class="danger"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="confirm_password"
                            placeholder="Confirm Password" value="<?php echo $confirm_password; ?>" />
                        <span class="danger"><?php echo $confirm_password_err; ?></span>
                    </div>
                </div>
                <input type="submit" class="btn btn-outline-dark btn-lg" value="Sign Up" /><br>
                <div class="card-footer">
                    <a href='login.php'>Already have an account? Login here</a>
                </div>
        </div>
        </form>
    </div>
    </div>
</body>

</html>