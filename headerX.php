
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

  
  <script type="text/javascript">
    function showAlert(a) {

      $(a).addClass("in");

      setTimeout(function () {
        hideAlert(a);
      }, 5000);
    }
                          
    function hideAlert(a) {

      $(a).removeClass("in");

      setTimeout(function () {
        $(a).remove();
      }, 1000);
    }

    $(document).ready(function () {
      $("#alert-section")
        .children()
        .each(function(_, a) { showAlert(a); });

    });
  </script>

  <div id="alert-section" style="position: absolute; top: 15%; left: 45%;">
    <?php for ($i = 0; $i < count(get_errors()); ++$i) { ?>
      <div id="alert" class="alert alert-warning fade" role="alert">
        <?php echo get_errors()[$i]; ?>
      </div>
    <?php } ?>
  </div>

</div>
