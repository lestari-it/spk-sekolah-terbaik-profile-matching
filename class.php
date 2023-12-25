<?php
function cari_nilai($sql){
	$host     = "localhost";
	$username = "root";
    $password = "";
    $database = "dss_profile_matching";
    $koneksi  = mysqli_connect($host, $username, $password, $database);

  $hasil=mysqli_query($koneksi, $sql);
  $r=mysqli_fetch_array($hasil);

  return $r["nilai"];
}
?>