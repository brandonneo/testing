<!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>EYD0T</title>

	<?php include('./functions/zebra_session.php'); ?>
	<?php include('./functions/session_handles.php'); ?>
	<?php include('./functions/session_functions.php'); ?>
	<?php redirectIfAdmin(); ?>

	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<!-- Bootstrap icons-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="css/styles.css" rel="stylesheet" /> 
	<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Exo+2:700');
	

	section {
		background: url("images/background/about_us_background.png");
		background-blend-mode: overlay;
		background-position: center;
		background-size: cover;
		text-align: center;
	}

	h1 {
		color: black;
		font-family: 'Exo 2', sans-serif;
		font-size: 46px;
		font-weight: 900;
		text-transform: uppercase;
	}

	.description {
		max-width: 700px;
		min-height: 200px;
		padding: 0;
		color: black;
		font-family: "Raleway", sans-serif;
		font-size: 14px;
		font-weight: 300;
		line-height: 22px;
		margin-left:auto;
		margin-right:auto;
	}

	.square {
		height: 60px;
		width: 60px;
		border: 1px dashed white;
		margin: 0 0 0 55px;
		/*   padding: 1px; resize squares */
		background-color: #4A4E69;
		display: inline-block;
		transform: rotateZ(44deg);
	}

	.icons{
		color: whitesmoke;
	}

	.icons: hover{
		color: black;
	}
	.square:hover {
		background-color: rgba(225, 221, 218, 1);
		transition: ease 0.2s;
		cursor: pointer;
	}

	.square .icons {
		position: absolute;
		transform: rotateZ(-44deg);
		margin: 20px 0 0px 21px;
	}

	.fa-facebook,
	.fa-twitter,
	.fa-dribbbler,
	.fa-youtube,
	.fa-dribbble {
		width: 11px;
		height: 22px;
		color: white;
		font-family: FontAwesome;
		font-size: 23px;
		font-weight: 400;
		text-transform: uppercase;
	}

	.square:hover .fa-facebook {
		color: rgba(59, 89, 152, 1)
	}

	.square:hover .fa-twitter {
		color: rgba(27, 182, 239, 1)
	}

	.square:hover .fa-dribbble {
		color: rgba(199, 59, 111, 1)
	}

	.square:hover .fa-youtube {
		color: rgba(229, 45, 39, 1)
	}

	@keyframes rotateInDownLeft {
		from {
			transform-origin: left bottom;
			transform: rotate3d(0,0,0, 0deg);
			opacity: 1;
		}

		to {
			-webkit-transform-origin: left bottom;
			transform-origin: left bottom;
			transform: ;
			transform:translateX(850px) translateY(-83px) rotate3d(0,0,1, -60deg);
			opacity: 1;
		}
	}
	@keyframes rotateOut {
		from {
			-webkit-transform-origin: center;
			transform-origin: center;
			opacity: 1;
		}

		to {
			-webkit-transform-origin: center;
			transform-origin: center;
			-webkit-transform: rotate3d(0, 0, 1, 90deg);
			transform: rotate3d(0, 0, 1, 90deg);
			opacity: 1;
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
<?php include "homepage/header-inc-2.php"; ?>
<?php include "homepage/timeout_modal.php";?>
<body>
	
	<section class="py-5">
		<h1>
			ABOUT US
			<br>
			⬩⬩⬩⬩⬩
		</h1>
		<article>
			<p class= "description">
				Our team created a secure, mobile-friendly E-Commerce website called EYD0T that will be dedicated exclusively to retail for footwear. From the various goods available, we choose to specialize in footwear since we feel that footwear is the cornerstone of a flawless outfit. It not only satisfies one's desire for fashion, but also reflects one's individuality and style. The website will serve as a one-stop platform for footwear from both leading international and local footwear merchants; allowing people to see how much ingenuity exists in our community and support them.
			</p>
		</article>
		<div class="social_icons">
			<div class="square">
				<div class="icons">
					<i class="bi bi-cart3" aria-hidden="true"></i>
				</div>
			</div>
			<div class="square">
				<div class="icons">
					<i class="bi bi-globe2" aria-hidden="true"></i>
				</div>
			</div>
			<div class="square">
				<div class="icons">
					<i class="bi bi-phone" aria-hidden="true"></i>
				</div>
			</div>
			<div class="square">
				<div class="icons">
					<i class="bi bi-shield-check" aria-hidden="true"></i>
				</div>
			</div>
		</div>
	</section> 
</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<?php  include "homepage/footer-inc.php"; ?>
</html>
