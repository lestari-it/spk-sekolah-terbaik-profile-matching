<?php
include 'koneksi.php';

if (isset($_GET['aa'])) {
    // data difilter terlebih dahulu & base64_decode berguna untuk mendeskripsi id yg sebelumnya di enkripsi/encoding
	$id = stripslashes(strip_tags(htmlspecialchars( base64_decode($_GET['aa']) ,ENT_QUOTES)));

	$query = "DELETE FROM master_sekolah WHERE id_sekolah=?";
    $sekolah = $koneksi->prepare($query);
    $sekolah->bind_param("i", $id);
    
    if ($sekolah->execute()) {
    	echo "<script>alert('Data Berhasil Dihapus');location='home.php?page=sekolah';</script>";
    } else {
    	echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

$koneksi->close();
?>