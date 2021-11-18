<?php


function checkExpired(){
	//if expired -> logout, else update user last activity time
	if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) {
		echo '<div class="modal fade" id="logout_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div style="width:100%;height:100%;margin: 0px; padding:0px">
                    <div style="margin: 0px; padding:0px;float:">
                        <h4>Your session is about to expire!</h4>
                        <p style="font-size: 15px;">You will be logged out in <span id="timer" style="display: inline;font-size: 30px;font-style: bold">10</span> seconds.</p>              
                        <p style="font-size: 15px;">Do you want to stay signed in?</p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div style="margin-left: 30%;margin-bottom: 20px;margin-top: 20px;">
                <a href="javascript:;" onclick="resetTimer()" class="btn btn-success" aria-hidden="true">Yes, Keep me signed in</a>
                <a href="#" class="btn btn-danger" aria-hidden="true">No, Sign me out</a>
            </div>
        </div>
    </div>
</div>';
    	}
}

function loadUserTab() {
    if (isset($_SESSION['email'])) {
    	checkExpired();
        echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="index.php">EYD0T
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li> 
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="all_products.php">All Products</a></li>
						<li><a class="dropdown-item" href="all_brands.php">All Brands</a></li>
					</ul>
				</li>
			</ul>
			<form class="d-flex" action="checkout.php">
				<button class="btn btn-outline-light" type="submit">
					<i class="bi-cart-fill me-1"></i>Cart
				</button>
			</form>
			<ul class="navbar-nav">
	        	<li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		           <img src="images/profiles/'. $_SESSION['profile_pic'] .'.jpg" width="40" height="40" class="rounded-circle">
		          </a>
		          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		            <li><a class="dropdown-item" href="myaccount.php">My Account</a></li>
		            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
		          </ul>
        		</li>  
	    	</ul>
		</div>
	</div>
</nav>';
    } else {

        echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="index.php">EYD0T
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li> 
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="all_products.php">All Products</a></li>
						<li><a class="dropdown-item" href="all_brands.php">All Brands</a></li>
					</ul>
				</li>
				<li class="nav-item"><a class="nav-link" href="login_modal.php">Login / Register</a></li>
			</ul>
		</div>
	</div>
</nav>';
    }
}
?>

<?php loadUserTab(); ?>	