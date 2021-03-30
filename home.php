<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width">
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
</head>

<body>
    <?php
    require_once 'navbar.php'
    ?>
    <div class="container">
        <h1>Top pick of the day</h1>
        <div class="flex d-flex flex-row">
            <?php
                include 'conn.php';
                // Get the first four items in the database.
                $sql = "SELECT * FROM products LIMIT 8";
                $result = $link->query($sql);

                if($result-> num_rows > 0) {
                    while($row = $result-> fetch_assoc()){
                        $id = $row["id"];
                        $name = $row["product_name"];
                        $price = $row["product_price"];
                        $image = $row["product_image"];
                        $description = $row["product_description"];
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        ?>
            <!-- display items in html. -->
            <div class="card">
                <img class="card-img-top image" src=<?php echo $image ?>>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $name ?></h5>
                    <p><b>$<?php echo $price ?></b></p>
                    <button class="btn btn-outline-dark btn-sm" data-toggle="modal"
                        data-target="#<?php echo $id ?>">View</button>
                </div>
            </div>
            <!-- Show a modal when view is clicked -->
            <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role=" document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $name ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="cart.php?action=add&id=<?php $id?>">
                                <div class="modal-view">
                                    <img class="modal-view-image" src=<?php echo $image ?>>
                                    <div class="modal-view-body">
                                        <h5 class="modal-view-title"><?php echo $name ?></h5>
                                        <p><b>$<?php echo $price ?></b></p>
                                        <p class="modal-view-text"><?php echo $description ?></p>
                                        <input type="hidden" name="hidden-name" value="<?php echo $name ?>" />
                                        <input type="hidden" name="hidden-price" value="<?php echo $price ?>" />
                                        <input type="hidden" name="hidden-image" value="<?php echo $image ?>" />
                                        <input type="hidden" name="url" value="<?php echo $url ?>" />
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
            ?>
        </div>
    </div>
    <?php
        require_once 'footer.html';
    ?>
</body>

</html>