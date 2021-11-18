<?php include('./functions/zebra_session.php');
include('./functions/session_handles.php');
include('./functions/session_functions.php');
include('./functions/database_functions.php');
redirectIfAdmin();
$brand = $_GET['brand'];
$brandName = str_replace(" ", "_", $brand);
if (isset($brand) && !empty($brand)){
    $data = viewAllProductByBrand($brand);
}
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
    <style>
    *{padding: 0; margin: 0; box-sizing: border-box;}
    body{height: 900px;}
    header {
        background-repeat: no-repeat; 
        background-size: cover; 
        background-
        text-align: center;
        width: 100%;
        height: auto;
        background-size: cover;
        background-attachment: fixed;
        position: relative;
        overflow: hidden;
        border-radius: 0 0 85% 85% / 30%;
    }
    header .overlay{
        width: 100%;
        height: 100%;
        padding: 50px;
        color: #FFF;
        text-shadow: 1px 1px 1px #333;   
    }

    h1 {
        font-family: 'Dancing Script', cursive;
        font-size: 80px;
        margin-bottom: 30px;
        text-align: center;
    }

    h3, p {
        font-family: 'Open Sans', sans-serif;
        margin-bottom: 30px;
    }

    button {
        border: none;
        outline: none;
        padding: 10px 20px;
        border-radius: 50px;
        color: #333;
        background: #fff;
        margin-bottom: 50px;
        box-shadow: 0 3px 20px 0 #0000003b;
    }
    button:hover{
        cursor: pointer;
    }
    
</style>
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

<body>
    <?php include "homepage/header-inc-2.php";?>
    <?php include "homepage/timeout_modal.php"; ?>
    <header style="background:url(images/brands/banner/<?php echo $brandName;?>.gif)">
        <div class="overlay">
            <h1><?php echo $brand ?></h1>
            <br>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($data as $item){
                    echo '<div class="col mb-5">
                    <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src='.$item["productImage"].' style="height:180px" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                    <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">'.$item["productName"].'</h5>
                    <!-- Product price-->
                    SGD $'.$item["productCost"].'
                    </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="product_modal.php?id='.$item["productID"].'">View More</a></div>
                    </div>
                    </div>
                    </div>';
                }?>
            </div>
        </div>
    </section>
    <?php include "homepage/footer-inc.php"; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html> 