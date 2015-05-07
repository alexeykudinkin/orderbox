
<div class="row">
  <a href="orders.php" style="text-decoration: none; color: #000000">
    <h1>OrderBox</h1>
  </a>

  <?php 
    $id   = $_SESSION['user'];

    $q    = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    $user = mysqli_fetch_assoc($q);
    ?>

  <h2 class="label label-default"><?php echo htmlspecialchars($user['email']) ?></h2>
  <h2 class="label label-default"><?php echo $user['balance'] ?> $</h2>

  <button class="btn btn-xs btn-default" onclick="location='logout.php'">Sign out</button>

</div>
