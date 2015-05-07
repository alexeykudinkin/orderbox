<?php

  session_start();

  include('authX.php');

  check_whether_authenticated_or_redirect("login.php");

  include('connX.php');

  $conn = db_conn_open("vk");

  include('createX.php');
  include('csrf_guardX.php');

 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>OrderBox</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

      <!-- Unfortunately, it's used inside the header included -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

  <body>

    <div class="container">

      <?php include('headerX.php') ?>

      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <h2>Create</h2>

          <form class="form-horizontal" action="" method="post">

            <hr/>

            <div class="form-group">
              <label for="short_decription" class="col-sm-2 control-label">Short</label>
              <div class="col-sm-10">
                <input id="short_decription" type="text" name="short_description" placeholder="Short description" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label for="full_description" class="col-sm-2 control-label">Full</label>
              <div class="col-sm-10">
                <input id="full_description" type="text" name="full_description" placeholder="Full description" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label for="cost" class="col-sm-2 control-label">Cost</label>
              <div class="col-sm-10">
                <input id="cost" type="number" name="cost" placeholder="Estimated cost" class="form-control">
              </div>
            </div>

            <hr/>

            <input name="submit" type="submit" value="Post" class="btn btn-default col-sm-offset-6">

          </form>

        </div>

      </div>
    </div>

  </body>

</html>

<?php db_conn_close($conn); ?>
