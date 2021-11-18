<?php
include('./functions/zebra_session.php');
include('./functions/session_handles.php');
include('./functions/session_functions.php');
require_once('./functions/database_functions.php');
redirectIfAdmin();

//default data
$data = viewAllBrand();
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="css/styles.css" rel="stylesheet" /> 
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
	<style type="text/css">

  body{
    background: #F2E9E4;
  }
.container1 {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(275px, 1fr));
  grid-gap: 2rem;
  margin: 2rem;
}

.card1 {
  height: 215px;
  position: relative;
  overflow: hidden;
  border-radius: 50%;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
  display: grid;
  grid-template-rows: 1fr 1fr;
  transition: 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
}

h3 {
  color: white;
  font-size: 24px;
  margin: 20px 0 0 20px;

}

#card_image {
  position: absolute;
  top: 0;
  height: 110%;
  width: 100%;
  z-index: -1;
  transition: 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.card1:hover {
  transform: scale(1.035, 1.035);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
}

.card1:hover #card_image {
  transform: translateY(-10px);
}
ransform: translateY(-10px);
}

	</style>
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
  <img src="images/banner/all_brands_banner.gif" style="width: 100%" />
	<section class="py-5">
<div class="container1">
  <?php foreach ($data as $item){
  echo '<div class="card1"><a href="individual_brand.php?brand='.urlencode($item["brandName"]).'" class="stretched-link"></a>
    <img id= "card_image" src="/images/brands/'. strtolower($item["brandName"]).'.png">
  </div>';
}?>

  
  </div>
</div>
    </section>
</body>
<?php  include "homepage/footer-inc.php"; ?>
<!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
