<?php
include('./functions/zebra_session.php');
require_once('./functions/session_handles.php');
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');

redirectIfAdmin();
// validation variables
$email = "";
$current_password = "";
$new_password = "";
$error_msg = "";
$change_ok = true;

  if (!empty($_POST["email"])) { // check if email has been posted
    // @@@@@@@  Start Main Validation Code

    //code block for email validation
  	$email = emailValidate($_POST["email"],$error_msg,$change_ok);
    // @@@@@@@  End Main Validation Code
  } else if(!empty($_POST["curr_pass"]) && !empty($_POST["pass"]) && !empty($_POST["conf_pass"])){
	// @@@@@@@  Start Main Validation Code
  	$current_password = passLogValidate($_POST["curr_pass"],$error_msg,$change_ok);
  	$new_password = passRegValidate($_POST["pass"],$_POST["conf_pass"],$error_msg,$change_ok);
	  // @@@@@@@  End Main Validation Code
  }
  
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="utf-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  	<meta name="description" content="Login" />
  	<meta name="author" content="EYD0T" />
  	<title>EYD0T</title>

  	<!-- Favicon-->
  	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  	<!-- Bootstrap icons-->
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<!-- Core theme CSS (includes Bootstrap)-->
  	<link href="css/styles.css" rel="stylesheet" />
  	<link href="css/history.css" rel="stylesheet" />
  	<script>
  		window.onload = function(){
  			"use strict";
		// Declare all variables
		var buttons = document.querySelectorAll(".tabs button");
		var current_button;
		var sections = document.querySelectorAll(".tabs section");
		var current_section;

		// show the first tabs
		buttons[0].classList.add("active");
		sections[0].classList.add("active");

		// set up onclick
		buttons.forEach(function(element){
			element.onclick = changeTab;
			}); // end forEach

		// get ".active" button
		function getCurrentButton() {
			buttons.forEach(function(element){
				if (element.classList.contains('active')) {
					current_button = element;
				} // end if
			}); // end forEach
			return current_button;
		} // end getCurrentButton()

		// get ".active" section
		function getCurrentSection() {
			sections.forEach(function(element){
				if (element.classList.contains('active')) {
					current_section = element;
				} // end if
			}); // end forEach
			return current_section;
		} // end getCurrentSection()

		// remove ".active" from inactive sections
		function hideTab() {
			console.log("hideTab() has been run");
			current_section.classList.remove("active");
			current_button.classList.remove("active");
		} // end hideTab()

		// add ".active" to active section
		function showTab(id) {
			console.log("showTab(id) has been run");
			sections.forEach(function(element){
				if (element.id === id) {
					element.classList.add("active");
		    } // end if
		  }); // end forEach
		} // end showTab(id)

		function changeTab() {
		//  console.log("changeTab() has been run");
		current_button = getCurrentButton();
		current_section = getCurrentSection();
		if (this.name !== current_button.name) {
			this.classList.add("active");
			hideTab();
			showTab(this.name);
			} // end if 
		} // end changeTab()

		
		}; // end window.onload
	</script>
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
    <style>
    input[type=email]{
    	width: 100%;
    }
    .bcontent {
    	margin-top: 10px;
    }
		/* ----------------
		optional fade-in for images
		---------------- */
		@media screen,handheld {
			@keyframes fadeIn {
				0% { opacity: 0; }
				100% { opacity: 1; }
			}

			.tabs img {
				animation: 3s fadeIn;
			}
			} /* / @media screen,handheld */

			/* ----------------------------*/

		/* ----------------
				tabs
				---------------- */
				@media all {
					.tabs {
						display: flex;
						flex-direction: row;
						row-wrap: nowrap;
						justify-content: flex-start;
						align-content: flex-start;
						align-items: flex-start;
						box-sizing: border-box;
					}
					.tabs * { box-sizing: inherit; }
					.tabs :focus {
						box-shadow: none;
						outline: none;
					}
					.tabs .button-list {
						flex: 1 0 auto;
						display: flex;
						flex-direction: column;
						justify-content: flex-start;
						align-content: stretch;
						align-items: stretch;
					}

					.tabs button {
						border-radius: 0;
						margin: 0;
						font-size: 1.5rem;
						padding: .75em .5em;
						border: 1px solid transparent;
						background: white;
						color: #666;
						transition: all .6s ease-in-out;
					}
					.tabs button:hover {
						color: #333;
					}
					.tabs button:not(:first-of-type) {
						border-top-color: #aaa;
					}
					.tabs button.active {
						background: #936d84;
						color: white;
					}

					.tabs section {
						flex: 2 1 auto;
						display: none;
						background: #F2E9E4;
						padding: 1rem;
						width: 100%;
						min-height: 100%;
					}
					.tabs section.active {
						display: block;
					}

					.tabs img {
						display: block;
						margin: 0 auto;
						width: 100%;
						min-width: 180px;
						max-width: 600px;
					}
					} /* / @media all */

					@media (max-width: 900px) {
						.tabs {
							flex-direction: column;
						}
						.tabs .button-list {
							flex-direction: row;
							min-width: 100%;
						}
						.tabs button:first-child:not(.active) {
							border-top: 1px solid #aaa;
							border-left: 1px solid #aaa;
						}
						.tabs button.active {
							border-right: 1px solid #aaa;
						}
						} /* / @media (max-width: 900px) */

						
						/* ---------------------------- */
						/* ---------------------------- */
						/* ---------------------------- */
						/* POSSIBLE LATER ADD-ON (HORIZONTAL LABELS) */

						@media (min-width: 901px) {
		/*
		.tabs button {
			transform: rotate(-90deg);
		  transform-origin: right bottom;
			white-space: nowrap;
		  justify-content: center;
		  align-content: center;
		  align-items: center;
		  position: relative;
		}
		.tabs button:nth-child(1) {
			top: -66px;
		}
		.tabs button:nth-child(2) {
			top: -24px;
		}
		.tabs button:nth-child(3) {
			top: 30px;
		}
		.tabs section {
				margin: 0;
		}
		*/
		} /* @media (min-width: 901px) */

		/* ----------------
				page setup
				---------------- */
				@media all {
					.text {
						background: #fff;
						background: rgba(255,255,255,.6);
						padding: 1rem 2rem;
					}

					body {
						color: #111;
						line-height: 1.2;
						letter-spacing: .2px;
					}
					figure {
						display: block;
					}
					figcaption {
						text-align: center;
						margin-top: .4em;
						color: #333;
						font-family: 'Indie Flower';
						font-size: 2em;
					}

					li a,
					p a {
						color: #016;
						text-decoration: none;
						border-bottom: 1px solid #666;
						margin: 0 0 -1px 0;
						display: inline-block;
					}
					li a:hover,
					p a:hover {
						border-bottom-color: #c40;
					}
					:focus,
					:selected,
					:target {
						outline: 1px dotted #c40;
						box-shadow: none;
					}
					:focus {
						box-shadow: 0 0 .3em 0 #fff;
					}

					h1 {
						color: black !important;
						text-shadow: 1px 1px #333;
						letter-spacing: 1px;
						text-align: center;
						font-size: 3.2rem;
						line-height: 1;
						max-width: 560px;
						margin: 1rem auto;
					}

					h2 {
						font-size: 1.8rem;
						line-height: 1.1;
						text-align: left;
					}

					button,
					a,
					a img {
						transition: .4s all ease-in-out;
					}

					a img {
						box-shadow: 0 0 .4em 1px #ccc;
					}
					a:hover img {
						box-shadow: 0 0 .4em 1px #333;
					}
					button {
						font-size: 3em;
						background-color: #016;
						color: #eee;
					}

					a,
					button,
					input[type=button],
					input[type=submit] {
						cursor: pointer;
						cursor: hand;
					}

					main > p:first-of-type:first-letter {
						font-family: 'Indie Flower';
						font-weight: bold;
						color: #016;
						text-shadow: 1px 1px #04c;
						float: left;
						font-size: 4.8em;
						margin: -.9rem .6rem 0 0;
					}

					main > p:first-of-type + p {
						clear: both;
					}

					ul li:not(:last-child) {
						margin-bottom: .6em;
					}

					footer {
						margin: 1em 0;
						font-size: .8em;
						text-align: center;
					}
					} /* @media all */
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
						color: black;
					}
					[name=pw]{
						text-decoration: underline;
						background-color: #dee2e6 !important;
						color: blue !important;
						display: inline-block !important;
						font-size: .8em !important;
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
					.col-15 {
						float: right;
						width: 25%;
						margin-top: 6px;
						text-align: center;
						text-decoration-color: white;
						font-weight: bold;
					}
					.col-75, .col-85 {
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

					.container2 {
						position: relative;
						max-width: 1000px;
						display: flex;
						justify-content: right;
						align-items: center;
						text-align: center;
						flex-wrap: wrap;
						/* Need to play around with z-index more with backgrounds*/
						z-index: 0;
					}

					.container2 .card2 {
						position: relative;
						display: flex;
						justify-content: center;
						align-items: center;
						flex-wrap: wrap;
						margin: 100px 0;
					}

					.container2 .card2:nth-child(odd) {
						flex-direction: row;
					}

					.container2 .card2:nth-child(even) {
						flex-direction: row-reverse;
						text-align: right;
					}

					.container2 .card2 .imgBx {
						position: relative;
						left: 25px;
						width: 400px;
						height: 400px;
						background: #482424;
						z-index: 1;
					}

					.container2 .card2:nth-child(even) .imgBx {
						left: -25px;
					}

					.container2 .card2 .imgBx img {
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						object-fit: cover;
					}

					.container2 .card2 .contentBx {
						position: relative;
						right: 25px;
						width: 400px;
						height: 400px;
						background: #bfb6b6;
						display: flex;
						justify-content: center;
						align-items: center;
						padding: 20px 60px 20px 100px;
					}

					.container2 .card2:nth-child(even) .contentBx {
						right: -25px;
						padding: 20px 100px 20px 60px;
					}

					.container2 .card2 .contentBx:before {
						content: '';
						position: absolute;
						top: -50px;
						bottom: -50px;
						left: 0;
						right: 0;
						background: #482424;
						z-index: -1;
					}

					.container2 .card2 .contentBx h2 {
						font-size: 30px;
						color: #fff;
					}

					.container2 .card2 .contentBx p {
						margin-top: 10px;
						color: #fff;
					}

					.container2 .card2 .contentBx a {
						display: inline-block;
						margin-top: 15px;
						color: #fff;
						text-decoration: none;
						padding: 10px;
						border: 1px solid #fff;
					}

					@media (max-width: 1000px) {
						.container2 .card2 {
							flex-direction: column;
							max-width: 350px;
							margin: 25px 25px;
						}
						
						.container2 .card2 .imgBx {
							width: 100%;
							height: 250px;
							left: 0;
						}
						
						.container2 .card2 .contentBx {
							width: 100%;
							height: auto;
							right: 0;
							padding: 30px;
							text-align: center;
						}
						
						.container2 .card2 .contentBx:before {
							top: 0;
							bottom: 0;
						}
						
						.container2 .card2:nth-child(even) .imgBx {
							left: 0;
						}
						
						.container2 .card2:nth-child(even) .contentBx {
							right: 0;
							padding: 30px;
						}
					}

					input[type=submit] {
						background-color: #04AA6D;
						color: white;
						padding: 12px;
						border: none;
						border-radius: 4px;
						cursor: pointer;
						float: center;
						align-items: center;
						width: 20%;
						margin-left: auto;
						margin-right: auto;
					}
					.card-horizontal {
						display: flex;
						flex: 1 1 auto;
					}
					.col-15: :after{
						content: "";
						clear: both;
						display: table;
					}
					.col-sm-5{
						align-items: left;
					}

					.col_half { width: 49%; }
					.col_third { width: 32%; }
					.col_fourth { width: 23.5%; }
					.col_fifth { width: 18.4%; }
					.col_sixth { width: 15%; }
					.col_three_fourth { width: 74.5%;}
					.col_twothird{ width: 66%;}
					.col_half,
					.col_third,
					.col_twothird,
					.col_fourth,
					.col_three_fourth,
					.col_fifth{
						position: relative;
						display:inline;
						display: inline-block;
						float: center;
						margin-right: auto;
						margin-bottom: 20px;
						color: #808080;
						text-align: center;	
						align-content: center;
					}
					.end { margin-right: 0 !important; }
					/* Column Grids End */

					.wrapper { 
						width: 980px; 
						margin: auto auto; 
						position: relative;
						align-items: center;
						justify-content: center;
						text-align: center;
					}
					.counter { background-color: #ffffff; padding: 20px 0; border-radius: 5px;}
					.count-title { font-size: 40px; font-weight: normal;  margin-top: 10px; margin-bottom: 0; text-align: center; }
					.count-text { font-size: 13px; font-weight: normal;  margin-top: 10px; margin-bottom: 0; text-align: center; }
					.fa-2x { margin: 0 auto; float: none; display: table; color: #4ad1e5; }

					@media screen and (max-width: 600px) {
						.col-25, .col-75, input[type=submit] {
							width: 100%;
							margin-top: 1;
						}
						.col-25 {
							text-align: left;
						}
						.col-15, .col-85{
							align-items: center;
						}
						.col-sm-7{
							padding-bottom: 2%;
						}
						.wrapper{
							text-align: unset;
						}
					</style>
					<script type="text/javascript">
						(function ($) {
							$.fn.countTo = function (options) {
								options = options || {};
								
								return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
			increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
			$self = $(this),
			loopCount = 0,
			value = settings.from,
			data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
							};
							
							$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

						jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
  	formatter: function (value, options) {
  		return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
  	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
  	var $this = $(this);
  	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
  	$this.countTo(options);
  }
});
</script>
</head>
<?php include "homepage/header-inc-2.php"; ?> 
<?php include "homepage/timeout_modal.php"; ?>
<body>
	<!-- Content Section--> 
	<section class="form-py-5">
		<h1>My Account</h1>
		<section class='tabs'>
			<div class='button-list'>
				<button name='profile'><i class="fa fa-fw fa-user"></i>Profile</button>
				<button name='history'><i class="fa fa-fw fa-history"></i>History</button>
				<button name='coins'><i class="fa fa-fw fa-money"></i> Coins</button>
			</div><!-- / .button-list -->

			<section id='profile'>
				<figure>
					<figcaption>Manage and protect your account</figcaption>
					<hr>
					<form action="myaccount_update.php" method="POST">
						<?php
						if (!empty($_POST["email"])){
							if($change_ok){
								echo "<p>Changing email.</p>";
							} else {
								echo $error_msg;
							}
						}
						?>
						<div class="row">
							<div class="col-25">
								<label for="email">Email</label>
							</div>
							<div class="col-75">
								<input type="email" id="email" name="email" placeholder="<?php echo $_SESSION['email'] ?>" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="email">Password</label>
							</div>
							<div class="col-75">
								<label for="email">************</label>
								<button name='pw'><a>Change password</a></button>
							</div>
						</div>
						<div class="row">
							<div class="col-25"></div>
							<div class="col-75">
								<input id="submitbutton" type="submit" value="Submit">
							</div>
						</div>
					</form>
				</figure>
			</section><!-- / #content1 -->

			<section id='history'>
				<figure>
					<figcaption>My Purchase</figcaption>
					<hr>
					<?php 
					
$user = getUserID($_SESSION['email'])[0]["userID"];
$data = viewAllOrders($user);
foreach($data as $item){
					echo '<div class="blog-card">
						<div class="meta">
							<div class="photo" style="background-image: url(images/products/'.str_replace(" ", "_",$item["productImage"]).'.jpg)"></div>
							<ul class="details">
								<li class="date">'.$item["orderTime"].'</li>
								<li class="tags">
									<ul>
										<li><a href="individual_brand.php?'.urlencode($item["brandName"]).'">'.$item["brandName"].'</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="description">
							<h1>'.$item["productName"].'</h1>
							<p> Quantity: '.$item["quantity"].'<br> Price: '.$item["price"].'</p>
							<p class="read-more">
								<a href="product_modal.php?id='.$item["productID"].'">Buy Again</a>
							</p>
						</div>
					</div>';
				};?>
				</figure>
			</section><!-- / #content2 -->

			<section id='coins'>
				<figure>
					<figcaption>My Coins</figcaption>
					<hr>
					<div class="wrapper">
						<div class="counter col_fourth">
							<i class="fa fa-fw fa-money"></i>
							<h2 class="timer count-title count-number" data-to="<?php echo getPoints($_SESSION['email'])[0]["points"];?>" data-speed="1500"></h2>
							<p class="count-text ">points in your account</p>
						</div>
					</div>
					<div class="container2">
						<div class="card2">
							<div class="imgBx">
								<img src="https://img.etimg.com/thumb/width-640,height-480,imgsize-70032,resizemode-1,msid-61094155/industry/services/retail/now-offline-stores-also-buy-products-from-flipkart-amazon-to-resell-them-at-market-prices/now-offline-stores-also-buy-online-to-resell-them-at-market-prices.jpg" alt="">
							</div>
							<div class="contentBx">
								<div class="content">
									<h2>How to Gain Coins?</h2>
									<p>Gain 1 Coin for every $1 spent.<br>
									For every 10 Coins, you can set $1 off your next purchase.</p>
								</div>
							</div>
						</div>
					</div>

				</figure>
			</section><!-- / #content3 -->

			<section id='pw'>
				<figure>
					<figcaption>Change Password</figcaption>
					<p style="text-align: center;">For your account's security, do not share your password with anyone else</p>
					<hr>
					<form action="myaccount_update.php" method="POST">
						<?php
						if (!empty($_POST["curr_pass"]) && !empty($_POST["pass"]) && !empty($_POST["conf_pass"])){
							if($change_ok){
								echo "<p>Changing password.</p>";
							} else {
								echo $error_msg;
							}
						}
						?>
						<div class="row">
							<div class="col-25">
								<label for="curr_pass">Current Password</label>
							</div>
							<div class="col-75">
								<input type="password" id="curr_pass" name="curr_pass" required>
								<a href="forget_password.php">Forgot your password?</a>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="pass">New Password</label>
							</div>
							<div class="col-75">
								<input type="password" id="pass" name="pass" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="conf_pass">Confirm Password</label>
							</div>
							<div class="col-75">
								<input type="password" id="conf_pass" name="conf_pass" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25"></div>
							<div class="col-75">
								<input id="submitbutton" type="submit" value="Submit">
							</div>
						</div>
					</form>
				</section><!-- / #content4 -->
			</section><!-- / .tabs -->

			<br />

		</section>
		<!-- Content Section-->  

		
		
		
	</body>
	<?php include "homepage/footer-inc.php";?>

	<!-- Bootstrap core JS-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Core theme JS-->
	<script src="js/scripts.js"></script>
	</html>
