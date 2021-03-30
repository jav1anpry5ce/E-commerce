<?php
include 'conn.php';
$target_dir = "images/";
session_start();
require_once 'admin-timeout.php';
if(isset($_SESSION['admin']) && $_SESSION['admin'] === true){

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

?>

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
    <title>Add Product</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center reg-centering">
            <form class="card w-50" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                enctype="multipart/form-data">
                <div class="card-body">
                    <h1>Add a Product</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" name="product_name" id="product_name"
                            placeholder="Product Name" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="product_description"
                            placeholder="Product Description">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="product_price" placeholder="Product Price">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="category" placeholder="Product Category">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="fileToUpload" requited />
                    </div>
                </div>
                <input type="submit" class="button" value="Add product" name="Add">
            </form>
        </div>
    </div>

</body>
<?php
}
else{
    header('Location: admin-login.php');
}
?>

</html>