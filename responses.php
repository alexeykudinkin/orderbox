<?php

  # HTTP 400: Bad request
  function respond_unprocessable() {
    http_response_code(400);
  }

  # HTTP 500
  function respond_internal_error() {
    http_response_code(500);
  }

  ?>
