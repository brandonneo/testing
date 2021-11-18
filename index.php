<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <?php include('./functions/zebra_session.php'); ?>
    <?php include('./functions/session_handles.php'); ?>
    <?php include('./functions/session_functions.php'); ?>
    <?php include('./functions/database_functions.php'); ?>
    <?php redirectIfAdmin(); ?>

    <?php
    if(isset($_SESSION['email'])){
        echo "<title>Welcome back to EYD0T</title>";
    } else {
        echo "<title>EYD0T</title>";
    }
    ?>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- JavaScript-->
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/themes/ui-lightness/jquery-ui.css" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
    
    #bgvid {
      min-width: 100%;
      object-fit: cover;
      width: 100vw;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
      background-image: 
      radial-gradient(
        circle at 36% 48%, #000000, 
        rgba(11, 39, 65, 0.32) 87%, 
        rgba(0, 0, 0, 0.0)
        );
  }

  @media (min-aspect-ratio: 16/9) {
    #bgvid {
        width:100%;
        height: auto;
    }
}

#header_text {
  text-align:center;
  color:white;
  font-family:'Raleway', sans-serif;
  font-weight:300;
  font-size:38px;
  height:50%;
  overflow:hidden;
  -webkit-backface-visibility: hidden;
  -webkit-perspective: 1000;
  -webkit-transform: translate3d(0,0,0);
}

#header_text_1, #header_text_2 {
  display:inline-block;
  overflow:hidden;
  white-space:nowrap;
  padding-top: 100px;
  padding-bottom: 100px;
}

#header_text_1 {
  animation: showup 7s infinite;
}

#header_text_2 {
  width:0px;
  animation: reveal 7s infinite;
}

#header_text_2 span {
  margin-left:-355px;
  animation: slidein 7s infinite;
}

@keyframes showup {
    0% {opacity:0;}
    20% {opacity:1;}
    80% {opacity:1;}
    100% {opacity:0;}
}

@keyframes slidein {
    0% { margin-left:-800px; }
    20% { margin-left:-800px; }
    35% { margin-left:0px; }
    100% { margin-left:0px; }
}

@keyframes reveal {
    0% {opacity:0;width:0px;}
    20% {opacity:1;width:0px;}
    30% {width:355px;}
    80% {opacity:1;}
    100% {opacity:0;width:355px;}
    }   80% {opacity:1;}
    100% {opacity:0;width:355px;}
}

.overlay {
    height: 100%;
    width: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 0;
    background: white;
    opacity: 0.5;
}

.py-0 {
  border-bottom: 5px solid lightgrey;
}

.py-0:after {
    content:'';
    position: absolute;
    left: 0;
    right: 0;
    margin: 0 auto;
    width: 0;
    height: 0;
    border-top: 25px solid lightgrey;
    border-left: 50px solid transparent;
    border-right: 50px solid transparent;
    color: rgba(0, 0, 0, 0.9);
}

/*

All grid code is placed in a 'supports' rule (feature query) at the bottom of the CSS (Line 77). 
        
The 'supports' rule will only run if your browser supports CSS grid.

Flexbox is used as a fallback so that browsers which don't support grid will still recieve an identical layout.

*/

@import url(https://fonts.googleapis.com/css?family=Montserrat:500);





.container1 {
    max-width: 100rem;
    margin: 0 auto;
    padding: 0 2rem 2rem;
}

.heading {
    font-family: "Montserrat", Arial, sans-serif;
    font-size: 4rem;
    font-weight: 500;
    line-height: 1.5;
    text-align: center;
    padding: 3.5rem 0;
    color: #1a1a1a;
}

.heading span {
    display: block;
}

.gallery {
    display: flex;
    flex-wrap: wrap;
    /* Compensate for excess margin on outer gallery flex items */
    margin: -1rem -1rem;
}

.gallery-item {
    /* Minimum width of 24rem and grow to fit available space */
    flex: 1 0 24rem;
    /* Margin value should be half of grid-gap value as margins on flex items don't collapse */
    margin: 1rem;
    box-shadow: 0.3rem 0.4rem 0.4rem rgba(0, 0, 0, 0.4);
    overflow: hidden;
}

.gallery-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 400ms ease-out;
}

.gallery-image:hover {
    transform: scale(1.15);
}

@supports (display: grid) {
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(18rem, 1fr));
        grid-gap: 2rem;
    }

    .gallery,
    .gallery-item {
        margin: 0;
    }
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

<body>
    <?php include "homepage/header-inc.php";?>
    <?php include "homepage/timeout_modal.php";?>
    
    
    <!-- Header-->
    <!-- <header class="bg-dark py-5"> -->
        <div class="overlay"></div>
        <video playsinline autoplay muted loop poster="images/misc/default_index_page.png" id="bgvid">
          <source src="video/Shoe_Commercial.mp4" type="video/mp4">
          </video>
          <!-- </header> -->
          <!-- Section-->
          <section class="py-0">
            <div id="header_text">
             <div id="header_text_1">Escape</div> 
             <div id="header_text_2"> 
              <span> and Make Memories  </span>
          </div>
      </div>
      <br><br><br><br><br><br><br><br>
  </section>

  <section class="py-5" style="background-color: white;">
    <div class="container1">

    <h2 class="heading">Featured Brand of the Time</span></h2>

    <div class="gallery">
        <?php $data = showFeaturedBrand(rand(2,11));
        foreach ($data as $item){
        echo '<div class="gallery-item">
            <a href="product_modal.php?id='.$item["productID"].'"><img class="gallery-image" src= ' . $item["productImage"]. ' alt="'.$item["productImage"].'"></a>
        </div>';}
?>
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