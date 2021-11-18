<?php 
   include('./functions/zebra_session.php');
   include('./functions/session_handles.php');
   include('./functions/session_functions.php');
   include('./functions/database_functions.php');
   redirectIfNotAdmin();
   $data = viewAllProductByAdmin($_SESSION['email']);
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <style>
  #btn {
    text-align:center;}
    th {
      background-color: #5c7cab !important;
      color: white;
    } 
  .alert {
  padding: 20px;
  background-color: #198754;
  color: white;
}
  </style>
  <script>
    $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });
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
</head>
<?php include "homepage/merchant-header-inc.php"; ?>
<?php include "homepage/timeout_modal.php"; ?>
<?php    if(isset($_SESSION['message'])){
    echo '<div class="alert">'.$_SESSION['message'].'
</div>';
    unset($_SESSION['message']);
}?>
<body>
  <section class="py-5">
    <table id="dtBasicExample" class="table table-striped table-bordered table-responsive-sm" cellspacing="0" width="100%">
      <thead>
        <tr class="bg-danger">
          <th class="th-sm">ID

          </th>
          <th class="th-sm">Name

          </th>
          <th id="btn" class="th-sm">Edit

          </th>
          <th id="btn" class="th-sm">Remove

          </th>

        </th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($data as $item){
      echo
      '<tr>
        <td>'.$item["productID"].'</td>
        <td>'.$item["productName"].'</td>
        <td id="btn"><a href="merchant_edit_product.php?id='.$item["productID"].'"<button type="button" class="btn btn-warning btn-rounded btn-sm my-0">Edit</button></span></a></td>

        <td id="btn"><a href="merchant_delete_product_post.php?id='.$item["productID"].'"<button type="button"  class="btn btn-danger btn-rounded btn-sm my-0 delete-button">Remove</button></span></a></td>
      </tr>';
    }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>ID
        </th>
        <th>Name
        </th>
        <th id="btn">Edit
        </th>
        <th id="btn">Remove
        </th>
      </tr>
    </tfoot>
  </table>
</section>
</body>
<?php include "homepage/merchant-footer-inc.php"; ?>
</html> 