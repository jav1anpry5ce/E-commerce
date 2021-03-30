<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $imageFileType = isset($imageFileType) ?  $imageFileType  : '';

    // Check if file is an image or not
    if (isset($_POST["Add"])) {

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //validate file type
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {

            $uploadOk = 1;
        } else {
            echo "Sorry, only image files are allowed.";
            $uploadOk = 0;
        }
    }

    //validate file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Your upload file should not be more that 5 mb.";
        $uploadOk = 0;
    }

    // validate image file extemsion(ext)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only file formats of these types are allowed - JPG, JPEG and PNG.";
        $uploadOk = 0;
    }

    // validating whether all previous chaecks came back ok
    if ($uploadOk == 0) {
        echo "Sorry. There was an issue updating your product. Please try again later.";
        // if everything is ok, try to upload file
    } else {

        //preparing inset statment to insert into database
        $produtUpdate = "INSERT INTO products (product_name, product_description, product_price, product_image, category) VALUES(?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $produtUpdate)) {

            mysqli_stmt_bind_param($stmt, "ssdss", $product_name, $product_description, $product_price, $filePath, $category);
            $product_name = $_POST['product_name'];
            $product_description = $_POST['product_description'];
            $product_price = $_POST['product_price'];
            $category = $_POST['category'];
            $filePath = $target_file;

            if (mysqli_stmt_execute($stmt)) {

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "Your product has been uploaded.";
                }
            } else {
                echo "Sorry, there was an error uploading your product.";
            }
        }
    }
}