<?php
  include('connX.php');
  include('cryptoX.php');
  include('errorsX.php');
  include('responsesX.php');

  ob_start();

  if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {

      push_error("Email or Password is invalid!");

    } else {

      $email    = $_POST['email'];
      $password = $_POST['password'];

      $conn = db_conn_open("vk");

      $email    = mysqli_real_escape_string($conn, stripslashes($email));
      $password = mysqli_real_escape_string($conn, stripslashes($password));

      $password_digest = hmac_sha256($password, $email); # Ok?

      if ($q = mysqli_query($conn, "SELECT * FROM users WHERE password_digest='$password_digest' AND email='$email'")) {

        $rs   = mysqli_num_rows($q);
        $user = mysqli_fetch_assoc($q);

        if ($rs == 1) {
          $_SESSION['user'] = $user['id'];
          header("location: orders.php");
        } else {
          push_error("Email or Password is invalid!");
        }

      } else {

        push_error("Sorry! We're experiencing some problems right now and can't sign-in you.");

      }

      db_conn_close($conn);
    }
  }

  ob_end_flush();
?>
