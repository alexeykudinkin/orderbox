<?php 

  session_start();

  include('auth.php');

  check_whether_authenticated_or_redirect("login.php");

  include('conn.php');

  $conn = db_conn_open("vk");

  if (!isset($conn)) {
    push_error("Couldn't connect to the Database!");
    respond_internal_error();
    exit;
  }

  include('csrf_guardX.php'); ?> 

<!DOCTYPE html>
<html>
  <head>
    <title>OrderBox</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  </head>

  <body>

    <div class="container">

      <?php include("headerX.php"); ?>
      
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <h2>Orders</h2>

          <hr/>

          <?php 
    
            $q = mysql_query("SELECT orders.*, users.email FROM orders JOIN users ON orders.created_by = users.id", $conn); 

            while ($order = mysql_fetch_assoc($q)) { 

              if (isset($order['executed_by']))
                continue;

              $short_description  = htmlspecialchars($order['short_description']);
              $full_description   = htmlspecialchars($order['full_description']);
              $customer           = htmlspecialchars($order['email']);
              $cost               = $order['cost'];
              $until              = $order['until'];
              $oid                = $order['id'];     ?>
  
              <div class="order">            
  
                <div class="panel panel-default">

                  <div class="panel-heading">
                    <h4><?php echo $short_description; ?></h4>
                  </div>
                
                  <div class="panel-body">
                    <p>
                      <?php echo $full_description; ?>
                    </p>
                  
                    <br/>

                    <span class="label label-info"><?php echo $cost; ?> $</span>
                    <span class="label label-info"><?php echo $customer; ?></span>

                    <form id="execute" action="execute.php" method="post" class="pull-right">
                      <input name="oid" type="hidden" value="<?php echo $oid ?>">
                      <input name="submit" type="submit" value="Execute" class="btn btn-default">
                    </form>

                  </div>

                </div>
                
                <hr/>

              </div>

          <?php 
            } 
            db_conn_close($conn); ?>

          <a class="btn btn-default" href="create.php">Create</a>

        </div>
      </div>

    </div>

  </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#execute").submit(function (e) {
        e.preventDefault();

        var order = $(this).closest("div.order");

        $.ajax({
          data: $(this).serialize(),
          type: $(this).attr('method'),
          url:  $(this).attr('action'),
          success: function (response, status, jqXHR) {
            if (jqXHR.status == 200) {
              order.remove();
            }
          }
        });
  
        return false;
      });
    });
  </script>

</html>

