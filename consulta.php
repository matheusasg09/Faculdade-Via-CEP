<?php
if (isset($_POST['selectApi'])){
  $selectApi = $_POST['selectApi'];
  if ($selectApi == 'viacep') {
    require_once('viacep.php');
  } else if ($selectApi == 'postmon') {
    require_once('postmon.php');
  } else {
    require_once('cepaberto.php');
  }
  $address = getAddress();
}