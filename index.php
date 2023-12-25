<?php
session_start();
if( empty( $_SESSION['id_user'] ) ){
  //session_destroy();
  header('Location: ./login.php');
  die();
}
?>
