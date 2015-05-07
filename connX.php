<?php 

  function db_conn_open($name) {
    $conn = mysqli_connect("localhost", "root", "", $name) or die(mysqli_error($conn));
    return $conn;
  }

  function db_conn_close($conn) {
    mysqli_close($conn);
  }
  
?>
