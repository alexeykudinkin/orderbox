<?php

  session_start();

  include('authX.php');

  check_whether_authenticated_or_redirect("login.php"); 

  include('connX.php');

  $conn = db_conn_open("vk");

  if (!isset($conn)) {
    push_error("Couldn't connect to the Database!");
    respond_internal_error();
    exit;
  } 

  include('csrf_guardX.php');

  include('ordersX.php'); ?>
