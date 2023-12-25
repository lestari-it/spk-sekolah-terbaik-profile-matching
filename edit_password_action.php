<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {

    $password_lama = stripslashes(strip_tags(htmlspecialchars($_POST['password_lama'] ,ENT_QUOTES)));
    
    $password_sekarang  = cari_nilai("select password as nilai from master_user where id_user =".$_SESSION['id_user']."");

    
    if($password_sekarang != MD5($password_lama)){
        echo "<script>alert('Password Lama Tidak Sama');location='home.php?page=gantipassword';</script>";
    }else{

	$password_baru = stripslashes(strip_tags(htmlspecialchars($_POST['password_baru'] ,ENT_QUOTES)));
	
	$query = "UPDATE master_user SET password=? WHERE id_user=?";
    $kriteria = $koneksi->prepare($query);
    $kriteria->bind_param("si", MD5($password_baru), $_SESSION['id_user'] );
    
        if ($kriteria->execute()) {
        	echo "<script>alert('Data Berhasil Diubah');location='home.php?page=gantipassword';</script>";
        } else {
        	echo "<script>alert('Error');window.history.go(-1);</script>";
        }
    }
}

$koneksi->close();
?>