<?php 

  function db_conn_open() {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server   = $url['host'];
    $user     = $url['user'];
    $password = $url['pass'];
    $db       = substr($url['path'], 1);

    $conn = mysqli_connect($server, $user, $password, $db);

    return $conn;
  }

  function db_conn_close($conn) {
    mysqli_close($conn);
  }
  
?>
