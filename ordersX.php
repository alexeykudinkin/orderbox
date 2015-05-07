<?php 
  
  if (isset($_GET['from'])) {

  $from = mysql_real_escape_string(stripslashes($_GET['from']));

  $q = mysql_query("SELECT orders.*, users.email FROM orders JOIN users ON orders.created_by = users.id WHERE orders.id > $from ORDER BY orders.id DESC", $conn); 

} else {

  $q = mysql_query("SELECT orders.*, users.email FROM orders JOIN users ON orders.created_by = users.id ORDER BY orders.id DESC", $conn); 

}

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
