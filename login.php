<?php

  session_start();

  include('loginX.php');

  if (isset($_SESSION['user'])) {
    header("location: orders.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>OrderBox</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  </head>

  <body>

    <div class="container">
      <h1>OrderBox</h1>

      <div class="col-md-offset-4 col-md-4">
        <h2>Sign in</h2>

        <form action="" method="post">

          <div class="form-group">
            <label for="email">Email:</label>
            <input id="email" name="email" class="form-control" placeholder="Email" type="text">
          </div>

          <div class="form-group">
            <label for="password">Password:</label>
            <input id="password" name="password" class="form-control" placeholder="Password" type="password">
          </div>

          <div class="form-group">
            <input name="submit" type="submit" value="Sign in" class="btn btn-default">
          </div>

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
