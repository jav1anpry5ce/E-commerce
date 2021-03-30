<?php
session_start();
if(isset($_COOKIE['loggedin'])){
    // Check if add to cart button was clicked and if true execute the below code
    if(isset($_POST['add-to-cart'])){
        // Check if there is a session variable called shopping cart if yes add a new item to it.
        if(isset($_SESSION['shopping-cart'])){
            $item_array_id = array_column($_SESSION['shopping-cart'], 'item-id');
            if(!in_array($_GET['id'], $item_array_id)){
                $count = count($_SESSION['shopping-cart']);
                $item_array = array(
                    'item-id' => $_GET['id'],
                    'item-name' => $_POST['hidden-name'],
                    'item-price' => $_POST['hidden-price'],
                    'item-quantity' => $_POST['hidden-quantity'],
                    'item-image' => $_POST['hidden-image']
                );
                $_SESSION['shopping-cart'][$count] = $item_array;
            }
        }
        else{
            // If no session variable for shopping cart exist create one and add the first item in.
            $item_array = array(
                'item-id' => $_GET['id'],
                'item-name' => $_POST['hidden-name'],
                'item-price' => $_POST['hidden-price'],
                'item-quantity' => $_POST['hidden-quantity'],
                'item-image' => $_POST['hidden-image']
            );
            $_SESSION['shopping-cart'][0] = $item_array;
        }
    }
    // check if the action is to delete an item from the cart and delete that spefic item.
    if(isset($_GET['action'])){
        if($_GET['action'] == 'delete'){
            foreach($_SESSION['shopping-cart'] as $key => $value){
                if($value['item-id'] == $_GET['id']){
                    unset($_SESSION['shopping-cart'][$key]);
                    header('Location: cart-view.php');
                }
            }
        }
    }
    if(isset($_POST['url'])){
        $url = $_POST['url'];
    // redirect to current page
        header('Location: '. $url);
    }
    
}
else{
    header('location: login.php');
}