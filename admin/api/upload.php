<?php

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
  $target = '../../static/uploads/' . $_FILES['file']['name'];
  $source = $_FILES['file']['tmp_name'];
  if (move_uploaded_file($source, $target)) {
    echo substr($target, 5);
  }
}
