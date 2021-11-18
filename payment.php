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
    <?php include('./functions/database_functions.php'); ?>
    <?php require_once('./functions/validation_functions.php'); ?>
    <?php redirectIfAdmin(); ?>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme JS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- <link href="css/payment.css" rel="stylesheet" /> -->
    <script src="js/payment.js"></script>

    <style type="text/css">
    .padding {
        padding: 5rem !important
    }

    .form-control:focus {
        box-shadow: 10px 0px 0px 0px #ffffff !important;
        border-color: #4ca746
    }
    .row{
        padding: 5px;
    }
    section{
        background-color: #efe3be;
    }
    .card-body{
        height: auto;
    }
</style>
</head>
<?php 
include "homepage/header-inc-2.php"; 
// validation variables
$email_sesh = $var_cname = $var_cnum = $var_cexp = $var_ccvc = "";
$error_msg = "";
$pay_ok = true;
echo 'in';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['email'])){
        if(isset($_POST['cardName']) || isset($_POST['cardNumber']) || isset($_POST['cardExpiry']) || isset($_POST['cardCvc'])){
            // validation code
            $email_sesh = emailValidate($_SESSION['email'],$error_msg,$pay_ok);
            $var_cname = usernameValidate($_POST['cardName'],$error_msg,$pay_ok);
            $var_cnum = creditCardNumValidate($_POST['cardNumber'], $error_msg, $pay_ok);
            $var_cexp = creditCardDateValidate($_POST['cardExpiry'], $error_msg, $pay_ok);
            $var_ccvc = numValidate($_POST['cardCvc'], $error_msg, $pay_ok);

            //if payment details validated is ok
            if($pay_ok){
                $result = insertOrderDetails($email_sesh, $var_cname, $var_cnum, $var_cexp, $var_ccvc);
                //send email
                if ($result == 1){
                    header("Location:payment_completed.php");
                }
            } else {
                echo $error_msg;
            }

        }
    } 
} 
?>
<body>
    <section class="py-5"> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
        <div class="padding">
            <div class="row">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="col-sm-8 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <span>CREDIT/DEBIT CARD PAYMENT</span> 
                                    </div> 
                                    <div class="col-md-6 text-right" style="margin-top: -5px;">   
                                        <img src="https://img.icons8.com/color/36/000000/amex.png"style="float: right;"> 
                                        <img src="https://img.icons8.com/color/36/000000/mastercard.png"style="float: right;"> 
                                        <img src="https://img.icons8.com/color/36/000000/visa.png" style="float: right;"> 
                                    </div>
                                </div>
                            </div>
                            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                                <div class="card-body" style="height: auto">
                                    <div class="row">
                                        <div class="form-group"> 
                                            <label for="numeric" class="control-label">CARD HOLDER NAME</label> 
                                            <input type="text" class="input-lg form-control" name="cardName"> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group"> 
                                            <label for="cc-number" class="control-label">CARD NUMBER</label> 
                                            <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="•••• •••• •••• ••••"  name="cardNumber" required> 
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="cc-exp" class="control-label">CARD EXPIRY</label> 
                                                <input id="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="•• / ••"  name="cardExpiry" required> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="cc-cvc" class="control-label">CARD CVC</label> 
                                                <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="•••" maxlength="3"  name="cardCvc" required> 
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="form-group"> 
                                            <input type="submit" class="btn btn-success btn-lg form-control" style="font-size: .8rem;"> 
                                        </div> 
                                    </div>  
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function($) {
                $('[data-numeric]').payment('restrictNumeric');
                $('.cc-number').payment('formatCardNumber');
                $('.cc-exp').payment('formatCardExpiry');
                $('.cc-cvc').payment('formatCardCVC');
                $.fn.toggleInputError = function(erred) {
                    this.parent('.form-group').toggleClass('has-error', erred);
                    return this;
                };
                // $('form').submit(function(e) {
                //     e.preventDefault();
                //     var cardType = $.payment.cardType($('.cc-number').val());
                //     $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
                //     $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
                //     $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
                //     $('.cc-brand').text(cardType);
                //     $('.validation').removeClass('text-danger text-success');
                //     $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
                // });
            });

        </script>

    </section>
</body>
<?php include "homepage/footer-inc.php"; ?>
</html> 