<?php
session_start();
?>

<!-- Create a Navbar to be used across the entire website -->
<nav class="nav-bar">
    <ul>
        <form method="GET" action="product.php">
            <a class="logo" title="Home" href="home.php"><img class="logo-img" src="images/e-commerce.png" /></a>
            <input name="search" class="search" type="text" placeholder="search..." />
            <button type="submit" class="btn btn-search" title="Search"><i class="fa fa-search fa-lg"
                    aria-hidden="true"></i></button>
            <li>
                <?php
                    if(isset($_COOKIE['loggedin'])){
                        ?>
                <a href="cart-view.php"><img src="images/ecc.png" class="cart" title="Cart" /></a>
                <?php
                    }
                ?>

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