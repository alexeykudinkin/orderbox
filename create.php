<?php

  session_start();

  include('auth.php');

  check_whether_authenticated_or_redirect("login.php");

  include('createX.php'); ?>

<html>
<head></head>
<body>

  <form action="" method="post">

    <label>Short</label>
    <input type="text" name="short_description">

    <label>Full</label>
    <input type="text" name="full_description">

    <label>Cost</label>
    <input type="number" name="cost">

    <input name="submit" type="submit" value="Post!">

  </form>

  <?php echo count(get_errors()) ?>
  <?php for ($i = 0; $i < count(get_errors()); ++$i) { ?>
    <span>
      <?php echo get_errors()[$i]; ?>
    </span>
  <?php } ?>

</body>
</html>

