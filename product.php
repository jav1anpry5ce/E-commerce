<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Products</title>
</head>

<body>
    <script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2000);
    </script>
    <?php
    require_once 'navbar.php';
    if(isset($_GET['cart'])){
        if($_GET['cart'] === 'updated'){
            ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        <strong>Sucess!</strong> Item added to cart.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    }
    }
    ?>
    <div class="container">
        <div class="d-flex flex-column">
            <?php
                include 'conn.php';
                // get the item that was searched for.
                if(isset($_GET['search'])){
                    $search_value = $_GET['search'];
                    $search_value = '%'. $search_value . '%';
                    // results per page
                    $results_per_page = 5;
                    // check both category and items with the name that was searched.
                    $sql = "SELECT * FROM products WHERE category like ? OR product_name like ?";
                    // replace '?' with the search the user entered.
                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "ss", $search_value, $search_value);
                        // execute the search query and gets the number of pages.
                        if(mysqli_stmt_execute($stmt)){
                            $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            mysqli_stmt_store_result($stmt);
                            $num_of_results = mysqli_stmt_num_rows($stmt);
                            $number_of_pages = ceil($num_of_results/$results_per_page);
                            // set the page to one
                            if(!isset($_GET['page'])){
                                $page = 1;
                            }else{
                                $page = $_GET['page'];
                            }
                            $this_page_first_result = ($page - 1) * $results_per_page;
                            // limit the result by the result per page
                            $sql = "SELECT * FROM products WHERE category like ? OR product_name like ? LIMIT ". $this_page_first_result. ','. $results_per_page;
                            if($stmt = mysqli_prepare($link, $sql)){
                                mysqli_stmt_bind_param($stmt, "ss", $search_value, $search_value);
                                if(mysqli_stmt_execute($stmt)){
                                    mysqli_stmt_store_result($stmt);

                                    if(mysqli_stmt_num_rows($stmt) > 0){
                                        mysqli_stmt_bind_result($stmt, $id, $product_name, $product_description, $product_price, $product_image, $category);
                                        // display the results in html.
                                        while(mysqli_stmt_fetch($stmt)){
                                            ?>
            <div class="listing">
                <a href="" data-toggle="modal" data-target="#<?php echo $id ?>"><img class="list-image"
                        src=<?php echo $product_image?>></a>
                <div class="list-body">
                    <a href="" data-toggle="modal" data-target="#<?php echo $id ?>">
                        <h5 class="list-title"><?php echo $product_name?></h5>
                    </a>

                    <p><b>$<?php echo $product_price?></b></p>

                </div>
            </div>
            <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role=" document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $product_name ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="cart.php?action=add&id=<?php echo $id?>">
                                <div class="modal-view">
                                    <img class="modal-view-image" src=<?php echo $product_image ?>>
                                    <div class="modal-view-body">
                                        <h5 class="modal-view-title"><?php echo $product_name ?></h5>
                                        <p><b>$<?php echo $product_price ?></b></p>
                                        <p class="modal-view-text"><?php echo $product_description ?></p>
                                        <input type="hidden" name="hidden-name" value="<?php echo $product_name?>" />
                                        <input type="hidden" name="hidden-price" value="<?php echo $product_price?>" />
                                        <input type="hidden" name="hidden-image" value="<?php echo $product_image?>" />
                                        <input type="hidden" name="url" value="<?php echo $url?>" />
                                        <input type="submit" name="add-to-cart" class="btn btn-outline-secondary btn-sm"
                                            value="Add to Cart" title="Add to Cart">
                                        <input type="number" name="hidden-quantity" value="1" min="1" max="10"
                                            class="co">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                                }
                            }
                            // if no results were found send the user to the home page.
                            else{
                                header('location: home.php?search=No results found');
                            }
                        }
                    }
                }
                ?>
            <!-- Create a paginiation to navigate through the pages -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="product.php?search=<?php
                            if($_GET['page'] > 1){
                            echo str_replace("%", "", $search_value)?>&page=<?php echo $_GET['page'] - 1;
                            }else{
                                echo str_replace("%", "", $search_value).'&page='.$_GET['page'];
                            }
                            ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php 
                        for($page=1; $page<=$number_of_pages; $page++){
                            ?>
                    <li class="page-item"><a class="page-link"
                            href="product.php?search=<?php echo str_replace("%", "", $search_value)?>&page=<?php echo $page?>"><?php echo $page?></a>
                    </li>
                    <?php
                        }
                        ?>
                    <li class="page-item">
                        <a class="page-link" href="product.php?search=<?php
                            if($_GET['page'] != $number_of_pages){
                            echo str_replace("%", "", $search_value)?>&page=<?php echo $_GET['page'] + 1;
                            }else{
                                echo str_replace("%", "", $search_value).'&page='.$number_of_pages;
                            }
                            ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php
            }
            }
            ?>
        </div>
    </div>
    <?php
        require_once 'footer.html';
    ?>
</body>

</html>