<?php 

  session_start();  

  include('auth.php');
  include('connX.php');
  include('responses.php');

  include('configX.php');
   
  check_whether_authenticated_or_forbid();

  if (!empty($_POST['oid'])) {

    ob_start();

    $conn = db_conn_open("vk");

    $eid = $_SESSION['user'];
    $oid = $_POST['oid'];

    mysql_query("BEGIN");

    $a = mysql_query("SELECT @COST:=cost, @CUSTOMER:=created_by FROM orders WHERE id=$oid", $conn);
  
    # Lock
    $r = mysql_query("SELECT executed_by FROM orders WHERE id=$oid FOR UPDATE");

    if ($r && ($x = mysql_fetch_assoc($r)) && !empty($x['executed_by'])) {
      mysql_query("ROLLBACK", $conn);
      respond_conflict();
      exit;
    }

    $b = mysql_query("UPDATE orders SET executed_by=$eid WHERE id=$oid", $conn);

    # Lock
          mysql_query("SELECT * FROM users WHERE id=$eid FOR UPDATE");
    $c =  mysql_query("UPDATE users SET balance=balance + (@COST * (1 - $fee)) WHERE id=$eid", $conn);

    # Lock
          mysql_query("SELECT * FROM users WHERE id=@CUSTOMER FOR UPDATE");
    $d =  mysql_query("UPDATE users SET balance=balance - @COST WHERE id=@CUSTOMER", $conn);

    if ($a && $b && $c && $d) {
      mysql_query("COMMIT", $conn);
      header("location: orders.php");
      exit;
    } else {
      mysql_query("ROLLBACK", $conn);
    }

    ob_end_flush();
  }

  respond_unprocessable();

  ?>
