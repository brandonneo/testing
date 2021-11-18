<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Login" />
    <meta name="author" content="EYD0T" />
    <title>EYD0T</title>

    <?php include('./functions/zebra_session.php'); ?>
    <?php include('./functions/session_handles.php'); ?>
    <?php include('./functions/session_functions.php'); ?>
    <?php redirectIfNotAdmin(); ?>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme JS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
    
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style type="text/css">
    body{
        min-height:100vh;
        justify-content: center;
        align-items: center;
    }
    .wrapper{
        width:100%;
        height:100%;
        min-height: 100vh;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        background-image: url("https://media.istockphoto.com/vectors/tropical-plant-leaves-on-pastel-colored-background-vector-id1313326603?k=20&m=1313326603&s=612x612&w=0&h=uInrIGS4-1n5g9halO6Ao_w6XM8RBfVv4AfwUIlD3Xo=");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover; 
    }
    .wrapper .box{
        position: relative;
        width:280px;
        height:400px;
        box-shadow: 20px 20px 50px rgba(0,0,0,0.5);
        border-radius:15px;
        margin:30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-top:1px solid rgba(255,255,255,0.5);
        border-left:1px solid rgba(255,255,255,0.5);
        backdrop-filter: blur(5px);
        transform-style: preserve-3d;
        transform: perspective(800px) 
    }
    h2{
        color:#f5f5f5;
        font-size:2.5rem;
        text-align: center;
        font-family: 'Acme', sans-serif;
    }

    .box:hover{
        background-color: rgba(47, 92, 49, 0.8);
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
<?php include "homepage/merchant-header-inc.php"; ?>
<?php include "homepage/timeout_modal.php"; ?>
<body>
    <section class="py-0">
        <div class="wrapper">
            <div class="box">
                <a href="merchant_user.php" class="stretched-link"></a>
                <div class="description">
                    <h2>User</h2>     
                </div>
            </div>
            <div class="box">
                <a href="merchant_product.php" class="stretched-link"></a>
                <div class="description">
                    <h2>Product</h2>
                </div>
            </div>
        </div>
    </section>
</body>
<?php include "homepage/footer-inc.php"; ?>
</html> 