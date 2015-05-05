
<div class="row">
  <h1>OrderBox</h1>

  <?php 
    $id   = $_SESSION['user'];

    $q    = mysql_query("SELECT * FROM users WHERE id=$id", $conn);
    $user = mysql_fetch_assoc($q);
    ?>

  <h2 class="label label-default"><?php echo htmlspecialchars($user['email']) ?></h2>
  <h2 class="label label-default"><?php echo $user['balance'] ?> $</h2>

</div>
