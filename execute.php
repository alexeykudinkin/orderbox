<?php 

  session_start();  

  include('authX.php');
  include('connX.php');
  include('responsesX.php');

  include('configX.php');
   
  check_whether_authenticated_or_forbid();

  if (!empty($_POST['oid'])) {

    ob_start();

    $conn = db_conn_open("vk");

    $eid = $_SESSION['user'];
    $oid = $_POST['oid'];

    mysqli_query($conn, "BEGIN");

    $a = mysqli_query($conn, "SELECT @COST:=cost, @CUSTOMER:=created_by FROM orders WHERE id=$oid");
  
    # Lock
    $r = mysqli_query($conn, "SELECT executed_by FROM orders WHERE id=$oid FOR UPDATE");

    if ($r && ($x = mysqli_fetch_assoc($r)) && !empty($x['executed_by'])) {
      mysqli_query($conn, "ROLLBACK");
      respond_conflict();
      exit;
    }

    $b = mysqli_query($conn, "UPDATE orders SET executed_by=$eid WHERE id=$oid");

    # Lock
          mysqli_query($conn, "SELECT * FROM users WHERE id=$eid FOR UPDATE");
    $c =  mysqli_query($conn, "UPDATE users SET balance=balance + (@COST * (1 - $fee)) WHERE id=$eid");

    # Lock
          mysqli_query($conn, "SELECT * FROM users WHERE id=@CUSTOMER FOR UPDATE");
    $d =  mysqli_query($conn, "UPDATE users SET balance=balance - @COST WHERE id=@CUSTOMER");

    if ($a && $b && $c && $d) {
      mysqli_query($conn, "COMMIT");
      header("location: orders.php");
      exit;
    } else {
      mysqli_query($conn, "ROLLBACK");
    }

    ob_end_flush();
  }

  respond_unprocessable();

  ?>
