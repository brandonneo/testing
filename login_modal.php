<?php
$log_ok = true;
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Login" />
    <meta name="author" content="EYD0T" />
    <title>EYD0T Login Page</title>

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
    <link href="css/login.css" rel="stylesheet" />
    <script>
        /*global $, document, window, setTimeout, navigator, console, location*/
        $(document).ready(function () {

            'use strict';

            var usernameError = true,
            emailError    = true,
            passwordError = true,
            passConfirm   = true;

    // Detect browser for css purpose
    if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
        $('.form form label').addClass('fontSwitch');
    }

    // Label effect
    $('input').focus(function () {

        $(this).siblings('label').addClass('active');
    });

    // Form validation
    $('input').blur(function () {

        // User Name
        if ($(this).hasClass('name')) {
            if ($(this).val().length === 0) {
                $(this).siblings('span.error').text('Please type your full name').fadeIn().parent('.form-group').addClass('hasError');
                usernameError = true;
            } else if ($(this).val().length > 1 && $(this).val().length <= 6) {
                $(this).siblings('span.error').text('Please type at least 6 characters').fadeIn().parent('.form-group').addClass('hasError');
                usernameError = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                usernameError = false;
            }
        }
        // Email
        if ($(this).hasClass('email')) {
            if ($(this).val().length == '') {
                $(this).siblings('span.error').text('Please type your email address').fadeIn().parent('.form-group').addClass('hasError');
                emailError = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                emailError = false;
            }
        }

        // PassWord
        if ($(this).hasClass('pass')) {
            if ($(this).val().length < 8) {
                $(this).siblings('span.error').text('Please type at least 8 charcters').fadeIn().parent('.form-group').addClass('hasError');
                passwordError = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                passwordError = false;
            }
        }

        // PassWord confirmation
        if ($('.pass').val() !== $('.passConfirm').val()) {
            $('.passConfirm').siblings('.error').text('Passwords don\'t match').fadeIn().parent('.form-group').addClass('hasError');
            passConfirm = false;
        } else {
            $('.passConfirm').siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
            passConfirm = false;
        }

        // label effect
        if ($(this).val().length > 0) {
            $(this).siblings('label').addClass('active');
        } else {
            $(this).siblings('label').removeClass('active');
        }
    });


    // form switch
    $('a.switch').click(function (e) {
        $(this).toggleClass('active');
        e.preventDefault();

        if ($('a.switch').hasClass('active')) {
            $(this).parents('.form-peice').addClass('switched').siblings('.form-peice').removeClass('switched');
        } else {
            $(this).parents('.form-peice').removeClass('switched').siblings('.form-peice').addClass('switched');
        }
    });


    // Form submit
    // $('form.signup-form').submit(function (event) {
    //     event.preventDefault();
    //     if (usernameError == true || emailError == true || passwordError == true || passConfirm == true) {
    //         $('.name, .email, .pass, .passConfirm').blur();
    //     } else {
    //         $('.signup, .login').addClass('switched');
            
    //         setTimeout(function () { $('.signup, .login').hide(); }, 700);
    //         setTimeout(function () { $('.brand').addClass('active'); }, 300);
    //         setTimeout(function () { $('.heading').addClass('active'); }, 600);
    //         setTimeout(function () { $('.success-msg p').addClass('active'); }, 900);
    //         setTimeout(function () { $('.success-msg a').addClass('active'); }, 1050);
    //         setTimeout(function () { $('.form').hide(); }, 700);
    //     }
    // });

    // Reload page
    // $('a.profile').on('click', function () {
    //     location.reload(true);
    // });


});

</script>
</head>

<body>
    <?php include "homepage/header-inc-2.php"; ?>

    <section class="py-5">
        <div class="container1">
         <section id="formHolder">
          <div class="row">
           <!-- Brand Box -->
           <div class="col-sm-6 brand">
            <a href="#" class="logo">All Eyes On You <span>.</span></a>

            <div class="heading">
             <h2>EYD0T</h2>
             <p>The ultimate shoe to see the world in</p>
         </div>

         <div class="success-msg">
             <p>Great! You are one of our members now</p>
             <a href="#" class="profile">Your Profile</a>
         </div>
     </div>


     <!-- Form Box -->

     <div class="col-sm-6 form">

        <!-- Login Form -->
        <div class="login form-peice">

         <form class="login-form" action="login_post.php" method="POST">
            <h2 id="header_text">Login</h2>
            <div class="form-group">
               <label for="loginemail">Email Address</label>
               <input type="email" name="loginemail" id="loginemail" required>
           </div>

           <div class="form-group">
               <label for="loginPassword">Password</label>
               <input type="password" name="loginPassword" id="loginPassword" required>
           </div>

           <div class="CTA">
               <input type="submit" name="loginSubmit" id="loginSubmit" value="Login">
               <a href="#" class="switch">I'm New </a><br><br>
               <a href="forget_password.php">Forgot Password?</a>
           </div>

       </form>
   </div><!-- End Login Form -->


   <!-- Signup Form -->
   <div class="signup form-peice  switched">
     <form class="signup-form" action="register_post.php" method="POST">
        <h2 id="header_text">Register</h2>
        <div class="form-group">
           <label for="name">Full Name</label>
           <input type="text" name="name" id="name" class="name" required>
           <span class="error"></span>
       </div>

       <div class="form-group">
           <label for="email">Email Address</label>
           <input type="email" name="email" id="email" class="email" required>
           <span class="error"></span>
       </div>

       <div class="form-group">
           <label for="password">Password</label>
           <input type="password" name="pw" id="pw" class="pass" required>
           <span class="error"></span>
       </div>

       <div class="form-group">
           <label for="passwordCon">Confirm Password</label>
           <input type="password" name="repw" id="repw" class="passConfirm" required>
           <span class="error"></span>
       </div>

       <div class="CTA">
           <input type="submit" value="Signup Now" id="submit" name="submit">
           <a href="#" class="switch">I have an account</a>
       </div>
       <!-- <h5 style="color: red;">enter error msg here</h5> -->
   </form>
</div><!-- End Signup Form -->

</div>
</div>
</section>
</div>
</section>

</body>
<?php include "homepage/footer-inc.php"; ?>
</html> 