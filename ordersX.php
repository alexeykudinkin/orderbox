<?php 
  
  if (isset($_GET['from'])) {

    $from = mysqli_real_escape_string($conn, stripslashes($_GET['from']));

    $q = mysqli_query($conn, "SELECT * FROM orders_mview AS orders WHERE orders.id > $from"); 

  } else {

    $q = mysqli_query($conn, "SELECT * FROM orders_mview");

  }

  if (!$q)
    push_error("Failed to fetch orders!");

  while ($q && $order = mysqli_fetch_assoc($q)) { 

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
