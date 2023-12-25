<?php
include 'koneksi.php';

if (isset($_GET['aa'])) {
    // data difilter terlebih dahulu & base64_decode berguna untuk mendeskripsi id yg sebelumnya di enkripsi/encoding
	$id = stripslashes(strip_tags(htmlspecialchars( base64_decode($_GET['aa']) ,ENT_QUOTES)));

	$query = "DELETE FROM pm_faktor WHERE id_faktor=?";
    $kriteria = $koneksi->prepare($query);
    $kriteria->bind_param("i", $id);
    
    if ($kriteria->execute()) {
    	echo "<script>alert('Data Berhasil Dihapus');location='home.php?page=kriteria';</script>";
    } else {
    	echo "<script>alert('Error');window.history.go(-1);</script>";
    }
}

$koneksi->close();
?>