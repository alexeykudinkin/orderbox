<?php 
  include('errorsX.php');
  include('responsesX.php');

  if (isset($_POST['submit'])) {
    if (empty($_POST['short_description']) || empty($_POST['cost'])) {

      push_error("Short description and cost may not be empty!");
      respond_unprocessable();

    } else {

      $short_description  = $_POST['short_description'];
      $full_description   = $_POST['full_description'];
      $cost               = $_POST['cost'];

      $short_description  = mysqli_real_escape_string($conn, stripslashes($short_description)); 
      $full_description   = mysqli_real_escape_string($conn, stripslashes($full_description)); 
      $cost               = mysqli_real_escape_string($conn, stripslashes($cost)); 

      $uid = $_SESSION['user'];

      $r = mysqli_query($conn, "INSERT INTO orders (short_description, full_description, cost, created_by) VALUES ('
$short_description', '$full_description', '$cost', '$uid')");

      if ($r) {
        header("location: orders.php");
      } else {
        push_error("Sorry! Failed to create new order!");
        respond_internal_error();
      }
    }
  }
  ?>
