<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_sekolah = stripslashes(strip_tags(htmlspecialchars($_POST['id_sekolah'] ,ENT_QUOTES)));
	$nama_sekolah = stripslashes(strip_tags(htmlspecialchars($_POST['nama_sekolah'] ,ENT_QUOTES)));
	$no_npsn = stripslashes(strip_tags(htmlspecialchars($_POST['no_npsn'] ,ENT_QUOTES)));
	$email = stripslashes(strip_tags(htmlspecialchars($_POST['email'] ,ENT_QUOTES)));
    $alamat = stripslashes(strip_tags(htmlspecialchars($_POST['alamat'] ,ENT_QUOTES)));

	$query = "UPDATE master_sekolah SET nama_sekolah=?, no_npsn=?, email=?, alamat=? WHERE id_sekolah=?";
    $sekolah = $koneksi->prepare($query);
    $sekolah->bind_param("ssssi", $nama_sekolah, $no_npsn, $email, $alamat, $id_sekolah);
    
    if ($sekolah->execute()) {
    	echo "<script>alert('Data Berhasil Diubah');location='home.php?page=sekolah';</script>";
    } else {
    	echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

$db1->close();
?>