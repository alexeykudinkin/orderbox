<?php
  include('connX.php');
  include('cryptoX.php');
  include('errors.php');
  include('responses.php');

  ob_start();

  if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {

      push_error("Email or Password is invalid!");

    } else {

      $email    = $_POST['email'];
      $password = $_POST['password'];

      $conn = db_conn_open("vk");

      if (!isset($conn)) {
        push_error("Couldn't connect to the Database!");
        respond_internal_error();
        exit;
      }

      $email    = mysql_real_escape_string(stripslashes($email));
      $password = mysql_real_escape_string(stripslashes($password));

      $password_digest = hmac_sha256($password, $email); # Ok?

      $q = mysql_query("SELECT * FROM users WHERE password_digest='$password_digest' AND email='$email'", $conn);

      $rs   = mysql_num_rows($q);
      $user = mysql_fetch_assoc($q);

      if ($rs == 1) {
        $_SESSION['user'] = $user['id'];
        header("location: orders.php");
      } else {
        push_error("Email or Password is invalid!");
      }

      db_conn_close($conn);
    }
  }

  ob_end_flush();
?>
