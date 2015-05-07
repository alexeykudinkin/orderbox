<?php

  session_start();

  include('authX.php');

  check_whether_authenticated_or_redirect("login.php"); 

  include('connX.php');

  $conn = db_conn_open("vk");

  include('csrf_guardX.php');
  include('errorsX.php');

  include('ordersX.php'); ?>
