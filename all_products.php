<?php
include('./functions/zebra_session.php');
include('./functions/session_handles.php');
include('./functions/session_functions.php');
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
redirectIfAdmin();

// validation variables
$var_search = $var_brand = $var_gender = "";
$error_msg = "";
$search_ok = true;

//default data
$getAllBrands = viewAllBrand();
$data = viewAllProduct();

//if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//get brands filter and store into array
    $brands = array();
    foreach ($getAllBrands as $item){
        if (isset($_POST[$item["brandName"]])){
            $var_brand = alphaNumSpecValidate($_POST[$item["brandName"]], $error_msg, $search_ok); // validate brand
            array_push($brands, $var_brand);
        }
    } 

//get gender filter and store into array
    $gender = array();
    if (isset($_POST['men'])){
        $var_gender = alphaValidate($_POST['men'], $error_msg, $search_ok);
      array_push($gender, $var_gender);
  }
  if (isset($_POST['women'])){
    $var_gender = alphaValidate($_POST['women'], $error_msg, $search_ok);
      array_push($gender, $var_gender);
  }
  if (isset($_POST['unisex'])){
    $var_gender = alphaValidate($_POST['unisex'], $error_msg, $search_ok);
      array_push($gender, $var_gender);
  }

//if search filter is empty, set default as empty
  if (isset($_POST['search'])){
      $var_search = alphaNumSpecValidate($_POST['search'], $error_msg, $search_ok);
      $search = $var_search;
  } else {
    $search = "";
}

//if no brands filter chosen, set default as all
if(empty($brands)){
    foreach ($getAllBrands as $item){
        array_push($brands, $item["brandName"]);
    } 
}

//if no gender filter chosen, set default as all
if(empty($gender)){
    array_push($gender, 'men');
    array_push($gender, 'women');
    array_push($gender, 'unisex');
}

if (!empty($_POST['search']) || !empty($brands) || !empty($gender)){
    $data = searchProduct($search, $brands, $gender);

  //header("Location:merchant_user.php");
} else {
  header("Location:all_products.php");
}
//echo json_encode($data);
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
    
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- JavaScript-->
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/themes/ui-lightness/jquery-ui.css" type="text/css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    
    <style>
    .navbar{
        margin-bottom: 0;
    }
    .py-5{
        margin-top: -3.5%;
        padding-top: 0 0 0 0!important;
    }
    body{
        margin-top: 0%;
        padding-top: 0 0 0 0!important;
    }
    #searchform{
        background-color: #a4c5b6;
    }
    label{
        font-family: sans-serif;
    }
    #name{
        width: 85%;
        margin-left: 5%;
        margin-right: 10%;
    }
    #title1, #filter{
        margin-left: 5%;
    }
    #saveForm {
      font-size: 1em !important;
      color: #fff !important;
      background:#623d3d !important;
      width: 100% !important;
      height: auto !important;
      outline: none !important;
      border: none !important;
      border-radius: 5px !important;
      cursor: pointer !important;
      border-bottom: 3px solid #0b0c0c !important;
      display: block !important;
      margin: 1.5em auto 0 !important;
  }
  header {
    background-repeat: no-repeat; 
    background-size: cover; 
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

/*#saveForm {
    border: none;
    outline: none;
    padding: 10px 20px;
    border-radius: 50px;
    color: #333;
    background: #fff;
    margin-bottom: 50px;
    box-shadow: 0 3px 20px 0 #0000003b;
}*/

.btn-outline-dark:active{
    background-color: #91555f;
}
button:hover{
    cursor: pointer;
}
select{
    width: 100%;
}
#slideshow { 
  position: relative; 
  width: 100%;
  min-height: 350px; 
  height: 100%; 
  overflow: auto;
}

#slideshow > div { 
  position: absolute; 
  top: 0px; 
  left: 0px; 
  right: 0px; 
  bottom: 0px; 
}

#slide{
    width: 100%;
    height: 350px;
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
        $("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow > div:first')
  .fadeOut(1000)
  .next()
  .fadeIn(1000)
  .end()
  .appendTo('#slideshow');
}, 3000);
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
    
<div id="slideshow">
  <div>
    <img id="slide"src="images/banner/women_shoe_banner.png">
  </div>
  <div>
    <img id="slide" src="images/banner/men_shoe_banner.png">
  </div>
</div>
<!-- Section-->
<section class="py-5">
    <form id="searchform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <br>
        <div class="container"><br>
            <div class="row justify-content-md-center">
              <div class="col">
                <label class="desc" id="filter" for="Field106">
                    Search
                </label>
                <input id="name" name="search" type="text" class="field text fn" size="8" tabindex="1"></div>
            </div>
        </div>
        <br>
        <div class="container">
         <div class="row">
            <div class="col">
              <div id="filter">
                  <label class="desc" for="Field106">
                    Brand
                </label>
                <div>
                    <?php foreach ($getAllBrands as $item){
                      echo '<div class="form-check form-check-inline">
                      <input class="form-check-input" name="'.$item["brandName"].'" type="checkbox" value="'.$item["brandName"].'">
                      <label class="form-check-label" for="inlineCheckbox1">'.$item["brandName"].'</label>
                      </div>';
                  }?>
              </div>
</div></div><br>
<div class="row">
              <div class="col">
                  <div>
                      <label class="desc" id="filter" for="Field106">
                        Gender
                    </label>
                    <div id="filter">
                       <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" name="men" value="men">
                          <label class="form-check-label" for="inlineCheckbox1">Men</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" name="women" type="checkbox" value="women">
                          <label class="form-check-label" for="inlineCheckbox2">Women</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" name="unisex" type="checkbox" id="inlineCheckbox1" value="unisex">
                          <label class="form-check-label" for="inlineCheckbox1">Unisex</label>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row justify-content-md-center">
      <div class="col-4">
          <div>
            <input id="saveForm" name="submit" type="submit" value="Submit">
        </div>
    </div>
</div>
</div>
<br>
</form>
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php foreach ($data as $item){
            echo '<div class="col mb-5">
            <div class="card h-100">
            <!-- Product image-->
            <img class="card-img-top" src='. $item["productImage"] .' style="height:180px" />
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