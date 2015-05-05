<?php 

  function db_conn_open($name) {
    $conn = mysql_connect("localhost", "root", "");

    if (!$conn)
      return NULL;

    mysql_select_db($name, $conn);

    return $conn;
  }

  function db_conn_close($conn) {
    mysql_close($conn);
  }
  
?>
