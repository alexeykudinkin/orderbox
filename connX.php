<?php 

  function db_conn_open() {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server   = $url['host'];
    $user     = $url['user'];
    $password = $url['pass'];

    $conn = mysql_connect($server, $username, $pass);

    if (!$conn)
      return NULL;

    $db = substr($url['path'], 1);

    mysql_select_db($db, $conn);

    return $conn;
  }

  function db_conn_close($conn) {
    mysql_close($conn);
  }
  
?>
