<?php 

  session_start();  

  include('auth.php');
  include('conn.php');
  include('responses.php');
   
  check_whether_authenticated_or_forbid();

  if (isset($_POST['submit'])) {
    if (empty($_POST['oid'])) {

      respond_unprocessable();

    } else {

      $conn = db_conn_open("vk");

      $eid = $_SESSION['user'];
      $oid = $_POST['oid'];

      mysql_query("BEGIN");

      $a = mysql_query("SELECT @COST:=cost, @CUSTOMER:=created_by FROM orders WHERE id=$oid", $conn);
      $b = mysql_query("UPDATE orders  SET executed_by=$eid WHERE id=$oid", $conn);
      $c = mysql_query("UPDATE users   SET balance=balance + @COST WHERE id=$eid", $conn);
      $d = mysql_query("UPDATE users   SET balance=balance - @COST WHERE id=@CUSTOMER", $conn);

      if ($a && $b && $c && $d) {
        mysql_query("COMMIT", $conn);
        header("location: orders.php");
        exit;
      } else {
        mysql_query("ROLLBACK", $conn);
      }
    }

    respond_internal_error();
  }

  ?>
