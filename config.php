<?php
$db = mysqli_connect("localhost","root","","dss_profile_matching");
if($host){
  echo "Koneksi berhasil";
 } else{
  echo "Koneksi gagal!" . mysqli_connect_error();
  die();
 }
?>
