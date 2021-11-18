<?php
require_once('./functions/session_handles.php');
require_once('./functions/database_functions.php');
require_once('./functions/sanitize_functions.php');
require_once('./functions/validation_functions.php');
redirectIfNotAdmin();

if (!empty($_GET['id'])){
  // Get Validation
  $error_msg = ""; 
  $edit_ok = true;
  $var_id = numValidate($_GET['id'], $error_msg, $edit_ok);
  // Get validation Done
  if($edit_ok){
    $id = getProductName($var_id);
    $data = viewProduct($id[0]["productName"]);
  } else {
    echo $error_msg;
  }

} else {
  header("Location:merchant_product.php");
}
echo json_encode($data);

?>
<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Login" />
  <meta name="author" content="EYD0T" />
  <title>EYD0T</title>


  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Core theme JS-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <!-- Bootstrap core JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>

  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <style>
  body{
    background-color: #e7e1d1;
  }
  form header, h5 {
    text-align: center;
    margin: 0 0 20px 0; 
  }
  form header div {
    font-size: 90%;
    color: #999;
  }
  form header h2 {
    margin: 0 0 5px 0;
  }
  form > div {
    clear: both;
    overflow: hidden;
    padding: 1px;
    margin: 0 0 10px 0;
  }
  form > div > fieldset > div > div {
    margin: 0 0 5px 0;
  }
  form > div > label,
  legend {
    width: 25%;
    float: left;
    padding-right: 10px;
  }
  form > div > div,
  form > div > fieldset > div {
    width: 75%;
    float: right;
  }
  form > div > fieldset label {
    font-size: 90%;
  }
  fieldset {
    border: 0;
    padding: 0;
  }

  input[type=text],
  input[type=email],
  input[type=url],
  input[type=password],
  input[type=file],
  #Field106,
  textarea {
    width: 70%;
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: 1px solid #eee;
    border-bottom: 1px solid #eee;
  }
  input[type=text],
  input[type=email],
  input[type=url],
  input[type=password],
  input[type=file],
  #Field106 {
    width: 70%;
  }
  input[type=text]:focus,
  input[type=email]:focus,
  input[type=url]:focus,
  input[type=password]:focus,
  textarea:focus {
    outline: 0;
    border-color: #4697e4;
  }

  @media (max-width: 600px) {
    form > div {
      margin: 0 0 15px 0; 
    }
    form > div > label,
    legend {
      width: 100%;
      float: none;
      margin: 0 0 5px 0;
    }
    form > div > div,
    form > div > fieldset > div {
      width: 100%;
      float: none;
    }
    input[type=text],
    input[type=email],
    input[type=url],
    input[type=password],
    input[type=file],
    #Field106,
    textarea,
    select {
      width: 100%;
    }
  }
  @media (min-width: 1200px) {
    form > div > label,
    legend {
      text-align: right;
    }
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
  <section class="py-5">
    <form action="merchant_edit_product_post.php" method="POST">
      <header>
        <h2>Edit Product</h2>
        <div>Bringing shoe to the world full of tracks</div>
      </header>
      <hr>

      <div>
        <label class="desc" id="title1" for="Field1">Image</label>
        <div>
         <input type="file" name="image" id="fileToUpload" value="hi">
       </div>
     </div>

     <div>
      <label class="desc" id="title1" for="Field1">Name</label>
      <div>
        <input id="Field1" name="name" type="text" class="field text fn" value="<?php echo $data[0]['productName']?>" size="8" tabindex="1">
      </div>
    </div>

    <div>
      <label class="desc" id="title106" for="Field106">
        Brand
      </label>
      <div>
        <select id="Field106" name="brand" class="field select medium" tabindex="11"> 
          <option value="<?php echo $data[0]['brandID']?>" selected><?php echo $data[0]['brandID']?></option>
          <option value="Adidas">Adidas</option>
          <option value="Nike">Nike</option>
          <option value="Puma">Puma</option>
        </select>
      </div>
    </div>

    <div>
      <label class="desc" id="title4" for="Field4">
        Description
      </label>

      <div>
        <textarea id="Field4" name="description" spellcheck="true" rows="10" cols="50" tabindex="4"><?php echo $data[0]['productDescription']?></textarea>
      </div>
    </div>

    <div>
      <label class="desc" id="title1" for="Field1">Price (SGD)</label>
      <div>
        <input id="Field1" name="price" value="<?php echo $data[0]['productCost']?>" type="text" class="field text fn" value="" size="8" tabindex="1">
      </div>
    </div>

    <div>
      <label class="desc" id="title106" for="Field106">
        In Stock
      </label>
      <div>
        <select id="Field106" name="instock" class="field select medium" tabindex="11"> 
          <option value="<?php echo $data[0]["inStock"] ?>"><?php echo $data[1][0]["inStockValue"] ?></option>
          <option value="1">In Stock</option>
          <option value="0">Out Of Stock</option>
        </select>
      </div>
    </div>

    
    <hr>
    <h5>Quantity for Each Size</h5>
    <div>
      <label class="desc" id="title1" for="Field1">Size 5</label>
      <div>
        <input id="Field1" name="size5" type="text" class="field text fn" value="<?php echo $data[0]['size5']?>" size="8" tabindex="1">
      </div>
    </div>
    <div>
      <label class="desc" id="title1" for="Field1">Size 6</label>
      <div>
        <input id="Field1" name="size6" type="text" class="field text fn" value="<?php echo $data[0]['size6']?>" size="8" tabindex="1">
      </div>
    </div>
    <div>
      <label class="desc" id="title1" for="Field1">Size 7</label>
      <div>
        <input id="Field1" name="size7" type="text" class="field text fn" value="<?php echo $data[0]['size7']?>" size="8" tabindex="1">
      </div>
    </div>
    <div>
      <label class="desc" id="title1" for="Field1">Size 8</label>
      <div>
        <input id="Field1" name="size8" type="text" class="field text fn" value="<?php echo $data[0]['size8']?>" size="8" tabindex="1">
      </div>
    </div>
    <div>
      <label class="desc" id="title1" for="Field1">Size 9</label>
      <div>
        <input id="Field1" name="size9" type="text" class="field text fn" value="<?php echo $data[0]['size9']?>" size="8" tabindex="1">
      </div>
    </div>
    <div>
      <label class="desc" id="title1" for="Field1">Size 10</label>
      <div>
        <input id="Field1" name="size10" type="text" class="field text fn" value="<?php echo $data[0]['size10']?>" size="8" tabindex="1">
      </div>
    </div>
    <div>
      <label class="desc" id="title1" for="Field1">Size 11</label>
      <div>
        <input id="Field1" name="size11" type="text" class="field text fn" value="<?php echo $data[0]['size11']?>" size="8" tabindex="1">
      </div>
    </div>
    <div>
      <label class="desc" id="title1" for="Field1">Size 12</label>
      <div>
        <input id="Field1" name="size12" type="text" class="field text fn" value="<?php echo $data[0]['size12']?>" size="8" tabindex="1">
      </div>
    </div>
    <hr>
    <div>
      <div>
        <input id="saveForm" name="saveForm" type="submit" value="Submit">
      </div>
    </div>

  </form>
</section>
</body>
<?php include "homepage/merchant-footer-inc.php"; ?>
</html> 