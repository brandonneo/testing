<?php
require_once('./functions/session_handles.php');
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
redirectIfNotAdmin();

// validation variables
$imagepath = $name = $brand = $gender = $desc = $price = $stock = "";
$sz5 = $sz6 = $sz7 = $sz8 = $sz9 = $sz10 = $sz11 = $sz12 = "";
$error_msg = "";
$add_ok = true;
// validation variables

    if (true){ // if login attempt
        $result=0;
        // @@@@@@@  Start Main Validation Code
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST["name"]) || !empty($_POST["price"]) || !empty($_POST["brand"]) || !empty($_POST["gender"])){ 
        
                // file validation
                
                $imagepath = "/images/products/". $_FILES["fileToUpload"]['name']; // validates and uploads the file to outside webroot, returns filepath
//                $imagepath = "/images/products/" . ($_FILES["fileToUpload"]["name"]);
                $full_path = "/var/www/html/Team11-AY21/images/products/" . ($_FILES["fileToUpload"]["name"]);

                if (isset($_FILES["fileToUpload"])) {
                    $allowedtypes = array("jpeg","jpg","png");
                    $filesize = $_FILES["fileToUpload"]['size'];
                    $file_ext = strtolower(end(explode('.',$_FILES["fileToUpload"]['name'])));
                    
                   // check if image alr exist in folder
                    if (file_exists($full_path)){
                        $errormsg .= "File already exists";
                        $add_ok = false;
                    }
                    // check if file type allowed
                    if (in_array($file_ext,$allowedtypes)=== false){
                        $error_msg .= "File type not allowed. please choose JPEG or PNG file only.";
                        $add_ok = false;
                     }
                     // check if file is bigger than 3MB
                    if ($filesize > 3145728) { // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
                        $error_msg .= "The file is too large";
                        $add_ok = false;
                     }
                     // check if file empty
                    if ($filesize == 0) {
                        $error_msg .= "The file is empty.";
                        $add_ok = false;
                     }
                 }
                 
                // name validation
                $name = usernameValidate($_POST["name"],$error_msg,$add_ok);
                // echo $contact_ok ? 'true1' : 'false1';
        
                // subject validation
                $brand = alphaValidate($_POST["brand"], $error_msg, $add_ok);
//        
//             // content validation
                $desc = alphaNumSpecValidate($_POST["description"], $error_msg, $add_ok);
//
//             // price validation
                $price = moneyValidate($_POST["price"], $error_msg, $add_ok);
//
//                // size validation
                $sz6 = numValidate($_POST["size6"], $error_msg, $add_ok);
                $sz7 = numValidate($_POST["size7"], $error_msg, $add_ok);
                $sz8 = numValidate($_POST["size8"], $error_msg, $add_ok);
                $sz9 = numValidate($_POST["size9"], $error_msg, $add_ok);
                $sz10 = numValidate($_POST["size10"], $error_msg, $add_ok);
                $sz11 = numValidate($_POST["size11"], $error_msg, $add_ok);
                $sz12 = numValidate($_POST["size12"], $error_msg, $add_ok);
                
                    if($add_ok){ // check if input validation is passed
                        // echo "validation pass";
                        
//                      $result= addProduct($_POST['name'], $_POST['brand'], $_POST['description'], $_POST['price'], $imagepath, $_POST['instock'],$_POST['size6'],$_POST['size7'],$_POST['size8'],$_POST['size9'],$_POST['size10'],$_POST['size11'],$_POST['size12'], $_POST['gender']);
//                      $result= addProduct($name, $brand, $desc, $price, $imagepath, $stock, $sz6, $sz7, $sz8, $sz9, $sz10, $sz11, $sz12, $_POST['gender']);
                        $result= addProduct($_SESSION['email'], $name, $brand, $desc, $price, $imagepath, $_POST['instock'], $sz6, $sz7, $sz8, $sz9, $sz10, $sz11, $sz12, $_POST['gender']);

                        echo json_encode($result);
                        
                        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $full_path) ;
                    } else {
                        $result = 0;
                        // echo "validation fail";
                    }
            }// end if
        }// end if start validation
    }// end if true
        ?>
        <!DOCTYPE html> 
        <html lang="en">
        <head>
        	<meta charset="utf-8" />
        	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        	<meta name="description" content="" />
        	<meta name="author" content="" />
        	<title>EYD0T</title>
        	<!-- Favicon-->
        	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        	<!-- Bootstrap icons-->
        	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        	<!-- Core theme CSS (includes Bootstrap)-->
        	<link href="css/styles.css" rel="stylesheet" /> 

        	<body>
        		<?php  include "homepage/merchant-header-inc.php"; ?>
                <?php
                if ($result == 1) {
                    echo '<section class="py-5" style="background-color: #8caf9f"><div class="jumbotron-fluid pt-5 pb-5">
                    <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Successful Product Creation</h2>
                    <div class="row"> 
                    <hr class="my-2 col-10">
                    </div>
                    </div></section';
                } else if ($result == -1) {
                    echo '<section class="py-5" style="background-color: #ab8a90"><div class="jumbotron-fluid pt-5 pb-5" >
                    <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Unsuccessful Product Creation</h2>
                    <div class="row"> 
                    <hr class="my-2 col-10">
                    </div>

                    <p class="lead text-center">Product already exists</b></p>
                    </div></section>';
                } else {
                    echo '<section class="py-5" style="background-color: #ab8a90"><div class="jumbotron-fluid pt-5 pb-5" >
                    <h2 class="display-3 text-center"><i class="far fa-check-circle"></i>Unsuccessful Product Creation</h2>
                    <div class="row"> 
                    <hr class="my-2 col-10">
                    </div>

                    <p class="lead text-center">Product Invalid</b></p>
                    </div></section>';
                }
                ?>

        		<?php include "homepage/footer-inc.php"; ?>

        		<!-- Bootstrap core JS-->
        		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        		<!-- Core theme JS-->
        		<script src="js/scripts.js"></script>

        	</body>
        	</html>
