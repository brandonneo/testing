<?php
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
include('./functions/zebra_session.php');
include('./functions/session_handles.php');
$email= $_SESSION['email'];
$user = getUserID($email);
$data = viewAllCartItems($user[0]["userID"]); 
$totalCost = getTotalCostFromCart($data);
$totalPoints = getUserPoints($user[0]["userID"]);
?>
<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Login" />
        <meta name="author" content="EYD0T" />
        <title>EYD0T</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
       <!-- Core theme JS-->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
         <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/checkout.css" rel="stylesheet" />
        <script>
        	// Remove Items From Cart
			$('a.remove').click(function(){
			  event.preventDefault();
			  $( this ).parent().parent().parent().hide( 400 );
			 
			})

			// Just for testing, show all items
			  $('a.btn.continue').click(function(){
			    $('li.items').show(400);
			  })
        </script>
        <script type="text/javascript">
    var idleTime = 0;
    $(document).ready(function () {
        // Increment the idle time counter every minute.
        var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

        // Zero the idle timer on mouse movement.
        $(this).mousemove(function (e) {
            
            idleTime = 0;
        });
        $(this).keypress(function (e) {
            
            idleTime = 0;
        });
    });

    function timerIncrement() {
        idleTime = idleTime + 1;
        if (idleTime > 10) { // 10 minutes
          var c = 0; max_count = 10; logout = true;
          if (<?php echo isset($_SESSION['email'])?'true':'false'; ?>) {
            startTimer();
        }
    }
}

function startTimer(){
    logout = true;
    c = 0; 
    max_count = 30;
    $('#timer').html(max_count);
    $('#logout_popup').modal('show');
    startCount();
}

function resetTimer(){
    logout = false;
    $('#logout_popup').modal('hide');
}

function timedCount() {
    c = c + 1;
    remaining_time = max_count - c;
    if( remaining_time == 0 && logout ){
        $('#logout_popup').modal('hide');
        location.href = 'logout.php';

    }else{
        $('#timer').html(remaining_time);
        t = setTimeout(function(){timedCount()}, 1000);
    }
}

function startCount() {
 timedCount();
}
</script>
    </head>
    <?php include "homepage/header-inc-2.php"; ?>
    <?php include "homepage/timeout_modal.php";?>
    <body>
        <section class="py-5">
<div class="wrap cf">
  <div class="heading cf">
    <h1>My Cart</h1>
    <a href="all_products.php" class="continue">Continue Shopping</a>
  </div>
  <div class="cart">
    <ul class="cartWrap">
      <li class="items odd">
        <?php 
        if (!empty($data)){
        foreach($data as $key => &$val){
    echo '<div class="infoWrap"> 
        <div class="cartSection">
        <img src=' .$val["productImage"]. ' alt="" class="itemImg" />
          <p class="itemNumber">'.$val["brandName"].'</p>
          <h3>'.$val["productName"].'</h3>
        
           <p> <input type="text"  class="qty" placeholder="'.$val["productQty"].'"/> x $'.$val["productCost"].'.00</p>
        
          <p class="stockStatus"> In Stock</p>
        </div>  
    
        
        <div class="prodTotal cartSection">
          <p>$'.$val["totalCost"].'.00</p>
        </div>
              <div class="cartSection removeWrap">
           <a href="checkout_delete_post.php?id='.$val["cartID"].'" class="remove">x</a>
        </div>
      </div>
      </li>
      <li class="items even">';
  }}
  else{
    echo '<h3>No products in your cart yet! Continue shopping!</h3>';
  }
        ?> 
      <!--<li class="items even">Item 2</li>-->
    </ul>
  </div>
  
  <div class="promoCode">
    <form action="checkout_points_post.php" method="POST">
<label for="promo">Offset using Points? Current: <?php echo $totalPoints[0]["points"];?> </label>
<input type="number" name="promo" value=0 placholder="Enter Points to Use" />
<button class="btn" type="submit"></button> 
</form>
</div>
  
  <div class="subtotal cf">
    <ul>
      <li class="totalRow"><span class="label">Subtotal</span><span class="value">$<?php echo $totalCost;?></span></li>
      
          <li class="totalRow"><span class="label">Free Shipping</span><span class="value">$0.00</span></li>

          <?php 
            if(isset($_SESSION['disc'])){
                if($_SESSION['disc'] > 0){
              echo '
              <li class="totalRow"><span class="label">Points Used</span><span class="value">$'.$_SESSION['disc'].'</span></li>';
          }}
          ?>

        <?php 
            if(isset($_SESSION['disc'])){
                if($_SESSION['disc'] > 0){
               echo '   <li class="totalRow final"><span class="label">Total</span><span class="value">$'.($totalCost - $_SESSION['disc']).'</span></li>
          <li class="totalRow"><a href="payment.php" class="btn continue">Checkout</a></li>';
                  } else {
                     echo '   <li class="totalRow final"><span class="label">Total</span><span class="value">$'.$totalCost.'</span></li>
          <li class="totalRow"><a href="payment.php" class="btn continue">Checkout</a></li>';
                  }
              }
              else{
                echo '   <li class="totalRow final"><span class="label">Total</span><span class="value">$'.$totalCost.'</span></li>
          <li class="totalRow"><a href="payment.php" class="btn continue">Checkout</a></li>';
          }
          ?>
         
    </ul>
  </div>
</div>
        </section>
    </body>
    <?php include "homepage/footer-inc.php"; ?>
</html> 