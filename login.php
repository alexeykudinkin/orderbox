<?php

  session_start();

  include('loginx.php');

  if (isset($_SESSION['user'])) {
    header("location: orders.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>OrderBox</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>

  <body>
    <div id="main">
      <h1>OrderBox</h1>

      <div id="login">
        <h2>Sign in</h2>

        <form action="" method="post">

          <label>Email:</label>
          <input id="email" name="email" placeholder="Email" type="text">
          <label>Password:</label>
          <input id="password" name="password" placeholder="Password" type="password">
          <input name="submit" type="submit" value="Sign in">

          <?php echo count(get_errors()) ?>
          <?php for ($i = 0; $i < count(get_errors()); ++$i) { ?>
            <span>
              <?php echo get_errors()[$i]; ?>
            </span>
          <?php } ?>
        </form>
      </div>
    </div>
  </body>
</html>
