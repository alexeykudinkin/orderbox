<?php

  $errors = [];

  function push_error($msg) {
    global $errors;
    array_push($errors, $msg);
  }

  function get_errors() {
    global $errors;
    return $errors;
  }

  ?>
