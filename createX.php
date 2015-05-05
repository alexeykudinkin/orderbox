<?php 
  include('conn.php');
  include('errors.php');

  if (isset($_POST['submit'])) {
    if (empty($_POST['short_description']) || empty($_POST['cost'])) {

      push_error("Short description and cost may not be empty!");
      respond_unprocessable();

    } else {

      $conn = db_conn_open("vk");

      if (!isset($conn)) {
        push_error("Couldn't connect to the Database!");
        respond_internal_error();
        exit;
      }

      $short_description  = $_POST['short_description'];
      $full_description   = $_POST['full_description'];
      $cost               = $_POST['cost'];

      $short_description  = mysql_real_escape_string(stripslashes($short_description)); 
      $full_description   = mysql_real_escape_string(stripslashes($full_description)); 
      $cost               = mysql_real_escape_string(stripslashes($cost)); 

      $user = $_SESSION['user'];

      $r = mysql_query("INSERT INTO orders (short_description, full_description, cost, created_by) VALUES ('
$short_description', '$full_description', '$cost', '$user')", $conn);

      if ($r) {
        header("location: orders.php");
      } else {
        push_error("Sorry! Failed to create new order!");
        respond_internal_error();
      }

      db_conn_close($conn);
    }
  }
  ?>
