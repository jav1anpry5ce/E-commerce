<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <!-- Create a Navbar to be used across the entire website -->
    <nav class="nav-bar">
        <ul>
            <form method="GET" action="product.php">
                <a class="logo" title="Home" href="home.php"><img class="logo-img" src="images/logo.png" /></a>
                <input name="search" class="search" type="text" placeholder="search..." />
                <button type="submit" class="btn btn-search" title="Search"><i class="fa fa-search fa-lg"
                        aria-hidden="true"></i></button>
                <li>
                    <a href="cart-view.php"><img src="images/ecc.png" class="cart" title="Cart" /></a>
                </li>
                <!-- If a user is logged display a logout button -->
                <li>
                    <?php if(isset($_COOKIE['loggedin'])){
                    ?>
                    <a class="logout" href="logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"
                            title="Logout"></i></a>
                    <?php
                    }
                    ?>
                </li>
                <!-- get the username of who is logged in -->
                <li>
                    <a href="#" class="account" title="Account">
                        <?php
                      if(isset($_COOKIE['username'])){echo 'Account'.'<br>'. 'Hello, '. $_COOKIE['firstname'];};?>
                    </a>
                </li>
            </form>
        </ul>
    </nav>
</body>

</html>