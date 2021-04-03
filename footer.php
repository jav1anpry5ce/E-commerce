<?php
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
    $url = "https://";
  }else{
    $url = "http://";
  }
  $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
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
    <!-- Create basic footer -->
    <footer class="bg-white">
        <div class="container py-5">
            <div class="row py-4">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <p class="font-italic text-muted">Follow our socials.</p>
                    <ul class="list-inline mt-4">
                        <li class="list-inline-item">
                            <a href="#" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank" title="pinterest"><i class="fa fa-pinterest"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank" title="vimeo"><i class="fa fa-vimeo"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-4">Shop</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-muted">For Women</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-muted">For Men</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-4">E-Commerce</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <a href="login.php" class="text-muted">Login</a>
                        </li>
                        <li class="mb-2">
                            <a href="register.php" class="text-muted">Register</a>
                        </li>
                        <li class="mb-2">
                            <a href="contact.php" class="text-muted">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-4">Newsletter</h6>
                    <p class="text-muted mb-4">
                        Sign up for our news letter and receive our latest deals.
                    </p>
                    <form action="subscribe.php" method="post">
                        <div class="p-1 rounded border">
                            <div class="input-group">
                                <input type="email" name="email" placeholder="Enter your email address"
                                    aria-describedby="Subscribe" class="form-control border-0 shadow-0" />
                                <input type="hidden" name="url" value="<?php echo $url?>" />
                                <div class="input-group-append">
                                    <button id="Subscribe" name="subscribe" type="submit" class="btn btn-link">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        </from>
                </div>
            </div>
        </div>
        <div class="bg-light py-4">
            <div class="container text-center">
                <p class="text-muted mb-0 py-2">
                    &copy; 2021 E-commerce All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>