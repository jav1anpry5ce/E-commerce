<?php
include 'conn.php';


$sql = "SELECT * FROM products";
$result = $link->query($sql);
$id = $name = $price = "";

if($result-> num_rows > 0) {
    while($row = $result-> fetch_assoc()){
        $id = $row["id"];
        $name = $row["product_name"];
        $price = $row["product_price"];
    }
}

echo $id;