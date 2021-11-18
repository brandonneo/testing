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
    article {
        font-family: Arial;
        font-size: 17px;
        padding: 8px;
    }

    h1{
        text-align: center;
        font-family: futura-pt,Tahoma,Geneva,Verdana,Arial,sans-serif;
        font-style: normal;
        font-weight: 700;
        letter-spacing: .200rem;
        line-height: 1.5rem;
        padding: 20px;
        padding-bottom: 35px;
    }
    .MHead{
        margin-top: 90px;
        color: white;
        font-family: futura-pt,Tahoma,Geneva,Verdana,Arial,sans-serif; 
        font-style: normal;
        font-weight: 700;
    }
    * {
     box-sizing: border-box;
 }

 .row {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
    margin: 0 -16px;
}

.col-sm-40 {
    -ms-flex: 40%; /* IE10 */
    flex: 40%;
}

.col-sm-50 {
    -ms-flex: 50%; /* IE10 */
    flex: 50%;
}

.col-sm-60 {
    -ms-flex: 60%; /* IE10 */
    flex: 60%;
}

.col-sm-40,
.col-sm-50,
.col-sm-60 {
    padding: 0 16px;
}

.container1 {
    background-color: #F2E9E4;
    padding: 5px 20px 15px 20px;
    border: 1px solid lightgrey;
    scroll-padding: 50px 0 0 50px;
    border-radius: 3px;
    width: 100%;
}

input[type=text] {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

label {
    margin-bottom: 10px;
    display: block;
}

.icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
}

.btn {
    background-color: #666666;
    color: white;
    padding: 12px;
    margin: 10px 0;
    border: none;
    width: 100%;
    border-radius: 3px;
    cursor: pointer;
    font-size: 17px;
}

.btn:hover {
    background-color: #999999;
}

a {
    color: #2196F3;
}

hr {
    border: 1px solid lightgrey;
}

span.price {
    float: right;
    color: grey;
}

iframe {
   height:  500px; 
}

#banner{
    width: 100%;
    height: 100%;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
    iframe {
       height:  100%; 
   }
   .row {
    flex-direction: column-reverse;
}

/*try*/
.col-sm-50{
    margin-bottom: 20px;
}
}

.sticky {
    position: -webkit-sticky; /* Safari */
    position: sticky;
    top: 0;
}

.frame {
  width: 90%;
  margin: 40px auto;
  text-align: center;
}
.custom-btn {
  width: 100%;
  height: 40px;
  color: #fff;
  border-radius: 5px;
  padding: 10px 25px;
  font-family: 'Lato', sans-serif;
  font-weight: 500;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
  box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
  7px 7px 20px 0px rgba(0,0,0,.1),
  4px 4px 5px 0px rgba(0,0,0,.1);
  outline: none;
}

/* 5 */
.btn-5 {
  width: 100%;
  height: 40px;
  line-height: 42px;
  padding: 0;
  border: none;
  background: rgb(255,27,0);
  background: linear-gradient(0deg, rgba(69, 70, 122, 0.8) 0%, rgba(25, 25, 55, 0.8) 100%);
}
.btn-5:hover {
  color: rebeccapurple;
  background: transparent;
  box-shadow:none;
}
.btn-5:before,
.btn-5:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
  background: #4A4E69;
  box-shadow:
  -1px -1px 5px 0px #fff,
  7px 7px 20px 0px #0003,
  4px 4px 5px 0px #0002;
  transition:400ms ease all;
}
.btn-5:after{
  right:inherit;
  top:inherit;
  left:0;
  bottom:0;
}
.btn-5:hover:before,
.btn-5:hover:after{
  width:100%;
  transition:800ms ease all;
}

/* Style inputs with type="text", select elements and textareas */
input[type=text], select, textarea {
    width: 100%; /* Full width */
    padding: 12px; /* Some padding */ 
    border: 1px solid #ccc; /* Gray border */
    border-radius: 3px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 20px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  width: 100%;
  height: 40px;
  line-height: 42px;
  padding: 0;
  border: none;
  background: rgb(255,27,0);
  background: linear-gradient(0deg, rgba(69, 70, 122, 0.8) 0%, rgba(25, 25, 55, 0.8) 100%);
}
input[type=submit]:hover {
    color: #f0094a;
    background: transparent;
    box-shadow:none;
}

input[type=submit]:before,
input[type=submit]:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
  background: #4A4E69;
  box-shadow:
  -1px -1px 5px 0px #fff,
  7px 7px 20px 0px #0003,
  4px 4px 5px 0px #0002;
  transition:400ms ease all;
}
input[type=submit]:after{
  right:inherit;
  top:inherit;
  left:0;
  bottom:0;
}
input[type=submit]:hover:before,
input[type=submit]:hover:after{
  width:100%;
  transition:800ms ease all;
}

.bg {
  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: repeat;
  background-size: cover;
}

.blkFont{
    color: black;
}

.smallIcon{
    width: 100%;
}

#email_us_banner{
    display: block;
    width: 100%;
    height: 100%;
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
    <?php  
    include "homepage/header-inc-2.php";
    include "homepage/timeout_modal.php";
    include "functions/database_functions.php";
    ?> 

    <!-- Content Section--> 
    <!-- <h1 class="MHead blkFont">CONTACT US</h1> -->
    <img id = "banner" src="/images/banner/contact_us_banner.png" alt="Contact Us Banner">
    <br><br>
    <section class="row">
        <section class="col-sm-50">
            <section class="container sticky">
                <section class="row">
                    <!-- Location & Contact -->
                    <iframe src="https://maps.google.com/maps?q=SIT%40NYP&t=&z=11&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <img src="images/misc/contact_us_description.png">
                </section>
            </section>
        </section>
        <section class="col-sm-50">
            <section class="container1">
                <form action="contactus_post.php" method="POST">
                    <!-- Emailing Feature -->
                    <h2>Email Us</h2>
                    <img id="email_us_banner" src="images/misc/header.png">
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fullname" placeholder="Your name...">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" placeholder="Your email..">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" placeholder="Write something..." style="height:200px"></textarea>
                    <div class="frame">
                      <input type="submit" class="custom-btn btn-5" value="Submit"> 
                  </div>
              </form>
          </section>
      </section>
  </section>
  <!-- Content Section-->  

  <?php  
  include "homepage/footer-inc.php"; 
  ?>

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  
</body>
</html>