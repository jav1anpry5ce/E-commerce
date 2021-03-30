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
    <title>Cart</title>
</head>

<body>
    <?php
        require_once 'navbar.php';
        // Check if a user is logged if not redirect them to the login page.
        if(isset($_COOKIE['loggedin'])){
            if(!empty($_SESSION['shopping-cart'])){
                $total = 0;
                // Display all item in the user cart.
                foreach($_SESSION['shopping-cart'] as $key => $value){
                    ?>
    <div class="container-cart">
        <div class="container justify-content-center">
            <div class="cartt">
                <img class="cartt-image" src="<?php echo $value['item-image'];?>">
                <div class="cartt-body">
                    <h5 class="cartt-title"><?php echo $value['item-name'];?></h5>
                    <p><b>$<?php echo $value['item-price'];?></b></p>
                    <input id="item-quantity" type="number" class="co" value="<?php echo $value['item-quantity'];?>" />
                    <a href="cart.php?action=delete&id=<?php echo $value['item-id'];?>">Remove</a>
                </div>
            </div>
        </div>
        <?php
    // calculate the user invoice.
    $total = $total + ($value['item-quantity'] * $value['item-price']);
    $shipping = ($total * 0.07);
    $tax = ($total * 0.16);
    $savings = ($total * 0.09);
    $final_price = ($total + $shipping + $tax) - $savings;
                }
            }
        }
        else{
            header('Location: login.php');
        }
    ?>
        <?php
    if(!empty($_SESSION['shopping-cart'])){
        ?>
        <!-- Display the user invoice -->
        <div class="total">
            <div class="card w-100">
                <div class="card-body">
                    <h3 class="card-title">Invoice</h3>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="col">Cart Total</th>
                                <td><?php echo '$'. number_format($total, 2);?></td>
                            </tr>
                            <tr>
                                <th scope="col">Tax</th>
                                <td><?php echo '$'. number_format($tax, 2);?></td>
                            </tr>
                            <tr>
                                <th scope="col">Shipping</th>
                                <td><?php echo '$'. number_format($shipping, 2);?></td>
                            </tr>
                            <tr>
                                <th scope="col">Savings</th>
                                <td><?php echo '$'. number_format($savings, 2);?></td>
                            </tr>
                            <tr>
                                <th scope="col">Total</th>
                                <td><?php echo '$'. number_format($final_price, 2);?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <?php require_once 'footer.html';?>
</body>

</html>