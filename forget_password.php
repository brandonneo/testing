<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>EYD0T</title>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <?php include('./functions/zebra_session.php'); ?>
  <?php include('./functions/session_handles.php'); ?>
  <?php include('./functions/session_functions.php'); ?>
  <?php redirectIfAdmin(); ?>

  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" /> 
  <style>
    * {
      box-sizing: border-box;
    }

    input[type=text], select, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }

    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }

    input[type=button] {
      background-color: #04AA6D;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: center;
      align-items: center;
      width: 50%;
    }

    input[type=button]:hover {
      background-color: #45a049;
    }

    .login_container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 10% 20px 10% 20px;
      background-image: linear-gradient(
        rgba(128,128,128, 0.45), 
        rgba(128,128,128, 0.45)
      ),url(images/forget_password_banner.png);
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }

    .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
      text-align: right;
      text-decoration-color: white;
      color: white;
      font-weight: bold;
    }

    .col-75 {
      float: left;
      width: 45%;
      margin-top: 6px;
    }

    input.col-75 {
      float: center;
      width: 100%;
      align-items: center;
    }

    .form-py-5 {
      padding-top: 0rem !important;
      padding-bottom: 0rem !important;
    }

    h1{
      text-align: center;
      padding-right: 10%;
      color: white;
      font-weight: bold;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    #buttonbutton{
      margin-left: 25%;
      justify-content: center;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .col-25, .col-75, input[type=button] {
        width: 100%;
        margin-top: 1;
      }
      .col-25 {
        text-align: left;
      }
      #buttonbutton{
        float: center;
        align-items: center;
        width: 50%;
        margin-left: 25%;
        margin-right: auto;
      }
    }
    .elelment h2 {
      font-size: 2.5em;
      color: #fff;
      text-align: center;
      margin-top:2em;
      font-weight: 700;
    }
    .element-main {
      width:27%;
      background: #fff;
      margin:4em auto 0em;
      border-radius: 5px;
      padding:3em 2em;
    }
    .element-main h1 {
      text-align: center;
      font-size: 2.3em;
      color:#0086E5;
      font-weight: 700;
    }
    .element-main p {
      font-size: 1em;
      color: #696969;
      line-height: 1.5em;
      margin: 1.5em 0em;
      text-align:center;
    }
    .element-main input[type="text"],input[type="password"]  {
      font-size: 1em;
      color: #A29E9E;
      padding: 1em 0.5em;
      display: block;
      width: 95%;
      outline: none;
      margin-bottom: 1em;
      text-align:center;
      border: 1px solid #B9B9B9;
    }
    .element-main input[type="button"] {
      font-size: 1em;
      color: #fff;
      background:#0086E5;
      width: 50%;
      padding: 0.8em 0em;
      outline: none;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      border-bottom: 3px solid #045B99;
      display: block;
      margin: 1.5em auto 0;
    }
    .element-main input[type="button"]:hover{
      background:#1D1C1C;
      border-bottom: 3px solid #2F2F2F;  
      transition: 0.5s all;
      -webkit-transition: 0.5s all;
      -moz-transition: 0.5s all;
      -o-transition: 0.5s all;
    }
/*---copyrights--*/
.copy-right {
  margin: 9em 0em 2em 0em;
}
.copy-right p {
  text-align: center;
  font-size:1em;
  color:#fff;
  line-height: 1.5em;

}
.copy-right p a{
  color:#fff;
}
.copy-right p a:hover{
 color:#000;
 transition: 0.5s all;
 -webkit-transition: 0.5s all;
 -moz-transition: 0.5s all;
 -o-transition: 0.5s all;
}
/*--element end here--*/
/*--media quiries start here--*/
@media(max-width:1440px){

}
@media(max-width:1366px){

}
@media(max-width:1280px){
  .elelment h2 {
    margin-top: 1em;  
  }
  .copy-right {
    margin: 6em 0em 2em 0em;
  }
  .element-main {
    width: 30%;
  }
}
@media(max-width:1024px){
  .element-main {
    width: 37%; 
  }
}
@media(max-width:768px){
  .element-main {
    width: 49%;
  } 
  .elelment h2 {
    font-size: 2em;
  }
  .element-main {
    width: 60%;
  }
  .element-main h1 {
    font-size: 2em;
  }
}
@media(max-width:640px){

}
@media(max-width:480px){
  .element-main {
    width: 80%;
    padding: 3em 1.5em;
  } 
  .copy-right {
    margin: 5em 0em 2em 0em;
  }
  .copy-right p {
    font-size: 0.9em;
  }
}
@media(max-width:320px){
  .elelment h2 {
    font-size: 1.5em;
  }
  .element-main h1 {
    font-size: 1.5em;
  }
  .element-main {
    width: 80%;
    margin: 2em auto 0em;
    padding: 1.5em 1.5em;
  }
  .element-main p {
    font-size: 0.9em; 
  }
  .element-main input[type="button"] {
    font-size:0.9em;
    width: 75%;
  }
  .element-main input[type="text"],input[type="password"] {
    font-size: 0.9em;
    padding: 0.8em 0.5em;
  }
</style>

<script type="text/javascript">
  $(document).ready(function(){

    $('#txtotp').hide();
    $('#txtnewpassword').hide();
    $('#btnchangepassword').hide();
    $(document).on('click', '#btnrestpassword', function() {
      $('#txtotp').hide();
      $('#txtnewpassword').hide();
      $('#btnchangepassword').hide();
      if ($('#txtemail').val()=="") {
        alert("Please Enter E-mail Address");
        $('#txtemail').focus();
        return false;
      }
      $.ajax({
       url: 'functions/forget_password_post.php',
       async: false,
       method: 'POST',
       data: {
         fp: "forgetpassord",
         txtemail: $('#txtemail').val()
       },
       dataType: 'json',
       success: function(data) {
        if (data[0].recordexist == "SendEmail") {
          alert('OTP Code Send to Email');
          $('#txtotp').show();
          $('#txtnewpassword').show();
          $('#btnchangepassword').show();
          $('#btnrestpassword').hide();
          $('#txtemail').hide();
        } else if (data[0].recordexist == "NotFound") {
          alert('Error Try Again!');

        } else if (data[0].recordexist == "MailCannot") {
         alert('Sorry Mail Cannot be sent, try again');
       }
     },
     error: function(jqXHR, exception) {
      if (jqXHR.status == 500) {
        msg = 'Internal Server Error [500].';
        alert(msg)
      }
    }
  });

    });

    $(document).on('click', '#btnchangepassword', function() {
      $('#txtotp').hide();
      $('#txtnewpassword').hide();
      $('#btnchangepassword').hide();
      if ($('#txtotp').val()=="") {
        alert("Please Enter OTP Code");
        $('#txtotp').focus();
        return false;
      }
      if ($('#txtnewpassword').val()=="") {
        alert("Please Enter New Password");
        $('#txtnewpassword').focus();
        return false;
      }
      $.ajax({
       url: 'functions/forget_password_post.php',
       async: false,
       method: 'POST',
       data: {
         cp: "changepassord",
         txtotp: $('#txtotp').val(),
         txtemail: $('#txtemail').val(),
         txtnewpassword: $('#txtnewpassword').val()
       },
       dataType: 'json',
       success: function(data) {
        if (data[0].recordexist == "UpdatePassword") {
          alert('Password Changed Sucessfully!');
          window.location.href = "login_modal.php";
        } 
        else if (data[0].recordexist == "NotFound") 
        {
          alert('OTP Not Found');
        } 
      },
      error: function(jqXHR, exception) {
        if (jqXHR.status == 500) {
          msg = 'Internal Server Error [500].';
          alert(msg)
        }
      }
    });

    });

    
  });
</script>
</head>
<body>
	<?php  
  include "homepage/header-inc.php"; 
  ?> 


  <!-- Content Section--> 
  <section class="form-py-5">
    <div class="login_container">
     <div class="elelment" style="margin-top: -7%;">
      <div class="element-main">
        <h1>Forgot Password</h1>
        <form>
          <input type="text"  id="txtemail"  placeholder="Your e-mail address">
          <input type="text"  id="txtotp"  placeholder="Your OTP">
          <input type="password"  id="txtnewpassword"  placeholder="Your New Password">
          <input type="button" id="btnrestpassword" value="Reset my Password">
          <input type="button" id="btnchangepassword" style="background-color: #2a8d92;" value="Change my Password">
        </form>
      </div>
    </div>
  </div>
</section>
<!-- Content Section-->  

<?php  
include "homepage/footer-inc.php"; 
?>

<!-- Bootstrap core JS-->
<!-- Core theme JS-->

<?php  
include "homepage/header-inc-2.php"; 
?> 


<?php  
include "homepage/footer-inc.php"; 
?>

<!-- Bootstrap core JS-->
<!-- Core theme JS-->
<script src="js/scripts.js"></script>

</body>
</html>
