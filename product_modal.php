<?php
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
require_once('./functions/session_functions.php');
include('./functions/zebra_session.php');
include('./functions/session_handles.php');
redirectIfAdmin();

// validation variables
$email_sesh = $var_id = $var_qty = $var_title = $var_desc = "";
$email = "";
$error_msg = "";
$product_ok = true;

if (!empty($_GET['id'])){ 
	// Get Validation
	$errorGet_msg = ""; 
	$productGet_ok = true;
	$var_id = numValidate($_GET['id'], $error_msg, $product_ok);
	// Get Validation
	if ($productGet_ok){
		$productID = $var_id; 
		$data = getIndividualProduct($productID);
		$reviews = getIndividualProductReviews($productID);
		$avgRating = getAvgRating($productID);
	} else{ // validation fail
		echo $errorGet_msg;
	}

}
else{
	header("Location:all_products.php");
}

//if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$result = -10;
	if(isset($_SESSION['email'])){
		//variables for adding to cart form
		$email_sesh = emailValidate($_SESSION['email'],$error_msg,$change_ok);
		$email= $email_sesh;
		$var_id = numValidate($_GET['id'], $error_msg, $product_ok);
		$productID = $var_id;

		if (isset($_POST['qty'])){
			$var_qty = numValidate($_POST['qty'], $error_msg, $product_ok);
			$selected_qty = $var_qty;
		}
		else{
			$selected_qty = '';
		}

		if (isset($_POST['size'])){
			$var_sz = alphaNumValidate($_POST['size'], $error_msg, $product_ok);
			$selected_size = $var_sz;
		}
		else
			$selected_size = '';


		if (!empty($selected_size) && !empty($selected_qty) && !empty($productID)){
			$result = addProductToCart($email, $productID, $selected_size, $selected_qty);
		} else {
		//$result = -1;
		}

		if(isset($_POST["rating1"]))
			$rating = 1;
		else if(isset($_POST["rating2"]))
			$rating = 2;
		else if(isset($_POST["rating3"]))
			$rating = 3;
		else if(isset($_POST["rating4"]))
			$rating = 4;
		else if(isset($_POST["rating5"]))
			$rating = 5;  
		else
			$rating = '';

		if (isset($_POST["title"])){
			$var_title = alphaNumSpecValidate($_POST["title"], $error_msg, $product_ok);
			$title = $var_title;
		}
		else
			$title = '';

		if (isset($_POST["description"])){
			$var_desc = alphaNumSpecValidate($_POST["description"], $error_msg, $product_ok);
			$desc = $var_desc;
		}
		else
			$desc = '';

	if(!empty($title) && !empty($desc) && !empty($rating)){//getUserID
		$user = getUserID($email);
		$result = addReview($user[0]["userID"], $productID, $title, $desc, $rating);
	}

	//default- do function to check if theres a row in review table w userid and product id 
	$reviewCount = 0;
}
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="Login" />
	<meta name="author" content="EYD0T" />
	<title>EYD0T</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<!-- Bootstrap icons-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- JavaScript Bundle with Popper -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="css/product.css" rel="stylesheet" /> 
	<link href="css/styles.css" rel="stylesheet" /> 


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="js/product.js"></script>
	<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/jquery-ui.min.js"></script>


</head>
<body>
	<?php  
	include "homepage/header-inc-2.php"; 
	if(!empty($result)){
		if ($result == 1){
			echo '<div class="alert alert-success">Product added to cart successfully</div>';
			$result = 0;
		}
		if ($result == 2){
			echo '<div class="alert alert-success">Thank you for your review!</div>';
			$result = 0;
		}
		if ($result == -10){
			echo '<div class="alert alert-warning">Please sign in to add products to cart!</div>';
			$result = 0;
		}
		if ($result == -9){
			echo '<div class="alert alert-warning">Sorry you have exceeded your review limit for this product</div>';
			$result = 0;
		}
		if ($result == -1 || $result == -2 || $result == -3 ){
			echo '<div class="alert alert-warning">Unsuccessful - Product not added to cart!</div>';
			$result = 0;
		}

	}
	?>      
	<div class="container productContainer">  
		<div class="row">
			<div class="col-md-5">  
				<img src="<?php echo $data[0]["productImage"]?>" alt="" class="img-thumbnail float-left productImg">
			</div>
			<div class="col-md-7">
				<!-- Product Name -->
				<div class="row">
					<div class="col-sm-6">  
						<?php echo "<h2>".$data[0]["productName"]."</h2>";  ?>  
					</div> 
					<div class="col-sm-6">  
						<div style="float: right;">
							<?php 
							for ($x = 0; $x < $avgRating; $x++) { 
								echo "<span class=\"fa fa-star checked\"></span>";
							}
							for ($x = 0; $x < 5-$avgRating; $x++) { 
								echo "<span class=\"fa fa-star unchecked\"></span>";
							}
							?>  
						</div> 
					</div>  
				</div> 
				<!-- Description -->
				<div class="row">
					<?php echo "<p>".$data[0]["productDescription"]."</p>";  ?>   
				</div> 
				<!-- Cost -->
				<div class="row">  
					<?php echo "<p class=\"price\">SGD".$data[0]["productCost"]."</p>";  ?>   
				</div> 
				<div class="row">  
					<label for="size">Select size:</label>
					<div class="sizeContainer"> 
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $productID;?>" method="POST" >  
							<?php  
							if($data[0]["size6"] != 0){ 
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size6" value="size6">
								<label class="form-check-label" for="inlineRadio6">6</label>
								</div>';
							}else{
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" name="size" id="size6" value="size6"" disabled>
								<label class="form-check-label" for="inlineRadio6">6</label>
								</div>'; 
							}

							if($data[0]["size7"] != 0){ 
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size7" value="size7">
								<label class="form-check-label" for="inlineRadio7">7</label>
								</div>';
							}else{
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size7" value="size7" disabled>
								<label class="form-check-label" for="inlineRadio7">7</label>
								</div>'; 
							}

							if($data[0]["size8"] != 0){ 
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size8" value="size8">
								<label class="form-check-label" for="inlineRadio8">8</label>
								</div>';
							}else{
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size8" value="size8" disabled>
								<label class="form-check-label" for="inlineRadio8">8</label>
								</div>'; 
							}

							if($data[0]["size9"] != 0){ 
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size9" value="size9">
								<label class="form-check-label" for="inlineRadio9">9</label>
								</div>';
							}else{
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size9" value="size9"" disabled>
								<label class="form-check-label" for="inlineRadio9">9</label>
								</div>'; 
							}

							if($data[0]["size10"] != 0){ 
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size10" value="size10">
								<label class="form-check-label" for="inlineRadio10">10</label>
								</div>';
							}else{
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size10" value="size10" disabled>
								<label class="form-check-label" for="inlineRadio10">10</label>
								</div>'; 
							}

							if($data[0]["size11"] != 0){ 
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size11" value="size11">
								<label class="form-check-label" for="inlineRadio11">11</label>
								</div>';
							}else{
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size11" value="size11" disabled>
								<label class="form-check-label" for="inlineRadio11">11</label>
								</div>'; 
							}

							if($data[0]["size12"] != 0){ 
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size12" value="size12">
								<label class="form-check-label" for="inlineRadio12">12</label>
								</div>';
							}else{
								echo '
								<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="size" id="size12" value="size12" disabled>
								<label class="form-check-label" for="inlineRadio12">12</label>
								</div>'; 
							} 
							?>  
							<!-- </form>   -->
						</div> 
					</div> 

					<!-- Quantity & Button -->
					<!-- <form action="product_modal.php" method="POST"> -->
						<div class="row row1">
							<div class="col-md-6">
								<div class="quantityContainer">
									<label for="quantity">Quantity</label>
									<div class="dec button decButton" id="decQty">-</div>
									<input type="text" name="qty" id="qty" value="0" class="input-filed">
									<div class="inc button incButton" id="incQty">+</div>   
								</div>
							</div>
							<div class="col-md-6"> 
								<button class="custom-btn cart-btn addcart" type="submit">Add to cart</button>  
							</div>
						</div>  
					</form>  
				</div> 
			</div> 
		</div> 
	</div>

	<div class="container productContainer">
		<div class="review-section">
			<h2 class="title">Our Customers Love Us</h2>
			<p class="note">Many people adore us. Squid game shooters are our biggest clientele. Let's have a look at what they have to say about our shoes.</p>

			<div class="reviews"> 
				<?php 
				if(sizeof($reviews) == 0){
					echo '
					<div class="review"> 
						<div class="body-review">
							<div class="name-review">Oh no!</div>
							<div class="desc-review">Yes, our consumers adore us, however this is a brand-new product with no reviews yet.
							</div> 
						</div>  
					</div>';
				}
				else{
					foreach ($reviews as $item){ 
						echo '
						<div class="review">
							<div class="head-review">
								<img id="img" src="images/profiles/'.rand(1,3).'.jpg" width="250px">
							</div>
							<div class="body-review">
								<div class="name-review">'.$item["reviewTitle"].'</div> 
							<div class="rating">';
							for ($x = 0; $x < $item["reviewRating"]; $x++) { 
								echo "<i class=\"fa fa-star checked\"></i>";
							}
							for ($x = 0; $x < 5-$item["reviewRating"]; $x++) { 
								echo "<i class=\"fa fa-star unchecked\"></i>";
							} 
						echo '.
							</div> 
								<div class="desc-review">'.$item["reviewDescription"].'</div>
							</div>   
						</div>';
					} 
				} 
				?>  
			</div> 

			<?php 
			if (isset($_SESSION['email'])){
				echo '
				<form class="login-form" action="
				'.$_SERVER["PHP_SELF"].'?id='.$productID.'" method="POST">
				<h2 class="title">We value your feedback.</h2>
				<p class="note">let know know what you think</p>  
				<div class="form-group row">   
				<div class="star-rating"> 
				<div class="star-input">
				<input type="radio" name="rating5" id="rating-5" style="float:left;">
				<label for="rating-5" class="fa fa-star"></label>
				<input type="radio" name="rating4" id="rating-4">
				<label for="rating-4" class="fa fa-star"></label>
				<input type="radio" name="rating3" id="rating-3">
				<label for="rating-3" class="fa fa-star"></label>
				<input type="radio" name="rating2" id="rating-2">
				<label for="rating-2" class="fa fa-star"></label>
				<input type="radio" name="rating1" id="rating-1">
				<label for="rating-1" class="fa fa-star"></label>
				</div>
				</div>
				</div> 
				<div class="form-group row"> 
				<label for="title" class="col-sm-2 col-form-label">Title</label> 
				<div class="col-sm-10">
				<input type="text" class="form-control" id="title" placeholder="Title" name = "title">
				</div>
				</div>  
				<div class="form-group row"> 
				<label for="description" class="col-sm-2 col-form-label">Description</label> 
				<div class="col-sm-10">
				<textarea class="form-control" id="description" rows="3" name="description"></textarea> 
				</div>
				</div> 
				<div class="form-group row align-items-right">  
				<div class="col-sm-2"></div> 
				<div class="col-sm-10">
				<button class="custom-btn cart-btn" type="submit">Submit</button>  
				</div> 
				</div>       
				</form>';
			}
			?>  
		</div>  
	</div>    
</div> 

<script> 
	var incButton = document.getElementById("incQty");
	var decButton = document.getElementById("decQty"); 

	incButton.addEventListener('click', function(event){
		var buttonClicked = event.target; 
		var inputValue = buttonClicked.parentElement.children[2].value; 
		var newValue = parseInt(inputValue) + 1; 
		buttonClicked.parentElement.children[2].value = newValue;
	})

	decButton.addEventListener('click', function(event){
		var buttonClicked = event.target; 
		var inputValue = buttonClicked.parentElement.children[2].value; 
		if(inputValue > 0){ 
			var newValue = parseInt(inputValue) - 1;
		}
		else{ 
			var newValue = parseInt(inputValue);
		}

		buttonClicked.parentElement.children[2].value = newValue;
	})
</script>  



<?php include "homepage/footer-inc.php";?>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script> 


</body>  
</html>  