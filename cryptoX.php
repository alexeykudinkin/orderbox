<?php 

  function hmac_sha256($data, $key) {
    return hash_hmac("sha256", $data, $key);
  }

?>
