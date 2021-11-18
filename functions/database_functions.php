<?php 
require_once('session_functions.php');
require_once('hashing_functions.php');
require_once('./vendor/catfan/medoo/db.php');
date_default_timezone_set('Asia/Singapore');

function insertLoginTime($user_email) {
	DB::update('User', ['loginTime' => date('Y-m-d H:i:s')], ['userEmail' => $user_email]);
	return;	
}

function insertLoginTimeInLog($user_email) {
	DB::insert('log', ['userEmail' => $user_email, 'loginTime' => date('Y-m-d H:i:s')]);
	return;	
}

function insertLogoutTimeInLog($user_email) {

	DB::insert('log', ['userEmail' => $user_email, 'logoutTime' => date('Y-m-d H:i:s')]);
	return;
}

function insertSignUpDetails($user_name, $user_email, $user_password) {
	DB::insert('User', ['userName' => $user_name,'userEmail' => $user_email, 'Password' => $user_password, 'userType' => 0, 'isVerified' => 1,  'points' => 0]);
	return;
}


function resetAttemptCount($user_email) {
	DB::update("User", ["attempt" => 0], ["userEmail" => $user_email]);
	return;
}

function increaseAttemptCountByOne($user_email) {
	DB::update("User", ["attempt[+]" => 1, "loginTime" => date('Y-m-d H:i:s')], ["userEmail" => $user_email]);
	return;
}

function lockUserAccountIfNecessary($user_email) {
	DB::update("User", ["isLocked" => 1], ["userEmail" => $user_email, "attempt[>=]" => 3]);
		// $details = DB::select("User", ["isLocked", "loginTime"], ["userEmail" => $user_email]);
	return;
}

function increaseLoginCounter($user_email) {
	DB::update("User", ["loginTime[+]" => 1], ["userEmail" => $user_email]);
	return;
}

function checkIfEmailAlreadyExistsInDatabase($user_email) {
	$listItems = DB::select("User", ["userEmail"], ["userEmail" => $user_email]);

	if (sizeof($listItems) == 0) {
		return false;
	} else if (sizeof($listItems) > 0) {
		return true;
	}
}

function checkIfEmailIsLocked($user_email) {
	$details = DB::select("User", ["isLocked", "loginTime"], ["userEmail" => $user_email]);
	if ($details[0]["isLocked"] > 0) {
		$diff_time=(strtotime(date("Y-m-d H:i:s"))-strtotime($details[0]["loginTime"]))/60;
		if ($diff_time >= 15){
			DB::update("User", ["isLocked" => 0], ["userEmail" => $user_email]);
			return 0;
		}
		return 1;
	} else {
		return 0;
	}
}
 
function logAdminAddProduct($userEmail){
	$userID = getUserID($userEmail)[0]["userID"];
	DB::insert("AdminLog", ["userID" => $userID, "LogDetails" => "Product added.", "logTime" => date('Y-m-d H:i:s')]); 
	return 0; 
}

function logAdminViewProduct($userEmail){
	$userID = getUserID($userEmail)[0]["userID"];
	DB::insert("AdminLog", ["userID" => $userID, "LogDetails" => "Product viewed.", "logTime" => date('Y-m-d H:i:s')]); 
	return 0; 
}

function  logAdminUpdateProduct($userEmail){
	$userID = getUserID($userEmail)[0]["userID"];
	DB::insert("AdminLog", ["userID" => $userID, "LogDetails" => "Product updated.", "logTime" => date('Y-m-d H:i:s')]); 
	return 0; 
}

function logAdminDeleteProduct($userEmail){
	$userID = getUserID($userEmail)[0]["userID"];
	DB::insert("AdminLog", ["userID" => $userID, "LogDetails" => "Product deleted.", "logTime" => date('Y-m-d H:i:s')]); 
	return 0; 
}

function logAdminViewUser($userEmail){
	$userID = getUserID($userEmail)[0]["userID"];
	DB::insert("AdminLog", ["userID" => $userID, "LogDetails" => "User viewed.", "logTime" => date('Y-m-d H:i:s')]); 
	return 0; 
}

function logAdminDeleteUser($userEmail){
	$userID = getUserID($userEmail)[0]["userID"];
	DB::insert("AdminLog", ["userID" => $userID, "LogDetails" => "User deleted.", "logTime" => date('Y-m-d H:i:s')]); 
	return 0; 
}


function getIndividualProduct($productID){
	$product = DB::select("Product", ["productName", "productDescription", "productCost", "size6", "size7", "size8", "size9", "size10", "size11", "size12", "productImage"], ["productID" => $productID]);
	return ($product); 
}

function getIndividualProductReviews($productID){
	$reviews = DB::select("Review", ["reviewTitle", "reviewDescription", "reviewRating"], ["productID" => $productID]);
	return ($reviews);
}

function addReview($userID, $productID, $reviewTitle, $reviewDescription, $reviewRating){ 
	//2 means review added successfully
	//-9 means review not added
	$data = DB::select("Review", ["reviewID"], ["userID" => $userID]);
	 if (sizeof($data) == 0){
		DB::insert("Review", ["userID" => $userID, "productID" => $productID, "reviewTitle" => $reviewTitle, "reviewDescription" => $reviewDescription, "reviewRating" => $reviewRating]);
		return 2;
	} else{
		return -9; 
	}
}

function checkReviewExists($userID, $productID){
	$data = DB::select("Review", ["reviewID"], ["userID" => $userID]);
	if(sizeof($data) == 1)
		return 1;
	else
		return 0; 
}

function getReviews($productID){
	$reviews = DB::select("Review", ["userID", "reviewTitle", "reviewDescription, reviewRating"], ["productID" => $productID]); 
 
	foreach($reviews as $review){
		$user = DB::select("User", ["userName"], ["userID" => $review[0]["userID"]]);
		$review[0]["userID"] = $user; 
	}
 
	return $reviews;
}

function getAvgRating($productID){
	$reviews = DB::select("Review", ["reviewRating"], ["productID" => $productID]); 

	$total = 0;
	$count = 0; 
	foreach($reviews as $review){ 
		$total += $review["reviewRating"];
		$count += 1; 
	} 

	if($total == 0 || $count == 0)
		return 0;
	else
		return round($total / $count);
}



function getHashedPasswordFromDatabase($user_email) {
	$details = DB::select("User", ["Password"], ["userEmail" => $user_email]);

	if (sizeof($details) > 0) {
		return $details[0]['Password'];			
	} else {
		return "null";
	}
}

function getIsAdmin($user_email) {
	$details = DB::select("User", ["userType"], ["userEmail" => $user_email]);
	return ( $details[0]["userType"] == 1 ? 1 : 0);
}

function getIsAdminById($id) {
	$details = DB::select("User", ["userType"], ["userID" => $id]);
	return ( $details[0]["userType"] == 1 ? 1 : 0);
}

function checkIfEmailIsVerified($user_email) {
	$details = DB::select("User", ["isVerified"], ["userEmail" => $user_email]);
	return ( $details[0]["isVerified"] == 1 ? 1 : 0);
}

function signupWithEmailAndPassword($user_name, $user_email, $user_password) {
	//1 Successfully added to database
	//0 Email already exists
	//-1 Invalid Email
	//-2 Invalid password
	// -3 Error

	if (empty($user_email) || $user_email == "") {
		return -1; 
	}
	if (empty($user_password) || $user_password == "") {
		return -2; 
	}

	if (checkIfEmailAlreadyExistsInDatabase($user_email)) { 
		return 0; 
	} else {
		insertSignUpDetails($user_name, $user_email, hashCredential($user_password));
		return 1;			
	}

	return -3;
}

function loginWithEmailAndPassword($user_email, $user_password) {
	// 1 means Success Email and password match
	// 0 Email doesnt exist
	// -1 Invalid Email input
	// -2 Invalid Password input
	// -3 Password incorrect
	// -4 Account is locked
 
	if (empty($user_email) || $user_email == "") {
		return -1;
	} elseif (empty($user_password) || $user_password == "") {
		return -2;
	}

	if (checkIfEmailAlreadyExistsInDatabase($user_email)) {
		if (checkIfEmailIsLocked($user_email) == 1) { 
			return -4;
		}

		$db_hash = getHashedPasswordFromDatabase($user_email);
		
		if (validifyAgainstHashedCredential(hashCredential($user_password), $db_hash)) {
			resetAttemptCount($user_email);
			increaseLoginCounter($user_email);
			insertLoginTime($user_email);
				//insertLoginTimeInLog($user_email);
			insertDetailsIntoSession($user_email, getIsAdmin($user_email));
			return 1;
		} 
		else {
			insertLoginTime($user_email);
			increaseAttemptCountByOne($user_email);
			lockUserAccountIfNecessary($user_email);
			return -3;
		}

	} else {
		return 0;
	}
}
function getBrandId($brandName){
	$data = DB::select("Brand", ["brandID"], ["brandName" => $brandName]);
	return $data;
}

function getBrandIdFromProduct($productID){
	$data = DB::select("Product", ["brandID"], ["productID" => $productID]);
	return $data;
}


function getBrandName($brandId){
	$data = DB::select("Brand", ["brandName"], ["brandID" => $brandId]);
	return $data;
}

function addProduct($userID, $name, $brand, $description, $cost, $image, $inStock,$size6,$size7,$size8,$size9,$size10,$size11,$size12, $gender) {
	// 1 means Success product creation
	// -1 means Product already exist

	$data = DB::select("Product", ["productName"], ["productName" => $name]);
	if (sizeof($data) == 0) {
		$data = getBrandId($brand);
		DB::insert("Product", ["brandID" => $data[0]["brandID"], "productName" => $name, "productDescription" => $description, "productCost" => $cost, "productImage" => $image, "inStock" => $inStock, "size6" =>$size6, "size7" =>$size7, "size8" =>$size8, "size9" =>$size9, "size10" =>$size10, "size11" =>$size11, "size12" =>$size12, "gender" =>$gender]);
		$logAdminAddProduct($userID);
		return 1;
	} else {
		return -1;
	}	
}

function addProductToCart($useremail, $productid, $size, $qty){
	//1 means sucessful product add to user cart
	//-1 means user does not exist
	// -2 means product does not exist
	//-3 means not enough quantity
	$user = getUserID($useremail);
	if (sizeof($user) > 0){
		$verifyQty = DB::select("Product", "*", ["productID" => $productid]);
		if (sizeof($verifyQty) > 0){
			if ($verifyQty[0][$size] >= $qty){
			DB::insert("Cart", ["productID" =>$productid, "userID" => $user[0]["userID"], "productSize" => $size,"productQty" => $qty]);
			return 1;
			} else{
				return -3;
			}
		} else {
			return -2;
		}
	} else {
	return -1;
	}
} 

function viewAllCartItems($userID) {
	$data = DB::select("Cart", ["cartID", "productID", "productQty", "productSize"], ["userID" => $userID]); 
	foreach($data as $key => &$val){
	     $product = DB::select("Product", ["productName", "productCost", "productImage"], ["productID" => $val['productID']]);
	     $val['cartID'] = $val["cartID"];
	    $val['productName'] = $product[0]["productName"];
	    $val['productImage'] = $product[0]["productImage"];
	    $val['productCost'] = $product[0]["productCost"];
	    $val['totalCost'] = $val["productQty"] * $val['productCost'];
	    $brandID = getBrandIdFromProduct($val['productID']);
	    $brandName = getBrandName($brandID[0]["brandID"]);
	    $val['brandName'] = $brandName[0]["brandName"];
	    $val['brandName'] = "Nike";
	}
	return $data;
}

function viewAllOrders($userID){
	$data = DB::select("Order_data", ["productID", "quantity","price", "orderTime" ], ["userID" => $userID]);
	foreach($data as $key => &$val ){ 
		$productCost = DB::select("Product", ["productName", "productImage", "brandID"], ["productID" => $val['productID']]); 
		$val['brandName'] = getBrandName($productCost[0]["brandID"])[0]["brandName"];
	    $val['productName'] = $productCost[0]["productName"]; 
	    $val['productImage'] = $productCost[0]["productImage"]; 
	}
	return $data;
}

function getAllCartItems($userID) {
	$data = DB::select("Cart", ["cartID", "productID", "productQty", "productSize"], ["userID" => $userID]);
	foreach($data as $key => &$val ){ 
		$productCost = DB::select("Product", ["productName", "productCost"], ["productID" => $val['productID']]); 
	    $val['productCost'] = $productCost[0]["productCost"]; 
	}
	return $data;
}

function deleteItemFromCart($cartID){
	DB::delete("Cart", ["cartID" => $cartID]);
	return;
}

function getTotalCostFromCart($data){
	$totalCost = 0;
	foreach($data as $key => $val){
		$totalCost += $val["totalCost"];
	}
	return $totalCost;
}

function insertOrderDetails($userEmail, $cardName, $cardNumber, $cardExpiry, $cardCvc){
	$userID = getUserID($userEmail)[0]["userID"];
	$uIDs = DB::select('Order_data', ['uOrderID']);
	
	//Get latest UID
	if(sizeof($uIDs) == 0)
		$uID = 1;
	else 
		$uID = (DB::max('Order_data', 'uOrderID')) + 1;
	$cartitems = getAllCartItems($userID);
	// Add cart items to order
	foreach ($cartitems as $val => $item) {
		DB::insert('Order_data', ['uOrderID' => $uID, 'userID' => $userID, 'productID' => $item['productID'], 'quantity' => $item['productQty'], 'price' => $item['productQty']*$item['productCost'], 'orderStatus' => 'To Ship', 'orderTime' => date('Y-m-d H:i:s')]);
		DB::delete('cart',['cartID' => $item['cartID']]);
	}   

	return 1; 
}

function insertPaymentDetails($orderID, $cardName, $cardNumber, $cardExpiry, $cardCvc){
	$data = DB::insert("PaymentMethod", ['orderID' => $orderID, 'paymentType' => 'card', 'cardName' => $cardName, 'cardNumber' => $cardNumber, 'cardExpiry' => $cardExpiry, 'cardCvc' => $cardCvc]);  
}

function updatePaymentDetails($paymentID, $orderID){
	DB::update("PaymentMethod", ['orderID' => $orderID], ['paymentID' => $paymentID]);
}

function searchProduct($search, $brandName, $gender) {
	$brands = array();
	foreach($brandName as $items){
		$data = getBrandId($items);
		array_push($brands, $data[0]["brandID"]);
	}
	$data = DB::select("Product", ["productID","productImage", "productName", "productCost"], ["AND" =>["productName[~]" => $search, "brandID" => $brands, "gender" => $gender]]);
	return $data;
}

function viewAllProductByAdmin($email) {
	$data = DB::select("Product", ["productID", "productName"]);
	logAdminviewProduct($email);
	return $data;
}

function viewAllProduct() {
	$data = DB::select("Product", ["productID", "productImage", "productName", "productCost"]);
	return $data;
}

function viewAllProductByBrand($brandName) {
	$brand = getBrandId($brandName);
	$data = DB::select("Product", ["productID", "productImage", "productName", "productCost"], ["brandID[~]" => $brand[0]["brandID"]]);
	return $data;
}

function viewAllBrand() {
	$data = DB::select("Brand", ["brandName"]);
	return $data;
}

function viewAllUser($email) {
	$data = DB::select("User", ["userID", "userName", "userEmail"]);
	logAdminviewUser($email);
	return $data;
}

function getProductName($id) {
	$data = DB::select("Product", ["productName"], ["productID" => $id]);
	return $data;
}

function viewProduct($name) {
	$data = DB::select("Product", ["brandID", "productName", "productDescription", "productCost", "productImage", "inStock", "size5", "size6", "size7", "size8", "size9", "size10", "size11", "size12"], ["productName" => $name]);
	$brand = getBrandName($data[0]["brandID"]);
	$data[0]["brandID"] = $brand[0]["brandName"];
	if ($data[0]["inStock"] == 1){
		$value[0]["inStockValue"] = "In Stock";
		array_push($data,$value); 
	}else{
		$value[0]["inStockValue"] = "Out Of Stock";
		array_push($data,$value);
	} 
	return $data;
}

function editProduct($email, $id, $name, $brand, $description, $cost, $image, $inStock,$size6,$size7,$size8,$size9,$size10,$size11,$size12) {
	// 1 means Success product details update
	// -1 means Product does not exist

	$data = DB::select("Product", ["productName"], ["productID" => $id]);
	if (sizeof($data) == 0) {
		return -1;
	} else {
		$data1 = getBrandId($brand);
		DB::update("Product", ["brandID" => $data1[0]["brandID"], "productName" => $name, "productDescription" => $description, "productCost" => $cost, "productImage" => $image, "inStock" => $inStock, "size6" =>$size6, "size7" =>$size7, "size8" =>$size8, "size9" =>$size9, "size10" =>$size10, "size11" =>$size11, "size12" =>$size12], ["productID" => $id]);
		logAdminUpdateProduct($email);
		return 1;
	}	
}

function deleteProduct($userEmail, $id){
	$data = DB::delete("Product", ["productID" => $id]);
	logAdminDeleteProduct($userEmail);
	return;
}

function deleteUser($userEmail, $id){
	$data = DB::delete("User", ["userID" => $id]);
	logAdminDeleteUser($userEmail);
	return;
}

function getUserPoints($userID){
	$data = DB::select("User", ["points"], ["userID" => $userID]);
	return $data;
}

function getUser($id){
	$data = DB::select("User",["userEmail"], ["userID" => $id]);
	return $data;
}

function getUserID($email){
	$email = str_replace(' ', '',$email);
	$data = DB::select("User",["userID"], ["userEmail" => $email]);
	return $data;
}

function getPoints($email){
	$data = DB::select("User",["points"], ["userEmail" => $email]);
	return $data;
}

function checkUserEmail($email){
	$data = DB::select("User", ["userEmail"], ["userEmail" => $email]);
	if (sizeof($data) == 0) {
		return -1;
	} else {
		return 1;
	}
}

function updateUserEmail($currentEmail, $email){
	$data = DB::select("User",["userID","userEmail"], ["userEmail" => $currentEmail]);
	if (sizeof($data) == 0) {
		return -1;
	} else {
		DB::update("User",["userEmail" => $email], ["userEmail" => $currentEmail]);
		return $data[0]["userID"];
	}
}

function changePasswordWithOtp($otp, $pw){
		// 1 means password changed
		// -1 means otp does not exist
	$data = DB::select("User",["userEmail", "Password"], ["otp_code" => $otp]);
	if (sizeof($data) == 0) {
		return -1;
	} else {
		DB::update("User",["Password" => $pw], ["userEmail" => $currentEmail]);
		return 1;
	}
}

function updateUserOtp($otp, $email){
	// 1 means success otp updated
	// -1 means email does not exist
	$data = DB::select("User",["userEmail"], ["userEmail" => $email]);
	if (sizeof($data) == 0) {
		return -1;
	} else {
		DB::update("User",["otp_code" => $otp], ["userEmail" => $email]);
		return 1;
	}
}

function getUserOtp($email){
	// 1 means success otp updated
	// -1 means email does not exist
	$data = DB::select("User",["otp_code"], ["userEmail" => $email]);
	return $data;
}

function updateUserPassword($email, $oldpw, $newpw){
	$data = DB::select("User",["Password"], ["userEmail" => $email]);
	if (sizeof($data) == 0) {
		return -1;
	} else {
		if(validifyAgainstHashedCredential($oldpw, $data[0]["Password"])){
			DB::update("User",["Password" => $newpw], ["userEmail" => $email]);
			return 1;
		}
		else{
			return -1;
		}
	}
}

function showFeaturedBrand($brandID){
	$data = DB::select("Product", ["productID", "productImage"],["brandID" => $brandID] );
	return $data;
}

?>