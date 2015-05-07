<?php 

  session_start();

  include('authX.php');

  check_whether_authenticated_or_redirect("login.php"); 

  include('connX.php');
  include('errorsX.php');

  $conn = db_conn_open("vk"); ?>
 
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

      <?php include("headerX.php"); ?>
      
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <h2>Orders</h2>

          <hr/>

          <div class="orders">

            <?php include("ordersX.php"); ?>

          </div>

          <a class="btn btn-default" href="create.php">Create</a>

        </div>
      </div>

    </div>

  </body>

  <script type="text/javascript">
    $(document).ready(function () {

      // Bind to the execute-action
      $("#execute").submit(function (e) {
        e.preventDefault();

        var order = $(this).closest("div.order");

        $.ajax({
          data: $(this).serialize(),
          type: $(this).attr('method'),
          url:  $(this).attr('action'),

          success:  function (response, status, jqXHR) {
            if (jqXHR.status == 200) {
              order.remove();
            }
          },

          error:    function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 409) {
              alert("Seems, like someone have grabbed the job already!");
              location.reload();
            }
          }
        });
  
        return false;
      });

      // Bind auto-refresh
      setInterval(function() {
        var last = null;
        var lid = 0;

        $(".order")
          .find("input[name='oid']")
          .each(function () {
            if (lid < $(this).val()) {
              lid   = $(this).val();
              last  = $(this).closest("div.order");
            }
          })

        $.ajax({
          data: "from=" + lid,
          type: "GET",
          url:  "orders0.php",

          success:  function (response, status, jqXHR) {
            $("div.orders").prepend(response);
          },

        });

      }, 1000);
    });
  </script>

</html>

