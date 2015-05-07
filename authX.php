<?php

  function is_authenticated() {
    return isset($_SESSION['user']);
  }

  function check_whether_authenticated_or_redirect($target) {
    if (!is_authenticated()) {
      header("location: $target");
    }
  }

  function check_whether_authenticated_or_forbid() {
    if (!is_authenticated()) {
      http_response_code(403);
    }
  }

  ?>
