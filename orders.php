<?php 

  session_start();

  include('auth.php');
  include('conn.php');

  check_whether_authenticated_or_redirect("login.php");

  $conn = db_conn_open("vk");
    
  $q = mysql_query("SELECT orders.*, users.email FROM orders JOIN users ON orders.created_by = users.id", $conn); ?> 

  <div>
    <h2>Orders</h2>

    <a href="create.php">Create</a>

<?php 

    while ($order = mysql_fetch_assoc($q)) { 

      if (isset($order['executed_by']))
        continue;

      $short_description  = htmlspecialchars($order['short_description']);
      $full_description   = htmlspecialchars($order['full_description']);
      $customer           = htmlspecialchars($order['email']);
      $cost               = $order['cost'];
      $until              = $order['until'];
      $oid                = $order['id'];

      ?>
      
      <div>
        <h4><?php echo $short_description; ?></h4>
        <p><?php echo $full_description; ?></p>

        <br/>

        <span><?php echo $cost; ?></span>
        <span><?php echo $until; ?></span>
        <span><?php echo $customer; ?></span>

        <form action="execute.php" method="post">
          <input name="oid" type="hidden" value="<?php echo $oid ?>">
          <input name="submit" type="submit" value="Execute">
        </form>

      </div>
      
<?php 
    } 
    db_conn_close($conn); ?>

  </div>
